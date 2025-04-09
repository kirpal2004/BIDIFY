<?php
session_start();
include 'partial/_dbconnect.php';
include 'partial/nav.php';
$email = $_SESSION['email'];
$name = $_SESSION['username'];
// $price = $_POST["st_bid_price"];
// $productid = $_POST["productId"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="./css/checkout.css"> -->
    <link rel="stylesheet" href="./css/checkout.css?v=2">

</head>
<body>

<div class="whole">
    <div class="add1">ADDRESS DETAILS</div>
    <form id="paymentForm">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required />

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required />

        <label for="mobile">Mobile no:</label>
        <input type="text" id="mobile" name="mobile" value="<?php echo htmlspecialchars($formData['mobile'] ?? ''); ?>" required />

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($formData['address'] ?? ''); ?>" required />

        <label for="city">City:</label>
        <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($formData['city'] ?? ''); ?>" required />

        <label for="zipCode">ZIP Code:</label>
        <input type="text" id="zipCode" name="zipCode" value="<?php echo htmlspecialchars($formData['zipCode'] ?? ''); ?>" required />

        <button type="submit" id="rzp-button1" class="buynow">Place Order</button>
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    // Mobile number validation function
    function validateMobileNumber(mobileNumber) {
        var re = /^\d{10}$/;
        return re.test(mobileNumber);
    }

    // ZIP code validation function
    function validateZIPCode(zipCode) {
        var re = /^\d{6}$/;
        return re.test(zipCode);
    }

    // Form submission event listener
    document.getElementById('paymentForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var mobileNumber = document.getElementById('mobile').value;
        var zipCode = document.getElementById('zipCode').value;
        let x = 0;

        // Check if mobile number is valid
        if (!validateMobileNumber(mobileNumber)) {
            // Prevent form submission
            alert('Please enter a valid 10-digit mobile number.');
        } else if (!validateZIPCode(zipCode)) {
            // Prevent form submission
            alert('Please enter a valid 6-digit ZIP code.');
        } else {
            x = 1;
        }

        if (x == 1) {
            var amount = <?= $_POST["st_bid_price"] ?> * 100;
            var productid = <?= $_POST["productId"] ?>;
            var name = $("#name").val();
            var email = $("#email").val();
            var mobile = $("#mobile").val();
            var address = $("#address").val();
            var city = $("#city").val();
            var zipCode = $("#zipCode").val();

            var options = {
                "key": "rzp_test_1g0ZiJbwkPpbl8",
                "amount": amount,
                "currency": "INR",
                "name": "BIDIFY",
                "description": "Test Transaction",
                "image": "ima.png",
                "handler": function(response) {
                    $.ajax({
                        url: 'order.php',
                        type: 'POST',
                        data: {
                            'productid': productid,
                            'amount': amount,
                            'name': name,
                            'email': email,
                            'mobile': mobile,
                            'address': address,
                            'city': city,
                            'zipCode': zipCode
                        },
                        success: function(data) {
                            window.location.href = "thankyouorder.php"
                        }
                    });
                },
                "theme": {
                    "color": "#3399cc"
                }
            };

            var rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function(response) {
                alert(response.error.code);
                alert(response.error.description);
                alert(response.error.source);
                alert(response.error.step);
                alert(response.error.reason);
                alert(response.error.metadata.order_id);
                alert(response.error.metadata.payment_id);
            });

            rzp1.open();
        }
    });
</script>

</body>
</html>
