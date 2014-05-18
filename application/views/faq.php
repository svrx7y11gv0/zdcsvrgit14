<?php   include_once('templates/header_bar.php');
        include_once('templates/left_sidebar.php');
?>
<!-- Page Specific CSS -->
<style>
    .tab-pane
    {
        margin-top: 0;
    }
</style>
									<div class="clearfix">
										<h3 class="content-title pull-left">Frequently Asked Questions</h3>
									</div>
									<div class="description">Important points and system understanding.</div>
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
										<div class="box border">
											<div class="box-title">
												<h4><i class="fa fa-bars"></i>Help Menu</h4>
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
												<?php   include_once('faq_content.php');?>
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
                    var attendance_type = jQuery('input[name=attendanceType]:checked', '#institute_setup_form').val();
                    if(attendance_type==null)
                        attendance_type="";
                    var dataString = 'name='+jQuery("#instituteName").val()+'&phone='+jQuery("#institutePhone").val()+'&email='+jQuery("#instituteEmail").val()+'&address='+jQuery("#instituteAddress").val()+'&atttype='+attendance_type;
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
                                if(data=="all_good")
                                {
                                    //Call
                                    Messenger().post({
                                            message:"Information Saved!",
                                            showCloseButton: true
                                    });
                                }
                                else
                                {
                                    //Call
                                    Messenger().post({
                                            message:data,
                                            type: "error",
                                            showCloseButton: true
                                    });
                                    $('input[name=attendanceType]').not(':checked').prop("checked", true);
                                }
                                if(attendance_type!="")
                                    jQuery('input[name=attendanceType]').prop("disabled",true);
                                App.unblockUI(el);
                            }
                       });
                       return false;
                 });
            });
        </script>
        
        <!-- COMMON END FOOTER JAVASCRIPT INCLUDES -->
	<?php include_once('templates/common_end_footer_scripts.php');?>
        
	<!-- /JAVASCRIPTS -->
</body>
</html>