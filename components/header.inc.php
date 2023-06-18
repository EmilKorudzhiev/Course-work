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

    <link rel="stylesheet" href="../utilities/styles/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Custom styling for the header */
        .custom-header {
            background-color: #1f5162;
            color: #ffffff;
        }

        .custom-header .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .custom-header .nav-link {
            color: #ffffff;
        }

        .custom-header .nav-link.active {
            color: #ffca28;
        }

        .custom-header .bi-cart {
            font-size: 1.5rem;
            vertical-align: middle;
        }

        .custom-header .profile-image {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }
        
    </style>

</head>
<body>

<header>
  <nav class="navbar navbar-expand-lg navbar-dark custom-header fixed-top p-1 border-bottom" id="header">
    <div class="container-fluid">
      <img class="navbar-brand" src="https://via.placeholder.com/45x45" alt="">
      <a class="navbar-brand" href="../controllers/home.php">Риболовен свят</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-lg-0 d-flex align-items-start">
          <li class="nav-item">
            <a class="nav-link<?php if ( $active == 'home' ) echo " active" ?>" aria-current="page" href="../controllers/home.php">Начало</a>
          </li>
          <li class="nav-item">
            <a class="nav-link<?php if ( $active == 'store' ) echo " active" ?>" href="../controllers/store.php">Магазин</a>
          </li>
          <li class="nav-item">
            <a class="nav-link<?php if ( $active == 'ai chat' ) echo " active" ?>" href="../controllers/ai_chat.php">AI Chat</a>
          </li>

        </ul>

        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-start">
          <li class="nav-item">
            <a class="nav-link<?php if ( $active == 'cart' ) echo " active" ?>" href="../controllers/cart.php"><span class="bi bi-cart h5"></span> Количка</a>
          </li>
          <li class="nav-item align-self-center">
            <a class="nav-link p-0" href="<?php if(isset($_SESSION["USER"])){echo '../controllers/user_profile.php';} else{ echo '../controllers/login.php';} ?>">
              <img src="../images/profile/<?php if(isset($_SESSION["USER"][4])){echo $_SESSION["USER"][4];} else{ echo 'default.jpg';} ?>" alt="Profile" class="rounded-circle profile-image">
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
