<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap");
      * {
        font-family: "Poppins", sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: Arial, sans-serif;
      }

      .container_nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #f5f5f7;
        padding: 10px 90px;
      }

      .logo {
        width: 35px; /* Set width of the image */
        height: auto; /* Maintain aspect ratio */
        margin-right: 10px;
      }

      .nav-list {
        list-style-type: none;
        margin: 0;
        display: flex;
        gap: 25px;
        padding: 0;
        display: flex;
      }

      .nav-item {
        margin-right: 15px;
      }

      .nav-link {
        text-decoration: none;
        font-weight: 500;
        font-size: 18px;
        color: #333;
        transition: color 0.3s;
      }

      .nav-link:hover {
        color: #555;
      }

      .logout-link {
        text-decoration: none;
        color: #333;
        font-weight: bold;
      }

      .logout-link:hover {
        color: #555;
      }

      .log_outb {
        padding: 7px 15px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
      }

      .log_outb:hover {
        background-color: #0056b3;
      }

      .profilephoto {
        width: 35px;
        height: 35px;
        object-fit: cover;
        cursor: pointer;
        mix-blend-mode: multiply;
        border-radius: 50%;
      }

      .andermenu {
        /* border: 1px solid #000; */
        width: 16vw;
        position: absolute;
        top: 50px;
        right: 0;
        min-width: 240px;
        min-height: 250px;
        border-radius: 5px;
        background-color: #fff;
        height: 45vh;
        margin-left: 50px;
        overflow: hidden;
        display: none;
      }

      .naa {
        margin: 12px 16px;
      }

      .onea {
        margin: 8px 16px;
        display: flex;
        gap: 8px;
        align-items: center;
      }

      .ri-logout-box-r-line {
        color: red;
      }

      .onea a {
        text-decoration: none;
        color: black;
      }

      .profile-container:hover .andermenu {
        display: block;
        cursor: pointer;
        z-index: 1;
      }
      .onea:hover {
        padding: 2px 4.5px;
        transition: padding 0.3s, background-color 0.3s;
        background-color: #dadada;
      }
      .first {
        display: flex;
        align-items: center;
      }
      .third {
        display: flex;
        align-items: center;
        gap: 10px;
        justify-content: center;
      }
      .ri-menu-3-line {
        display: none;
      }

      @media (max-width: 768px) {
        .nav-list {
          display: none;
        }

        .ri-menu-3-line {
          display: block;
          font-size: 28px;
        }
        .container_nav {
          padding: 10px 10px;
        }

        .andermenu {
          z-index: 10;
          position: absolute;
        }
      }
    </style>
  </head>
  <body>
    <div class="container_nav">
      <div class="first">
        <a href="welcome.php">
          <img class="logo" src="./logo.png" width="35px" alt="logo" />
        </a>
        <h3>BIDIFY</h3>
      </div>
      <div class="second">
        <ul class="nav-list">
          <li class="nav-item"><a href="welcome.php" class="nav-link">Auctions</a></li>
          <li class="nav-item">
            <a href="Categories.php" class="nav-link">Categories</a>
          </li>
          <li class="nav-item">
            <a href="Sell.php" class="nav-link">Sell</a>
          </li>
          <li class="nav-item">
            <a href="add_to_cart.php" class="nav-link">Cart</a>
          </li>
          <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
        </ul>
      </div>
      <div class="third">
        <i class="ri-menu-3-line"></i>
        <div class="gol profile-container">
          <img
            class="profilephoto"
            src="https://wallpaperaccess.com/full/2102767.jpg"
            alt="profile photo"
          />
          <div class="andermenu" style=" z-index: 100;">
            <div class="naa">
              <p><?php echo $_SESSION["username"]?></p>
              <p>
                <?php  
              
               echo $_SESSION["email"];     
      
                      ?>
              </p>
            </div>
            <hr />
            <div class="onea">
              <i class="ri-logout-box-r-line"></i>
              <a href="logout.php" style="color: rgb(255, 0, 0)">logout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
