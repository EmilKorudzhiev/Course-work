<?php 
$sql = "
SELECT products.id, products.name, products.description, products.price, products.quantity, tags.tag, images.path 
FROM products
JOIN products_has_tags ON products.id = products_has_tags.products_id
JOIN tags ON products_has_tags.tags_id = tags.id
JOIN images ON  products.id = images.products_id
GROUP BY products.id;
";
$result = $connection->query($sql);

while($row = $result->fetch()){
    echo 
    '<div class="col-sm-6 col-md-4 py-2">
        <a href=".\product.php?id='.$row["id"].'">
            <div class="card">
            <img src="..\images\shop items\\'.$row["path"].'" class="card-img-top shop-item-img border-bottom" alt="image"/>
                <div class="card-body">
                    <h5 class="card-title">'
                        . $row["name"] .
                    '</h5>
                    <p class="card-text">'
                        . $row["price"] . " лв." .
                    '</p>
                </div>
            </div>
        </a>
    </div>';
}

?>