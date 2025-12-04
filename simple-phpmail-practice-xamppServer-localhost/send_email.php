<?php 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $subj = $_POST['subject'];
    $messageText = $_POST['message'];
    // $img = $_POST['image'];
    $to='zainwebtaker@gmail.com';


   $headers  = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";

    $message = "
     <html>
    <head>
        <title>$subj</title>
    </head>
    <body style='font-family: Arial; background:#f9f9f9; padding:20px;'>
        <div style='max-width:600px; margin:auto; background:white; padding:20px; border-radius:8px;'>
            <h2 style='color:#333;'>New Contact Form Message</h2>

            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Subject:</strong> $subj</p>

            <hr>

            <p style='font-size:16px; line-height:1.5;'>$messageText</p>

            <hr>
            <p style='font-size:14px; color:#555;'>This message was sent from your website contact form.</p>
        </div>
    </body>
    </html>
    ";

    if(mail($to,$subj,$message,$headers)){
        echo"Email sent successfull";
    }
    else{
        echo"Error sending email";
    }

}

?>