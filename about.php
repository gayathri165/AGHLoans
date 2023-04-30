<?php
include("header.php");
?>
        <!-- banner -->
        <section class="banner_w3pvt">
            <div class="csslider infinity" id="slider1">
                <input type="radio" name="slides" checked="checked" id="slides_1" />
                <input type="radio" name="slides" id="slides_2" />
                <input type="radio" name="slides" id="slides_3" />

<ul>

	<li>
		<div class="banner-top">
			<div class="overlay">
			<div class="container">
			<div class="banner-info">
				<div class="banner-w3ls-inner">
				<br><br><br><br><br><br><br>
				
					<div class="test-info text-left mt-lg-5 mt-4">
						<a href="about.php" class="btn mr-2">About Us</a>
						<a href="contact.php" class="btn">Contact Us</a>
					</div>
				</div>

			</div>
			</div>
			</div>
		</div>
	</li>

<li>
<div class="banner-top1">
<div class="overlay sec">
<div class="container">
<div class="banner-info">
	<div class="banner-w3ls-inner">
				
		<div class="test-info text-left mt-lg-5 mt-4">
			<div class="test-info text-left mt-lg-5 mt-4">
				<a href="about.php" class="btn mr-2">About Us</a>
				<a href="contact.php" class="btn">Contact Us</a>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
</li>
<li>
<div class="banner-top2">
<div class="overlay">
<div class="container">
<div class="banner-info">
	<div class="banner-w3ls-inner">
	
		<div class="test-info text-left mt-lg-5 mt-4">
			<div class="test-info text-left mt-lg-5 mt-4">
				<a href="about.php" class="btn mr-2">About Us</a>
				<a href="contact.php" class="btn">Contact Us</a>
			</div>
		</div>
	</div>

</div>
</div>
</div>
</div>
</li>

</ul>

				<div class="arrows">
                    <label for="slides_1"></label>
                    <label for="slides_2"></label>
                    <label for="slides_3"></label>

                </div>
            </div>
        </section>
        <!-- //slider -->
    </div>

    <!-- //banner -->
    <!-- /features -->
    <section class="about py-md-5 py-5" id="loans">
        <div class="container py-md-5">
            <div class="feature-grids row mt-3">
                <div class="col-lg-6 ab-content-img">
                    <img src="images/ab.jpg" alt="" class="img-fluid image1">
                </div>
                <div class="col-lg-6 ab-content-inf pl-lg-5">
                    <h3 class="title-w3ls my-3"> Loans @ AGH LOANS </h3>
                    <p>Loan demand is still there — even if it seems to be drying up. You just need to know where to look for it and allot your marketing budget accordingly.</p>
                
            </div>
        </div>
    </section>
    <!-- //features -->


<section class="content-info py-5">
	<div class="container py-md-5">

		<h3 class="title-w3ls mb-5 text-center">Loan Types</h3>
		<div class="row">
		<?php
		$sql = "SELECT * FROM  ltyp_loantypes WHERE ltyp_status	='Active'";
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
		?>
			<div class="col-lg-4 col-md-6 mt-4">
				<div class="thumbnail card">
					<div class="position-relative">
						<img src="<?php echo $icon; ?>" style="height: 250px;width: 100%;" class="img-fluid" alt="">
					</div>
					<div class="blog-info card-body">
						<h4 class=""><?php echo $rs['ltyp_loantype']; ?></h4>
						<p class="mt-2">
						<b>- Loan Amount -</b> <?php echo moneyFormatIndia($rs['min_loanamt']); ?> - <?php echo moneyFormatIndia($rs['max_loanamt']); ?><br>
						<b>- maximum Month -</b>  <?php echo $rs['ltyp_maxmonth']; ?> months<br>
						<b>- Interest rate -</b> <?php echo $rs['ltyp_interestperc']; ?>% 
						</p>
					</div>
				</div>
			</div>
		<?php
		}
		?>
		</div>
	</div>
