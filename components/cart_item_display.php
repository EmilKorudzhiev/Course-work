<?php 
$sqlGetProduct = '
SELECT * FROM products 
JOIN images ON  products.id = images.products_id
WHERE products.id=(?);
';

$getProduct= $connection -> prepare($sqlGetProduct);


ob_start();
if(empty($_SESSION["CART"])){
    echo '
        <li class="list-group-item d-flex justify-content-centre align-items-center border mb-2">
            <h2 class="p-3">Количката е празна. Хайде на шопинг.</h2>
            <a href="/Course-work/controllers/store.php" class="btn btn-primary m-3">Към магазина</a>
        </li>
        ';
}else{
    $priceOfAllElements = 0;
    foreach ($_SESSION["CART"] as $productId => $quantity) {
        $getProduct -> execute([$productId]);
        $getProductResult = $getProduct -> fetch();
        echo '
        <li class="list-group-item d-flex justify-content-between align-items-center border mb-2">
            <div class="row">
                <div class="col-12 col-sm-2 p-1 d-flex align-items-center p-0">
                    <img class="rounded float-left img-fluid" src="\Course-work\images\shop items\\'.$getProductResult['path'].'" alt="'.$getProductResult['path'].'">
                </div>
                <div class="col-12 col-sm-4 p-1 d-flex align-items-center">
                    <h3 class="form-control">'.$getProductResult['name'].'</h3>
                </div>
                <div class="col-6 col-sm-3 p-1 text-center d-flex align-items-center">
                    <h3 class="form-control">'.number_format($getProductResult['price'], 2).'лв.</h3>
                </div>
                <div class="col-6 col-sm-2 p-1 text-center d-flex align-items-center">
                    <h3 class="form-control">'.$_SESSION['CART'][$productId].'x</h3>
                </div>
                <div class="col-12 col-sm-1 p-0 d-flex align-items-center justify-content-center">
                    <div>
                        <button value="'.$productId.'" class="btn btn-danger align-self-end bi bi-trash removeButton"></button>
                    </div>
                </div>
            </div>
        </li>
        '; 
        $priceOfAllElements += $getProductResult['price']*$_SESSION['CART'][$productId];
    }

    
    echo'
    <li class="list-group-item d-flex border mb-2">
        <div class="row w-100 d-flex justify-content-end">                
            <div class="col-lg-6 p-1 text-center d-flex align-items-center">
                <h3 class="form-control ms-1">Общо: </h3>
                <h3 class="form-control ms-1">'.number_format($priceOfAllElements, 2).'лв.</h3>
            </div>                 
        </div>
    </li>';

}
$response = ob_get_clean();
echo $response;
?>