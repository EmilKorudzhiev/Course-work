<?php
require_once('../vendor/erusev/parsedown/Parsedown.php');
$parsedown = new Parsedown();

$id = (int) $_GET["id"];

$sqlSelectItemDetails = "
SELECT products.id, products.name, products.description, products.price, tags.tag, images.path 
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

<div class="p-5 mt-3 pb-2">
    <div class="container px-2 py-3">
        <div class="row justify-content-center">
            <div class="col-md-6 d-flex justify-content-center">
                <div id="ProductCarousel" class="carousel slide rounded border border-gray" data-bs-ride="carousel" style="max-width:500px; max-height: 500px;">
                    <div class="carousel-inner">
                        <?php $isActive = true;
                        foreach ($productData["images"] as $img) {
                            echo '
                            <div class="carousel-item '.($isActive ? 'active':'').'">
                            <img src="/Course-work/images/shop items/'.$img.'" class="d-block w-100 rounded" alt="'.$img.'">
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
                <h2 class="mt-0 ps-3 pt-2"><?php echo $productData["price"]?> лв.</h2>
                <h6 class="text-secondary">
                    Tags: 
                    <?php
                    echo implode(', ',$productData['tags']);
                    ?>
                </h6>
                <div class="row py-3">
                    <div class="col-8 col-sm-6 col-md-9 col-lg-7 col-xl-6">
                        <form id="addToCart">
                            <div class="input-group">
                                <input type="number" class="form-control" value="1" min="1" max="10" id="quantity" aria-describedby="basic-addon2">
                                <button class="btn btn-outline-dark" type="submit" id="add" value="<?php echo $id ?>"><span class="bi-cart-fill me-1"></span>Добави в количка</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-10 pt-md-3">
                <?php echo $parsedown->text($productData['description']); ?>
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

<script>
    $("#addToCart").on("submit", function(e) {
    e.preventDefault();
    var quantity = $("#quantity").val();
    var id = $("#add").val();
    alert(id);

    $.ajax({
      url: "/Course-work/components/update_cart.php",
      type: "post",
      data: {
        id: id,
        quantity: quantity
      },
      success: function(response) {
        alert(response);
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
    });
</script>