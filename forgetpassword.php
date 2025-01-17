<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f1f1f1;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 400px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
}

input[type="email"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #45a049;
}


    </style>
</head>
<body>
    <div class="container">
        <h2>Password Recovery</h2>
        <form action="forgetpassword.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html> 


<?php

   session_start();
   $_SESSION["email"]=$_POST["email"]; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


$mail = new PHPMailer(true);
$email=$_POST["email"];

try {
    //Server settings
    
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                   
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'ieitata44@gmail.com';                  
    $mail->Password   = 'zjcefztgjhhgiora';                               
    $mail->SMTPSecure = 'ssl';            
    $mail->Port       = 465;                                  

  
    $mail->setFrom('ieitata44@gmail.com', 'BIFIFY');
    $mail->addAddress("$email");     
    $mail->isHTML(true);   
    $mail->Subject = 'Here is the subject';
    $mail->Body    = '<body style="font-family: Arial, sans-serif;">

    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd;">
        <h2 style="color: #333;">Change Your Password</h2>
        <p style="color: #555;">Dear <?php echo $_SESSION["username"]; ?>,</p>
        <p style="color: #555;">Weve received a request to change your password. To proceed, please click the button below:</p>
        <p style="text-align: center; margin-top: 30px;">
    <button onclick="{console.log(`aa`);}"><a href="localhost/PROJECT/resetpassword.php" style="display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: #fff; text-decoration: none; border-radius: 5px;">Change Password</a></button> 
        </p>
        <p style="color: #555;">If you didnt request this change, you can ignore this email.</p>
        <p style="color: #555;">Thanks,<br>BIDIFY</p>
    </div>

</body>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo "
    <script>
        alert('Message has been sent')
    </script>"
    ;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}