<?php 
if(isset($_SESSION["USER"])){
  debug_to_console($_SESSION["USER"]);
  } 
if(isset($_SESSION["CART"])){
  debug_to_console($_SESSION["CART"]);
} 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="/Course-work/utilities/styles/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    
  </head>
<body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top p-1 border-bottom" id="header">
    <div class="container-fluid">
      <img class="navbar-brand" src="https://via.placeholder.com/45x45 " alt="">
      <a class="navbar-brand" href="/Course-work/controllers/home.php">Company</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-lg-0 d-flex align-items-start">
          <li class="nav-item">
            <a class="nav-link<?php if ( $active == 'home' ) echo " active" ?>" aria-current="page" href="/Course-work/controllers/home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link<?php if ( $active == 'store' ) echo " active" ?>" href="/Course-work/controllers/store.php">Store</a>
          </li>
          <li class="nav-item">
            <a class="nav-link<?php if ( $active == 'ai chat' ) echo " active" ?>" href="/Course-work/controllers/ai_chat.php">AI Chat</a>
          </li>
          <li class="nav-item">
            <a class="nav-link<?php if ( $active == 'forum' ) echo " active" ?>" href="#">Forum</a>
          </li>
          <li class="nav-item">
            <a class="nav-link<?php if ( $active == 'contact us' ) echo " active" ?>" href="#">Contact Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link<?php if ( $active == 'faq' ) echo " active" ?>" href="#">FAQ</a>
          </li>
          
        </ul>

        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-start">
          <li class="nav-item">
            <a class="nav-link<?php if ( $active == 'cart' ) echo " active" ?>" href="/Course-work/controllers/cart.php"><span class="bi bi-cart h5"></span> Cart</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php if(isset($_SESSION["USER"])){echo '/Course-work/controllers/user_profile.php';} else{ echo '/Course-work/controllers/login.php';} ?>">
              <img src="/Course-work/images/profile/<?php if(isset($_SESSION["USER"][4])){echo $_SESSION["USER"][4];} else{ echo 'default.jpg';} ?>" alt="Profile" class="rounded-circle" width="30" height="30">
            </a>
          </li>
        </ul>
    
      </div>
    </div>
  </nav>
</header>


