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


try {
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
        <tr>
            <td style="padding: 10px;
                        text-align: left;
                        border-bottom: 1px solid #dddddd;">
                <img style="max-width: 100px;
                            height: auto;
                            margin-right: 10px;"
                src="cid:'.$getProductResult["path"].'" alt="'.$getProductResult['name'].'">
            </td> 
            <td style="padding: 10px;
                        text-align: left;
                        border-bottom: 1px solid #dddddd;">'.$getProductResult['name'].'</td>
            <td style="padding: 10px;
                        text-align: left;
                        border-bottom: 1px solid #dddddd;">'.$_SESSION['CART'][$productId].'x</td>
            <td style="padding: 10px;
                        text-align: left;
                        border-bottom: 1px solid #dddddd;">'.number_format($getProductResult['price'], 2).' лв.</td>
        </tr>
        ';
        $priceOfAllElements += $getProductResult['price']*$_SESSION['CART'][$productId];
        $mail->addEmbeddedImage('../images/shop items/'.$getProductResult["path"], $getProductResult["path"]); 
    }
    $body = '
    <body style="font-family: Arial, sans-serif;
                 background-color: #f5f5f5;
                 margin: 0;
                 padding: 0;">

        <div style="max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #ffffff;
                    border: 1px solid #dddddd;
                    border-radius: 6px;
                    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);">

            <h1 style="font-size: 24px;
                       color: #333333;
                       margin-top: 0;
                       margin-bottom: 20px;">Поръчка</h1>

            <p style="font-size: 12px;
                      margin-bottom: 10px;">Благодарим за поръчката Ви, ето какво сте си поръчали:</p>
            
            <table style="width: 100%;
                          border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f5f5f5;">
                        <th style="padding: 10px;
                                   text-align: left;
                                   border-bottom: 1px solid #dddddd;">Снимка</th>
                        <th style="padding: 10px;
                                   text-align: left;
                                   border-bottom: 1px solid #dddddd;">Име на продукт</th>
                        <th style="padding: 10px;
                                   text-align: left;
                                   border-bottom: 1px solid #dddddd;">Бройка</th>
                        <th style="padding: 10px;
                                   text-align: left;
                                   border-bottom: 1px solid #dddddd;">Цена</th>
                    </tr>
                </thead>
    
                <tbody>
                '.$listOfProducts.'
                </tbody>
    
                <tfoot>
                    <tr>
                        <td style="text-align: right;
                                   font-weight: bold;"
                        colspan="4">Общо: '.number_format($priceOfAllElements,2).' лв.</td>
                    </tr>
                </tfoot>
            </table>
    
            <p style="font-size: 12px;">Получател: '.$_SESSION["USER"][0]." ".$_SESSION["USER"][1].'</p>
            <p style="font-size: 12px;">Град: '.$city.'</p>

            '.($address == null ? 
            '<p style="font-size: 12px;">Доставка до офис на Еконт</p>' :
            '<p style="font-size: 12px;">Адрес: '.$address.'</p>
            <p style="font-size: 12px;">Доставка до вас </p>').'
            
            <p style="font-size: 12px;">Начин на плащане:'.($cardNumber == null ? 'Плащане на място' : 'Платено с карта').'</p>
    
            <p style="font-size: 10px;
                      margin-top: 20px;
                      margin-bottom: 5px;"
                      >Metna-Vadq</p>
            
        </div>
    </body>';

    $mail->Body = $body;


    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>