<?php   include_once('templates/header_bar.php');
        include_once('templates/left_sidebar.php');
?>
									<div class="clearfix">
										<h3 class="content-title pull-left">Manage Classes</h3>
									</div>
									<div class="description">Management of classes is as per ACL (Access Control List) as defined in FAQs</div>
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
												<h4><i class="fa fa-bars"></i>Select a Class</h4>
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
                                                                                            <form class="form-horizontal" id="manage_classes" name="manage_classes" >
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
                                                                                                            <label class="col-md-2 control-label">Select Class</label> 
                                                                                                             <div class="col-md-10">
                                                                                                                 <select id="class_code" name="thisclasscode" data-placeholder="Choose a Class..." class="form-control">
                                                                                                                     <?php if(isset($classes)):?>
                                                                                                                         <?php foreach($classes as $class):?>
                                                                                                                             <option value="<?php echo $class['class_code'];?>"> <?php echo $class['classname']." ".$class['section']; ?></option>
                                                                                                                         <?php endforeach;?>
                                                                                                                     <?php endif; ?>
                                                                                                                 </select>
                                                                                                             </div>
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                            <label class="col-md-2 control-label">Select Month & Year</label> 
                                                                                                             <div class="col-sm-9">
                                                                                                                 <div class="col-lg-4" style="padding-left:0;"> 
                                                                                                                    <select id="month" name="month" data-placeholder="Choose Month..." class="form-control">
                                                                                                                        <option value="01" <?php if(date('F')=='January') echo " selected " ?> >January</option>
                                                                                                                        <option value="02" <?php if(date('F')=='February') echo " selected " ?> >February</option>
                                                                                                                        <option value="03" <?php if(date('F')=='March') echo " selected " ?> >March</option>
                                                                                                                        <option value="04" <?php if(date('F')=='April') echo " selected " ?> >April</option>
                                                                                                                        <option value="05" <?php if(date('F')=='May') echo " selected " ?> >May</option>
                                                                                                                        <option value="06" <?php if(date('F')=='June') echo " selected " ?> >June</option>
                                                                                                                        <option value="07" <?php if(date('F')=='July') echo " selected " ?> >July</option>
                                                                                                                        <option value="08" <?php if(date('F')=='August') echo " selected " ?> >August</option>
                                                                                                                        <option value="09" <?php if(date('F')=='September') echo " selected " ?> >September</option>
                                                                                                                        <option value="10" <?php if(date('F')=='October') echo " selected " ?> >October</option>
                                                                                                                        <option value="11" <?php if(date('F')=='November') echo " selected " ?> >November</option>
                                                                                                                        <option value="12" <?php if(date('F')=='December') echo " selected " ?> >December</option>
                                                                                                                    </select>
                                                                                                                 </div>
                                                                                                                 <div class="col-lg-4" style="padding-left:0;"> 
                                                                                                                    <select id="year" name="year" data-placeholder="Choose Year..." class="form-control">
                                                                                                                        <?php for($i=2010; $i<=2050; $i++): ?>
                                                                                                                            <option value="<?php echo $i;?>" <?php if(date('Y')==$i) echo " selected " ?>><?php echo $i;?></option>
                                                                                                                        <?php endfor;?>
                                                                                                                    </select>
                                                                                                                 </div>
                                                                                                                 
                                                                                                                 <div class="col-lg-2"> <input type="submit" value="Show Records" id="btn_show_records" class="btn btn-primary pull-right"> </div>
                                                                                                             </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
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
                                   jQuery("#class_code option").remove();
                                   if(data)
                                   {
                                        for(var i = 0; i < data.length; i++)
                                        {
                                           var obj = data[i];
                                           var option = new Option(obj.classname + " " + obj.section,obj.class_code);
                                           /// jquerify the DOM object 'option' so we can use the html method
                                           jQuery(option).html(obj.classname + " " + obj.section);
                                           jQuery("#class_code").append(option);
                                        }
                                        
                                        /******UPDATE STUDENTS LIST AFTER CHANGING DEPARTMENT*****/
                                        var dataString = 'class_code='+data[0].class_code;
                    
                                        var url = "<?php echo base_url('secure/get_students_ofa_class');?>";
                                        jQuery.ajax({
                                             type: "POST",
                                             url: url,
                                             data: dataString, // serializes the form's elements.
                                             dataType: "json",
                                             success: function(data)
                                             {
                                                 jQuery("#student_bioid option").remove();
                                                 if(data)
                                                 {
                                                    for(var i = 0; i < data.length; i++)
                                                    {
                                                       var obj = data[i];
                                                       if(obj.rollno!=0 && obj.rollno!=null) 
                                                           option_text = obj.rollno+" - "+obj.firstname + " " + obj.middlename + " " + obj.lastname; 
                                                       else
                                                           option_text = obj.firstname + " " + obj.middlename + " " + obj.lastname;
                                                       var option = new Option(option_text, obj.bioid);
                                                       /// jquerify the DOM object 'option' so we can use the html method
                                                       $(option).html(option_text);
                                                       $("#student_bioid").append(option);
                                                    }
                                                 }
                                                 App.unblockUI(el);
                                             }
                                        });
                                        /******END UPDATING STUDENTS LIST AFTER CHANGING DEPARTMENT*****/
                                   }
                                   else
                                        jQuery("#student_bioid option").remove();
                                   App.unblockUI(el);
                                }
                           });
                    });
            });
        </script>
        
        <!-- COMMON END FOOTER JAVASCRIPT INCLUDES -->
	<?php include_once('templates/common_end_footer_scripts.php');?>
        
	<!-- /JAVASCRIPTS -->
</body>
</html>