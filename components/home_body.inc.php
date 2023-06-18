<?php 
  $sqlSelectItems = "
  SELECT products.id, products.name, products.description, products.price,
        (SELECT GROUP_CONCAT(DISTINCT tags.tag SEPARATOR ', ')
        FROM products_has_tags
        JOIN tags ON products_has_tags.tags_id = tags.id
        WHERE products_has_tags.products_id = products.id
        ) AS tags,
        images.path
    FROM (
        SELECT products.id
        FROM products
		LEFT OUTER JOIN products_has_tags ON products.id = products_has_tags.products_id
        LEFT OUTER JOIN tags ON products_has_tags.tags_id = tags.id 
        ORDER BY products.id
    ) AS page_products
    LEFT OUTER JOIN products ON page_products.id = products.id
    LEFT OUTER JOIN products_has_tags ON products.id = products_has_tags.products_id
    LEFT OUTER JOIN tags ON products_has_tags.tags_id = tags.id
    LEFT OUTER JOIN images ON products.id = images.products_id
    GROUP BY products.id
    ORDER BY rand()
    LIMIT 3
    ;";
    $items = $connection->prepare($sqlSelectItems);
    $items -> execute();
    ?>


<div class="mainPic pt-5 m-0 my-5">
  <div class="container py-5">
    <h1 class="ps-2 pt-3">
      Мястото за всеки рибар!
    </h1>

    <h2 class="ps-5">
      Метна-Вадя Ви предоставя голям набор от продукти за вашите рибарски приключения.
    </h2>
  </div>
</div>

<div class="row justify-content-center w-100 m-auto">
  <div class="row col-md-10 col-lg-8 col-xl-6 m-0 mb-5 justify-content-center">
    <h1>Продукти, които ще ви харесат</h1>

    <?php 
    while($row = $items->fetch()){
      echo '
      <div class="col-6 col-sm-4 mb-2">
        <a href=".\product.php?id='.$row["id"].'">
          <div class="card">
            <img src="..\images\shop items\\'.$row["path"].'" id="productImg" class="card-img-top border-bottom" alt="'.$row["path"].'"/>
            <div class="card-body">
              <h5 class="card-title text-truncate">
              '.$row["name"].'
              </h5>
              <p class="card-text">
              '.$row["price"].'лв.
              </p>
            </div>
          </div>
        </a>
      </div>';
    }
    ?>
  </div>
</div>  
