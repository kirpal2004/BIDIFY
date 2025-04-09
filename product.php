<?php
session_start();
include 'partial/_dbconnect.php';
include "partial/nav.php";

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $sql_product = "SELECT * FROM products WHERE id = '$productId'";
    $result_product = mysqli_query($conn, $sql_product);

    if ($result_product && mysqli_num_rows($result_product) > 0) {
        $row = mysqli_fetch_assoc($result_product);
        echo '<title>' . htmlspecialchars($row['name']) . '</title>';
    } else {
        echo '<title>Product Not Found</title>';
        echo '<div style="text-align:center; margin-top:50px; font-size:20px; color:red;">Product not found. Please check the link or try again.</div>';
        include 'partial/footer.php';
        exit();
    }
} else {
    echo '<title>Product Details</title>';
}
?>

<div style="text-align: center; margin-top: 20px;">
    <a href="#live-auction" class="join-auction-button" style="
        background-color: #ff4d4d;
        color: white;
        padding: 12px 25px;
        font-size: 18px;
        border: none;
        border-radius: 10px;
        text-decoration: none;
    ">🎥 Join Live Auction</a>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data-2012-2022.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.js"></script>
<link rel="stylesheet" href="./CSS/product.css?v=<?php echo time(); ?>">
<?php
if (isset($_POST["bid"]) && isset($_POST["product_id"])) {
    $bid = $conn->real_escape_string($_POST["bid"]);
    $product_id = $conn->real_escape_string($_POST["product_id"]);
    $st_bid_price = $conn->real_escape_string($_POST["st_bid_price"]);

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $sql = "SELECT highest_bid_price FROM products WHERE id = $product_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $current_highest_bid_price = $row["highest_bid_price"];

            if ($bid > $current_highest_bid_price && $bid > $st_bid_price) {
                $update_sql = "UPDATE products SET highest_bid_price = $bid WHERE id = $product_id";
                $update_sql1 = "UPDATE products SET highest_bid_price_users = '$email' WHERE id = $product_id";
                if ($conn->query($update_sql1) === TRUE && $conn->query($update_sql) === TRUE) {
                    $add_user_bid = "INSERT INTO usersallbid (user_email, product_id, bid_price) VALUES ('$email','$product_id','$bid')";
                    if (mysqli_query($conn, $add_user_bid)) {
                        echo '<script>window.location.href = `thankyoubid.php`;</script>';
                        exit();
                    } else {
                        echo "Error: " . $conn->error;
                    }
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo '<script>alert("Add Higher price Than Base Price Or Maximum Bid Price")</script>';
                echo '<script>window.location.href = `Categories.php`;</script>';
                exit();
            }
        } else {
            echo "Product not found!";
        }
    } else {
        echo "Please log in to place a bid!";
    }
}

if (isset($row)) {
    $last_date = $row['Last_date'];
    $_SESSION["loa"]=$last_date;
    $loa = $_SESSION["loa"];
    $st_bid_price = $row['st_bid_price'];
?>
<div class="product-container">
    <div class="product-images">
        <?php if (!empty($row['file_name'])) : ?>
            <img src="./images/<?php echo $row['file_name']; ?>" alt="<?php echo $row['name']; ?>">
        <?php endif; ?>
    </div>
    <div class="product-details">
        <h1 class="product-title"><?php echo $row['name']; ?></h1>
        <p class="product-description"><?php echo $row['description']; ?></p>
        <div class="assa">
            <p class="abc" style="font-weight: 800;">BASE PRICE</p>
            <p class="product-price"><?php echo $st_bid_price; ?>$</p>
            <?php
            if ($row['highest_bid_price'] == 0) {
                echo '<div style="font-weight: 800;">No One Added Bid.</div>';
            } else {
                echo '<div class="assa">
                        <p class="abc" style="font-weight: 800;">HIGHEST BID PRICE</p>
                        <p class="product-price">' . $row['highest_bid_price'] . '$</p>
                      </div>';
            }
            ?>
            <div class="clock"></div>
            <div class="inas" id="live-auction">
                <form action="product.php" method="post">
                    <input type="hidden" name="st_bid_price" value="<?php echo $st_bid_price; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                    <input type="hidden" name="product_images" value="<?php echo $row['file_name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $st_bid_price; ?>">
                    <input type="text" name="bid" placeholder="Enter bid amount">
                    <button type="submit" class="add-bidcart">Add bid</button>
                </form>
                <div class="clocktitle">
                    <h3>TIME LEFT</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'partial/footer.php'; ?>
<?php } ?>
<script>
window.addEventListener('load', (event) => {
    let clock;
    var loaValue = '<?php echo strval($loa); ?>';
    let currentDate = new Date();
    let targetDate = moment.tz(loaValue, "Asia/Kolkata");
    let diff = targetDate / 1000 - currentDate.getTime() / 1000;

    if (diff <= 0) {
        clock = (".clock").FlipClock(0, {
            clockFace: "DailyCounter",
            countdown: true,
            autostart: false
        });
        console.log("Date has already passed!")
    } else {
        clock = $(".clock").FlipClock(diff, {
            clockFace: "DailyCounter",
            countdown: true,
            callbacks: {
                stop: function() {
                    console.log("Timer has ended!")
                }
            }
        });
        setTimeout(function() {
            checktime();
        }, 1000);

        function checktime() {
            t = clock.getTime();
            if (t <= 0) {
                clock.setTime(0);
            }
            setTimeout(function() {
                checktime();
            }, 1000);
        }
    }
});

setInterval(function () {
    $.ajax({
        url: 'get_highest_bid.php',
        type: 'GET',
        data: { product_id: <?php echo $row['id']; ?> },
        success: function (data) {
            $('.product-price').eq(1).text(data + '$');
        }
    });
}, 5000);
</script>