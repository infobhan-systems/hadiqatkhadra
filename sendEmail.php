<?php

use PHPMailer\PHPMailer\PHPMailer;


if(isset($_POST['name']) && isset($_POST['email'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $email_template = file_get_contents('email_template.html');
    $email_template = str_replace('$name', $name, $email_template);
    $email_template = str_replace('$email', $email, $email_template);
    $email_template = str_replace('$message', $message, $email_template);

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail = new PHPMailer();

    #SMTP Settings
    $mail->isSMTP();
    $mail->Host = "a2plcpnl0443.prod.iad2.secureserver.net";
    $mail->SMTPAuth = true;
    $mail->Username= "mailer@infobhan.tech";
    $mail->Password="MailAdmin@7166";
    $mail->Port=465;
    $mail->SMTPSecure="ssl";

    $body=$email_template;

    //email settings
    $mail->isHTML(true);
    $mail->setFrom("mailer@infobhan.tech","Website Contact Form");
    $mail->addAddress("ameen.adeeb@gmail.com");
    $mail->Subject="$name (Enquiry) $email";
    $mail->Body = $body;

    if($mail->send()){
        $status = "success";
        $response = "Email is sent!";
    }
    else{
        $status = "failed";
        $response = "Something is wrong: <br>".$mail->ErrorInfo;
    }

    exit(json_encode(array("status" => $status, "response" => $response)));

}

?>