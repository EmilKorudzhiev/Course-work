<?php 
$sql = "
SELECT products.id, products.name, products.description, products.price, SUBSTRING_INDEX(GROUP_CONCAT(DISTINCT tags.tag SEPARATOR ', '), ', ', 2) as tags, images.path
FROM products
JOIN products_has_tags ON products.id = products_has_tags.products_id
JOIN tags ON products_has_tags.tags_id = tags.id
JOIN images ON  products.id = images.products_id
GROUP BY products.id
;
";
$result = $connection->query($sql);



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


?>