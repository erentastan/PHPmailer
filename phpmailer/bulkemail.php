<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer();


$mail->isSMTP();
$mail->SMTPKeepAlive = true;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls'; //ssl

$mail->Port = 587; //25 , 465 , 587
$mail->Host = "smtp.gmail.com";

$mail->Username = "febatilim@gmail.com";
$mail->Password = "febatilim2018";


$mail->setFrom("febatilim@gmail.com");

$data = [
    [
        "id" => 1,
        "name" => "Eren TAŞTAN",
        "email" => "tastan.seren@atilim.edu.tr"
    ],
    [
        "id" => 2,
        "name" => "Emre TAŞTAN",
        "email" => "haytastan@gmail.com"
    ],
    [
        "id" => 3,
        "name" => "Hayati TAŞTAN",
        "email" => "hayati.tatsan@gmail.com"
    ]
];


foreach ($data as $d){
    $mail->addAddress($d["email"]);

    $body = file_get_contents('./bulkemail-template.html');

    $gelen = ["username","userID"];
    $giden = [$d["name"],$d["id"]];

    $body = str_replace($gelen,$giden,$body);

    $mail->isHTML(true);
    $mail->Subject = "Hosgeldin ".$d["name"];
    $mail->Body = $body;

    if ($mail->send()) {
        echo "Mail sent to: " . $d["name"] . " - Email: " . $d["email"];
        echo('<br>');
    }
    else
        echo "Malesef olmadi. HATA : ".$mail->ErrorInfo;

    $mail->clearAddresses();
    $mail->clearAttachments();
}

?>