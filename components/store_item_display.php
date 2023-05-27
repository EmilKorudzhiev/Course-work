<?php 
require('../components/database_connection.inc.php');
$tags = $_POST["tags"] ?? null;
$priceRange = $_POST["range"] ?? null;
$itemsOnPage = 40;
$page = 1;

if($tags == null){
    $sql = "
    SELECT products.id, products.name, products.description, products.price,
        (SELECT GROUP_CONCAT(DISTINCT tags.tag SEPARATOR ', ')
        FROM products_has_tags
        JOIN tags ON products_has_tags.tags_id = tags.id
        WHERE products_has_tags.products_id = products.id
        ) AS tags
        ,images.path
    FROM products
    JOIN products_has_tags ON products.id = products_has_tags.products_id
    JOIN tags ON products_has_tags.tags_id = tags.id
    JOIN images ON products.id = images.products_id
    WHERE products.price BETWEEN (?) AND (?)
    GROUP BY products.id
    ;";
    $result = $connection->prepare($sql);
    $result ->execute($priceRange);
}else{
    $placeholders = implode(',', array_fill(0, count($tags), '?'));
    $info = array_merge($tags,$priceRange);
    $sql = "
    SELECT products.id, products.name, products.description, products.price,
        (SELECT GROUP_CONCAT(DISTINCT tags.tag SEPARATOR ', ')
        FROM products_has_tags
        JOIN tags ON products_has_tags.tags_id = tags.id
        WHERE products_has_tags.products_id = products.id
        ) AS tags
        ,images.path
    FROM products
    JOIN products_has_tags ON products.id = products_has_tags.products_id
    JOIN tags ON products_has_tags.tags_id = tags.id
    JOIN images ON products.id = images.products_id
    WHERE tags.tag IN  ($placeholders)
    AND products.price BETWEEN (?) AND (?)
    GROUP BY products.id
    ;";
    $result = $connection->prepare($sql);
    $result ->execute($info);
}



ob_start();
if($result -> rowCount() == 0) {
    echo 
    '<div class="p-5">
        <h1 class="text-center">Няма намерени артикули с тези характеристики.</h1>
    </div>';
}else{
    echo '<div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 w-100 m-0">';
    while($row = $result->fetch()){
        echo 
        '<div class="p-2">
            <div class="card h-100">
                <a href=".\product.php?id='.$row["id"].'">
                    <img src="..\images\shop items\\'.$row["path"].'" id="productImg" class="card-img-top border-bottom" alt="image"/>
                </a>  
                <div class="card-body p-2">
                    <div>
                        <a href=".\product.php?id='.$row["id"].'">
                            <p class="card-title text-dark">'
                                . $row['name'] .
                            '</p>
                            <p class="text-secondary">'
                                .$row['tags'].
                            '</p>
                            <p class="card-text text-dark pe-2">'
                            . $row['price'] . " лв." .
                            '</p>
                        </a>
                        
                    </div>
                    <div class="d-flex justify-content-center">
                        
                        <button class="btn btn-outline-dark p-2 align-self-center" type="button">
                            <span class="bi-cart-fill me-1"></span>
                            Купи
                        </button>
                    </div>
                </div>
            </div>
        </div>';
    }



    echo '</div>';
}
$response = ob_get_clean();
echo $response;


?>