<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Bidify</title>
  <link rel="stylesheet" href="CSS/style.css?v=<?php echo time(); ?>">
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap");

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }
    
    

    body {
      background-color: #f5f5f7;
    }

    .container_nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 90px;
      background-color:rgb(86, 86, 88);
      position: sticky;
      top: 0;
      z-index: 999;
    }

    .first {
      display: flex;
      align-items: center;
    }

    .logo {
      width: 35px;
      margin-right: 10px;
    }

    .container_nav h3 {
      font-size: 1.6rem;
      color:rgb(241, 242, 244);
    }

    .nav-list {
      list-style: none;
      display: flex;
      gap: 25px;
    }

    .nav-item .nav-link {
      text-decoration: none;
      color: white;
      font-weight: 500;
      font-size: 18px;
      transition: color 0.3s ease;
    }

    .nav-item .nav-link:hover {
      color:rgb(5, 5, 6);
    }

    .third {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .ri-menu-3-line {
      display: none;
      font-size: 28px;
      cursor: pointer;
    }

    .profilephoto {
      width: 35px;
      height: 35px;
      object-fit: cover;
      border-radius: 50%;
      cursor: pointer;
      mix-blend-mode: multiply;
    }

    .profile-container {
      position: relative;
    }

    .andermenu {
      position: absolute;
      top: 45px;
      right: 0;
      width: 240px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      display: none;
      padding: 10px 0;
      z-index: 100;
    }

    .profile-container:hover .andermenu {
      display: block;
    }

    .naa {
      padding: 10px 16px;
    }

    .onea {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 8px 16px;
      transition: background-color 0.3s ease;
    }

    .onea:hover {
      background-color: #eaeaea;
    }

    .onea a {
      text-decoration: none;
      color: red;
      font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .container_nav {
        padding: 10px 20px;
        flex-wrap: wrap;
      }

      .nav-list {
        display: none;
        flex-direction: column;
        background-color: #f5f5f7;
        width: 100%;
        padding: 10px 0;
      }

      .nav-list.active {
        display: flex;
      }

      .ri-menu-3-line {
        display: block;
        color: wheat;
      }

      .andermenu {
        top: 50px;
        right: 10px;
      }
    }
  </style>
</head>
<body>

<script>
  const menuToggle = document.getElementById('menu-toggle');
  const navLinks = document.getElementById('nav-links');

  menuToggle?.addEventListener('click', () => {
    navLinks.classList.toggle('active');
  });
</script>

<div class="container_nav">
  <div class="first">
    <a href="welcome.php">
      <img class="logo" src="./logo.png" alt="logo" />
    </a>
    <h3>BIDIFY</h3>
  </div>
  <div class="second">
    <ul class="nav-list" id="nav-links">
      <li class="nav-item"><a href="welcome.php" class="nav-link">Auctions</a></li>
      <li class="nav-item"><a href="Categories.php" class="nav-link">Categories</a></li>
      <li class="nav-item"><a href="Sell.php" class="nav-link">Sell</a></li>
      <li class="nav-item"><a href="add_to_cart.php" class="nav-link">Cart</a></li>
      <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
    </ul>
  </div>
  <div class="third">
    <i class="ri-menu-3-line" id="menu-toggle"></i>
    <div class="gol profile-container">
      <img class="profilephoto" src="https://wallpaperaccess.com/full/2102767.jpg" alt="profile photo" />
      <div class="andermenu">
        <div class="naa">
          <p><?php echo $_SESSION["username"]?></p>
          <p><?php echo $_SESSION["email"]; ?></p>
        </div>
        <hr />
        <div class="onea" style="display: flex; align-items: center; gap: 8px; padding: 8px 16px; transition: background-color 0.3s ease; cursor: pointer;" onmouseover="this.style.backgroundColor='#eaeaea'" onmouseout="this.style.backgroundColor='transparent'">
  <i class="ri-logout-box-r-line" style="font-size: 18px; color: red;"></i>
  <a href="logout.php" style="text-decoration: none; color: red; font-weight: 500;">Logout</a>
</div>

      </div>
    </div>
  </div>
</div>

</body>
</html>
