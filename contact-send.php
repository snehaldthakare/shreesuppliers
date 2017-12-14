<?php
ob_start();
if(isset($_POST['submit']))
{
     /* Verify Email */
    include_once 'class.verifyEmail.php';
	$email = $_POST['email'];
    $vmail = new verifyEmail();
	$vmail->setStreamTimeoutWait(20);
	$vmail->setEmailFrom('viska@viska.is');
	$name=$_POST['name'];
	if (!$vmail->check($email) || !preg_match ("/^[a-zA-Z\s]+$/",$name)) {
?>
    <script>
           alert('This is not valid email id');
           history.go(-1);
    </script>
<?php

	}else{

    require("class.phpmailer.php");
    
    $mail = new PHPMailer();
    
    //Your SMTP servers details
    
    $mail->IsSMTP();               // set mailer to use SMTP
    $mail->Host = "localhost";  // specify main and backup server or localhost
    $mail->SMTPAuth = true;     // turn on SMTP authentication
    $mail->Username = "manoj@aviatorsinfotech.com";  // SMTP username manoj@aviatorsinfotech.com  test@cakeshopnashik.com
    $mail->Password = "hashamtaiyyab7@1234"; // SMTP password hashamtaiyyab7@1234 test@1234
    //It should be same as that of the SMTP user
    
    $redirect_url = "http://".$_SERVER['SERVER_NAME']; //Redirect URL after submit the form
    
    $mail->From = $mail->Username;	//Default From email same as smtp user
    $mail->FromName = $_POST['name'];
    
    //Email address where you wish to receive/collect those emails.
    $mail->AddAddress("shreesuppliers99@gmail.com"); 
    
    $mail->WordWrap = 50;                                 // set word wrap to 50 characters
    $mail->IsHTML(true);                                  // set email format to HTML
    
    $mail->Subject = $_POST['subject'] ;
    $message = "name :".$_POST['name'].
	" \r\n <br>email :".$_POST['email'].
	" \r\n <br>subject:".$_POST['subject'].
    " \r\n <br>message :".$_POST['message'];
    $mail->Body = $message;
    
    if(!$mail->Send())
    {
    ?>
        <script>
               alert('This message is not send');
               history.go(-1);
        </script>
<?php
    }else{
?>
     <script>
             alert('This message is send successfully');
             window.open('index.php','_self');
    </script>
<?php    
    }
}
}
?>
