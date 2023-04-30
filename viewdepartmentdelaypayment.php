<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM dpmt_delaypayment WHERE dpmt_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Loan Types record deleted successfully...');</script>";
		echo "<script>window.location='viewdepartmentdelaypayment.php';</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
?>
    </div>

    <!-- products -->
    <section class="products py-5" id="stats">
        <div class="container">

 <h3 class="title-w3ls mb-sm-5 mb-4 text-center"> View Department Delay Payment</h3>
	
	<table id="example"  class="table table-striped table-bordered">
		<THEAD>
			<tr>
				<th>Department ID</th>th>
				<th>Department Charge</th>
				<th>Department Status</th>
				<th>Action</th>
			</tr>
		</THEAD>
		<tbody>
			<?php
			$sql = "SELECT * FROM  dpmt_delaypayment";
			$qsql = mysqli_query($con,$sql);
			while($rs = mysqli_fetch_array($qsql))
			{
				echo "<tr>
						<td>$rs[dpmt_id]</td>
						<td>$rs[dpmt_charge]</td>
						<td>$rs[dpmt_status]</td>
			
						
						<td>Edit | <a href='viewdepartmentdelaypayment.php?delid=$rs[0]' class='btn btn-danger' onclick='return confirmdelete()' >Delete</a>
						
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