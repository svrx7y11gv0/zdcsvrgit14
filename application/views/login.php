<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Edbeans - All in one place</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- STYLESHEETS --><!--[if lt IE 9]><script src="<?php echo base_url('resources/js/flot/excanvas.min.js');?>"></script><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/css/cloud-admin.css');?>" >
	<!-- HUBSPOT MESSENGER -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/hubspot-messenger/css/messenger.min.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/hubspot-messenger/css/messenger-theme-flat.min.css');?>">
        
        
	<link href="<?php echo base_url('resources/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">
	<!-- DATE RANGE PICKER -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/bootstrap-daterangepicker/daterangepicker-bs3.css');?>" />
	<!-- UNIFORM -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/uniform/css/uniform.default.min.css');?>" />
	<!-- ANIMATE -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/css/animatecss/animate.min.css');?>" />
	<!-- FONTS -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/css/mystyle.css');?>" >
</head>
<body class="login">
        <!-- Hubspot-Messenger -->
        <ul id="messenger-on-top-right" class="messenger messenger-fixed messenger-on-top messenger-on-right messenger-theme-flat">
            <li class="messenger-message-slot messenger-shown messenger-first messenger-last">

            </li>
        </ul>
        <!-- END Hubspot-Messenger -->
	<!-- PAGE -->
	<section id="page">
			<!-- HEADER -->
			<header>
				<!-- NAV-BAR -->
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<div id="logo">
								<a href="index.html"><img src="<?php echo base_url('resources/img/logo/logo-alt.png');?>" height="60" alt="logo name" /></a>
							</div>
						</div>
					</div>
				</div>
				<!--/NAV-BAR -->
			</header>
			<!--/HEADER -->
			<!-- LOGIN -->
			<section id="login" class="visible">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<div class="box border login-box-plain">
								<h2 class="bigintro" style="margin-top:0px">Sign In</h2>
								<div class="divide-40"></div>
								<form id="login_form" role="form" method="post" action="<?php echo base_url('secure/login');?>">
                                                                  <div class="form-group">
									<label for="InputInstitute1">Institute</label>
									<i class="fa fa-th-list"></i>
									<select class="form-control institute-list" id="InputInstitute1" name="InputInstitute1" >
                                                                            <?php foreach($institutes as $institute) :?>
                                                                                <option value="<?php echo $institute->id;?>"><?php echo $institute->name; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
								  </div>
								  <div class="form-group">
									<label for="InputUsername1">Username</label>
									<i class="fa fa-user"></i>
									<input type="text" class="form-control" id="InputUsername1" name="InputUsername1"  >
								  </div>
								  <div class="form-group"> 
									<label for="InputPassword1">Password</label>
									<i class="fa fa-lock"></i>
									<input type="password" class="form-control" id="InputPassword1" name="InputPassword1"  >
								  </div>
								  <div class="form-actions">
									<label class="checkbox"> <input type="checkbox" class="uniform" id="RememberMe" value=""> Stay signed in</label>
									<button type="submit" class="btn btn-danger">Submit</button>
                                                                        <div class="login-helpers">
                                                                            <a href="#" onclick="swapScreen('forgot');return false;">Forgot Password?</a> <br>
                                                                        </div>
								  </div>
                                                                    
								</form>
								<!-- SOCIAL LOGIN -->
								<div class="divide-20"></div>
								<div class="center">
									<strong>Follow Us</strong>
								</div>
								<div class="divide-20"></div>
								<div class="social-login center">
									<a href ="http://www.facebook.com/cssindia" target="_blank" class="btn btn-primary btn-lg">
										<i class="fa fa-facebook"></i>
									</a>
									<a href="" target="_blank" class="btn btn-info btn-lg">
										<i class="fa fa-twitter"></i>
									</a>
									<a href="" target="_blank"class="btn btn-danger btn-lg">
										<i class="fa fa-google-plus"></i>
									</a>
								</div>
								<!-- /SOCIAL LOGIN -->
								
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--/LOGIN -->
			<!-- REGISTER -->
			<section id="register">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<div class="login-box-plain">
								<h2 class="bigintro">Register</h2>
								<div class="divide-40"></div>
								<form role="form">
								  <div class="form-group">
									<label for="exampleInputName">Full Name</label>
									<i class="fa fa-font"></i>
									<input type="text" class="form-control" id="exampleInputName" >
								  </div>
								  <div class="form-group">
									<label for="exampleInputUsername">Username</label>
									<i class="fa fa-user"></i>
									<input type="text" class="form-control" id="exampleInputUsername" >
								  </div>
								  <div class="form-group">
									<label for="exampleInputEmail1">Email address</label>
									<i class="fa fa-envelope"></i>
									<input type="email" class="form-control" id="exampleInputEmail1" >
								  </div>
								  <div class="form-group"> 
									<label for="exampleInputPassword1">Password</label>
									<i class="fa fa-lock"></i>
									<input type="password" class="form-control" id="exampleInputPassword1" >
								  </div>
								  <div class="form-group"> 
									<label for="exampleInputPassword2">Repeat Password</label>
									<i class="fa fa-check-square-o"></i>
									<input type="password" class="form-control" id="exampleInputPassword2" >
								  </div>
								  <div class="form-actions">
									<label class="checkbox"> <input type="checkbox" class="uniform" value=""> I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
									<button type="submit" class="btn btn-success">Sign Up</button>
								  </div>
								</form>
								<!-- SOCIAL REGISTER -->
								<div class="divide-20"></div>
								<div class="center">
									<strong>Or register using your social account</strong>
								</div>
								<div class="divide-20"></div>
								<div class="social-login center">
									<a class="btn btn-primary btn-lg">
										<i class="fa fa-facebook"></i>
									</a>
									<a class="btn btn-info btn-lg">
										<i class="fa fa-twitter"></i>
									</a>
									<a class="btn btn-danger btn-lg">
										<i class="fa fa-google-plus"></i>
									</a>
								</div>
								<!-- /SOCIAL REGISTER -->
								<div class="login-helpers">
									<a href="#" onclick="swapScreen('login');return false;"> Back to Login</a> <br>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--/REGISTER -->
			<!-- FORGOT PASSWORD -->
			<section id="forgot">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<div class="login-box-plain">
								<h2 class="bigintro">Reset Password</h2>
								<div class="divide-40"></div>
								<form role="form">
								  <div class="form-group">
									<label for="exampleInputEmail1">Enter your Email address</label>
									<i class="fa fa-envelope"></i>
									<input type="email" class="form-control" id="exampleInputEmail1" >
								  </div>
								  <div class="form-actions">
									<button type="submit" class="btn btn-info">Send Me Reset Instructions</button>
								  </div>
								</form>
								<div class="login-helpers">
									<a href="#" onclick="swapScreen('login');return false;">Back to Login</a> <br>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- FORGOT PASSWORD -->
	</section>
	<!--/PAGE -->
	<!-- JAVASCRIPTS -->
	<!-- Placed at the end of the document so the pages load faster -->
        <script>
            var base_url = "<?php echo base_url('');?>";
        </script>
	<!-- COMMON JAVASCRIPT INCLUDES -->
	<?php include_once('templates/common_footer_scripts.php');?>
	
	<!-- UNIFORM -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/uniform/jquery.uniform.min.js');?>"></script>
        <!-- BLOCK UI -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/jQuery-BlockUI/jquery.blockUI.min.js');?>"></script>
        <!-- JQUERY CooKie Plugin -->
        <script src="<?php echo base_url('resources/js/jquery.cookie.js');?>"></script>
	<!-- CUSTOM SCRIPT -->
	<script src="<?php echo base_url('resources/js/script.js');?>"></script>
	<script>
		jQuery(document).ready(function() {		
			App.setPage("login");  //Set current page
			App.init(); //Initialise plugins and elements
		});
	</script>
	<script type="text/javascript">
		function swapScreen(id) {
			jQuery('.visible').removeClass('visible animated fadeInUp');
			jQuery('#'+id).addClass('visible animated fadeInUp');
		}
	</script>

