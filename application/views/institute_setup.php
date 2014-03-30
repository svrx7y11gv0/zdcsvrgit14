<?php   include_once('templates/header_bar.php');
        include_once('templates/left_sidebar.php');
?>

									<div class="clearfix">
										<h3 class="content-title pull-left">Institute Setup</h3>
									</div>
									<div class="description">Configuration</div>
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
                                                <!-- FORMS -->
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<!-- BASIC -->
										<div class="box border orange">
											<div class="box-title">
												<h4><i class="fa fa-bars"></i>Institute Setup & Configuration Form</h4>
												<div class="tools hidden-xs">
													<a href="javascript:;" class="collapse">
														<i class="fa fa-chevron-up"></i>
													</a>
													<a href="javascript:;" class="remove">
														<i class="fa fa-times"></i>
													</a>
												</div>
											</div>
											<div class="box-body big">
												<h3 class="form-title">Basic Details</h3>
												<form role="form" id="institute_setup_form">
												  <div class="form-group">
													<label for="instituteName">Institute Name</label>
													<input type="text" class="form-control" id="instituteName" placeholder="Enter full name" value="<?php if(isset($institute_details)) echo $institute_details->name;?>" >
												  </div>
                                                                                                  <div class="form-group">
													<label>Address</label>
													 <textarea id="instituteAddress" class="form-control" rows="3"><?php if(isset($institute_details)) echo $institute_details->address;?></textarea>
												  </div>
												  <div class="form-group">
                                                                                                        <label for="institutePhone">Institute Contact Numbers</label>
                                                                                                        <div class="input-group">
                                                                                                            <span class="input-group-addon">
                                                                                                                <i class="fa fa-phone"></i>
                                                                                                            </span> 
                                                                                                            <input type="text" class="form-control" id="institutePhone" placeholder="Enter Numbers Separated By Comma"  value="<?php if(isset($institute_details)) echo $institute_details->phone_nos;?>" >
                                                                                                        </div>
												  </div>
                                                                                                  <div class="form-group">
                                                                                                        <label for="instituteEmail">Email Id's</label>
                                                                                                        <div class="input-group">
                                                                                                            <span class="input-group-addon">
                                                                                                                <i class="fa fa-pencil"></i>
                                                                                                            </span> 
                                                                                                            <input type="text" class="form-control" id="instituteEmail" placeholder="Enter Email Ids Separated By Comma"  value="<?php if(isset($institute_details)) echo $institute_details->email_ids;?>">
                                                                                                        </div>
												  </div>
												  
												  <button type="submit" class="btn btn-success">Save Details</button>
												</form>

											</div>
										</div>
									</div>
                                                                </div>
                                                        </div>
                                                </div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/PAGE -->
        
        <!-- COMMON JAVASCRIPT INCLUDES -->
	<?php include_once('templates/common_footer_scripts.php');?>
		
	<!-- DATE RANGE PICKER -->
	<script src="<?php echo base_url('resources/js/bootstrap-daterangepicker/moment.min.js');?>"></script>
	
	<script src="<?php echo base_url('resources/js/bootstrap-daterangepicker/daterangepicker.min.js');?>"></script>
	<!-- SLIMSCROLL -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/js/jQuery-slimScroll-1.3.0/slimScrollHorizontal.min.js');?>"></script>
	<!-- BLOCK UI -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/jQuery-BlockUI/jquery.blockUI.min.js');?>"></script>
        <!-- COOKIE -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/jQuery-Cookie/jquery.cookie.min.js');?>"></script>
	<!-- CUSTOM SCRIPT -->
	<script src="<?php echo base_url('resources/js/script.js');?>"></script>
	<script>
		jQuery(document).ready(function() {		
			App.setPage("fixed_header_sidebar");  //Set current page
			App.init(); //Initialise plugins and elements
		});
	</script>
        <script>
    
            jQuery(document).ready(function(){
                 jQuery("#institute_setup_form").submit(function(){
                    var el = jQuery(this).parents(".box");
                    App.blockUI(el);
                    var dataString = 'name='+jQuery("#instituteName").val()+'&phone='+jQuery("#institutePhone").val()+'&email='+jQuery("#instituteEmail").val()+'&address='+jQuery("#instituteAddress").val();
                       var url = "<?php echo base_url('secure/updateInstituteDetails');?>";
                       jQuery.ajax({
                            type: "POST",
                            url: url,
                            data: dataString, // serializes the form's elements.
                            success: function(data)
                            {
                                var mytheme = "flat";
                                var mypos = "messenger-on-top messenger-on-right";
                                //Set theme
                                Messenger.options = {
                                        extraClasses: 'messenger-fixed '+mypos,
                                        theme: mytheme
                                }
                                //Call
                                Messenger().post({
                                        message:"Information Saved!",
                                        showCloseButton: true
                                });
                                App.unblockUI(el);
                            }
                       });
                       return false;
                 });
            });
        </script>
	<!-- /JAVASCRIPTS -->
</body>
</html>