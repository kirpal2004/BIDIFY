<?php
    session_start();
    if($_SESSION['username']=="admin"){
    }else{
        header("Location: loogin.php");
    }
?>

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
  background-color: grey;
  color:rgb(13, 12, 12);
}

.container_nav {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color:rgb(129, 124, 124);
  padding: 10px 90px;
  border-bottom: 1px solid #333;
}

.logo {
  width: 35px;
  height: auto;
  margin-right: 10px;
}

.nav-list {
  list-style-type: none;
  display: flex;
  gap: 25px;
}

.nav-item {
  margin-right: 15px;
}

.nav-link {
  text-decoration: none;
  font-weight: 500;
  font-size: 18px;
  color: #f5f5f5;
  transition: color 0.3s;
}

.nav-link:hover {
  color: #00bcd4;
}

.logout-link {
  text-decoration: none;
  color: #f5f5f5;
  font-weight: bold;
}

.logout-link:hover {
  color: #ff4444;
}

.log_outb {
  padding: 7px 15px;
  background-color: #00bcd4;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s ease;
}

.log_outb:hover {
  background-color: #0097a7;
}

.profilephoto {
  width: 35px;
  height: 35px;
  object-fit: cover;
  cursor: pointer;
  border-radius: 50%;
  border: 2px solid #fff;
  transition: transform 0.3s ease;
}

.profilephoto:hover {
  transform: scale(1.05);
}

.andermenu {
  width: 240px;
  position: absolute;
  top: 50px;
  right: 10px;
  background-color: white;
  border-radius: 8px;
  height: auto;
  display: none;
  flex-direction: column;
  padding: 15px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  z-index: 100;
}

.profile-container:hover .andermenu {
  display: flex;
}

.naa {
  margin-bottom: 10px;
}

.naa p {
  color: black;
  font-weight: 500;
}

.onea {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.onea:hover {
  background-color: #333;
}

.ri-logout-box-r-line {
  color: #ff4c4c;
}

.onea a {
  text-decoration: none;
  color: #ff4c4c;
  font-weight: 500;
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
  color: #fff;
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
    padding: 10px 20px;
  }

  .andermenu {
    width: 90%;
    top: 60px;
    right: 5%;
  }
}

    </style>
  </head>
  <body>
    <div class="container_nav">
      <div class="first">
        <a href="adminpanel.php">
          <img class="logo" src="../logo.png" width="35px" alt="logo" />
        </a>
        <h3>BIDIFY</h3>
      </div>
      <div class="second">
        <ul class="nav-list">
          <li class="nav-item"><a href="productdata.php" class="nav-link">All Products</a></li>
          <li class="nav-item">
            <a href="addupcomingauction.php" class="nav-link">Add Upcoming Auctions</a>
          </li>
          <li class="nav-item">
            <a href="orders.php" class="nav-link">Total-Orders</a>
          </li>
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
            </div>
            <hr />
            
            <hr />
            <div class="onea">
              <i class="ri-logout-box-r-line"></i>
              <a href="../logout.php" style="color: rgb(255, 0, 0)">logout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
