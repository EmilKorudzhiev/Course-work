<?php
    require('../components/database_connection.inc.php');
    date_default_timezone_set("Europe/Sofia");

    $city = $_POST["city"];
    $address = $_POST["address"] ?? null;
    $cardNumber = $_POST["cardNumber"] ?? null;
    $cardName = $_POST["cardName"] ?? null;
    $expiryDate = $_POST["expiryDate"] ?? null;
    $cvv = $_POST["cvv"] ?? null;
  
    $sqlGetUserInfo = "
    SELECT * FROM users 
    WHERE email = ?
    ;";
    $userResult = $connection -> prepare($sqlGetUserInfo);
    $userResult -> execute([$_SESSION["USER"][3]]);
    $userResult = $userResult -> fetch();

    $userID = $userResult["id"];

    $sqlInserOrder = "
    INSERT INTO orders (user_id, city, address, date_ordered)
    VALUES (?,?,?,?)
    ;";
    $insertOrder = $connection -> prepare($sqlInserOrder);
    $insertOrder -> execute([$userID,$city,$address,date("Y-m-d H:i:s")]);
    $order_id = $connection -> lastInsertId();

    $sqlInsertItems = "
    INSERT INTO orders_has_products (orders_id, products_id, number_of_product_ordered)
    VALUES (?,?,?)
    ;";
    $insertItems = $connection -> prepare($sqlInsertItems);
    foreach ($_SESSION["CART"] as $product => $quantity) {
        $insertItems -> execute([$order_id, $product, $quantity]);
    }
    
    ob_start();
    echo '
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-lg-8 list-group p-0 border">
                <h3 class="text-center">Поръчката беше създадена.</h3>
                <h5 class="text-center">На имейла Ви ще бъде изпратена информация за поръчката.</h5>
                <div class="d-flex justify-content-center p-3">
                    <a href="/Course-work/controllers/home.php" class="btn btn-primary mx-3">Към началната страница</a>
                </div>
            </div>
        </div>
    </div>
    ';

    $response = ob_get_clean();
    echo $response;

    require("../components/email_order.inc.php");
    
    unset($_SESSION["CART"]);
?>