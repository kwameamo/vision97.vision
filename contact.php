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
    <div class="head">
        <div class="marq">
                <div class="click-here">
                    <a href="https://wa.me/message/5P5KBD3UDAXLP1" target="_blank"><span class="click">🇬🇭 Shopping from Ghana? Click Here! 🇬🇭</span></a>  
                </div>
        </div>    
        
<!-- NAVBAR --><!-- NAVBAR --><!-- NAVBAR -->
        <div class="nav">
            <div class="leftNav">
                <a href="#1" class="item">Shop</a>
                <a href="looks.html" class="item">Looks</a>
                <a href="list.html" class="item">List</a>
                <a href="news.html" class="item">News</a>
            </div>
            <div class="logoCentre">
                <a href="index.html"><img src="images/Vision97LogoW.svg" alt="Vision'97 Logo"></a>
            </div>
            <div class="rightNav">
                <a href="terms.html" class="item">Terms</a>
                <a href="about.html" class="item">About</a>
                <a href="contact.html" class="item">Contact</a>
                <a href="#8" class="item">Cart (97)</a>
            </div>
        </div>    
        
    </div>


    <!-- Content -->
    <div class="about">
            <p> <h2>CONTACT</h2>
            <br>
            
            <div class="contact-form">

                <?php
                    if($_POST) {
                        $name = "";
                        $email = "";
                        $message = "";
                        $email_body = "<div>";
                            
                        if(isset($_POST['name'])) {
                            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
                            $email_body .= "<div>
                                                <label><b>Name:</b></label>&nbsp;<span>".$name."</span>
                                            </div>";
                        }
                    
                        if(isset($_POST['email'])) {
                            $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['visitor_email']);
                            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
                            $email_body .= "<div>
                                                <label><b>Email:</b></label>&nbsp;<span>".$email."</span>
                                            </div>";
                        }
                            
                        if(isset($_POST['message'])) {
                            $message = htmlspecialchars($_POST['message']);
                            $email_body .= "<div>
                                                <label><b>Message:</b></label>
                                                <div>".$message."</div>
                                            </div>";
                        }
                        {
                                $recipient = "kwameagain@icloud.com";
                            }

                        $email_body .= "</div>";
                    
                        $headers  = 'MIME-Version: 1.0' . "\r\n"
                        .'Content-type: text/html; charset=utf-8' . "\r\n"
                        .'From: ' . $email . "\r\n";
                            
                        if(mail($recipient, $email_title, $email_body, $headers)) {
                            echo 
                            "
                            <p>Thank you for contacting us, $name. <br> You will get a reply within 24 hours.</p>
                            ";
                        } else {
                            echo '<p>We are sorry but the email did not go through.</p>';
                        }
                            
                    } else {
                        echo '<p>Something went wrong</p>';
                    }
                ?>
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
    </div>
    
</body>
</html>