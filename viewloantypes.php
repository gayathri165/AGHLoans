<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM ltyp_loantypes WHERE ltyp_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Loan Types record deleted successfully...');</script>";
		echo "<script>window.location='viewloantypes.php';</script>";
	}
}
?>
    </div>

    <!-- products -->
    <section class="products py-5" id="stats">
        <div class="container">

 <h3 class="title-w3ls mb-sm-5 mb-4 text-center"> View Loan Type</h3>
	
	<table id="example"  class="table table-striped table-bordered">
		<THEAD>
			<tr>
				<th style="width: 50px;">Icon</th>
				<th style="width: 250px;">Loan Type</th>
				<th>Minimum Loan Amount</th>
				<th>Maximum Loan Amount</th>
				<th>Maximum Month</th>
				<th>Interest percentage</th>
				<th>Status</th>
				<th style="width: 175px;">Action</th>
			</tr>
		</THEAD>
		<tbody>
			<?php
			$sql = "SELECT * FROM  ltyp_loantypes";
			$qsql = mysqli_query($con,$sql);
			while($rs = mysqli_fetch_array($qsql))
			{
				if($rs['ltyp_icon'] == "")
				{
					$icon = "images/noimage.png";
				}
				else if(file_exists("imgloantype/".$rs['ltyp_icon']))
				{
					$icon = "imgloantype/".$rs['ltyp_icon'];
				}
				else
				{
					$icon = "images/noimage.png";
				}
				echo "<tr>
						<td style='width: 50px;'><img src='$icon' style='width: 50px;height: 50px;'></td>
						<td>$rs[ltyp_loantype]</td>
						<td>" . moneyFormatIndia($rs['min_loanamt']) ."</td>
						<td>" . moneyFormatIndia($rs['max_loanamt']) ."</td>
						<td>$rs[ltyp_maxmonth] months</td>
						<td>$rs[ltyp_interestperc]%</td>
						<td>$rs[ltyp_status]</td>
						<td><a href='loantypes.php?editid=$rs[0]' class='btn btn-info'  >Edit</a> | <a href='viewloantypes.php?delid=$rs[0]' class='btn btn-danger' onclick='return confirmdelete()' >Delete</a>
						
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