<script>
    
jQuery(document).ready(function(){
    //Preventing going back to login page unless logged_out
/*    var is_logged = '< ?php if($this->session->userdata('username')) echo 1; else echo 0;?>';
    if(is_logged=='1')
        alert(is_logged);
        window.location.href="< ?php echo base_url('secure');?>";*/

    jQuery("#login_form").submit(function(){
                   var el = jQuery(this).parents(".box");
                   App.blockUI(el);
                   message="";
                   jQuery("ul#messenger-on-top-right li.messenger-message-slot").text("");
                   if(jQuery.trim(jQuery("#InputUsername1").val())=="")
                   {
                       message = 'Username can not be empty';
                       jQuery("#InputUsername1").focus();                            
                   }
                   else if(jQuery.trim(jQuery("#InputPassword1").val())=="")
                   {
                       message = 'Password can not be empty';
                       jQuery("#InputPassword1").focus();
                   }
                   if(message!="")
                   {
                        App.unblockUI(el);
                        var hubspot_messenger = '<div class="messenger-message message alert error message-error alert-error messenger-will-hide-after">\
                                                             <button type="button" class="messenger-close" data-dismiss="alert">×</button>\
                                                             <div class="messenger-message-inner">'+message+'</div>\
                                                     </div>';
                        jQuery("ul#messenger-on-top-right li.messenger-message-slot").append(hubspot_messenger); 
                   }
                   else
                   {
                       //Ajax post
                       if(jQuery("#RememberMe").is(':checked'))
                           remember_me = "yes";
                       else
                           remember_me = "no";
                       var dataString = 'institute_id='+jQuery("#InputInstitute1").val()+'&username='+jQuery("#InputUsername1").val()+'&password='+jQuery("#InputPassword1").val()+'&remember_me='+remember_me;
                       var url = "<?php echo base_url('secure/login');?>";
                       jQuery.ajax({
                            type: "POST",
                            url: url,
                            data: dataString, // serializes the form's elements.
                            success: function(data)
                            {
                                if(data=="true")
                                    window.location.href="<?php echo base_url("secure");?>";
                                else
                                {
                                    message = "User Name or Password is Not Correct.";
                                    var hubspot_messenger = '<div class="messenger-message message alert error message-error alert-error messenger-will-hide-after">\
                                                             <button type="button" class="messenger-close" data-dismiss="alert">×</button>\
                                                             <div class="messenger-message-inner">'+message+'</div>\
                                                     </div>';
                                    jQuery("ul#messenger-on-top-right li.messenger-message-slot").append(hubspot_messenger);
                                }
                                App.unblockUI(el);
                            }
                       });
                   }
                   
                   return false;
    });
               

      
});
</script>
	<!-- /JAVASCRIPTS -->
</body>
</html>