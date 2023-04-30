<?php
$txt_file=fopen('file2.txt','r');
$a=1;
$line=fgets($txt_file);
$to_email =$line; 
$subject = "Application has been Approved";
$body = "Your Application has been Approved . Kindly visit the website for more updates. Thanking you, Regards AGH Teams ";
$headers = "From: aghloansandservices@gmail.com";
if(mail($to_email, $subject, $body, $headers)) 
{ 
echo "Email successfully sent to $to_email...";
fclose($txt_file);
} 
else {

echo "Email sending failed...";

} 

?>