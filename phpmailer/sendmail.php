<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// error_reporting(0); hataları ekranda göstermemek için (aksi halde hackerlar bu hata mesajlarını kullanabilirler

$sender = isset($_POST['name']) ? $_POST['name'] : '';
$sender .= " ";
$sender .= isset($_POST['surname']) ? $_POST['surname'] : '';
$sender_email = isset($_POST['email']) ? $_POST['email'] : '';
$email_subject = isset($_POST['subject']) ? $_POST['subject'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

//Create a new PHPMailer instance:
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable or disable SMTP debugging:
// 0 = messages off (for production stage)
// 1 = client messages on (for test stage)
// 2 = client and server messages on(for development stage)
$mail->SMTPDebug = 0; // 0: Debug: off, 1: Debug on;

//Ask for HTML-friendly debug output if $mail->SMTPDebug = 0 or 1
$mail->Debugoutput= 'html';

//Set the hostname of the mail server:
$mail->Host ="smtp.gmail.com";
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number – 587 for authenticated TLS, 465 for ssl:
$mail->Port = 587; //587 for tls, 465 for ssl

//Set the encryption system to use – ssl (deprecated) or tls:
$mail->SMTPSecure='tls'; // 'ssl'

//Whether to use SMTP authentication:
$mail->SMTPAuth=true;

//Whether to keep SMTP alive while sending message:
$mail->SMTPKeepAlive=true;


//Username to use for SMTP authentication – use full email address for gmail
$mail->Username= "febatilim@gmail.com";

//Password to use for SMTP authentication:
$mail->Password ="febatilim2018";

//Set who the message is to be sent from:
$mail->setFrom($sender_email,$sender);

//Set an alternative reply-to address:
$mail->addReplyTo('febatilim@gmail.com');

//Set who the message is to be sent to
$mail->addAddress('haytastan@gmail.com', 'Mr Hayati TAŞTAN');

//Set who the message is to be sent to (as CC)
$mail->addCC('haytastan@gmail.com','Hayyam TAŞTAN');

//Set who the message is to be sent to (as Secret)
$mail->addBCC('hayati.tastan@afad.gov.tr','Dr. Hayati TAŞTAN');

//Set the char set of the message:
$mail->CharSet = 'UTF-8';

//Set the subject line:
$mail->Subject = $email_subject;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body:
// $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
// veya:
// $mail->msgHTML('Mesaj İçeriği');
//veya:

//Read from here:
//$mail->isHTML(true);
//$mail->Body = "<h1> Hello Eren!</h1><p> How are you? This is an email from PHP</p>";

$mail->msgHTML($message);

//Replace the plain text body with one created manually
//$mail->AltBody = 'And this is a plain-text message body';

//Attach files:
$mail->addAttachment('images/set.jpg');
$mail->addAttachment('docs/send_email_via_php.txt');
$mail->addAttachment('rars/php.rar');

//send the message, check for errors:
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
// Hesabım, oturum açma ve güvenlik, hesabae erişim olan uygulamalar, daha az güvenli uygulamalara İZİN VER: açık olmalı
// ÇAlıştuırmadan önce wamp çalıştırılmalı
// php config yapılarak php interpreter, dizin adresi (örn: C:/wamp/php) ve lokal adres (örn: http:\\localhost\php) tanımlanmalı
// video: https://www.youtube.com/watch?v=9XV5l2O1IJU
// KAYNAK: https://kadirkasim.com/

?>

