<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM lacc_loanaccount WHERE lacc_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Loan application record deleted successfully...');</script>";
		echo "<script>window.location='viewloanapplication.php';</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
?>
</div>
    <!-- products -->
    <section class="products" id="stats">
        <div class=""  style="width: 100%;">
<br>
 <h3 class="title-w3ls mb-sm-1 mb-4 text-center"> View Closed Loan Accounts</h3>
	
	<table id="example"  class="table table-striped table-bordered">
		<THEAD>
						<tr>
							<th style="font-size: 15px;width: 75px;"><center>Loan Application No.</center></th>
							<th>Open Date</th>
							<th>Customer Name</th>
							<th style="width: 150px;">Address</th>
							<th>Loan Detail</th>
							<th>Loan Amount</th>
							<th>Interest</th>
							<th>Total</th>

							<th><center>Transaction</center></th>
						</tr>
		</THEAD>
		<tbody>
			<?php
			$sql = "SELECT * FROM  lacc_loanaccount where lacc_id!='0'";
			$sql = $sql . " AND lacc_status='Closed' ";
			if(isset($_SESSION['cst_id']))
			{
				$sql = $sql . " AND  cst_id='$_SESSION[cst_id]'";
			}
			$sql = $sql . " and DATE_ADD(`lacc_opendt`, INTERVAL lacc_tenor MONTH) > '$dt' ";
			$qsql = mysqli_query($con,$sql);
			while($rs = mysqli_fetch_array($qsql))
			{
				$sqlloantype=  "SELECT * FROM ltyp_loantypes where ltyp_id='$rs[ltyp_id]'";
				$qsqlloantype = mysqli_query($con,$sqlloantype);
				$rsloantype = mysqli_fetch_array($qsqlloantype);
				$resaddress =unserialize($rs['lacc_resaddr']);
				echo "<tr>
						<td style='font-size: 25px;'><center>$rs[lacc_no]</center></td>
						<td>" . date("d-M-Y",strtotime($rs['lacc_opendt'])) . "</td>
						<td>";
						
						
if($rs['comp_name'] == "")						
{
echo "<b>$rs[lacc_custname]</b>";
echo "<br><b>DOB</b> - ".  date("d-M-Y",strtotime($rs['lacc_dob'])) . "<br>			<b>PAN</b> -  $rs[lacc_pan]";
}
if($rs['comp_name'] != "")						
{
	echo "<b>$rs[comp_name]</b>";
}
						
				echo "</td>
						<td>$resaddress[0],$resaddress[1],
						<br><b>Ph. No:</b> $resaddress[2],
						<br><b>Email:</b> $resaddress[3]</td>
						<td>
						<b>Loan Type -</b> $rsloantype[ltyp_loantype]<br style='padding-bottom: 10px;'>
						<b>Interest -</b> $rsloantype[ltyp_interestperc]%<br>
						<b>Tenor -</b> $rs[lacc_tenor] months<br>
						</td>
						<td style='font-size: 20px;'>". moneyFormatIndia(floor($rs['lacc_loanamt'])) ."</td>";
				echo "<td style='font-size: 20px;'>". moneyFormatIndia(floor($rs['interest_amt'])) ."</td>";
				$totamt = $rs['lacc_loanamt'] +$rs['interest_amt'] ;
				echo "<td style='font-size: 20px;'>". moneyFormatIndia($totamt) ."</td>";

	echo "<td style='width: 50px;'>";
	echo "<a href='viewloantransaction.php?lacc_id=$rs[0]' class='btn btn-warning' >Transaction<br>Report</a>";
	echo "</td>";
					echo "</tr>";
			}
			?>
		</tbody>
	</table>	
			<br><hr>
        </div>
    </section>
    <!-- //products -->
<?php
include("footer.php");
?>
<script>
function confirmdelete()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>