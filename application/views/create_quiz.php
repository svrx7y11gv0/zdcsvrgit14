<?php   include_once('templates/header_bar.php');
        include_once('templates/left_sidebar.php');
?>
<!-- PAGE SPECIFIC STYLE / CSS -->
<link rel="stylesheet" href="<?php echo base_url('resources/css/chosen/chosen.min.css');?>">
<style>

    @media screen and (min-width: 240px)
    {
        /* styles for browsers larger than 240px; */
        .chosen-select
            {
                width: 115px;
            }
    }
    @media screen and (min-width: 320px)
    {
        /* styles for browsers larger than 320px; */
        .chosen-select
            {
                width: 150px;
            }
    }
    @media screen and (min-width: 480px)
    {
        /* styles for browsers larger than 480px; */
        .chosen-select
            {
                width: 230px;
            }
    }
    @media screen and (min-width: 768px)
    {
        /* styles for browsers larger than 768px; */
        .chosen-select
            {
                width: 368px;
            }
    }
    @media screen and (min-width: 1024px)
    {
        /* styles for browsers larger than 1024px; */
        .chosen-select
            {
                width: 490px;
            }
    }
    

</style>
									<div class="clearfix">
										<h3 class="content-title pull-left">Create Quiz</h3>
									</div>
									<div class="description">Generate Quiz</div>
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
										<div class="box border blue">
											<div class="box-title">
												<h4><i class="fa fa-bars"></i>Quiz Creator</h4>
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
                                                                                            <form class="form-horizontal" id="create_quiz" name="create_quiz" method="post" action="<?php echo base_url('secure/create_quiz_db');?>">
												<div class="row">
                                                                                                    <div class="col-md-12">
                                                                                                        <div class="form-group">
                                                                                                            <label class="col-md-2 control-label">Select Department</label> 
                                                                                                            <div class="col-md-10">
                                                                                                                <select id="select_department" name="thisdeptid" data-placeholder="Choose Department..." class="form-control" style="cursor:pointer;">
                                                                                                                    <?php if(isset($departments)):?>
                                                                                                                        <?php foreach($departments as $department):?>
                                                                                                                            <option value="<?php echo $department['id'];?>" <?php if($thisdeptid==$department['id']) echo " selected ";?> > <?php echo $department['department_name']; ?> </option>
                                                                                                                        <?php endforeach;?>
                                                                                                                    <?php endif; ?>
                                                                                                                            <option value="others" <?php if($thisdeptid=="others") echo " selected ";?> >Others</option>
                                                                                                                </select>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                            <label class="col-md-2 control-label">Add Classes</label> 
                                                                                                            <div class="col-md-10">
                                                                                                                <select id="multi_classes" name="multi_classes[]" data-placeholder="Choose Classes..." class="chosen-select form-control" multiple>
                                                                                                                    <?php if(isset($classes)):?>
                                                                                                                        <?php foreach($classes as $class):?>
                                                                                                                            <option value="<?php echo $class['class_code'];?>"><?php echo $class['classname']." ".$class['section']; ?></option>
                                                                                                                        <?php endforeach;?>
                                                                                                                    <?php endif; ?>
                                                                                                                </select>
                                                                                                                <span class="help-block">Press and hold Ctrl key + Click on class for adding multiple classes in one go.</span>
                                                                                                                <span id="classes_error" class="help-block"></span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                            <label class="col-md-2 control-label">Quiz Type</label> 
                                                                                                            <div class="col-md-10">
                                                                                                                <select id="quiz_type" name="quiz_type" class="form-control" style="cursor:pointer;">
                                                                                                                    <option selected value="p">Practice</option>
                                                                                                                    <option value="e">Exam</option>
                                                                                                                </select>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                            <label class="col-md-2 control-label">Quiz Title</label> 
                                                                                                            <div class="col-md-10">
                                                                                                                <input type="text" name="quiz_title" id="quiz_title" class="form-control" placeholder="Enter Quiz Title / Name" />
                                                                                                                <span id="quiz_title_error" class="help-block"></span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                            <label class="col-md-2 control-label">Number of Questions to be solved</label> 
                                                                                                            <div class="col-md-10">
                                                                                                                <input type="text" name="num_questions" id="num_questions" class="form-control" placeholder="Enter number of questions which should appear in quiz" />
                                                                                                                <span id="num_questions_error" class="help-block"></span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                            <label class="col-md-2 control-label">Is it Time Based?</label> 
                                                                                                            <div class="col-md-10">
                                                                                                                <select id="is_timed" name="is_timed" class="form-control" style="cursor:pointer;">
                                                                                                                    <option selected value="1">Yes</option>
                                                                                                                    <option value="0">No</option>
                                                                                                                </select>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                            <label class="col-md-2 control-label">Time Period of Quiz (in minutes)</label> 
                                                                                                            <div class="col-md-10">
                                                                                                                <input type="text" name="time_period" id="time_period" class="form-control" placeholder="Enter number of minutes for which quiz is to be conducted" />
                                                                                                                <span id="time_period_error" class="help-block"></span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </form>
                                                                                            <div class="form-actions clearfix"> 
                                                                                                <input type="submit" value="Create the Quiz" id="btn_create_quiz" class="btn btn-primary pull-right"> 
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
                
                jQuery("#is_timed").change(function() {
                    if(jQuery("#is_timed").val()==0)
                        jQuery("#time_period").attr("disabled", "disabled");
                    else
                        jQuery("#time_period").removeAttr("disabled"); 
                });
                jQuery( "#select_department" ).change(function() {
                    var el = jQuery(this).parents(".box");
                    App.blockUI(el);
                    var dataString = "deptid="+jQuery("#select_department").val();
                    var url = "<?php echo base_url('secure/get_selective_classes');?>";
                           jQuery.ajax({
                                type: "POST",
                                url: url,
                                data: dataString, 
                                dataType: "json",
                                success: function(data)
                                {
                                   jQuery("#multi_classes option").remove();
                                   $('#multi_classes').trigger('chosen:updated');
                                   if(data)
                                   {
                                        for(var i = 0; i < data.length; i++)
                                        {
                                           var obj = data[i];
                                           var option = new Option(obj.classname + " " + obj.section,obj.class_code);
                                           /// jquerify the DOM object 'option' so we can use the html method
                                           jQuery(option).html(obj.classname + " " + obj.section);
                                           jQuery("#multi_classes").append(option);
                                        }
                                        
                                   }
                                   $('#multi_classes').trigger('chosen:updated');
                                   App.unblockUI(el);
                                }
                           });
                    });
                    
                    jQuery("#btn_create_quiz").click(function(){
                        var el = jQuery(this).parents(".box");
                        App.blockUI(el);
                        jQuery('#multi_classes').parent().parent().removeClass("has-error");
                        jQuery('#classes_error').text(''); 
                        jQuery('#quiz_title').parent().parent().removeClass("has-error");
                        jQuery('#quiz_title_error').text(''); 
                        jQuery('#num_questions').parent().parent().removeClass("has-error");
                        jQuery('#num_questions_error').text(''); 
                        jQuery('#time_period').parent().parent().removeClass("has-error");
                        jQuery('#time_period_error').text(''); 
                        var error_flag = 0;
                        
                        var index = jQuery("#multi_classes")[0].selectedIndex;
                        if(! jQuery("#multi_classes option").eq(index).is(':selected'))
                        {
                            error_flag = 1;
                            jQuery('#multi_classes').parent().parent().addClass("has-error");
                            jQuery('#classes_error').text('Atleast one class must be added for quiz'); 
                        }
                        if(jQuery('#quiz_title').val()=="")
                        {
                            error_flag = 1;
                            jQuery('#quiz_title').parent().parent().addClass("has-error");
                            jQuery('#quiz_title_error').text('Please enter the quiz title.');
                        }
                        if(jQuery('#num_questions').val()=="")
                        {
                            error_flag = 1;
                            jQuery('#num_questions').parent().parent().addClass("has-error");
                            jQuery('#num_questions_error').text('Please enter number of questions to be asked.');
                        }
                        if(jQuery("#is_timed").val()==1 && jQuery('#time_period').val()=="")
                        {
                            error_flag = 1;
                            jQuery('#time_period').parent().parent().addClass("has-error");
                            jQuery('#time_period_error').text('Please enter time period / duration of quiz (in minutes).');
                        }
                        if(error_flag==0)
                        {
                            jQuery('form#create_quiz').submit();
                        }
                        App.unblockUI(el);
                    });
            });
        </script>
        
        <!-- COMMON END FOOTER JAVASCRIPT INCLUDES -->
	<?php include_once('templates/common_end_footer_scripts.php');?>
        
	<!-- /JAVASCRIPTS -->
</body>
</html>