<?php 
include './adminpanel.php';
include '../partial/_dbconnect.php';

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['paybutton'])) {
    $product_id = $_POST['product_id'];
    $sql1 = "UPDATE products SET ispaymentdone=1 WHERE id=$product_id";
    $res1 = mysqli_query($conn, $sql1);
    if($res1) {
    } else {
        echo "<script>alert('Failed to update payment status.')</script>";
    }
}
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deletebutton'])) {
    $product_id = $_POST['product_id'];
    $sql1 = "DELETE FROM products WHERE id=$product_id";
    $res1 = mysqli_query($conn, $sql1);
    if($res1) {
    } else {
        echo mysqli_query($conn, $sql1);
        echo "<script>alert('Failed to update payment status.')</script>";
    }
}
echo '<div class="profuctheasder">
<h1>All Products</h1>
<select class="as" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">';
echo '<option value="?category=all" hidden>Sort By</option>';
echo '<option value="?category=all">ALL</option>';
echo '<option value="?sort=sortbyrange">Sort By range</option>';
echo '<option value="?sort=expensive">Expensive</option>';
echo '<option value="?sort=endingsoon">Ending Soon</option>';
echo '<option value="?sort=completed">Completed</option>';

// Fetch and display categories
$sql_categories = "SELECT DISTINCT category FROM products";
$result_categories = mysqli_query($conn, $sql_categories);
while ($row_category = mysqli_fetch_assoc($result_categories)) {
    $category = $row_category['category'];
    echo '<option value="?category=' . $category . '">' . $category . '</option>';
}
echo '</select>
</div>';

// Construct SQL query
$sql_products = "SELECT * FROM products";

// Apply category filter if category is selected
if(isset($_GET['category']) && $_GET['category'] != 'all') {
    $selectedCategory = $_GET['category'];
    $sql_products .= " WHERE category = '$selectedCategory'";
}

// Apply sorting option
if(isset($_GET['sort'])) {
    $sortOption = $_GET['sort'];
    // Append ORDER BY clause to SQL query based on the selected sorting option
    if ($sortOption == 'completed') {
        $cur_date = date("Y-m-d");
        $sql_products .= " WHERE Last_date <= '$cur_date'";
    }
    else if ($sortOption == 'sortbyrange') {
        $sql_products .= " ORDER BY st_bid_price";
    } elseif ($sortOption == 'expensive') {
        $sql_products .= " ORDER BY st_bid_price DESC";
    } elseif ($sortOption == 'endingsoon') {
        $sql_products .= " ORDER BY Last_date ASC";
        // Assuming Last_date is the column representing the ending date of the bid
    }
}

$result = mysqli_query($conn, $sql_products);

if (mysqli_num_rows($result) > 0) {
    echo '<table>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Name</th>';
    echo '<th>Owner</th>';
    echo '<th>UPI ID</th>';
    echo '<th>Photo</th>';
    echo '<th>Base Price</th>';
    echo '<th>Highest Price</th>';
    echo '<th>Highest Bid Price User</th>';
    echo '<th>Payment Status</th>';
    echo '<th>Delete</th>';
    echo '</tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['owner'] . '</td>';
        echo '<td>' . $row['upi_id'] . '</td>';
        echo '<td><img src="../images/' . $row['file_name'] . '" alt="' . $row['name'] . '"/></td>';
        echo '<td>' . $row['st_bid_price'] . '</td>';

        if ($row['highest_bid_price'] == 0) {
            echo "<td>No one added bid</td>";
            echo "<td>No one added bid</td>";
        } else {
            echo '<td>' . $row['highest_bid_price'] . '</td>';
            echo '<td>' . $row['highest_bid_price_users'] . '</td>';
        }

        
        $cur_date = date("Y-m-d");
        if($row['Last_date']>$cur_date){
            echo '<td>';
            echo "<p>Ongoing bid</p>";
            echo '</td>';
            echo '<td>';
            echo '<form method="POST" action="">';
            echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
            echo '<center><button type="submit" class="delete-button" name="deletebutton">DELETE</button></center>';
            echo '</form>';
            echo '</td>';
        }else{
            echo '<td>';
            if($row['ispaymentdone']==0){
                echo '<form method="post" action="">';
                echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
                echo '<center><button type="submit" class="pay-button" name="paybutton">Pay</button></center>';
                echo '</form>';
            } else {
                echo '<span class="payment-done">Payment done</span>';
            }
            echo '</td>';
            echo '<td><center><span class="notdel">SOLD</span></center></td>';
        }
        
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo 'No products found.';
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* CSS for Product List */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

th {
    background-color: #f2f2f2;
}

img {
    height: 80px;
    width: auto;
}
.profuctheasder{
    margin: 25px;
    display: flex;
    justify-content: space-between;
}
.as {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
    color: #333;
    font-size: 16px;
    cursor: pointer;
    transition: border-color 0.3s, background-color 0.3s, color 0.3s;
}

.as:hover {
    border-color: #007bff;
}

.as:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

.as option {
    background-color: #fff;
    color: #333;
}

.as option:hover {
    background-color: #007bff;
    color: #fff;
}

.as option:checked {
    background-color: #007bff;
    color: #fff;
}
.center {
    text-align: center;
}

.pay-button {
    padding: 5px 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}
.delete-button {
    padding: 5px 10px;
    background-color: red;
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

.pay-button:hover {
    background-color: #45a049;
}
.delete-button:hover {
    background-color: #45a049;
}

.payment-done {
    color: #4CAF50;
    font-weight: bold;
}
.notdel {
    text-align:center;
    color: red;
    font-weight: bold;
}

    </style>
</head>
<body>
    
</body>
</html>
