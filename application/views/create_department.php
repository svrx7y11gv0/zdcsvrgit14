<?php   include_once('templates/header_bar.php');
        include_once('templates/left_sidebar.php');
?>
<!-- PAGE SPECIFIC STYLE / CSS -->
<link rel="stylesheet" href="<?php echo base_url('resources/css/chosen/chosen.min.css');?>">
<style>
    /* Smartphones (portrait and landscape) ----------- */
    @media only screen 
    and (min-device-width : 2048px)
    {
        .chosen-select
        {
            width: 460px;
        }
    }
    
    @media only screen 
    and (min-device-width : 1024px)
    {
        .chosen-select
        {
            width: 360px;
        }
    }
    
    @media only screen 
    and (min-device-width : 220px) and (max-device-width : 1024px)
    {
        .chosen-select
        {
            width: 160px;
        }
    }

</style>
									<div class="clearfix">
										<h3 class="content-title pull-left">Create Department</h3>
									</div>
									<div class="description">Add classes and teachers to department</div>
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
										<div class="box border lite">
											<div class="box-title">
												<h4><i class="fa fa-bars"></i>Create Department</h4>
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
                                                                                            <form class="form-horizontal" id="department_form" name="department_form" method="post" action="<?php echo base_url('secure/add_department');?>">
													<div class="row">
                                                                                                            <div class="col-md-12">
                                                                                                                   <div class="form-group">
                                                                                                                      <label class="col-md-2 control-label">Department Name *</label> 
                                                                                                                      <div class="col-md-10">
                                                                                                                          <input type="text" name="deptname" class="form-control" placeholder="Enter Department Name" />
                                                                                                                          <span id="deptname_error" class="help-block"></span>
                                                                                                                      </div>
                                                                                                                   </div>
                                                                                                                   <div class="form-group">
                                                                                                                       <label class="col-md-2 control-label">Add Classes</label> 
                                                                                                                        <div class="col-md-10">
                                                                                                                            <select id="multi_classes" name="multi_classes[]" data-placeholder="Choose Classes..." class="chosen-select form-control" multiple>
                                                                                                                                <?php if(isset($classes)):?>
                                                                                                                                    <?php foreach($classes as $class):?>
                                                                                                                                        <option value="<?php echo $class['class_code'];?>"><?php echo $class['class']." ".$class['section']; ?></option>
                                                                                                                                    <?php endforeach;?>
                                                                                                                                <?php endif; ?>
                                                                                                                            </select>
                                                                                                                            <span class="help-block">Press and hold Ctrl key + Click on class for adding multiple classes in one go.</span>
                                                                                                                        </div>
                                                                                                                   </div>
                                                                                                                    <div class="form-group">
                                                                                                                        <label class="col-md-2 control-label">Add Teachers</label> 
                                                                                                                        <div class="col-md-10">
                                                                                                                            <select id="multi_teachers" name="multi_teachers[]" data-placeholder="Add Teachers..." class="chosen-select form-control" multiple>
                                                                                                                                <?php if(isset($teachers)):?>
                                                                                                                                    <?php foreach($teachers as $teacher):?>
                                                                                                                                        <option value="<?php echo $teacher['bioid'];?>"><?php echo ucfirst($teacher['firstname'])." ".ucfirst($teacher['middlename']." ".ucfirst($teacher['lastname']));?></option>
                                                                                                                                    <?php endforeach;?>
                                                                                                                                <?php endif; ?>
                                                                                                                            </select>
                                                                                                                            <span class="help-block">Press and hold Ctrl key + Click on class for adding multiple teachers in one go.</span>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                            </form>
                                                                                            <div class="form-actions clearfix"> <input type="submit" value="Create Department" id="btn_create_dept" class="btn btn-primary pull-right"> </div>
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
	<!-- Multi Value Select CHOSEN -->
        <script src="<?php echo base_url('resources/js/chosen/chosen.jquery.min.js');?>" type="text/javascript"></script>
        <script type="text/javascript">
            var config = {
              '.chosen-select'           : {},
              '.chosen-select-deselect'  : {allow_single_deselect:true},
              '.chosen-select-no-single' : {disable_search_threshold:10},
              '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
              '.chosen-select-width'     : {width:"95%"}
            }
            for (var selector in config) {
              $(selector).chosen(config[selector]);
            }
        </script>
        <!-- END Multi Value Select CHOSEN -->
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
                
                <?php 
                $message_type = "";
                $message="";
                if($this->session->flashdata('error_msg'))
                {
                        $message = strip_tags($this->session->flashdata('error_msg'))." ";
                        $message_type = 'error';
                }
                else if($this->session->flashdata('success_msg'))
                {
                        $message .= $this->session->flashdata('success_msg');
                        $message_type = 'success';
                }
                ?>
                <?php if($message_type=='error'):?>
                    var mytheme = "flat";
                    var mypos = "messenger-on-top messenger-on-right";
                    //Set theme
                    Messenger.options = {
                            extraClasses: 'messenger-fixed '+mypos,
                            theme: mytheme
                    }
                    Messenger().post({
                            message: "<?php echo $message;?>",
                            type: "error",
                            showCloseButton: true
                    });
                <?php endif; ?>
                <?php if($message_type=='success'):?>
                    var mytheme = "flat";
                    var mypos = "messenger-on-top messenger-on-right";
                    //Set theme
                    Messenger.options = {
                            extraClasses: 'messenger-fixed '+mypos,
                            theme: mytheme
                    }
                    Messenger().post({
                            message: "<?php echo $message;?>",
                            showCloseButton: true
                    });
                <?php endif; ?>
                
                jQuery("#btn_create_dept").click(function(){
                    var el = jQuery(this).parents(".box");
                    App.blockUI(el);
                    var error_flag = 0;
                    jQuery('#deptname_error').text('');
                    if(jQuery.trim(jQuery('input[name=deptname]').val())=="")
                    {
                        error_flag = 1;
                        jQuery('input[name=deptname]').parent().parent().addClass("has-error");
                        jQuery('#deptname_error').text('This field is compulsory.');
                    }
                    if(error_flag==0)
                    {
                        jQuery('form#department_form').submit();
                    }
                    else
                        App.unblockUI(el);
                });
            });
        </script>
        
        <!-- COMMON END FOOTER JAVASCRIPT INCLUDES -->
	<?php include_once('templates/common_end_footer_scripts.php');?>
        
	<!-- /JAVASCRIPTS -->
</body>
</html>