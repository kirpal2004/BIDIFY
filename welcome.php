<?php 
session_start();
$a = isset($_SESSION["username"]) ? $_SESSION["username"] : '';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: loogin.php"); 
    exit;
} 
include 'partial/_dbconnect.php';
$sql = "SELECT image_url, description, title , link FROM imagesadminpanel";
$result = mysqli_query($conn, $sql);
$imageData = array();

$sql2 = "SELECT `title`, `date`, `link`, `image_url` FROM `upcoming_auction`";
$result2 = mysqli_query($conn,$sql2);
$upcoming = array();


if ($result->num_rows > 0) { while ($row = $result->fetch_assoc()) {
$imageData[] = $row; } } if ($result2->num_rows > 0) { while ($row =
$result2->fetch_assoc()) { $upcoming[] = $row; } } ?>

<!DOCTYPE html>
<html lang="en">
  <head>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="shortcut icon" href="./logo.png" type="image/x-icon" />

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Bidify</title>
    <link rel="stylesheet" href="./CSS/welcomee.css?v=<?php echo time(); ?>" />
  </head>
  <body>
    <div class="container_w">
      <div id="loader">
      <div class="ad">
        <h1>1</h1>
        <h1>2</h1>
        <h1>3</h1>
        <h1>SOLD !</h1>
      </div>
      <div class="avade">
        <center>
          <h1 style="font-size: 35px">
            <span>W</span><span>E</span><span>L</span><span>C</span
            ><span>O</span><span>M</span><span>E</span> <span>T</span
            ><span>O</span> <span>B</span><span>I</span><span>D</span
            ><span>I</span><span>F</span><span>Y</span>
          </h1>
        </center>
      </div>
    </div>

    <?php require 'partial\nav.php'?>

    <div class="welcome_container">
      <div class="main_1">
        <div
          class="swiper-container"
          style="width: 100vw; overflow: hidden; height: 100%"
        >
          <div class="swiper-wrapper" style="width: 100%; height: 100%">
            <?php foreach ($imageData as $image): ?>
            <div class="swiper-slide" style="width: 100%; height: 100%">
              <div class="lakhelu">
                <h2
                  style="
                    font-size: 30px;
                    margin-top: 25px;
                    color: #fff;
                    margin-left: 25px;
                    "
                >
     
                  <?php echo $image['title']; ?>
                </h2>
                <p
                  style="
                    font-size: 14px;
                    margin-top: 25px;
                    margin-bottom: 20px;
                    color: #fff;
                    margin-left: 25px;
                    margin-right: 25px;
                  "
                >
                  <?php echo $image['description']; ?>
                </p>
                <a class="explore" href="<?php echo $image['link']; ?>">EXPLORE NOW</a>
              </div>
              <img
                class="carimage"
                src="<?php echo $image['image_url']; ?>"
                alt="car"
              />
            </div>
            <?php endforeach; ?>
          </div>
          <div class="swiper-pagination"></div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </div>
      </div>
    </div>

    <div class="welcome__container">
      <div class="popolar">
        <div class="popular_first">
          <h2>Popular Top Category</h2>
          <a href="categories.php"><h4>view all</h4></a>
        </div>
        <div class="popular_second">
        <a href="Categories.php?category=travel">
          <div class="choktha">
            <div class="choktha_first">
              <img src="./images/bags.jpg" alt="bags" srcset="" />
            </div>
            <div class="choktha_second">
              <center><p class="chok">Travel</p></center>
            </div>
          </div>
          </a>

          <a href="Categories.php?category=Electronics">
    <div class="choktha">
        <div class="choktha_first">
            <img src="./images/lap.jpg" alt="laptop" />
        </div>
        <div class="choktha_second">
            <center><p class="chok">Electronics</p></center>
        </div>
    </div>
</a>

