<?php

/**
 * This example shows how to handle a simple contact form safely.
 */

//Import PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

$msg = '';
//Don't run this unless we're handling a form submission
if (array_key_exists('email', $_POST)) {
    date_default_timezone_set('Etc/UTC');

    require '../vendor/autoload.php';

    //Create a new PHPMailer instance
    $mail = new PHPMailer();
    //Send using SMTP to localhost (faster and safer than using mail()) – requires a local mail server
    //See other examples for how to use a remote server such as gmail
    $mail->isSMTP();
    $mail->Host = 'localhost';
    $mail->Port = 25;

    //Use a fixed address in your own domain as the from address
    //**DO NOT** use the submitter's address here as it will be forgery
    //and will cause your messages to fail SPF checks
    $mail->setFrom('from@example.com', 'First Last');
    //Choose who the message should be sent to
    //You don't have to use a <select> like in this example, you can simply use a fixed address
    //the important thing is *not* to trust an email address submitted from the form directly,
    //as an attacker can substitute their own and try to use your form to send spam
    $addresses = ['vision97.vision@gmail.com'];
    //Validate address selection before trying to use it
    if (array_key_exists('dept', $_POST) && array_key_exists($_POST['dept'], $addresses)) {
        $mail->addAddress($addresses[$_POST['dept']]);
    } else {
        //Fall back to a fixed address if dept selection is invalid or missing
        $mail->addAddress('vision97.vision@gmail.com');
    }
    //Put the submitter's address in a reply-to header
    //This will fail if the address provided is invalid,
    //in which case we should ignore the whole request
    if ($mail->addReplyTo($_POST['email'], $_POST['name'])) {
        $mail->Subject = 'PHPMailer contact form';
        //Keep it simple - don't use HTML
        $mail->isHTML(false);
        //Build a simple message body
        $mail->Body = <<<EOT
        Email: {$_POST['email']}
        Name: {$_POST['name']}
        Message: {$_POST['message']}
        EOT;
        //Send the message, check for errors
        if (!$mail->send()) {
            //The reason for failing to send will be in $mail->ErrorInfo
            //but it's unsafe to display errors directly to users - process the error, log it on your server.
            $msg = 'Sorry, something went wrong. Please try again later.';
        } else {
            $msg = 'Message sent! Thanks for contacting us.';
        }
    } else {
        $msg = 'Invalid email address, message ignored.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700|Space+Mono" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Vision'97 — Contact</title>
</head>
<body>
<!-- NAVBAR --><!-- NAVBAR --><!-- NAVBAR -->
        <div class="nav">
            <div class="logoCentre">
                <a href="index.html"><img src="images/Vision97LogoW.svg" alt="Vision'97 Logo"></a>
            </div>
            <div class="bottomNav">
                <a href="shop.html" class="item">Shop</a>
                <a href="looks.html" class="item">Looks</a>
                <a href="terms.html" class="item">Terms</a>
                <a href="about.html" class="item">About</a>
                <!-- <a href="#" class="item">Contact</a> -->
                <a href="#" class="item">Contact</a>
            </div>
        </div>    
    </div>
<!-- NAVBAR --><!-- NAVBAR --><!-- NAVBAR -->

    <!-- Content -->
    <div class="about">
            <p> <h2>CONTACT</h2>
            <br>

            <?php if (!empty($msg)) {
                echo "<h2>$msg</h2>";
            } ?>
            
            <div class="contact-form">
                <form action="" method="POST">
                    <input type="text" name="name" placeholder="Name" id="name" required>
                    <input type="email" name="email" placeholder="Email" id="email" required>
                    <textarea name="message" id="message" cols="30" rows="5" placeholder="Message" required></textarea>
                    <input type="submit" name="submit" value="Send">
                </form>
            </div>

        </div>

    <footer>
        <div class="social">
            <h3> <span><a href="https://www.instagram.com/vision97.vision" class="socialLink" target="_blank">INSTAGRAM</a></span> — <span><a href="https://www.twitter.com/vision97.vision" class="socialLink" target="_blank">TWITTER</a></span> — <span><a href="#" class="socialLink" target="_blank">NEWSLETTER</a></span></h3>
        </div>
        <div class="copy">
              <h3>Vision'97® 2022 *the future's clear**</h3>
        </div>
    </footer>            
</body>
</html>