<?php
	$name=isset($_POST['fname'])?$_POST['fname']:"";
	$name=isset($_POST['lname'])?$_POST['lname']:"";
	$email=isset($_POST['email'])?$_POST['email']:"";
	$mobile=isset($_POST['mobile'])?$_POST['mobile']:"";
	$message=isset($_POST['message'])?$_POST['message']:"";
	
	$to="manju9343945143@gmail.com";
	$cc="";
	$bcc="manjjk@gmail.com";
	$sub="From Ellen Technologies";
	$err="Email not sent";
	$eb='<p>Name: '.$fname.' '.$lname.'</p>';
	$eb.='<p>Email : '.$email.'</p>';
	$eb.='<p>Mobile: '.$mobile.'</p>';
	$eb.='<p>Message: '.$message.'</p>';
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From:  <'.$email.'> ' . "\r\n";
	if($cc==""){}else{
	$headers .= 'cc: <'.$cc.'>' . "\r\n"; }
	if($bcc==""){}else{
	$headers .= 'Bcc: <'.$bcc.'>' . "\r\n"; }
	
	if(mail($to, $sub, $eb, $headers)){
		
	  echo "Thank You for your enquiry. We will contact you soon.";	
	   } else {
	  
		echo "Email Not Sent";
	}
	?>