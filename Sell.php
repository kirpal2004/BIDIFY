<?php
session_start();
if (isset($_POST['submit']) && isset($_POST["name"]) && isset($_POST["description"]) && isset($_POST["category"])) {
    include 'partial/_dbconnect.php';

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO products (name, description, st_bid_price, category, file_name, last_date, upi_id, owner) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind the parameters
    $stmt->bind_param("ssdsssss", $name, $description, $st_bid_price, $category, $fileName, $last_date, $upi_id, $owner);

    // Get form data
    $name = $_POST["name"];
    $description = $_POST["description"];
    $st_bid_price = $_POST["bid_price"];
    $category = $_POST["category"];
    $last_date = $_POST["lastdate"];
    $upi_id = $_POST['upi_id'];
    $owner = $_SESSION['email'];

    // File upload settings
    $targetDir = "C:/xampp/htdocs/APC/images/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true); // Create directory if it doesn't exist
    }

    $fileName = basename($_FILES["fileToUpload"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Debug information
    echo "Temporary file: " . $_FILES["fileToUpload"]["tmp_name"] . "<br>";
    echo "Target file: " . $targetFilePath . "<br>";

    // Check file upload errors
    if ($_FILES["fileToUpload"]["error"] !== UPLOAD_ERR_OK) {
        echo "Error in file upload: " . $_FILES["fileToUpload"]["error"];
        exit;
    }

    // Check if file is selected
    if (!empty($fileName)) {
        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {
                // Execute the statement
                if ($stmt->execute()) {
                    echo "<script>alert('Product added successfully!')</script>";
                } else {
                    echo "Database error: " . $stmt->error;
                }
            } else {
                echo "Failed to move uploaded file. Check directory existence and permissions.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, GIF, & PDF files are allowed.";
        }
    } else {
        echo "Please select a file to upload.";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Your Product</title>
    <link rel="stylesheet" href="./CSS/sell.css?v=<?php echo time(); ?>">
</head>
<?php include "./partial/nav.php"; ?>
<body>
    <div class="maincell">
        <div class="container">
            <div class="title">Sell Your Product</div>
            <form action="Sell.php" method="post" enctype="multipart/form-data">
                <div class="user__details">
                    <div class="input__box">
                        <span class="details">Product Name</span>
                        <input type="text" name="name" placeholder="E.g: Mac Book" required>
                    </div>
                    <div class="input__box">
                        <span class="details">Category</span>
                        <select name="category" required>
                            <option value="Furniture">Furniture</option>
                            <option value="Books">Books</option>
                            <option value="Car">Car</option>
                            <option value="Travel">Travel</option>
                            <option value="Electronics">Electronics</option>
                            <option value="Shoes">Shoes</option>
                            <option value="Controller">Controller</option>
                            <option value="Cream">Cream</option>
                            <option value="Vegetables">Vegetables</option>
                            <option value="WomenCollection">Women's Collection</option>
                            <option value="HeadPhones">Headphones</option>
                            <option value="Sports">Sports</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="input__box" style="width: 100%;">
                        <span class="details">Description</span>
                        <textarea name="description" cols="97%" rows="3" required></textarea>
                    </div>
                    <div class="input__box">
                        <span class="details">Base Price for Product</span>
                        <input type="number" name="bid_price" placeholder="2000" required>
                    </div>
                    <div class="input__box" style="outline: 0; border: 0;">
                        <span class="details">Photo of Product</span>
                        <input type="file" name="fileToUpload" id="fileToUpload" required>
                    </div>
                    <div class="input__box">
                        <span class="details">UPI ID</span>
                        <input type="text" name="upi_id" placeholder="Enter your UPI ID" required>
                    </div>
                    <div class="input__box">
                        <span class="details">Expiry Date</span>
                        <input type="date" name="lastdate" required>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" name="submit" value="ADD">
                </div>
            </form>
        </div>
    </div>
    <?php include 'partial/footer.php'; ?>
</body>
</html>
