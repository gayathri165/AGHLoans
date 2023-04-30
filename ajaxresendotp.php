<?php
error_reporting(0);
/*
https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=04024e1f-2d50-4874-b1b5-b1b1d901e928&senderid=BIXTEL&channel=2&DCS=0&flashsms=0&number=9986058114&text=test%20message&route=21
*/ 
echo $randomotp = $_GET['otp'];
?>
<?php
$mobno=$_GET['mobno'];
$msg= str_replace(" ","%20","Thanks for Registration. Your AGH Loans One Time Password(OTP) verification code is $randomotp. Don't share it with anyone. OTP is valid for 15 minutes...");//test%20message
$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: 0'));
curl_setopt($ch,CURLOPT_URL,  "https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=04024e1f-2d50-4874-b1b5-b1b1d901e928&senderid=BIXTEL&channel=2&DCS=0&flashsms=0&number=$mobno&text=$msg&route=21");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&cid=$cid&msgtxt=$msgtxt");
$buffer = curl_exec($ch);
if(empty ($buffer))
{ 
//echo " buffer is empty ";
}
else
{
//	echo $buffer; 
} 
curl_close($ch);
?>