<a href="Categories.php?category=Furniture">
          <div class="choktha">
            <div class="choktha_first">
              <img src="./images/sofa.jpg" alt="laptop" srcset="" />
            </div>
            <div class="choktha_second">
              <center><p class="chok">Furniture</p></center>
            </div>
          </div>
          </a>

          <a href="Categories.php?category=Books">
          <div class="choktha">
            <div class="choktha_first">
              <img
                src="https://img.freepik.com/premium-photo/stack-books-with-one-that-says-word-it_732812-1236.jpg?w=740"
                alt="laptop"
                srcset=""
              />
            </div>
            <div class="choktha_second">
              <center><p class="chok">Books</p></center>
            </div>
          </div>
        </a>

        <a href="Categories.php?category=Shoes">
          <div class="choktha">
            <div class="choktha_first">
              <img
                src="https://img.freepik.com/premium-photo/black-sneakers-yellow-background-right-upper-corner_639785-9175.jpg?w=740"
                alt="laptop"
                srcset=""
              />
            </div>
            <div class="choktha_second">
              <center><p class="chok">Shoes</p></center>
            </div>
          </div>
            </a>


            <a href="Categories.php?category=Controller">
          <div class="choktha">
            <div class="choktha_first">
              <img
                src="https://img.freepik.com/premium-photo/neon-cyberpunk-gamepad-motion-screen-flat-icon-with-thick-lines-black-background_1114736-34.jpg?w=740"
                alt="laptop"
                srcset=""
              />
            </div>
            <div class="choktha_second">
              <center><p class="chok">Controller</p></center>
            </div>
          </div>
            </a>

            <a href="Categories.php?category=Cream">
          <div class="choktha">
            <div class="choktha_first">
              <img
                src="https://img.freepik.com/free-photo/skincare-products-near-lemon-honey_23-2147710606.jpg?t=st=1711692233~exp=1711695833~hmac=b29f3e2453a2ada222d887f429c9c43121b6b497b3663a11c65aafb2be34e291&w=740"
                alt="laptop"
                srcset=""
              />
            </div>
            <div class="choktha_second">
              <center><p class="chok">Cream</p></center>
            </div>
          </div>
            </a>


            <a href="Categories.php?category=Vegetables">
          <div class="choktha">
            <div class="choktha_first">
              <img
                src="https://img.freepik.com/premium-photo/top-view-fruits-vegetables_1057389-20588.jpg?w=740"
                alt="laptop"
                srcset=""
              />
            </div>
            <div class="choktha_second">
              <center><p class="chok">Vegetables</p></center>
            </div>
          </div>
            </a>
          <div class="choktha">
            <div class="choktha_first">
              <img
                src="https://img.freepik.com/premium-photo/top-view-fruits-vegetables_1057389-20588.jpg?w=740"
                alt="laptop"
                srcset=""
              />
            </div>
            <div class="choktha_second">
              <center><p class="chok">Vegetables</p></center>
            </div>
          </div>
          <div class="choktha">
            <div class="choktha_first">
              <img
                src="https://img.freepik.com/premium-photo/top-view-fruits-vegetables_1057389-20588.jpg?w=740"
                alt="laptop"
                srcset=""
              />
            </div>
            <div class="choktha_second">
              <center><p class="chok">Vegetables</p></center>
            </div>
          </div>
        </div>
      </div>
      <div class="todaybest">
        <div class="todayfirst">
          <h2>Today Our Best Product</h2>
          <!-- <a href="#"><h4>view all</h4></a> -->
        </div>
        <div class="todaysecond">
          <div class="todaysecond-first">
            <a href="Categories.php?category=WomenCollection">
            
            <div class="ona">
              <h3>Women's Collection</h3>
            </div>
            <img src="./images/womenscoll.jpg" alt="" />
          </a>
          </div>
          <div class="todaysecond-second">
            <div class="second-1">
              <a href="Categories.php?category=HeadPhones">
              <div class="onna">
                <h4>HeadPhones</h4>
              </div>
              <img
                src="https://img.freepik.com/free-photo/beautiful-woman-enjoying-song-headphones-close-eyes-smile-while-listening-music-headphones-holding-smartphone-hand-standing-blue-background_1258-70094.jpg?w=996&t=st=1712317052~exp=1712317652~hmac=b5a7c51e6eb1d88219d6bc091956f096a80216fa10a0f31248599f6b5d94b05c"
                alt=""
              />
            </a>
            </div>
            <div class="second-1">
            <a href="Categories.php?category=Sports">
              <div class="onna">
                <h4>Sports</h4>
              </div>
              <img src="./images/sports.jpg" alt="" />
              <!-- <img src="https://img.freepik.com/premium-photo/international-sports-day-6-april_10221-18936.jpg?w=996" alt=""/> -->
            </a>
            </div>
            <div class="second-1">
            <a href="Categories.php?category=Cream">
              <div class="onna">
                <h4>Beauty Products</h4>
              </div>
              <img
                src="https://img.freepik.com/premium-photo/eco-friendly-cosmetics-decorated-with-green-leaves-ai-generated_866663-2043.jpg?w=1060"
                alt=""
              />
            </a>
            </div>
            <div class="second-1">
            <a href="Categories.php?category=Shoes">
              <div class="onna">
                <h4>Shoes</h4>
              </div>
              <img
                src="https://sneakerbardetroit.com/wp-content/uploads/2020/02/Nike-Air-Max-Plus-Gumball.jpg"
                alt=""
                srcset=""
              />
            </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="welcome__container">
      <div class="rect">
        <img
          src="https://img.freepik.com/premium-vector/new-arrival-sneakers-collection-social-media-banner-template-design_596383-159.jpg?w=1380"
          alt=""
          srcset=""
        />
      </div>
    </div>
    <div class="upcoming">
        <div class="popular_first">
          <h2>Upcoming Auctions</h2>
        <div class="upcoming_second">
          <?php
            $sql_products = "SELECT * FROM adminbids";
              $result3=mysqli_query($conn,$sql_products);
              $result_products = mysqli_query($conn, $sql_products);
              if (mysqli_num_rows($result_products) > 0) {
                while ($row = mysqli_fetch_assoc($result_products)) {
                    $cur_date = date("Y-m-d");
                    if ($cur_date > $row['u_date']) {
                        continue;
                    }
                    echo '<div class="pro1">'; 
                    echo '<div class="aa">';
                    if(!empty($row['file_name'])) {
                        echo '<img src="./images/' . $row['file_name'] . '" alt="Product Image" >';
                    }                
                    echo '</div>';
                    echo '<div class="bb">';
                    echo '<div class="bbfirst">';
                    echo '<h3>' . $row['name'] . '</h3>';
                    echo '<h3>' . $row['st_bid_price'] . '$'. '</h3>';
                    echo '</div>';
                    echo '<h3>Starting Date :  '. $row['u_date'] . '</h3>';
                    echo '</div>';
                    echo '</div>';
                  }
                }
          ?>
              
        </div>
        
      </div>
      </div>
    <?php include 'partial\footer.php';?>
    <!-- <div class="welcome__container" style="background-color: #dadada"></div> -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"
      integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"
      integrity="sha512-onMTRKJBKz8M1TnqqDuGBlowlH0ohFzMXYRNebz+yOcc5TQr/zAKsthzhuv0hiyUKEiQEQXEynnXCvNTOk50dg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script src="./CSS/welcome.js?v=<?php echo time(); ?>"></script>
  </body>
</html>
