<?php 

require_once('phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

$promo = $_POST['promo'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$adress = $_POST['adress'];
$second_adress = $_POST['second_adress'];
$social = $_POST['social'];
$account_name = $_POST['account_name'];
$product_links = $_POST['product_links'];
$product_count = $_POST['product_count'];
$comment = $_POST['comment'];

 

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mail.ru';  																							// Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'wsb-orders@mail.ru'; // Ваш логин от почты с которой будут отправляться письма
$mail->Password = 'sDSjr1m6rpbbiVmU1xAC'; // Ваш пароль от почты с которой будут отправляться письма
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465; // TCP port to connect to / этот порт может отличаться у других провайдеров

$mail->setFrom('wsb-orders@mail.ru'); // от кого будет уходить письмо?
$mail->addAddress('worldshoppingbuyers@gmail.com');     // Кому будет уходить письмо 
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Заявка с тестового сайта';
$mail->Body    = '' .'Имя:  '.$name .'<br/>' . 'Фамилия:  ' .$surname . '<br/>' .'Tелефон:  ' .$phone. '<br/>' . 'Почта:  ' .$email .'<br/>' . 'Адрес:  ' .$adress . '<br/>' . 'Второй адрес:  ' .$second_adress . '<br/>' . 'Социальная сеть:  ' .$social . '<br/>' . 'Аккаунт:  ' .$account_name . '<br/>' . 'Ссылки на товары:  ' .$product_links . '<br/>' . 'Количество товаров:  ' .$product_count . '<br/>' . 'Комменатрий:  ' .$comment . '<br/>' . 'Промо-код:  ' .$promo;
$mail->AltBody = '';

if(!$mail->send()) {
    header('location: error.html');
} else {
    header('location: thankyou.html');
}
?>