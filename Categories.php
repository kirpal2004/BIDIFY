<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <link rel="stylesheet" href="./CSS/category.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php
    session_start();
    include 'partial/_dbconnect.php'; ?>
    <?php include "./partial/nav.php"; ?>

    <div class="container">
        <div class="sidebar">
            <h2>Categories</h2>
            <ul>
                <?php
                    $sql_categories = "SELECT DISTINCT category FROM products";
                    $result_categories = mysqli_query($conn, $sql_categories);
                    echo '<div class="sidec">';
                        echo '<li><a href="?category=all">ALL</a></li>';
                        echo '</div>';
                    while ($row_category = mysqli_fetch_assoc($result_categories)) {
                        $category = $row_category['category'];
                        echo '<div class="sidec">';
                        echo '<li><a href="?category=' . $category . '">' . $category . '</a></li>';
                        echo '</div>';
                    }
                ?>
            </ul>
        </div>
        <div class="main-content">
            <div class="profuctheasder">
                <h1>Products</h1>
                <select class="as" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                    <option disabled selected>Sort By</option>
                    <option value="?sort=sortbyrange">Sort By range</option>
                    <option value="?sort=expensive">Expensive</option>
                    <option value="?sort=endingsoon">Ending Soon</option>
                </select>


            </div>
            <div class="product-list">   
                <?php
                    if(isset($_GET['category']) && ($_GET['category']!='all')) {
                        $selectedCategory = $_GET['category'];
                        // echo $selectedCategory;
                        $sql_products = "SELECT * FROM products WHERE category = '$selectedCategory'";
                    } else {
                        $sql_products = "SELECT * FROM products";
                    }
                    if(isset($_GET['sort'])) {
                        $sortOption = $_GET['sort'];
                        // Append ORDER BY clause to SQL query based on the selected sorting option
                        if ($sortOption == 'sortbyrange') {
                            $sql_products .= " ORDER BY st_bid_price";
                        } elseif ($sortOption == 'expensive') {
                            $sql_products .= " ORDER BY st_bid_price DESC";
                        } elseif ($sortOption == 'endingsoon') {
                            $sql_products .= " ORDER BY Last_date ASC";
                            // Assuming Last_date is the column representing the ending date of the bid
                        }
                    }
                    $result_products = mysqli_query($conn, $sql_products);
                    if (mysqli_num_rows($result_products) > 0) {
                        while ($row = mysqli_fetch_assoc($result_products)) {
                            $cur_date = date("Y-m-d");
                            if ($cur_date >= $row['Last_date']) {
                                continue;
                            }
                            echo '<div class="pro1">'; 
                            echo '<div class="aa">';
                            if(!empty($row['file_name'])) {
                                echo '<img src="./images/' . $row['file_name'] . '" alt="Product Image" onclick="openProductWindow(' . $row['id'] . ')">';
                            }                
                            echo '</div>';
                            echo '<div class="bb">';
                            echo '<div class="bbfirst">';
                            echo '<h3>' . $row['name'] . '</h3>';
                            echo '<h3>' . $row['st_bid_price'] . '$'. '</h3>';
                            echo '</div>';
                            echo '<div class="bbsecond">';

$description = $row['description'];
$words = str_word_count($description, 1); 
$truncatedDescription = implode(' ', array_slice($words, 0, 10)); 
echo '<p style="font-family: serif; font-size: 16px; margin: 5px;">' . $truncatedDescription;
echo '</p>';
echo '</div>';

                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No products found.</p>';
                    }
                ?>
            </div>
        </div>
    </div>

    <script>
    function openProductWindow(productId) {
        var productURL = 'http://localhost/PROJECT/product.php?id=' + productId;
        var productWindow = window.open(productURL, '_blank');
    }
    </script>

    <?php mysqli_close($conn); ?>
    <?php include 'partial\footer.php';?>

</body>
</html>
