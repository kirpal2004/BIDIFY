<?php
session_start();
include 'partial\_dbconnect.php';
include 'partial\nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Bids</title>
    <link rel="stylesheet" href="./CSS/addtocart.css?v=<?php echo time(); ?>">
</head>
<body>
<?php
    echo '<div class="productmain">';
if (isset($_SESSION['email'])) {
    $email = ($_SESSION['email']);

    $sql1 = "SELECT * FROM usersallbid WHERE user_email = '$email'";
    
    $result = mysqli_query($conn, $sql1);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="partial">';
            echo '<div class="productasa">';
            echo '<h1 style="
            margin-top: 30px;
        ">All bids</h1>';
        echo '</div>';

            while ($row = mysqli_fetch_assoc($result)) {
                $productId = $row['product_id'];
                $sql2 = "SELECT * FROM products WHERE id = '$productId'";
                $result2 = mysqli_query($conn, $sql2);
                while($row1 = mysqli_fetch_assoc($result2)) {
                    echo '<div class="product-details">';
                    echo '<div class="product-d">';
                    echo "<img src='./images/" . $row1['file_name'] . "' alt='" . $row1['name'] . "'>";
                    echo '</div>';
                    echo '<div class="product-db">';
                    echo '<p style="
                    font-size: 24px;
                    font-weight: 700;
                ">' . $row1['name'] . '</p>';
                    echo '<p>'.'<span style="
                    font-size: 18px;
                    font-weight: 550;
                "> Base price : </span>' . $row1['st_bid_price'] .' $'. '</p>';
                    echo '<p>'.'<span style="
                    font-size: 18px;
                    font-weight: 550;
                "> Your Bid Price : </span>' . $row['bid_price'] .' $'. '</p>';
                    echo '<p> <span style="
                    font-size: 18px;
                    font-weight: 500;"> timing : </span>  '.$row['timing'].'  </p>';
                    echo '</div>';
                    echo '</div>';
                }

            }
            echo '</div>';

        } else {
            echo '<div class="productasa">';
            echo '<h1 style="
            margin-top: 30px;
        ">All bids</h1>';
            echo '<p class="product-details">Not Attend any bids </p>';
            echo '</div>';
        }
    } else {
        echo "Error executing query: " . mysqli_error($conn);
    }
    
    $sql1 = "SELECT * FROM usersallbid WHERE user_email = '$email'";
    
    $result = mysqli_query($conn, $sql1);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            
            $product_id_array = array();
            echo '<div class="partial">';
        $x=0;
            while ($row = mysqli_fetch_assoc($result)) {
                if (in_array($row['product_id'], $product_id_array)) {
                    continue; 
                }
                else {
                    $product_id_array[] = $row['product_id']; 
                }
                
                $productId = $row['product_id'];
                $sql2 = "SELECT * FROM products WHERE id = '$productId'";
                $result2 = mysqli_query($conn, $sql2);
                    while ($row1 = mysqli_fetch_assoc($result2)) {
                        $curr_date = date("Y-m-d"); 
                        if ($curr_date < $row1['Last_date'] ) {
                            continue;
                        }
                        $sql3 = "SELECT * FROM orders WHERE product_id = $productId AND user_email='$email'";
                        $result4 = mysqli_query($conn, $sql3);
                        if ($email == $row1['highest_bid_price_users']) {
                            $x++;
                            if($x==1){
                                echo '<div class="productasa">';
                                echo '<h1 style="
                                margin-top: 30px;
                                ">Winning bids</h1>';
                                echo '</div>';
                            }
                            echo '<div class="product-details">';
                            echo '<div class="product-d">';
                            echo "<img src='./images/" . $row1['file_name'] . "' alt='" . $row1['name'] . "'>";
                            echo '</div>';
                            echo '<div class="product-db">';
                            echo '<p style="
                            font-size: 24px;
                            font-weight: 700;
                                ">' . $row1['name'] . '</p>';   
                                echo '<p>'.'<span style="
                                font-size: 18px;
                                font-weight: 550;
                            "> Base price : </span>' . $row1['st_bid_price'] .' $'. '</p>'; 
                            echo '<p>' .'<span style="
                            font-size: 18px;
                            font-weight: 550;
                        ">Sold Price : </span>'. $row1['highest_bid_price'] .' $'. '</p>';
                            echo '<p style="font-size:18px" class="winning-bid">You won the bid</p>';
                            if(mysqli_num_rows($result4) > 0){
                                $row3 = mysqli_fetch_assoc($result4);
                                echo '<p style="
                                font-size: 15px;
                                font-weight: 600;
                            ">Delivery Status : '.$row3['delivery_status'].'</p>';
                            }else{
                                echo '<form action="checkout.php" method="POST">';
                                echo '<input type="hidden" name="st_bid_price" value="' . $row1['highest_bid_price'] . '">';
                                echo '<input type="hidden" name="name" value="' . $row1['name'] . '">';
                                echo '<input type="hidden" name="productId" value="' . $productId . '">';
                                echo '<input type="hidden" name="email" value="' . $email . '">';
                                echo '<button type="submit" class="add-product-btn" style="margin-top: 20px; margin-bottom: 7px; padding: 10px 40px; font-size: 18px;">Buy</button>';
                                echo '</form>';

                            }
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                    
            }
            echo '</div>';
            if($x==0){
                echo '<div style="margin-top: 00px;" class="productasa">';
            echo '<h1 style="
            margin-top: 30px;
        ">Winning bids</h1>';
            echo '<p class="product-details">No Winning bids found for the current user.</p>';
            echo '</div>';
            }
        } else {
            echo '<div style="margin-top: 00px;" class="productasa">';
            echo '<h1 style="
            margin-top: 30px;
        ">Winning bids</h1>';
            echo '<p class="product-details">No Winning bids found for the current user.</p>';
            echo '</div>';
        }
    } else {
        echo "Error executing query: " . mysqli_error($conn);
    }
}
echo '</div>';
include 'partial\footer.php';

?>
</body>
</html>