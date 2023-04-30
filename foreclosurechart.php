<?php
include("header.php");
//##########Loan Account starts here ########
$sqllacc_loanaccount = "SELECT lacc_loanaccount.*,cst_customer.* FROM  lacc_loanaccount LEFT JOIN cst_customer on lacc_loanaccount.cst_id=cst_customer.cst_id where lacc_loanaccount.lacc_id='$_GET[lacc_id]' ";
$qsqllacc_loanaccount = mysqli_query($con,$sqllacc_loanaccount);
$rslacc_loanaccount = mysqli_fetch_array($qsqllacc_loanaccount);
//##########Loan Account ends here ########
//#############################################################################
//#############################################################################
if(isset($_POST['submit']))
{
	$sqlloantransaction = "SELECT * FROM  ltr_loantransaction WHERE ltr_transtype='Payment'";
	$qsqlloantransaction = mysqli_query($con,$sqlloantransaction);
	$rsloantransaction = mysqli_fetch_array($qsqlloantransaction);
	$billno = $rsloantransactio['billno'] + mysqli_num_rows($qsqlloantransaction);
	$note = array($_POST['paymenttype'],$_POST['cardholder'],$_POST['cardnumber'],$_POST['expirydate'],$_POST['cvvnumber']);
	$arrnote = serialize($note);
	$sql ="INSERT INTO ltr_loantransaction( lacc_id, lins_id, ltr_transdt, ltr_transtype, ltr_billno, ltr_amt, ltr_paymenttype, ltr_chqno, ltr_bank, ltr_note, ltr_status, ltr_cancellationtype, ltr_cancellationreason, ltr_chq_bounce_id, ltr_del_id) values('$_GET[lacc_id]','$_GET[lins_id]','$dt','Foreclosure','$billno','$_POST[paymentamt]','$_POST[paymenttype]','','','$arrnote','Active','','','','')";
	$qsql = mysqli_query($con,$sql);
	$insid = mysqli_insert_id($con);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		$sqllacc_loanaccount = "UPDATE lacc_loanaccount set lacc_status='Closed' WHERE lacc_id='$_GET[lacc_id]'";
		mysqli_query($con,$sqllacc_loanaccount);
		//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
		//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
		$randomotp = rand(100000,999999);
		$mobno=$_GET['mobno'];
		$txtloanacno =  str_replace("#","Loan Account No. ", $_POST['txtloanacno']);
		$mobno  = $_POST['mobno'];
		$txtinstno = $_POST['txtinstno'];
		$paymentamt  = $_POST['paymentamt'];
		$paymenttype  = $_POST['paymenttype'];
		$dts = date("d M Y",strtotime($dt));
		$msg= str_replace(" ","%20","Your Foreclosure payment to $txtloanacno has been made on "  . $dts  . " for the amount of Rs. ". $paymentamt. " and Your Loan account has been closed. Thank You for Payment.. -AGH Loans");
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: 0'));
		curl_setopt($ch,CURLOPT_URL,  "https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=04024e1f-2d50-4874-b1b5-b1b1d901e928&senderid=BIXTEL&channel=2&DCS=0&flashsms=0&number=$mobno&text=$msg&route=21");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		$buffer = curl_exec($ch);
		if(empty ($buffer))
		{ 
			echo " buffer is empty ";
		}
		else
		{
			//echo $buffer; 
		}
		curl_close($ch);
		//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
		//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
		echo "<script>alert('Loan Payment done successfully..');</script>";
		echo "<script>window.location='loanpaymentreceipt.php?insid=$insid';</script>";
	}
}
//#############################################################################
//#############################################################################	
$pmtst=0;
$sql = "SELECT * FROM  lins_loaninstallment WHERE lacc_id='$_GET[lacc_id]' ORDER BY lins_no ASC";
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
	$delaypayment = 0;
	$sqlloanpenaltytransaction= "SELECT ifnull(SUM(ltr_amt),0) as penaltyamt FROM ltr_loantransaction WHERE lins_id='$rs[lins_id]' AND ltr_transtype IN ('Legal Case','Cheque Bounce','Others') AND ltr_status='Active'";
	$qsqlloanpenaltytransaction = mysqli_query($con,$sqlloanpenaltytransaction);
	$rsloanpenaltytransaction = mysqli_fetch_array($qsqlloanpenaltytransaction);
	$sqlloandelaypmttrans= "SELECT ifnull(SUM(ltr_amt),0) as interstamt FROM ltr_loantransaction WHERE lins_id='$rs[lins_id]' AND ltr_transtype='Delay Payment' AND ltr_status='Active'";
	$qsqlloandelaypmttrans = mysqli_query($con,$sqlloandelaypmttrans);
	$rsloandelaypmttransaction = mysqli_fetch_array($qsqlloandelaypmttrans);
	$sqlloanpmt= "SELECT ifnull(SUM(ltr_amt),0) as loanpaid FROM ltr_loantransaction WHERE lins_id='$rs[lins_id]' AND ltr_transtype='Payment' AND ltr_status='Active'";
	$qsqlloanpmt = mysqli_query($con,$sqlloanpmt);
	$rsloanpmt = mysqli_fetch_array($qsqlloanpmt);
	$totamt = 0;
	$totamt = $rs['lins_amt'] + $rs['lins_iamt'] + $rsloandelaypmttransaction['interstamt'] + $rsloanpenaltytransaction['penaltyamt'];
	$balamts = $totamt - $rsloanpmt['loanpaid'];
	//################Delay Payment New starts here
	   $date1 = $dt;
	   $dtm= date("Y-m");
	   $date2 = $rs['lins_date'];
	   $curtimestamp1 = strtotime($date1);
	   $curtimestamp2 = strtotime($date2);
	   if ($curtimestamp1 > $curtimestamp2)
	   {
		   if($balamts >= 1)
		   {
			//echo "$date1 is latest than $date2";
			$sqlchkdelaypmt = "select * from ltr_loantransaction WHERE ltr_transtype='Delay Payment' AND lins_id='$rs[lins_id]' AND (ltr_transdt BETWEEN '$dtm-01' AND '$dtm-31')";
			$qsqlchkdelaypmt = mysqli_query($con,$sqlchkdelaypmt);
			if(mysqli_num_rows($qsqlchkdelaypmt) ==0)
			{
				$delaypayment = ($balamts * $rsdelaypaymentpenaltycharge['dpmt_charge']/100)/12;
				$sqlinsdelaypayment = "INSERT INTO ltr_loantransaction(`lacc_id`, `lins_id`, `ltr_transdt`, `ltr_transtype`, `ltr_billno`, `ltr_amt`, `ltr_paymenttype`, `ltr_chqno`, `ltr_bank`, `ltr_note`, `ltr_status`, `ltr_cancellationtype`, `ltr_cancellationreason`, `ltr_chq_bounce_id`, `ltr_del_id`) VALUES('$_GET[lacc_id]', '$rs[lins_id]', '$dt', 'Delay Payment', '0', '$delaypayment', '', '', '', '', 'Active', '', '', '', '')";
				mysqli_query($con,$sqlinsdelaypayment);
				echo mysqli_error($con);
			}
		   }
	   }
	//################Delay Payment New starts here
}
//##########Loan Account starts here ########
$sqllacc_loanaccount = "SELECT lacc_loanaccount.*,cst_customer.* FROM  lacc_loanaccount LEFT JOIN cst_customer on lacc_loanaccount.cst_id=cst_customer.cst_id where lacc_loanaccount.lacc_id='$_GET[lacc_id]' ";
$qsqllacc_loanaccount = mysqli_query($con,$sqllacc_loanaccount);
$rslacc_loanaccount = mysqli_fetch_array($qsqllacc_loanaccount);
//##########Loan Account ends here ########
?>
    </div>

