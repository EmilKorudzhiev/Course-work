<?php 
if(!isset($_SESSION["USER"])){
  header("Location: /Course-work/controllers/home.php");
}

if($_SESSION["USER"][5] == "user"){
  header("Location: /Course-work/controllers/home.php");
}


$sqlGetTags = '
SELECT * from tags;
';
$resultTags = $connection -> query($sqlGetTags) -> fetchAll();




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
  <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

</head>
<body>
<h1 class="text-danger text-center my-3">ADMIN PANEL</h1>  

//make it work and redact elements

<div class="container mb-5">
  <div class="row justify-content-center">
    <div class="col-10 col-sm-8 col-lg-7 border border-black mb-3">
      <h2>Добавяне на продукт</h2>
      <form action="">
        <div class="mb-3">
          <label for="productName" class="form-label">Име</label>
          <input type="text" class="form-control" id="productName" required>
        </div>
        <div class="mb-3">
          <label for="productDescription" class="form-label">Описание</label>
          <textarea class="form-control" id="productDescription" rows="3" required></textarea>
        </div>
        <div class="mb-3">
          <label for="productPrice" class="form-label">Цена</label>
          <input type="number" class="form-control" id="productPrice" min="0.00" max="10000.00" step="0.01" required>
        </div>
        <div class="mb-3">
          <label for="productImage" class="form-label">Снимки</label>
          <input type="file" class="form-control" id="productImage" required multiple>
        </div>
        <div class="mb-3">
          <label for="productTags">Тагове</label>
          <div class="row row-cols-3">
              <?php
              foreach ($resultTags as $tag) {
                echo '
                <div class="form-check mb-3">
                  <input type="checkbox" id="tag'.$tag["id"].'">
                  <label for="tag'.$tag["id"].'" class="form-label">'.$tag["tag"].'</label>
                </div>
                ';
              }
              ?>
          </div>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Добави</button>
      </form>
    </div>

    <div class="col-10 col-sm-8 col-lg-7 border border-black mb-3">
      <h2>Добавяне на таг</h2>
      <form action="">
        <div class="mb-3">
          <label for="tagName" class="form-label">Име на таг</label>
          <input type="text" class="form-control" id="tagName" required>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Добави</button>
      </form>
    </div>
  
  </div>
</div>

</body>
</html>