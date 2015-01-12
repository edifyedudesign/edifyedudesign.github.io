<?php

$to = "mail@domain.com"; # <--- Your Email 
$subject = "You received a mail from your website's contact form";

if ($_POST) {
	$name = stripslashes($_POST['fullname']);
	$email = trim($_POST['email']);
	$phone = stripslashes($_POST['phone']);
	$message = htmlspecialchars($_POST['message']);

	$error = '';

	if (!$name) {
		$error .= '<p>Enter your name</p>';
	}

	if (!$email) {
		$error .= '<p>Enter your email</p>';
	}

	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
  	$error .= "<p>E-mail is not valid</p>";
  }

	if (!$phone) {
		$error .= '<p>Enter your phone number</p>';
	}

	if (!$message) {
		$error .= '<p>Enter a message</p>';
	}

	$mess = "Full Name: " . $name . "\r\n";
	$mess .= "Email: " . $email . "\r\n";
	$mess .= "Phone:" . $phone . "\r\n";
	$mess .= "Message: " . $message . "\r\n";

	if (!$error) {
		$mail = mail($to, $subject, $mess,
  	"From: ".$name." <".$email.">\r\n"
  	."Reply-To: ".$name."<".$email.">\r\n"
  	);

  	if ($mail) {
  		echo "Ok";
  	}
  	else{
  		header('HTTP/1.1 500 ' . $error );
      exit();
  	}
	}
	else{
		echo $error;
	}
}

?>