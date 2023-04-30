    <!-- footer -->
    <footer class="footer-content py-5">
        <div class="container py-md-3" >
            <div class="footer-top text-center">
                <h2>
                    <a class="navbar-brand" href="index.php" >
                        <span class="fa fa-suitcase"></span> AGH Loans
                    </a>
                </h2>
            </div>
        </div>
        <!-- //footer bottom -->
    </footer>
    <!-- //footer -->
    <div class="copy-right">
        <div class="container">
            <div class="row">
                <p class="copy-right-grids text-md-left text-center my-sm-4 my-4 col-md-6">© <?php echo date("Y"); ?> AGH Loans. All Rights Reserved 
                </p>
<?php
if(!isset($_SESSION['usr_id']))
{
	if(!isset($_SESSION['cst_id']))
	{
?>
<div class="w3-pvt-footer text-md-right text-center mt-4 col-md-5">
	<ul class="list-unstyled w3-pvt-icons">
		<li>
			<a href="userlogin.php" class="btn btn-primary">
				ADMIN LOGIN
			</a>
		</li>
	</ul>
</div>
<?php
	}
}
?>
                <div class="move-top text-right col-md-1"><a href="#home" class="move-top"> <span class="fa fa-angle-up  mb-3" aria-hidden="true"></span></a></div>

            </div>
        </div>
    </div>
</body>
</html>

<!------ Include the above in your HEAD tag ---------->

<script src="js/jquery-3.3.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
});
</script>