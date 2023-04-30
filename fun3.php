<?php
$txt_file=fopen('file3.txt','r');
$a=1;
$line=fgets($txt_file);
$to_email =$line; 
$subject = "Your Loan Application has been modified ";
$body = "Dear Customer, Your Loan Application has been modified . Kindly check the website for further details.Thanking you , Regards AGH Team ";
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