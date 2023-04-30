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
        <div class="">
<br>
 <h3 class="title-w3ls mb-sm-5 mb-4 text-center"> View <?php echo $_GET['status']; ?> Loan Applications</h3>
	
	<table id="example"  class="table table-striped table-bordered">
		<THEAD>
						<tr>
							<th style="font-size: 15px;width: 50px;"><center>Loan Application No.</center></th>
							<th>Application Date</th>
							<th>Customer Name </th>
							<th style="width: 150px;">Address</th>
							<th>Loan Type</th>
							<th>Desired <br>Loan Amount</th>
<?php
if(isset($_SESSION['usr_id']))
{
?>
							<th><centeR>Action</center></th>
<?php
}
if(isset($_SESSION['cst_id']))
{
	if($_GET['status'] == "Approved")
	{
?>
							<th><centeR>Action</center></th>
<?php
	}
}
?>	
						</tr>
		</THEAD>
		<tbody>
			<?php
			$sql = "SELECT * FROM  lacc_loanaccount where lacc_id!='0'";
			if(isset($_GET['status']))
			{
			$sql = $sql . " AND lacc_status='$_GET[status]' ";
			}
			else
			{
			$sql = $sql . " AND lacc_status='Pending' ";
			}
			if(isset($_SESSION['cst_id']))
			{
				$sql = $sql  . " AND  cst_id='$_SESSION[cst_id]'";
			}			
			$qsql = mysqli_query($con,$sql);
			while($rs = mysqli_fetch_array($qsql))
			{
				$sqlloantype=  "SELECT * FROM ltyp_loantypes where ltyp_id='$rs[ltyp_id]'";
				$qsqlloantype = mysqli_query($con,$sqlloantype);
				$rsloantype = mysqli_fetch_array($qsqlloantype);
				$resaddress =unserialize($rs['lacc_resaddr']);
				echo "<tr>
						<td style='font-size: 25px;'><center>$rs[lacc_id]</center></td>
						<td>" . date("d-M-Y",strtotime($rs['lacc_applicationdt'])) . "</td>
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
						$rsloantype[ltyp_loantype]<hr>
						<b>Interest -</b> $rsloantype[ltyp_interestperc]%<br>
						</td>
						<td style='font-size: 20px;'>". moneyFormatIndia(floor($rs['lacc_loanamt'])) ."</td>";
if(isset($_SESSION['usr_id']))
{						
	echo "<td style='width: 50px;'>";
	echo "<a href='loanpendingaccount.php?viewid=$rs[0]&status=$_GET[status]' class='btn btn-primary' >View <br>Application</a>";
	echo "</td>";
}
if(isset($_SESSION['cst_id']))
{
	if($_GET['status'] == "Approved")
	{	
	echo "<td style='width: 50px;'>";
	echo "<a href='loanprocessaccount.php?viewid=$rs[0]&status=$_GET[status]' class='btn btn-primary' >View Loan <br>offer</a>";
	echo "</td>";
	}
}
echo "</td>
						<td> <a href='editcustomerprofile1.php?editid=$rs[0]' class='btn btn-secondary' style='width:100%;' >Edit</a>
						</td>
					</tr>";
/*						
echo "<a href='viewloanapplication.php?delid=$rs[0]' class='btn btn-danger' onclick='return confirmdelete()' >Delete</a>";
*/
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