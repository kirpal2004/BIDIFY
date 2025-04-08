<?php
session_start();
include 'partial/_dbconnect.php';
include 'partial/nav.php';
$email = $_SESSION['email'];
$name = $_SESSION['username'];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["address"]) && isset($_POST["mobile"]) && isset($_POST["city"])) {
    $name = isset($_POST['name']) ? $_POST['name'] : $_SESSION['username'];
    $email = isset($_POST['email']) ? $_POST['email'] : $_SESSION['email'];
    $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
    $add = isset($_POST['address']) ? $_POST['address'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $zip = isset($_POST['zipCode']) ? $_POST['zipCode'] : '';
    $address = $add . $city . $zip;
    $price = isset($_POST['amount']) ? $_POST['amount'] : 0;
    $price=$price/100;
    $id = isset($_POST['productid']) ? $_POST['productid'] : 0;
    // $order_id = isset($_POST['order_id']) ? $_POST['order_id'] : 0;
    $payment_id = isset($_POST['payment_id']) ? $_POST['payment_id'] : 0;
    $sql2 = "UPDATE winners SET paymentstatus=1 WHERE user_email='$email' AND product_id='$id'";
    $result2 = mysqli_query($conn, $sql2);
    $order_id = $email . date('YmdHis');
    $sql = "INSERT INTO `orders`(`user_email`, `user_name`, `product_id`, `price`, `address`, `zip`, `mobilenum`,`order_id`,`payment_id`) VALUES ('$email','$name','$id','$price','$add','$zip','$mobile','$order_id','$payment_id')";
    $result = mysqli_query($conn, $sql);
    $result2 = mysqli_query($conn, $sql2);
    if ($result1 && $result && $result2) {
        echo '<script>window.location.href = "thankyouorder.php"</script>';
    } else {
        echo '<script>window.location.href = "thankyouorder.php"</script>';
    }
}
?>
