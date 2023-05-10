<?php 
$sqlGetProduct = '
SELECT * FROM products 
JOIN images ON  products.id = images.products_id
WHERE products.id=(?);
';

$getProduct= $connection -> prepare($sqlGetProduct);

?>
make remove button make shop button work 
<div class="container pt-5 my-5">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-9">
            <div class="card">

                <div class="card-header">
                    <h5>Количка</h5>
                </div>

                
                <div class="card-body">
                    <ul class="list-group">
                        
                        <?php 
                        if(empty($_SESSION["CART"])){
                            echo '
                                <li class="list-group-item d-flex justify-content-centre align-items-center border mb-2">
                                    <h2 class="p-3">Количката е празна. Хайде на шопинг.</h2>
                                    <a href="/Course-work/controllers/store.php" class="btn btn-primary m-3">Към магазина</a>
                                </li>
                                ';
                        }else{
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
                                            <h3 class="form-control">'.$getProductResult['price'].'лв.</h3>
                                        </div>
                                        <div class="col-6 col-sm-2 p-1 text-center d-flex align-items-center">
                                            <h3 class="form-control">'.$_SESSION['CART'][$productId].'x</h3>
                                        </div>
                                        <div class="col-12 col-sm-1 p-0 d-flex align-items-center justify-content-center">
                                            <form id="removeItem">
                                                <button id="removeButton" type="submit" value="'.$productId.'" class="btn btn-danger align-self-end"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                                ';
                            }
                        }
                        ?>
                    </ul>
                </div>

            </div>
        </div>

        <div class="col-6 col-md-3">
            <div>
                buttons
            </div>

        </div>

    </div>
</div>

<script> 
  
  $("#removeItem").on("submit", function(e) {
    //e.preventDefault();
    var id = $("#removeButton").val();
    

    $.ajax({
      url: "/Course-work/components/remove_product_cart.php",
      type: "post",
      data: {
        id: id
      },
      dataType: "json",
      success: function(response) {
        alert(response);
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  });
</script>