<?php
@include 'config.php';

session_start();

// Optional: redirect if not logged in as admin
if (!isset($_SESSION['admin_name'])) {
    header('location:login_form.php');
    exit;
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $base_price = $_POST['base_price'];
    $start_date = $_POST['start_date'];
    $last_date = $_POST['last_date'];
    $description = $_POST['description'];

    $fileName = $_FILES["image"]["name"];
    $tempName = $_FILES["image"]["tmp_name"];
    $folder = "./images/" . $fileName;

    if (move_uploaded_file($tempName, $folder)) {
        // Insert into adminbids
        $stmt = $conn->prepare("INSERT INTO adminbids (name, category, base_price, start_date, last_date, description, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssdssss", $name, $category, $base_price, $start_date, $last_date, $description, $fileName);
            if ($stmt->execute()) {
                echo "<script>alert('Product added to adminbids')</script>";

                // Also insert into upcoming_auction
                $title = $name;
                $date = $start_date;
                $link = "#";
                $image_url = $folder;

                $stmt2 = $conn->prepare("INSERT INTO upcoming_auction (title, date, link, image_url) VALUES (?, ?, ?, ?)");
                if ($stmt2) {
                    $stmt2->bind_param("ssss", $title, $date, $link, $image_url);
                    $stmt2->execute();
                    $stmt2->close();
                    echo "<script>alert('Also added to upcoming_auction')</script>";
                } else {
                    echo "Error in upcoming_auction insert: " . $conn->error;
                }
            } else {
                echo "Error inserting to adminbids: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "DB statement error: " . $conn->error;
        }
    } else {
        echo "<script>alert('Image upload failed!')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Auction Product</title>
    <style>
        body {
            font-family: Arial;
            background: #f0f0f0;
        }
        .form-container {
            width: 400px;
            background: white;
            padding: 20px;
            margin: 40px auto;
            box-shadow: 0 0 10px gray;
            border-radius: 10px;
        }
        .form-container input, textarea, select {
            width: 100%;
            margin: 10px 0;
            padding: 8px;
        }
        .form-container input[type="submit"] {
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h3>Add Auction Product</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="text" name="category" placeholder="Category" required>
        <input type="number" name="base_price" step="0.01" placeholder="Base Price" required>
        <label>Start Date:</label>
        <input type="date" name="start_date" required>
        <label>End Date:</label>
        <input type="date" name="last_date" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="file" name="image" accept="image/*" required>
        <input type="submit" name="submit" value="Add Product">
    </form>
</div>

</body>
</html>
