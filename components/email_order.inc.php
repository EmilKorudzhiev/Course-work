<?php 
require("../accessDetails/emailAppPassword.php");

require_once ('../vendor/autoload.php');
require_once ('../vendor/phpmailer/phpmailer/src/PHPMailer.php');
require_once ('../vendor/phpmailer/phpmailer/src/SMTP.php');
require_once ('../vendor/phpmailer/phpmailer/src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);



$sqlGetProduct = '
SELECT * FROM products 
JOIN images ON  products.id = images.products_id
WHERE products.id=(?);
';
$getProduct= $connection -> prepare($sqlGetProduct);

$listOfProducts='';                    
$priceOfAllElements = 0;
foreach ($_SESSION["CART"] as $productId => $quantity) {
    $getProduct -> execute([$productId]);
    $getProductResult = $getProduct -> fetch();
    $listOfProducts .='
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
    ';
    $priceOfAllElements += $getProductResult['price']*$_SESSION['CART'][$productId];
}

$body = '
<!DOCTYPE html>
<html lang="bg">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Поръчка</title>
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
                
                    <ul class="list-group border p-2">'
                    .$listOfProducts.
                    '</ul>

                    <div class="d-flex justify-content-end mx-3">
                        <p>Обща цена: '.$priceOfAllElements.'лв.</p>
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
</html>';

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = _GMAIL;
    $mail->Password = _GMAIL_APP_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    $mail->CharSet ='UTF-8';

    $mail->setFrom(_GMAIL, 'Metna-Vadq');
    $mail->addAddress($_SESSION["USER"][3], $_SESSION["USER"][0].' '.$_SESSION["USER"][1]);    
   
    $mail->isHTML(true);
    $mail->Subject = 'Поръчка за '. $_SESSION["USER"][0] .' '. $_SESSION["USER"][1];
    $mail->Body = $body;


    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>