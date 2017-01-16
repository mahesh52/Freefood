
<?php

// server info
$server = 'freefood.cx78rd1gm7jm.us-west-2.rds.amazonaws.com';
$user = 'freefooddbmaster';
$pass = 'freefooddbmaster';
$db = 'freefood_freefood';

// connect to the database
 mysql_connect($server, $user, $pass);
mysql_select_db($db);
?>

<?php
$user_id=$_GET["id"];

$qrf = "SELECT * from details  where user_id='58'";
$result5 = mysql_query($qrf);
while($row5=mysql_fetch_array($result5)){

$user_id=$row5['user_id'];
$email1=$row5['email1'];
$email2=$row5['email2'];
echo $user_id;
echo $email1;
echo $email2;
}
?>
<?php
/**
 * This example shows making an SMTP connection with authentication.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require '../PHPMailerAutoload.php';


//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();



//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = "md-1.webhostbox.net";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 465;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;

$mail->SMTPSecure = "ssl";
//Username to use for SMTP authentication
$mail->Username = "kavya@hariprahlad.com";
//Password to use for SMTP authentication
$mail->Password = "HP@2015";
//Set who the message is to be sent from
$mail->setFrom('kavya@hariprahlad.com');
//Set an alternative reply-to address
$mail->addReplyTo('kavya@hariprahlad.com');
//Set who the message is to be sent to
$mail->addAddress("$email1","$email2");
//Set the subject line
$mail->Subject = 'Jivamitra';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.php'), dirname(__FILE__));

$mail->IsHTML(true);
$mail->Body = "<h1>Test 1 of PHPMailer html</h1><p>"+echo "karthik"+"</p>";
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
$mail->addAttachment('images/test.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}


