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

    
  </head>
<body>
<style>
    header {
  background-color: #1f5162;
  padding: 10px 0;
}

/* Style the navbar links */
.navbar-nav .nav-link {
  color: #fff;
  font-weight: 500;
  padding: 0.5rem 1rem;
  transition: color 0.3s ease;
}

.navbar-nav .nav-link:hover,
.navbar-nav .nav-link.active {
  color: #ffc107;
}

/* Style the logo */
.navbar-brand {
  font-size: 1.5rem;
  margin-right: 1rem;
}

/* Style the shopping cart icon */
.bi-cart {
  font-size: 1.2rem;
}

/* Style the user profile image */
.navbar-nav .nav-link img {
  border-radius: 50%;
}

/* Media query for responsiveness */
@media (max-width: 767px) {
  /* Reduce padding for smaller screens */
  .navbar {
    padding: 0.5rem 0;
  }

  /* Center the logo and collapse the navbar links */
  .navbar-brand {
    margin-right: auto;
  }

  .navbar-collapse {
    justify-content: flex-end;
  }

  .navbar-nav {
    flex-direction: column;
  }

  .navbar-nav .nav-link {
    padding: 0.5rem;
  }

  /* Adjust the spacing for the shopping cart and profile image */
  .navbar-nav .nav-link:last-child {
    margin-top: 0.5rem;
  }
}
</style>
    
    <link rel="icon" href="../images/site assets/MV_Letters.svg" type="image/svg+xml"/>
<header>
  
<nav class="navbar navbar-expand-md navbar-dark fixed-top p-1 border-bottom" id="header" style="background-color: #1f5162;">
    <div class="container-fluid p-0">
      <div class="me-2">
        <svg viewBox="0 0 256 120" style="height: 40px;">
          <style type="text/css">
            .st0{fill:none;stroke:#fff;stroke-width:2;stroke-miterlimit:10;}
            .st1{fill:none;stroke:#fff;stroke-width:5;stroke-miterlimit:10;}
          </style>
          <path class="st0" d="M11.53,50.98"/>
          <path class="st0" d="M15.94,83.85"/>
          <path class="st0" d="M7.13,76.38"/>
          <path class="st0" d="M78.72,98.79"/>
          <path class="st0" d="M189.29,104.31c-22.7,0.76-52.51-0.64-85.08-9.13c-9.08-2.36-17.52-4.98-25.12-7.77
            c-11.34,10.61-22.79,13.87-28.11,14.99c-9.5,2-18.1,1.27-27.78,0.24c-8.62-0.91-15.87-2.41-19.59-3.23
            c5.88-0.37,13.99-1.73,23.13-5.98c8.51-3.96,15.15-9.14,19.83-13.45c-2.82-3.2-6.84-7.13-12.12-10.46
            c-5.54-3.5-10.49-5.46-14.22-6.29c3.73-0.83,8.87-2.79,14.42-6.29c5.28-3.33,9.3-7.25,12.12-10.46
            c-4.67-4.31-11.31-9.49-19.83-13.45c-9.14-4.25-17.25-5.6-23.13-5.98c3.71-0.82,10.97-2.31,19.59-3.23
            c9.67-1.03,18.27-1.76,27.78,0.24c5.32,1.12,16.66,4.37,28.01,14.99c9.54-4.28,20.69-8.43,33.36-11.69
            c30.32-7.79,57.03-7.31,76-5.21"/>
          <path class="st0" d="M165.33,20.86c-8.58-1.91-18.19-3.6-28.71-4.74c-12.4-1.34-23.76-1.67-33.8-1.45c3.5,0.45,9.27,1.72,14.95,5.75
            c2.16,1.53,3.88,3.15,5.22,4.64"/>
          <path class="st0" d="M178.36,104.49c-3.55,2.08-9.04,4.79-16.4,6.7c-6.49,1.69-12.25,2.18-16.4,2.28c1.62-0.35,4.79-1.22,7.78-3.4
            c3.22-2.35,4.53-4.98,5.04-6.23"/>
          <path class="st0" d="M112.73,97.26c-1.4,1.13-3.52,2.59-6.44,3.84c-3.71,1.59-7.15,2.17-9.39,2.41c4.01,0.59,9.99,1.11,17.11,0.34
            c6.34-0.69,11.41-2.15,14.9-3.41"/>
          <path class="st0" d="M188.56,22.19c0.09,13.74,0.2,27.48,0.32,41.22c0.12,13.63,0.26,27.27,0.42,40.9
            c5.85-0.01,31.05-0.59,50.29-15.88c9.48-7.53,13.88-15.74,15.97-20.84c-10.38-0.72-20.76-1.45-31.14-2.17
            c10.53-2.21,21.05-4.43,31.58-6.64c-1.09-3.11-3.04-7.58-6.56-12.22c0,0-4.41-5.81-11.56-10.67
            C221.77,24.95,190.11,22.31,188.56,22.19z"/>
          <path class="st1" d="M33.66,31.09l45.53,19.8L42.6,63.73l36.6,14.39c-14.43,6.08-28.87,12.17-43.3,18.25"/>
          <path class="st1" d="M105.75,63.73c22.87,0.04,45.74,0.07,68.61,0.11"/>
          <path class="st1" d="M193.59,63.48c0-11.07,0-22.13,0-33.2c5.66,0.12,11.32,0.23,16.98,0.35c0.82,0.18,8.67,2.09,11.99,9.85
            c0.36,0.84,2.92,7.1-0.2,13.54c-2.93,6.05-9.67,9.76-17.03,9.37C201.42,63.41,197.5,63.44,193.59,63.48z"/>
          <path class="st1" d="M193.59,63.48c0,11.23,0,22.47,0,33.7c6.05-0.06,12.09-0.12,18.14-0.18c0.74-0.19,8.52-2.27,11.43-9.93
            c2.87-7.55-1.43-14.09-2.19-15.24c-5.22-7.95-14.66-8.41-15.64-8.44C201.42,63.41,197.5,63.44,193.59,63.48z"/>
        </svg>
      </div>
      <a class="navbar-brand m-0" href="../controllers/home.php">Метна-Вадя</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-md-0 d-flex align-items-start">
          <li class="nav-item">
            <a class="nav-link<?php if ( $active == 'home' ) echo " active" ?>" aria-current="page" href="../controllers/home.php">Начало</a>
          </li>
          <li class="nav-item">
            <a class="nav-link<?php if ( $active == 'shop' ) echo " active" ?>" href="/Course-work/controllers/shop.php">Магазин</a>
          </li>
          <li class="nav-item">
            <a class="nav-link<?php if ( $active == 'ai chat' ) echo " active" ?>" href="../controllers/ai_chat.php">AI Chat</a>
          </li>

        </ul>

        <ul class="navbar-nav ms-auto mb-2 mb-md-0 d-flex align-items-start">
          <li class="nav-item">
            <a class="nav-link<?php if ( $active == 'cart' ) echo " active" ?>" href="../controllers/cart.php"><span class="bi bi-cart h5"></span> Количка</a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-0" href="<?php if(isset($_SESSION["USER"])){echo '/Course-work/controllers/user_profile.php';} else{ echo '/Course-work/controllers/login.php';} ?>">
              <img src="../images/<?php if(isset($_SESSION["USER"][4])){echo 'profile/'.$_SESSION["USER"][4];} else{ echo 'site assets/defaultProfile.jpg';} ?>" alt="Profile" class="rounded-circle" width="36" height="36" style="object-fit: cover;">
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