</section>
<!-- //banner-botttom -->


    <!--mid -->
    <section class="mid-w3-pvt-content">
        <div class="overlay-inner py-5">
            <div class="container py-lg-5 py-md-3">
                <div class="test-info text-right ml-auto">
                    
                    <div class="text-right mt-5">
                        <a href="about.php" class="btn mr-2">Read More</a>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //mid-->

    <!-- /services -->
    <div class="welcome py-5">
        <div class="container py-xl-5 py-lg-3" id="services">
            <div class="row">
                <div class="col-lg-5 welcome-left">
                    <h4>What We Provide</h4>
                    <h3 class="title-w3ls mt-2 mb-3">Services we’re Provided</h3>
<ul class="tic-info list-unstyled mt-5">
                        <li>
                            <span class="fa fa-check-square-o mr-2"></span> All Types of Loans available
                        </li>
						
                        <li>

                            <span class="fa fa-check-square-o mr-2"></span> Paperless Loan Application
                        </li>

                        <li>

                            <span class="fa fa-check-square-o mr-2"></span> Repayable in 12 to 60 EMIs

                        </li>
                        <li>

                            <span class="fa fa-check-square-o mr-2"></span>Loan Interest starts from 10%

                        </li>
                        <li>
                            <span class="fa fa-check-square-o mr-2"></span> Easy Online Payment
                        </li>
                    </ul>
                </div>
<?php
$i=0;
$sqlltyp_loantypes = "SELECT * FROM ltyp_loantypes ORDER BY RAND() LIMIT 6";
$qsqlltyp_loantypes= mysqli_query($con,$sqlltyp_loantypes);
while($rsltyp_loantypes = mysqli_fetch_array($qsqlltyp_loantypes))
{
	$ltyp_loantype[$i] = $rsltyp_loantypes['ltyp_loantype'];
	$ltyp_interestperc[$i] = $rsltyp_loantypes['ltyp_interestperc'];
	$i++;
}
?>
                <div class="col-lg-7 welcome-right text-center mt-lg-0 mt-5">
                    <div class="row">
                        <div class="col-sm-4 service-1-w3pvt serve-gd1">
                        <div class="serve-grid mt-4">
                                <p class="mt-2" style="color: red;"><?php echo $ltyp_loantype[2]; ?> </p>
                                <p class="mt-2"><?php echo $ltyp_interestperc[2]; ?>%</p>
                            </div>
                        </div>
                        <div class="col-sm-4 service-1-w3pvt serve-gd2">
                            <div class="serve-grid mt-4">
                                <p class="mt-2" style="color: red;"><?php echo $ltyp_loantype[0]; ?> </p>
                                <p class="mt-2"><?php echo $ltyp_interestperc[0]; ?>%</p>
                            </div>
                            <div class="serve-grid mt-4">
                                <p class="mt-2" style="color: red;"><?php echo $ltyp_loantype[1]; ?> </p>
                                <p class="mt-2"><?php echo $ltyp_interestperc[1]; ?>%</p>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //services -->


    <!-- /news-letter -->
    <section class="news-letter-w3-pvt" style="background-color:powderblue;">
        <div class="container contact-form mx-auto text-left">
            <h3 class="title-w3ls two text-left mb-5" >Take instant loans @ AGH LOANS </h3>
            <form method="post" action="#" class="w3pvt-frm">
                <div class="row subscribe-sec">
                    <p class="news-para col-lg-12">Take instant loans whenever you need, 24x7. You can get cash loans from AGH loans and also a credit card.</p>
                </div>

            </form>
        </div>
    </section>
    <!-- //news-letter -->
    <!-- /services -->
    <div class="welcome py-5" id="test">
        <div class="container py-xl-5 py-lg-3">
            <div class="row">
                <div class="col-lg-7 welcome-right text-center mt-lg-0 mt-5">
                    <div class="row">
