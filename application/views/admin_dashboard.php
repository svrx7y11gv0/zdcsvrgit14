<?php   include_once('templates/header_bar.php');
        include_once('templates/left_sidebar.php');
?>
<style>
    .gauge
    {
        width:100%; height:160px;
    }
</style>
									<div class="clearfix">
										<h3 class="content-title pull-left">Dashboard</h3>
									</div>
									<div class="description">Overview, Statistics and more</div>
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
                                                <!-- FORMS -->
						<div class="row">
							<!-- COLUMN 1 -->
							<div class="col-md-12">
								<div class="row">
								  <div class="col-lg-6">
									 <div class="dashbox panel panel-default">
										<div class="panel-body">
										   <div class="panel-left red">
												<!--<i class="fa fa-instagram fa-3x"></i>-->
                                                                                                <img src="<?php echo base_url('resources/img/students1.png');?>" />
										   </div>
										   <div class="panel-right">
												<div class="number"><?php echo $total_students; ?></div>
												<div class="title">Students</div>
                                                                                                <?php 
                                                                                                if($total_students!=0)
                                                                                                    $present_percentage = round(($todays_present_students / $total_students) * 100,2);
                                                                                                else {
                                                                                                    $present_percentage = 0;
                                                                                                }
                                                                                                ?>
												<span title="Percentage of today's present students" class="label <?php if($present_percentage<=50) echo 'label-warning'; else echo 'label-success';?>">
													<?php echo $present_percentage;?>% <i class="fa fa-arrow-up"></i>
												</span>
										   </div>
										</div>
									 </div>
								  </div>
								  <div class="col-lg-6">
									 <div class="dashbox panel panel-default">
										<div class="panel-body">
										   <div class="panel-left blue">
												<!--<i class="fa fa-twitter fa-3x"></i>-->
                                                                                                <img src="<?php echo base_url('resources/img/teachers1.png');?>" />
										   </div>
										   <div class="panel-right">
												<div class="number"><?php echo $total_teachers; ?></div>
												<div class="title">Teachers</div>
												<!--<span class="label label-warning">
													5% <i class="fa fa-arrow-down"></i>
												</span>-->
										   </div>
										</div>
									 </div>
								  </div>
								</div>
							</div>
							<!-- /COLUMN 1 -->
                                                </div>
                                                <!-- GAUGES FOR TODAY'S ATTENDANCE PERCENTAGE CLASS WISE -->
                                                <div class="row">
							<div class="col-md-12">
								<!-- BOX -->
								<div class="box border blue">
									<div class="box-title">
										<h4><i class="fa fa-bars"></i>Today's Attendance Percentage of Students (Class Wise)</h4>
										<div class="tools">
											<a href="javascript:;" class="reload">
												<i class="fa fa-refresh"></i>
											</a>
											<a href="javascript:;" class="collapse">
												<i class="fa fa-chevron-up"></i>
											</a>
											<a href="javascript:;" class="remove">
												<i class="fa fa-times"></i>
											</a>
										</div>
									</div>
									<div class="box-body">
                                                                            <form class="form-horizontal" id="dashboard" name="dashboard" method="post" action="<?php echo base_url('secure/dashboard');?>">
                                                                                <div class="row" style="margin-top:20px;">
                                                                                    <div class="form-group">
                                                                                        <label class="col-md-2 control-label" style="font-size:16px; padding: 8px 8px 20px 20px; text-align: right;">Select Department</label> 
                                                                                        <div class="col-md-9">
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
                                                                                </div>
                                                                            </form>
                                                                            <hr/>
                                                                            <?php $i=0; ?>
                                                                            <?php foreach($gauge_data as $gauge):?>
                                                                                <?php if($i % 3 == 0):?>
                                                                                    <div class="row">
                                                                                <?php endif; ?>
                                                                                
                                                                                <div class="col-md-4"><div id="<?php echo 'g'.$i;?>" class="gauge"></div></div>
										<?php if(($i+1) % 3 == 0):?>
                                                                                    </div>
										<?php endif; ?>
                                                                                <?php $i++; ?>
                                                                            <?php endforeach; ?>
									</div>
								</div>
								<!-- /BOX -->
							</div>
						</div>
                                                <!-- END GAUGES FOR TODAY'S ATTENDANCE PERCENTAGE CLASS WISE -->
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
        <!-- GAUGE -->
	<script src="<?php echo base_url('resources/js/justgage/js/raphael.2.1.0.min.js');?>"></script>
        <script src="<?php echo base_url('resources/js/justgage/js/justgage.1.0.1.min.js');?>"></script>
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
                 window.onload = function(){
                     <?php $i = 0; ?>
                     <?php foreach($gauge_data as $gauge):?>
                            var <?php echo 'g'.$i;?> = new JustGage({
                                id: "<?php echo 'g'.$i;?>", 
                                value: <?php echo (int)$gauge['percentage'];?>, 
                                min: 0,
                                max: 100,
                                title: "<?php echo $gauge['class_name'];?>",
                                label: "",  
                                levelColors: [Theme.colors.red, Theme.colors.yellow, Theme.colors.green]
                            });
                            <?php $i++; ?>
                      <?php endforeach; ?>
                 };
                 
                 jQuery("#select_department").change(function(){
                     jQuery("form#dashboard").submit();
                 });
            });
        </script>
        
        <!-- COMMON END FOOTER JAVASCRIPT INCLUDES -->
	<?php include_once('templates/common_end_footer_scripts.php');?>
        
	<!-- /JAVASCRIPTS -->
</body>
</html>