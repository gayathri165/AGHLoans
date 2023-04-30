
<?php
$txt_file=fopen('file1.txt','r');
$a=1;
$line=fgets($txt_file);
$to_email =$line; 
$subject = "Your Application has been Rejected ";
$body = "Dear Customer, Your Application has been Rejected , Kindly visit the website for more updates . Thanking your. Regards AGH Teams ";
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

