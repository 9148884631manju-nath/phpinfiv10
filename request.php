<?php
	$name=isset($_POST['name'])?$_POST['name']:"";
	$mobile=isset($_POST['mobile'])?$_POST['mobile']:"";
	
	$to="manju9343945143@gmail.com";
	$cc="";
	$bcc="manjjk@gmail.com";
	$sub="Request From Ellen Technologies";
	$err="Email not sent";
	$eb='<p>Name: '.$name.'</p>';
	$eb.='<p>Mobile: '.$mobile.'</p>';
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From:  <manjjk@gmail.com> ' . "\r\n";
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