<form method="post" action=""  >
    <!-- products -->
    <section class="products py-5" id="stats">
        <div class="container">

 <h3 class="title-w3ls mb-sm-5 mb-4 text-center"> ForeClosure Chart</h3>
	<table class="table table-striped table-bordered">
			<tr>
			<?php
			if($rslacc_loanaccount['comp_name'] != "")
			{
			?>
				<th>Company Name.</th>
				<td style="text-align: left;"><?php echo $rslacc_loanaccount['comp_name']; ?></td>
			<?php
			}
			else
			{
			?>
				<th>Customer Name.</th>
				<td style="text-align: left;"><?php echo $rslacc_loanaccount['lacc_custname']; ?></td>
			<?php
			}
			?>  
				<th>PAN Card No. </th>
				<td style="text-align: left;"><?php echo $rslacc_loanaccount['cst_pan']; ?></td>
			</tr>
			<tr>
				<th style="width:20%">Address</th>
				<td style="text-align: left;width:30%"><?php echo $rslacc_loanaccount['cst_address']; ?>, <?php echo $rslacc_loanaccount['cst_state']; ?></td>
				<th style="width:20%">Bank Account</th>
				<td  style="text-align: left;width:30%"><?php $arrbankdet =  unserialize($rslacc_loanaccount['cst_bankdetail']); ?>
				<b>Bank Name:</b> <?php echo $arrbankdet[0]; ?><br>
				<b>Bank A/c:</b> <?php echo $arrbankdet[1]; ?><br>
				<b>IFSC Code:</b> <?php echo $arrbankdet[2]; ?><br>
				</td>
			</tr>
			<tr>
				<th>Email ID.</th>
				<td style="text-align: left;"><?php echo $rslacc_loanaccount['cst_email']; ?></td>
				<th>Contact No. </th>
				<td style="text-align: left;"><?php echo $mobno = $rslacc_loanaccount['cst_contact']; ?></td>
			</tr>
	</table>
	<hr>
	<table class="table table-striped table-bordered">
			<tr>
				<th style="width:20%">Loan Account No.</th>
				<td  style="text-align: left;width:30%" ><?php echo $txtloanacno = $rslacc_loanaccount['lacc_no']; ?></td>
				<th style="width:20%">Account Opened Date</th>
				<td  style="text-align: left;width:30%" ><?php echo date("d-M-Y",strtotime($rslacc_loanaccount['lacc_opendt'])); ?></td>
			</tr>
			<tr>
				<th>Loan Amount</th>
				<td style="text-align: left;"><?php echo moneyFormatIndia($rslacc_loanaccount['lacc_loanamt']); ?></td>
				<th>Interest </th>
				<td style="text-align: left;"><?php echo $rslacc_loanaccount['lacc_intrate']; ?>%</td>
			</tr>
			<tr>
				<th>Tenor</th>
				<td style="text-align: left;"><?php echo $rslacc_loanaccount['lacc_tenor']; ?> months</td>
				<th>Loan Type </th>
				<td style="text-align: left;"><?php echo $rslacc_loanaccount['ltyp_loantyp']; ?></td>
			</tr>
			<tr>
				<th>Processing Charge</th>
				<td style="text-align: left;"><?php echo moneyFormatIndia($rslacc_loanaccount['lacc_ipfprocessingfee']); ?></td>
				<th>Delay Payment Charge</th>
				<td style="text-align: left;"><?php echo $rslacc_loanaccount['dpmt_charge']; ?>%</td>
			</tr>
	</table>
	<hr>
	<table  class="table table-striped table-bordered">
		<THEAD>
			<tr>
				<th>Installment No.</th>
				<th style="width: 130px;">EMI Date</th>
				<th style='text-align: right'>Principal Amount</th>
				<th style='text-align: right'>Interest amount</th>
				<th style='text-align: right'>Delay Payment Charges</th>
				<th style='text-align: right'>Penalty amount</th>
				<th style='text-align: right'>Total amount</th>
				<th style='text-align: right'>Payable Amount</th>
				<th style='text-align: right'>Balance Amount</th>
				<th>Foreclosure Amount</th>
			</tr>
		</THEAD>
		<tbody>
			<?php
			$pmtst=0;$pmtst1=0;$totamttopay=0;
			$sql = "SELECT * FROM  lins_loaninstallment WHERE lacc_id='$_GET[lacc_id]' ORDER BY lins_no ASC";
			$qsql = mysqli_query($con,$sql);
			while($rs = mysqli_fetch_array($qsql))
			{

				$sqlloanpenaltytransaction= "SELECT ifnull(SUM(ltr_amt),0) as penaltyamt FROM ltr_loantransaction WHERE lins_id='$rs[lins_id]' AND ltr_transtype IN ('Legal Case','Cheque Bounce','Others') AND ltr_status='Active'";
				$qsqlloanpenaltytransaction = mysqli_query($con,$sqlloanpenaltytransaction);
				$rsloanpenaltytransaction = mysqli_fetch_array($qsqlloanpenaltytransaction);
				$sqlloandelaypmttrans= "SELECT ifnull(SUM(ltr_amt),0) as interstamt FROM ltr_loantransaction WHERE lins_id='$rs[lins_id]' AND ltr_transtype='Delay Payment' AND ltr_status='Active'";
				$qsqlloandelaypmttrans = mysqli_query($con,$sqlloandelaypmttrans);
				$rsloandelaypmttransaction = mysqli_fetch_array($qsqlloandelaypmttrans);
				$sqlloanpmt= "SELECT ifnull(SUM(ltr_amt),0) as loanpaid FROM ltr_loantransaction WHERE lins_id='$rs[lins_id]' AND ltr_transtype='Payment' AND ltr_status='Active'";
				$qsqlloanpmt = mysqli_query($con,$sqlloanpmt);
				$rsloanpmt = mysqli_fetch_array($qsqlloanpmt);
				$totamt = 0;
				$totamt = $rs['lins_amt'] + $rs['lins_iamt'] + $rsloandelaypmttransaction['interstamt'] + $rsloanpenaltytransaction['penaltyamt'];
				echo "<tr>
						<td>$rs[lins_no]</td>
						<td>". date("d-M-Y",strtotime($rs['lins_date'])) . "</td>
						<td style='text-align: right'>" . moneyFormatIndia($rs['lins_amt']) ."</td>
						<td style='text-align: right'>" . moneyFormatIndia($rs['lins_iamt']) ."</td>
						<td style='text-align: right'>". moneyFormatIndia($rsloandelaypmttransaction['interstamt']) ."</td>
						<td style='text-align: right'>" . moneyFormatIndia($rsloanpenaltytransaction['penaltyamt']) . "</td>
						<td style='text-align: right'>" . moneyFormatIndia($totamt) . "</td>
						<td style='text-align: right'>" . moneyFormatIndia($rsloanpmt['loanpaid']) . "</td>";
						$balamts = $totamt - $rsloanpmt['loanpaid'];
				echo "<td style='text-align: right'>" . moneyFormatIndia($balamts) . "</td>";
						
						echo "<td  style='text-align: right;'>";
		$dtm= date("Y-m-d");
		$date2 = $rs['lins_date'];
		$curtimestamp1 = strtotime($date1);
		$curtimestamp2 = strtotime($date2);
		if ($curtimestamp1 > $curtimestamp2)
		{
			$totamttopay = $totamttopay + $balamts;
			echo moneyFormatIndia($balamts);
		}
		else
		{
			$intamt = $rs['lins_iamt'] /2;
			$totamt = $rs['lins_amt'] + $intamt +  $rsloandelaypmttransaction['interstamt'] + $rsloanpenaltytransaction['penaltyamt'];
			$totamttopay = $totamttopay + $totamt;
			echo moneyFormatIndia($totamt);
		}
						echo "</td>";
						
				echo "</tr>";
			}
			?>
		</tbody>
		<THEAD>
			<tr>
				<th style='text-align: right' colspan="9">Total Foreclosure Amount</th>
				<th style="text-align: right;"><?php echo moneyFormatIndia($totamttopay); ?></th>
			</tr>
		</THEAD>
	</table>
	
	<hr>
			
	<table class="table table-striped table-bordered">
			<tr>
				<th>Payment you Pay</th>
				<td style="text-align: left;"><input type="number"  class="form-control" name="paymentamt" id="paymentamt" readonly style="background-color: pink; color: green;font-weight: 900;" value="<?php echo intval($totamttopay); ?>"  ><span id="idpaymentamt" class="errorclass"></td>
				<th style="width:20%">Payment Type</th>
				<td  style="text-align: left;width:30%" >
	<select class="form-control" name="paymenttype" id="paymenttype">
		<option value="">Select payment type</option>
		<?php
		$arr= array("VISA","Master Card","Rupay","American Express");
		foreach($arr as $val)
		{
			if($val == $rsedit['paymenttype'])
			{
			echo "<option value='$val' selected>$val</option>";
			}
			else
			{
			echo "<option value='$val'>$val</option>";
			}
		}
		?>
	</select><span id="idpaymenttype" class="errorclass"></span>
				</td>
			</tr>
			<tr>
				<th style="width:20%">Card Holder</th>
				<td  style="text-align: left;width:30%" ><input type="text"  class="form-control" name="cardholder" id="cardholder"  ><span id="idcardholder" class="errorclass"></span></td>
				<th>Card Number</th>
				<td style="text-align: left;"><input type="number"  class="form-control" name="cardnumber" id="cardnumber" min="1000000000000000"  max="9999999999999999"  ><span id="idcardnumber" class="errorclass"></td>
			</tr> 
			<tr>
				<th>Expiry Date </th>
				<td style="text-align: left;"><input type="month"  class="form-control" name="expirydate" id="expirydate" min="<?php echo date("Y-m"); ?>"  ><span id="idexpirydate" class="errorclass"></span></td>
				<th>CVV Number</th>
				<td style="text-align: left;"><input type="number"  class="form-control" name="cvvnumber" id="cvvnumber" min="101" max="999" ><span id="idcvvnumber" class="errorclass"></td>
			</tr>
			<tr>
				<th colspan="4"><center><input type="submit" class="form-control btn btn-primary" name="submit" id="submit" style="width: 325px;height: 50px;font-size: 25px;" value="Click here to Make Payment" ></center></th>
			</tr>
	</table>
        </div>
    </section>
    <!-- //products -->

<input type="hidden" name="txtloanacno" id="txtloanacno" value="<?php echo $txtloanacno; ?>" >
<input type="hidden" name="mobno" id="mobno" value="<?php echo $mobno; ?>" >
<input type="hidden" name="txtinstno" id="txtinstno" value="<?php echo $txtinstno; ?>" >
</form>
<?php
include("footer.php");
?>