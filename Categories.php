<?php
session_start();
include 'partial/_dbconnect.php'; 
include "./partial/nav.php";

// Set defaults
$categoryFilter = "";
$orderBy = " ORDER BY id DESC"; // default sort

// Category
if (isset($_GET['category']) && strtolower($_GET['category']) != 'all') {
    $selectedCategory = strtolower($_GET['category']);
    $categoryFilter = " WHERE LOWER(category) = '$selectedCategory'";
}

// Sorting
if (isset($_GET['sort'])) {
    $sortOption = $_GET['sort'];
    if ($sortOption == 'sortbyrange') {
        $orderBy = " ORDER BY st_bid_price";
    } elseif ($sortOption == 'expensive') {
        $orderBy = " ORDER BY st_bid_price DESC";
    } elseif ($sortOption == 'endingsoon') {
        $orderBy = " ORDER BY Last_date ASC";
    }
}

$sql_products = "SELECT * FROM products" . $categoryFilter . $orderBy;
$result_products = mysqli_query($conn, $sql_products);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <link rel="stylesheet" href="./CSS/category.css?v=<?php echo time(); ?>">
    <style>
        .product-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }
        .pro1 {
            width: 250px;
            border: 1px solid #ccc;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 10px;
            background-color: white;
        }
        .aa img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            cursor: pointer;
        }
        .bb {
            padding: 10px 0;
        }
        .bbfirst {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Categories</h2>
            <ul>
                <?php
                    $sql_categories = "SELECT DISTINCT category FROM products";
                    $result_categories = mysqli_query($conn, $sql_categories);
                    echo '<div class="sidec"><li><a href="?category=all">ALL</a></li></div>';
                    while ($row_category = mysqli_fetch_assoc($result_categories)) {
                        $category = $row_category['category'];
                        echo '<div class="sidec"><li><a href="?category=' . strtolower($category) . '">' . $category . '</a></li></div>';
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
                            echo '<p style="font-family: serif; font-size: 16px; margin: 5px;">' . $truncatedDescription . '</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p style="padding:20px;">No products found.</p>';
                    }
                ?>
            </div>
        </div>
    </div>

    <script>
        function openProductWindow(productId) {
            var productURL = 'http://localhost/PROJECT/product.php?id=' + productId;
            window.open(productURL, '_blank');
        }
    </script>

    <?php 
    mysqli_close($conn); 
    include 'partial/footer.php'; 
    ?>
</body>
</html>
