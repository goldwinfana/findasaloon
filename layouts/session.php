<?php
	include 'conn.php';

        session_start();


        function sendMAil($to,$subject,$messege){

            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
            $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
            $mail->Port = 587; // TLS only
            $mail->SMTPSecure = 'tls'; // ssl is deprecated
            $mail->SMTPAuth = true;

            $mail->Username   = "crimealertsystem21@gmail.com";
            $mail->Password   = "1234@Abc";

            $mail->IsHTML(true);
            $mail->AddAddress($to, "Admin");
            $mail->SetFrom("crimealertsystem21@gmail.com", "Find A Saloon Support Team");

            $mail->Subject = $subject;
            $mail->msgHTML($messege);
            $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->send();
        }

?>
