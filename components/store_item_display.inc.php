<?php 
$sql = "
SELECT products.id, products.name, products.description, products.price, products.quantity, SUBSTRING_INDEX(GROUP_CONCAT(DISTINCT tags.tag SEPARATOR ', '), ', ', 2) as tags, images.path
FROM products
JOIN products_has_tags ON products.id = products_has_tags.products_id
JOIN tags ON products_has_tags.tags_id = tags.id
JOIN images ON  products.id = images.products_id
;
";
$result = $connection->query($sql);

while($row = $result->fetch()){
    echo 
    '<div class="py-2 pb-2">
        <a href=".\product.php?id='.$row["id"].'">
            <div class="card">
            <img src="..\images\shop items\\'.$row["path"].'" class="card-img-top border-bottom" alt="image"/>
                <div class="card-body">
                    <p class="card-title">'
                        . $row['name'] .
                    '</p>
                    <p class="text-secondary">'
                        .$row['tags'].
                    '</p>
                    <p class="card-text">'
                        . $row['price'] . " лв." .
                    '</p>
                </div>
            </div>
        </a>
    </div>';
}


?>