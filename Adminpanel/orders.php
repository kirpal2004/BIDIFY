<?php
// session_start();
include '../partial/_dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderId = $_POST['orderId'];
    $status = $_POST['delivery_status'];

    $sql = "UPDATE orders SET delivery_status = '$status' WHERE order_id = '$orderId'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>window.location.href = 'orders.php';</script>";
        exit();
    } else {
        echo "Error updating delivery status: " . mysqli_error($conn);
    }
}
?>

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

// Fetch and display product list
$sql = "SELECT * FROM orders";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<table>';
    echo '<tr>';
    echo '<th>Product Id</th>';
    echo '<th>Name</th>';
    echo '<th>Email</th>';
    echo '<th>Mobile Number</th>';
    echo '<th>Price</th>';
    echo '<th>Address</th>';
    echo '<th>Zip</th>';
    echo '<th>Delivery Status</th>';
    echo '</tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['product_id'] . '</td>';
        echo '<td>' . $row['user_name'] . '</td>';
        echo '<td>' . $row['user_email'] . '</td>';
        echo '<td>' . $row['mobilenum'] . '</td>';
        echo '<td>' . $row['price'] . '</td>';
        echo '<td>' . $row['address'] . '</td>';
        echo '<td>' . $row['zip'] . '</td>';
        echo '<td>
        <form action="orders.php" method="POST">
            <input type="hidden" name="orderId" value="' . $row['order_id'] . '">
            <select name="delivery_status" onchange="this.form.submit()">
                <option value="pending"' . ($row['delivery_status'] == 'pending' ? ' selected' : '') . '>Pending</option>
                <option value="on the way"' . ($row['delivery_status'] == 'on the way' ? ' selected' : '') . '>On the way</option>
                <option value="delivered"' . ($row['delivery_status'] == 'delivered' ? ' selected' : '') . '>Delivered</option>
            </select>
        </form>
    </td>';


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

.pay-button:hover {
    background-color: #45a049;
}

.payment-done {
    color: #4CAF50;
    font-weight: bold;
}

    </style>
</head>
<body>

</body>
</html>
