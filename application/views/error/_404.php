﻿<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
        <link rel="icon" type="image/ico" href="<?php echo base_url('favicon.ico');?>"/>
	<title>Edbeans - All in one place</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- STYLESHEETS --><!--[if lt IE 9]><script src="<?php echo base_url('resources/js/flot/excanvas.min.js');?>"></script><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/css/cloud-admin.css');?>" >
	<link rel="stylesheet" type="text/css"  href="<?php echo base_url('resources/css/responsive.css');?>" >
	
        <link href="<?php echo base_url('resources/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">
	<!-- DATE RANGE PICKER -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/bootstrap-daterangepicker/daterangepicker-bs3.css');?>" />
	<!-- FONTS -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
</head>
<body>	
	<!-- PAGE -->
	<section id="page">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="divide-100"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 not-found text-center">
				   <div class="error">
					  404
				   </div>
				</div>
				<div class="col-md-4 col-md-offset-4 not-found text-center">
				   <div class="content">
					  <h3>Page not Found</h3>
					  <p>
						 Sorry, but the page you're looking for has not been found.<br />
						 Try checking the URL for errors, <a href="<?php echo base_url('secure');?>">goto dashboard</a> or try following.
					  </p>
					  <div class="btn-group">
						<a href="#" class="btn btn-success" onclick="javascript:history.go(-1);return false;"><i class="fa fa-chevron-left"></i> Go Back</a>
						<a href="<?php echo base_url('');?>" class="btn btn-default">Edbeans Home Page</a>
					  </div>
				   </div>
				</div>
			</div>
		</div>
	</section>
	<!--/PAGE -->
	<!-- JAVASCRIPTS -->
	<!-- Placed at the end of the document so the pages load faster -->
	<!-- JQUERY -->
	<script src="<?php echo base_url('resources/js/jquery/jquery-2.0.3.min.js');?>"></script>
	<!-- JQUERY UI-->
	<script src="<?php echo base_url('resources/js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js');?>"></script>
	<!-- BOOTSTRAP -->
	<script src="<?php echo base_url('resources/bootstrap-dist/js/bootstrap.min.js');?>"></script>
	
		
	<!-- DATE RANGE PICKER -->
	<script src="<?php echo base_url('resources/js/bootstrap-daterangepicker/moment.min.js');?>"></script>
	
	<script src="<?php echo base_url('resources/js/bootstrap-daterangepicker/daterangepicker.min.js');?>"></script>
	<!-- SLIMSCROLL -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/js/jQuery-slimScroll-1.3.0/slimScrollHorizontal.min.js');?>"></script>
	<!-- COOKIE -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/jQuery-Cookie/jquery.cookie.min.js');?>"></script>
	<!-- CUSTOM SCRIPT -->
	<script src="<?php echo base_url('resources/js/script.js');?>"></script>
	<script>
		jQuery(document).ready(function() {		
			App.setPage("widgets_box");  //Set current page
			App.init(); //Initialise plugins and elements
		});
	</script>
	<!-- /JAVASCRIPTS -->
</body>
</html>