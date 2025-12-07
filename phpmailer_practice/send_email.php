<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "vendor/autoload.php";

if($_SERVER['REQUEST_METHOD'] = 'POST'){

    $name = $_POST['fullname'];    
    $email = $_POST['email'];    
    $subject = $_POST['subject'];    
    $message = $_POST['message'];    

    $mail = new PHPMailer(true);

    try{

        $mail -> isSMTP();
        $mail -> isHTML(true);
        $mail -> Host = 'smtp.gmail.com';
        $mail -> Port = 587;
        $mail -> SMTPAuth = true;
        $mail -> SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail -> Username = 'zainab.rd.93@gmail.com';
        $mail -> Password = '';


        $mail -> setFrom('test@test.com',$name);
        $mail->addReplyTo($email, $name);
        $mail -> addAddress('zainab.rd.93@gmail.com','Zainab');
        $mail -> Subject = $subject;

        if(isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0){
            if(!empty($_FILES['attachment']['name'])){
                $mail -> addAttachment($_FILES['attachment']['tmp_name'],$_FILES['attachment']['name']);
            }            
        }
        $mail -> Body = "
     <html>
    <head>
        <title>$subject</title>
    </head>
    <body style='font-family: Arial; background:#f9f9f9; padding:20px;'>
        <div style='max-width:600px; margin:auto; background:white; padding:20px; border-radius:8px;'>
            <h2 style='color:#333;'>New Contact Form Message</h2>

            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Subject:</strong> $subject</p>

            <hr>

            <p style='font-size:16px; line-height:1.5;'>$message</p>

            <hr>
            <p style='font-size:14px; color:#555;'>This message was sent from your website contact form.</p>
        </div>
    </body>
    </html>
    ";

    if($mail -> send()){
        echo"Email send successfully";
    }else{
        echo"Error sending an email". $mail -> ErrorInfo;
    }


    }
    catch(Exception $e){
        echo"Message could'nt be send " . $mail -> ErrorInfo;
        echo"Message could not be send " . $e;
    }

}

?>