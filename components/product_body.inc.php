<?php
$id = $_GET["id"];

$sqlSelectItemDetails = "
SELECT products.id, products.name, products.description, products.price, products.quantity, tags.tag, images.path 
FROM products
JOIN products_has_tags ON products.id = products_has_tags.products_id
JOIN tags ON products_has_tags.tags_id = tags.id
JOIN images ON  products.id = images.products_id
WHERE products.id = (?) ;
";
$product = $connection->prepare($sqlSelectItemDetails);
$product -> execute([$id]);
$productData = [];
while ($row = $product->fetch(PDO::FETCH_ASSOC)){
    $productData['name'] = $row['name'];
    $productData['price'] = $row['price'];
    $productData['description'] = $row['description'];
    $productData['tags'][] = $row['tag'];
    $productData['images'][] = $row['path'];
}
$productData['tags'] = array_unique($productData['tags']);
$productData['images'] = array_unique($productData['images']);


$sqlSelectRelatedItems = '

';

?>

<div class="p-5 pb-2">
    <div class="container px-2 py-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div id="ProductCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php $isActive = true;
                        foreach ($productData["images"] as $img) {
                            echo '
                            <div class="carousel-item '.($isActive ? 'active':'').'">
                            <img src="/Course-work/images/shop items/'.$img.'" class="d-block w-100" alt="'.$img.'">
                            </div>
                            ';
                            $isActive = false;
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev btn btn-outline-secondary" type="button" data-bs-target="#ProductCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>
                    <button class="carousel-control-next btn btn-outline-secondary" type="button" data-bs-target="#ProductCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
            <div class="col-md-6 pt-lg-5">
                <h1 class="fw-bold"><?php echo $productData["name"]?></h1>
                <h2 class="mt-0 ps-3"><?php echo $productData["price"]?> лв.</h2>
                <h6 class="text-secondary">
                    Tags: 
                    <?php
                    echo implode(', ',$productData['tags']);
                    ?>
                </h6>
                <div class="py-3">
                    <button class="btn btn-outline-dark" type="button">
                        <span class="bi-cart-fill me-1"></span>
                        Добави в количка
                    </button>
                </div>
                <p>
                    <?php echo $productData['description'] ?>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="py-3 bg-light w-100">
    <div class="container px-1">
        <h2 class="text-center pb-3 m-0 fw-bold">Подобни продукти</h2>

        <div class="row row-cols-2 row-cols-md-4 justify-content-center"> 

            <div class="col pb-3">
                <a href="">
                    <div class="card">
                    <img src="..\images\shop items\160913240_7-700x700.jpg" class="card-img-top border-bottom" alt="image"/>
                        <div class="card-body">
                            <h5 class="card-title">
                                erwstrssgf
                            </h5>
                            <p class="card-text">
                                13.20 лв
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col pb-3">
                <a href="">
                    <div class="card">
                    <img src="..\images\shop items\160913240_7-700x700.jpg" class="card-img-top border-bottom" alt="image"/>
                        <div class="card-body">
                            <h5 class="card-title">
                                erwstrssgf
                            </h5>
                            <p class="card-text">
                                13.20 лв
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col pb-3">
                <a href="">
                    <div class="card">
                    <img src="..\images\shop items\160913240_7-700x700.jpg" class="card-img-top border-bottom" alt="image"/>
                        <div class="card-body">
                            <h5 class="card-title">
                                erwstrssgf
                            </h5>
                            <p class="card-text">
                                13.20 лв
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col pb-3">
                <a href="">
                    <div class="card">
                    <img src="..\images\shop items\160913240_7-700x700.jpg" class="card-img-top border-bottom" alt="image"/>
                        <div class="card-body">
                            <h5 class="card-title">
                                erwstrssgf
                            </h5>
                            <p class="card-text">
                                13.20 лв
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            
        </div>
    </div>
</div>