<?php
$i=0;
$sqlcustomer = "SELECT * FROM cst_customer WHERE cst_status='Active' and cst_type='Customer' ORDER BY RAND() LIMIT 6";
$qsqlcustomer= mysqli_query($con,$sqlcustomer);
while($rscustomer = mysqli_fetch_array($qsqlcustomer))
{
	$cstname[$i] = $rscustomer['cst_fname'] . " " .$rscustomer['cst_mname'] . " " .$rscustomer['cst_lname'];
	$cstimg[$i] = $rscustomer['cst_photo'];
	$i++;
}
?>
<div class="col-sm-4 service-1-w3pvt serve-gd3">
	<div class="serve-grid test-gd mt-4">
		<img src="filecst_photo/<?php echo $cstimg[0]; ?>" alt="" style="width: 160px; height: 160px;" class="img-fluid image1">
		<p class="mt-2"><?php echo $cstname[0]; ?></p>
	</div>
	<div class="serve-grid test-gd mt-4">
		<img src="filecst_photo/<?php echo $cstimg[1]; ?>" style="width: 160px; height: 160px;" alt="" class="img-fluid image1">
		<p class="mt-2"><?php echo $cstname[1]; ?> </p>
	</div>
	<div class="serve-grid test-gd mt-4">
		<img src="filecst_photo/<?php echo $cstimg[2]; ?>" style="width: 160px; height: 160px;" alt="" class="img-fluid image1">
		<p class="mt-2"><?php echo $cstname[2]; ?> </p>
	</div>
</div>

<div class="col-sm-4 service-1-w3pvt serve-gd2">
	<div class="serve-grid test-gd mt-4">
		<img src="filecst_photo/<?php echo $cstimg[3]; ?>" style="width: 160px; height: 160px;" alt="" class="img-fluid image1">
		<p class="mt-2"><?php echo $cstname[3]; ?> </p>
	</div>
	<div class="serve-grid test-gd mt-4">
		<img src="filecst_photo/<?php echo $cstimg[4]; ?>" alt="" class="img-fluid image1" style="width: 160px; height: 160px;" >
		<p class="mt-2"><?php echo $cstname[4]; ?> </p>
	</div>
</div>
<div class="col-sm-4 service-1-w3pvt serve-gd1">
	<div class="serve-grid test-gd mt-4">
		<img src="filecst_photo/<?php echo $cstimg[5]; ?>" style="width: 160px; height: 160px;" alt="" class="img-fluid image1">
		<p class="mt-2"><?php echo $cstname[5]; ?> </p>
	</div>
</div>

                    </div>
                </div>
                <div class="col-lg-5 welcome-left pl-lg-5">
                    <h4>Words </h4>
                    <h3 class="title-w3ls mt-2 mb-3">Customer Afterthought</h3>

                    <p class="mt-4 test"><span class="fa fa-quote-left"></span>Before 4 years ago, purchased my home loan from AGH Housing finance. Due to the low interest rates, i have selected AGH Housing. Taken the loan amount of Rs. 14 lakhs and i am paying the EMI amount of Rs. 12940 per month. Total duration of the loan is 15 years.</p>
                    <p class="mt-4 test"><span class="fa fa-quote-left"></span> I will recommend this site to all those who want to apply loan online.</p>
                    <p class="mt-4 test"><span class="fa fa-quote-left"></span> I got an offer for personal loan from Home credit. I used the loan for investment and the loan was sanctioned on time.The tenure of the loan were 3 years and its almost complete.The overall experience with the personal loan were fine.</p>
                    <p class="mt-4 test"><span class="fa fa-quote-left"></span> Instant Loans are best for urgent requirements. I applied for the same from AGH Loans. The process to apply was very simple and easy. I got the approval message within seconds and disbursal happened on the same day.</p>
                </div>

            </div>
        </div>
    </div>
    <!-- //services -->
    <?php
include("footer.php");
?>