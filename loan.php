<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 
<html> 
<head> 
<title>Loan Calculator -example</title> 
</head> 
<body> 
<? 
/* 
Author: Jouni Juntunen  
Date: 8/2009  
Description: Read capital, interest, time and instalment from HTML-form and calculates annuity or fixed instalment 
         amortization schedule payment. 
*/ 
//Read values passed from HTML-form. 
$capital=$_POST['capital']; 
$interest=$_POST['interest']; 
$year=$_POST['year']; 
$instalment=$_POST['instalment']; 

//Print passed values to page. 
print "Capital $capital<br>"; 
print "Interest $interest<br>"; 
print "Instalment $instalment<br>"; 
print "Years $year<br>"; 

//Calculate time in months. 
$months=$year * 12; 

//Check out which is the instalment. 
if (strcmp($instalment,"Fixed")==0) 
//Fixed amortization schedule 
{ 
//Calculate fixed payment for month. 
    $fixedPayment=$capital / $months; 
    $interestRateForMonth=$interest / 12; 

//Calculate interest for every month. 
    for ($i=0;$i<$months;$i++) 
    { 
//Interest for the month. 
        $interestForMonth=$capital / 100 * $interestRateForMonth; 
//Diminish capital after calculating interest. 
        $capital=$capital - $fixedPayment; 
//Payment for month is fixed pay + interest. 
        $paymentForMonth=$fixedPayment + $interestForMonth; 
//Print out payment for this month. Output is formatted (payment has two digits) 
        $month=$i+1; 
        printf("$month payment is %.2f<br>", $paymentForMonth); 
    }     
} 
//Annuity 
else 
{ 
//Calculate montly pay. 
    $interest=$interest / 100; 
    $result=$interest / 12 * pow(1 + $interest / 12,$months) / (pow(1 + $interest / 12,$months) - 1) * $capital;     
    printf("Monthly pay is %.2f", $result); 
} 
?> 

</body> 
</html>