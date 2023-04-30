<?php
include("header.php");
if(!isset($_SESSION['cst_id']))
{
		echo "<script>window.location='customerlogin.php';</script>";
}
?>
    </div>

<section class="content-info py-5">
	<div class="container py-md-5">

		<h3 class="title-w3ls mb-5 text-center">CIBIL SCORE</h3>
		<div class="row">


			<div class="col-lg-6 col-md-6 mt-8">
				<div class="thumbnail card">
					<div class="blog-info card-body">
<script>
// JS 
var chart = JSC.chart('chartDiv', { 
  debug: true, 
  type: 'gauge ', 
  legend_visible: false, 
  chartArea_boxVisible: false, 
  xAxis: { 
    /*Used to position marker on top of axis line.*/
    scale: { range: [0, 1], invert: true } 
  }, 
  palette: { 
    pointValue: '%yValue', 
    ranges: [ 
      { value: 350, color: '#FF5353' }, 
      { value: 600, color: '#FFD221' }, 
      { value: 700, color: '#77E6B4' }, 
      { value: [800, 850], color: '#21D683' } 
    ] 
  }, 
  yAxis: { 
    defaultTick: { padding: 13, enabled: false }, 
    customTicks: [600, 700, 800], 
    line: { 
      width: 15, 
      breaks_gap: 0.03, 
      color: 'smartPalette'
    }, 
    scale: { range: [350, 850] } 
  }, 
  defaultSeries: { 
    opacity: 1, 
    shape: { 
      label: { 
        align: 'center', 
        verticalAlign: 'middle'
      } 
    } 
  }, 
  series: [ 
    { 
      type: 'marker', 
      name: 'Score', 
      shape_label: { 
        text: 
          "720<br/> <span style='fontSize: 35'>Great!</span>", 
        style: { fontSize: 48 } 
      }, 
      defaultPoint: { 
        tooltip: '%yValue', 
        marker: { 
          outline: { 
            width: 10, 
            color: 'currentColor'
          }, 
          fill: 'white', 
          type: 'circle', 
          visible: true, 
          size: 30 
        } 
      }, 
      points: [[1, 720]] 
    } 
  ] 
}); 
</script>
<div id="chartDiv" style="max-width: 400px; height: 370px;margin: 0px auto">
</div>
					</div>
				</div>
			</div>
			
			
			<div class="col-lg-6 col-md-6 mt-8">
				<div class="thumbnail card">
					<div class="position-relative">
						<img src="<?php echo $icon; ?>" style="height: 250px;width: 100%;" class="img-fluid" alt="">
					</div>
					<div class="blog-info card-body">
						<h4 class=""><?php echo $rs['ltyp_loantype']; ?></h4>
						<p class="mt-2">
						<b>- Loan Amount -</b> <?php echo moneyFormatIndia($rs['min_loanamt']); ?> - <?php echo moneyFormatIndia($rs['max_loanamt']); ?><br>
						<b>- maximum Month -</b>  <?php echo $rs['ltyp_maxmonth']; ?> months<br>
						<b>- Interest rate -</b> <?php echo $rs['ltyp_interestperc']; ?>% <br>
						<b>- Delay Payment Charges -</b> <?php echo $rsdelaypaymentpenaltycharge['dpmt_charge']; ?>% 
						</p>
					</div>
				</div>
			</div>
			
			
		</div>
		<div class="row">


			<div class="col-lg-12 col-md-12 mt-8">
				<div class="thumbnail card">
					<div class="position-relative">
						<img src="<?php echo $icon; ?>" style="height: 250px;width: 100%;" class="img-fluid" alt="">
					</div>
					<div class="blog-info card-body">
						<h4 class=""><?php echo $rs['ltyp_loantype']; ?></h4>
						<p class="mt-2">
						<b>- Loan Amount -</b> <?php echo moneyFormatIndia($rs['min_loanamt']); ?> - <?php echo moneyFormatIndia($rs['max_loanamt']); ?><br>
						<b>- maximum Month -</b>  <?php echo $rs['ltyp_maxmonth']; ?> months<br>
						<b>- Interest rate -</b> <?php echo $rs['ltyp_interestperc']; ?>% <br>
						<b>- Delay Payment Charges -</b> <?php echo $rsdelaypaymentpenaltycharge['dpmt_charge']; ?>% 
						</p>
					</div>
				</div>
			</div>
			
			
		</div>
	</div>
</section>
<!-- //banner-botttom -->



<?php
include("footer.php");
?>