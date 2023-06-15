<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Поръчка</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-10 offset-md-1">
        <div class="card mt-4">
          <div class="card-header">
            <h3>Поръчка</h3>
          </div>
          <div class="card-body">
            <p>Благодарим за пръчката Ви, ето какво сте си поръчали:</p>
            
            <ul class="list-group border p-2">
                <li class="list-group-item d-flex justify-content-between align-items-center border mb-2">
                    <div class="row">
                        <div class="col-12 col-sm-2 p-0 d-flex align-items-center">
                            <img class="rounded float-left img-fluid" src="images\shop items\1_0.jpg" alt="'.$getProductResult['path'].'">
                        </div>
                        <div class="col-12 col-sm-5 p-1 d-flex align-items-center">
                            <h3 class="form-control m-0">'.$getProductResult['name'].'</h3>
                        </div>
                        <div class="col-6 col-sm-3 p-1 text-center d-flex align-items-center">
                            <h3 class="form-control m-0">'.number_format($getProductResult['price'], 2).'лв.</h3>
                        </div>
                        <div class="col-6 col-sm-2 p-1 text-center d-flex align-items-center">
                            <h3 class="form-control m-0">'.$_SESSION['CART'][$productId].'x</h3>
                        </div>
                    </div>
                </li>
            </ul>

            <div class="d-flex justify-content-end mx-3">
                <p>Обща цена: </p>
            </div>

            <div>
                <p>Получател: [Customer Name]</p>
                <p>Адрес: [Shipping Address]</p>
                <p>Град: </p>
                <p>Доставка до вас / доставка до офис на Еконт</p>
                <p>Начин на плащане: [Payment Method]</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>