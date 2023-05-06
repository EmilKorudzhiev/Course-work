<?php 
$sqlGetProduct = '
SELECT * FROM products 
WHERE id=(?);
';

$getProductResult = $connection -> prepare($sqlGetProduct);

?>

<div class="container pt-5 my-5">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-9">
            <div class="card">

                <div class="card-header">
                    <h5>Количка</h5>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center border mb-2">
                            <div class="row">
                                <div class="col-12 col-sm-3 p-1">
                                    <img class="rounded float-left img-fluid" src="\Course-work\images\shop items\2_0.jpg" alt="">
                                </div>
                                <div class="col-12 col-sm-4 p-1">
                                    <input type="text" class="form-control" placeholder="Product name">
                                </div>
                                <div class="col-6 col-sm-2 p-1 text-center">
                                    <input type="number" class="form-control" placeholder="Price" step="0.01" min="0">
                                </div>
                                <div class="col-6 col-sm-2 p-1 text-center">
                                    <input type="number" class="form-control" placeholder="Quantity" min="1">
                                </div>
                                <div class="col-12 col-sm-1 p-0 d-flex align-items-center justify-content-center">
                                    <button type="button" class="btn btn-danger align-self-end"><i class="bi bi-trash"></i></button>
                                </div>
                            </div>
                        </li>
                        <?php 
                        foreach ($_SESSION["CART"] as $productId => $quantity) {
                            $getProductResult -> execute([$productId]);
                            //get make it show quantity and calculate price !!!!
                            echo '
                            <li class="list-group-item d-flex justify-content-between align-items-center border mb-2">
                                <div class="row">
                                    <div class="col-12 col-sm-3 p-1">
                                        <img class="rounded float-left img-fluid" src="\Course-work\images\shop items\2_0.jpg" alt="">
                                    </div>
                                    <div class="col-12 col-sm-4 p-1">
                                        <input type="text" class="form-control" placeholder="Product name">
                                    </div>
                                    <div class="col-6 col-sm-2 p-1 text-center">
                                        <input type="number" class="form-control" placeholder="Price" step="0.01" min="0">
                                    </div>
                                    <div class="col-6 col-sm-2 p-1 text-center">
                                        <input type="number" class="form-control" placeholder="Quantity" min="1">
                                    </div>
                                    <div class="col-12 col-sm-1 p-0 d-flex align-items-center justify-content-center">
                                        <button type="button" class="btn btn-danger align-self-end"><i class="bi bi-trash"></i></button>
                                    </div>
                                </div>
                            </li>
                            ';
                        }
                        ?>
                    </ul>
                </div>

            </div>
        </div>

        <div class="col-6 col-md-3">
            <div>
                
            </div>

        </div>

    </div>
</div>