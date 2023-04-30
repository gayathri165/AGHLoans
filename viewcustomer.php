<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM cst_customer WHERE cst_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Loan installment record deleted successfully...');</script>";
		echo "<script>window.location='viewcustomer.php';</script>";
	}
}
?>
    </div>

    <!-- products -->
    <section class="products py-5" id="stats">
        <div class="container">

 <h3 class="title-w3ls mb-sm-5 mb-4 text-center"> View Customer</h3>
	
	<table id="example"  class="table table-striped table-bordered">
		<THEAD>
			<tr>
				<th>Image</th>
				<th>Customer Name</th>
				<th>Personal Detail</th>
				<th>Customer Address</th>
				<th>Credit Score</th>
				<th>Documents</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</THEAD>
		<tbody>
			<?php
			$sql = "SELECT * FROM  cst_customer WHERE cst_type='Customer'";
			$qsql = mysqli_query($con,$sql);
			while($rs = mysqli_fetch_array($qsql))
			{
$sqlcreditscore = "SELECT * FROM  creditscore WHERE cst_id='$rs[cst_id]'";
$qsqlcreditscore = mysqli_query($con,$sqlcreditscore);
$rscreditscore = mysqli_fetch_array($qsqlcreditscore);
				if($rs['cst_photo'] == "")
				{
					$cst_photo = "images/noimage.png";
				}
				else if(file_exists("filecst_photo/" . $rs['cst_photo']))
				{
					$cst_photo = "filecst_photo/" . $rs['cst_photo'];
				}
				else
				{
					$cst_photo = "images/noimage.png";
				}
				echo "<tr>
						<td><img SRC='$cst_photo' style='width: 70px; height: 80px;'></td>
						<td>$rs[cst_fname] $rs[cst_mname] $rs[cst_lname]</td>
						<td><b>DOB</b><br>" . date("d-M-Y",strtotime($rs['cst_dob'])) . "
						<br><b>Gender -</b>";
				echo $rs['cst_gender'] . "</td>
						<td>$rs[cst_address],<br>$rs[cst_state],<br> <b>Ph No.</b> $rs[cst_contact]<br>
						<b>Email:</b> $rs[cst_email]</td>
						<td>";
echo "<a href='updatecreditscore.php?cst_id=$rs[0]' class='btn btn-dark' style='width:100%;' >Update</a><br>";
if(mysqli_num_rows($qsqlcreditscore) != 0)
{
echo "<center><b>" . $rscreditscore['credit_score'] . " Points</b></center>";
}
					echo "</td>
						<td>";
					if(file_exists("filecst_idproof/" . $rs['cst_idproof']))
					{
					echo "<a href='filecst_idproof/$rs[cst_idproof]' class='btn btn-info' style='width: 100%;' download >ID Proof</a>";
					}
					if(file_exists("filecst_addressproof/" . $rs['cst_addressproof']))
					{
					echo "<a href='filecst_addressproof/$rs[cst_addressproof]' class='btn btn-primary' style='width: 100%;' download>Address Proof</a>";
					}
					echo "</td>
						<td>$rs[cst_status]";
					echo "</td>
						<td> <a href='editcustomerprofile.php?editid=$rs[0]' class='btn btn-secondary' style='width:100%;' >Edit</a>   
						<a href='viewcustomer.php?delid=$rs[0]' class='btn btn-danger' onclick='return confirmdelete()' style='width:100%;' >Delete</a>
						<a href='viewcustomerprofile.php?editid=$rs[0]' class='btn btn-warning' style='width:100%;' >View</a>
						</td>
					</tr>";
			}
			?>
		</tbody>
	</table>
	
			

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