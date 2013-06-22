<?php
include("phpMailer/class.phpmailer.php");
include("phpMailer/class.smtp.php");

global $mail;

$mail = new PHPMailer();

$mail->IsSMTP();

$mail->SMTPAuth = true;

$mail->SMTPSecure = "ssl";

$mail->Host = "smtp.gmail.com";

$mail->Port = 465;

$mail->Username = "cvs.aw.urjc@gmail.com";

$mail->Password = "futurama";

$mail->From = "cvs.aw.urjc@gmail.com";

?>
