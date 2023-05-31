<?php 
require('../components/database_connection.inc.php');
$tags = $_POST["tags"] ?? null;
$priceRange = $_POST["range"] ?? null;
$page = $_POST["page"] ?? 1;
$itemsPerPage = $_POST["itemsPerPage"] ?? 24;

$pageDetails = array(
    intval($priceRange[0]), 
    intval($priceRange[1]), 
    intval($itemsPerPage), 
    intval(($page - 1) * $itemsPerPage));

if($tags == null){
    $sql="
    SELECT *
    FROM products
    LEFT OUTER JOIN products_has_tags ON products.id = products_has_tags.products_id
    LEFT OUTER JOIN tags ON products_has_tags.tags_id = tags.id
    LEFT OUTER JOIN images ON products.id = images.products_id
    WHERE price BETWEEN ? and ?
    GROUP BY products.id
    ;";
    $result = $connection -> prepare($sql);
    $result->bindParam( 1, $pageDetails[0], \PDO::PARAM_INT);
    $result->bindParam( 2, $pageDetails[1], \PDO::PARAM_INT);
    $result ->execute();
    $numOfItems = $result -> rowCount();
    $numOfPages = ceil ($numOfItems / $itemsPerPage);  

    $sql = "
    SELECT products.id, products.name, products.description, products.price,
        (SELECT GROUP_CONCAT(DISTINCT tags.tag SEPARATOR ', ')
        FROM products_has_tags
        JOIN tags ON products_has_tags.tags_id = tags.id
        WHERE products_has_tags.products_id = products.id
        ) AS tags,
        images.path
    FROM (
        SELECT id
        FROM products
        WHERE price BETWEEN ? AND ?
        ORDER BY id
        LIMIT ? OFFSET ?
    ) AS page_products
    LEFT OUTER JOIN products ON page_products.id = products.id
    LEFT OUTER JOIN products_has_tags ON products.id = products_has_tags.products_id
    LEFT OUTER JOIN tags ON products_has_tags.tags_id = tags.id
    LEFT OUTER JOIN images ON products.id = images.products_id
    GROUP BY products.id
    ;";
    $result = $connection->prepare($sql);
    $result->bindParam( 1, $pageDetails[0], \PDO::PARAM_INT);
    $result->bindParam( 2, $pageDetails[1], \PDO::PARAM_INT);
    $result->bindParam( 3, $pageDetails[2], \PDO::PARAM_INT);
    $result->bindParam( 4, $pageDetails[3], \PDO::PARAM_INT);

    $result ->execute();
}else{
    $placeholders = implode(',', array_fill(0, count($tags), '?'));

    $sql="
    SELECT *
    FROM products
    LEFT OUTER JOIN products_has_tags ON products.id = products_has_tags.products_id
    LEFT OUTER JOIN tags ON products_has_tags.tags_id = tags.id
    LEFT OUTER JOIN images ON products.id = images.products_id
    WHERE tags.tag IN ($placeholders) 
    AND price BETWEEN ? and ?
    GROUP BY products.id
    ;";
    $result = $connection -> prepare($sql);
    $count = 0;
    foreach ($tags as $index => $tag) {
        $result->bindValue($index+1, $tag);
        $count = $index+1;
    }
    $count=$count+1;
    $result->bindParam($count, $pageDetails[0], \PDO::PARAM_INT);
    $count=$count+1;
    $result->bindParam($count, $pageDetails[1], \PDO::PARAM_INT);
    
    $result ->execute();
    $numOfItems = $result -> rowCount();
    $numOfPages = ceil ($numOfItems / $itemsPerPage);  

    $sql = "
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
        WHERE tags.tag IN ($placeholders) 
        AND price BETWEEN ? AND ?
        ORDER BY products.id
        LIMIT ? OFFSET ?
    ) AS page_products
    LEFT OUTER JOIN products ON page_products.id = products.id
    LEFT OUTER JOIN products_has_tags ON products.id = products_has_tags.products_id
    LEFT OUTER JOIN tags ON products_has_tags.tags_id = tags.id
    LEFT OUTER JOIN images ON products.id = images.products_id
    GROUP BY products.id
    ;";
    $result = $connection->prepare($sql);
    
    $count = 0;
    foreach ($tags as $index => $tag) {
        $result->bindValue($index+1, $tag);
        $count = $index+1;
    }
    $count=$count+1;
    $result->bindParam($count, $pageDetails[0], \PDO::PARAM_INT);
    $count=$count+1;
    $result->bindParam($count, $pageDetails[1], \PDO::PARAM_INT);
    $count=$count+1;
    $result->bindParam($count, $pageDetails[2], \PDO::PARAM_INT);
    $count=$count+1;
    $result->bindParam($count, $pageDetails[3], \PDO::PARAM_INT);

    $result ->execute();
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
                            <p class="card-title text-dark text-truncate">'
                                . $row['name'] .
                            '</p>
                            <p class="text-secondary text-truncate">'
                                .$row['tags'].
                            '</p>
                            <p class="card-text text-dark pe-2">'
                            . $row['price'] . " лв." .
                            '</p>
                        </a>
                        
                    </div>
                    <div class="d-flex justify-content-center">
                        
                        <button class="btn btn-outline-dark p-2 align-self-center addToCartButton" type="button" value="'.$row["id"].'">
                            <span class="bi-cart-fill me-1"></span>
                            Купи
                        </button>
                    </div>
                </div>
            </div>
        </div>';
    }


    echo '
    <div class="d-flex justify-content-center w-100 mb-2">
        <ul class="pagination m-0">
            <li class="page-item ';
            if($page == 1)echo "disabled"; 
            echo '">
            <button class="page-link bi bi-caret-left paginationButton h-100" value="'. intval($page-1) .'"></button>
            </li>';


    $dif = 2;
    for ($i = 1; $i <= 5; $i++) {
        if(intval($page-$dif) > 0 && intval($page-$dif)<=$numOfPages){
        echo '<li class="page-item '; 
        if($page == intval($page-$dif))echo "disabled"; 
        echo '">
            <button class="page-link paginationButton" value="'.intval($page-$dif).'">'.intval($page-$dif).'</button>
        </li>';
        }
        $dif--;
    }

    echo '
            <li class="page-item ';
            if($page == $numOfPages)echo "disabled"; 
            echo '">
                <button class="page-link bi bi-caret-right paginationButton h-100" value="'. intval($page+1) .'"></button>
            </li>
        </ul>
    </div>';

    echo '</div>';
    
}

$response = ob_get_clean();
echo $response;


?>