<?php
    session_start();
    if(isset($_POST['submit']) && isset($_POST["name"]) && isset($_POST["description"]) && isset($_POST["category"])) {
        
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
        $targetDir = "C:/xampp/htdocs/Project/images/";
        $fileName = basename($_FILES["fileToUpload"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        
        // Check if file is selected
        if(!empty($fileName)) {
            // Allow certain file formats
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
            if(in_array($fileType, $allowTypes)) {
                // Upload file to server
                if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {
                    // Execute the statement
                    if($stmt->execute()) {
                        echo "<script>alert('Product added successfully!')</script>";
                    } else {
                        echo "Error: " . $stmt->error;
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.";
            }
        } else {
            echo "Please select a file to upload.";
        }
        
        // Close statement
        $stmt->close();
        // Close connection
        $conn->close();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/sell.css?v=<?php echo time(); ?>">
</head>
<?php  include "./partial/nav.php"; ?>
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
                    <option value="travel">Travel</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Shoes">Shoes</option>
                    <option value="Controller">Controller</option>
                    <option value="Cream">Cream</option>
                    <option value="Vegetables">Vegetables</option>
                    <option value="WomenCollection">Women's Collection</option>
                    <option value="HeadPhones">HeadPhones</option>
                    <option value="Sports">Sports</option>
                    <option value="bid">Other</option>
                </select>
              </div>
              <div class="input__box" style="width: 100%;">
                <span class="details">Description</span>
                <textarea name="description" id="" cols="97%" rows="3" required></textarea>
                <!-- <input style="height: 150px;" type="text" placeholder="johnWC98" required> -->
              </div>
              <div class="input__box">
                <span class="details">Base Price for Product</span>
                <input type="number" name="bid_price" placeholder="2000" required>
              </div>
              <div class="input__box" style="outline: 0;border: 0;">
                <span class="details">Photo of Product</span>
                <input style="position: relative;outline: 0;border: 0;top: 10px;padding-left: 0px;" type="file" name="fileToUpload" id="fileToUpload" required>
              </div>
              <div class="input__box">
                <span class="details">UPI ID</span>
                <input type="text" name="upi_id" placeholder="********" required>
            </div>
              <div class="input__box">
                <span class="details">EXPIRY DATE</span>
                <input type="date" name="lastdate" id="lastdate" required>
              </div>
        
            </div>
            
            <div class="button">
              <input type="submit" name="submit" value="ADD">
            </div>
          </form>
        </div>
    </div>
    <?php include 'partial\footer.php';?>

</body>
</html> 