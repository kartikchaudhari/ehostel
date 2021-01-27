<?php 
  include 'includes/functions.php';
  	$css='img{width: 340px; height: 215px;} .col-md-4{padding: 10px;text-align: center;}';
	put_head("eHostel :: Hostel at a Glance",$css,false);
	include 'includes/nav.php';
?>
<div class="container-fluid" style="min-height: 502px;">
	<h1 align="center">Hostel at a Glance</h1>
	<hr>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-4">
				<img src="<?=base_url('assets/gallery/hostel2.jpg');?>">
			</div>
			<div class="col-md-4">
				<img src="<?=base_url('assets/gallery/hostel3.png');?>">
			</div>
			<div class="col-md-4">
				<img src="<?=base_url('assets/gallery/hostel4.png');?>">
			</div>
		</div>	
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-4">
				<img src="<?=base_url('assets/gallery/hostel5.png');?>">
			</div>
			<div class="col-md-4">
				<img src="<?=base_url('assets/gallery/hostel6.png');?>">
			</div>
			<div class="col-md-4">
				<img src="<?=base_url('assets/gallery/hostel7.png');?>">
			</div>
		</div>	
	</div>
</div>
<!-- the footer -->
<?php
	put_footer(true,null);
?>