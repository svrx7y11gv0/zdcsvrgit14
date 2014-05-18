<?php   include_once('templates/header_bar.php');
        include_once('templates/left_sidebar.php');
?>
<!-- PAGE SPECIFIC STYLE / CSS -->
<!-- TABLE CLOTH -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/tablecloth/css/tablecloth.min.css');?>" />

									<div class="clearfix">
										<h3 class="content-title pull-left">Departments Information</h3>
									</div>
									<div class="description">View all information associated with departments.</div>
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
												<h4><i class="fa fa-bars"></i>Departments Information</h4>
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
                                                                                            <?php if(isset($departments)):?>
												<form class="form-horizontal" id="department_form" name="department_form" method="post" action="<?php echo base_url('secure/view_departments');?>">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="form-group">
                                                                                                                <label class="col-md-2 control-label">Select Department</label> 
                                                                                                                <div class="col-md-10">
                                                                                                                    <select id="select_department" name="thisdeptid" data-placeholder="Choose Department..." class="form-control" style="cursor:pointer;">
                                                                                                                        <?php if(isset($departments)):?>
                                                                                                                            <?php foreach($departments as $department):?>
                                                                                                                                <option value="<?php echo $department['id'];?>" <?php if($thisdeptid==$department['id']) { $curr_deptname = $department['department_name']; echo " selected ";}?> > <?php echo $department['department_name']; ?> </option>
                                                                                                                            <?php endforeach;?>
                                                                                                                        <?php endif; ?>
                                                                                                                    </select>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </form>
                                                                                                <div class="dept_classes">
                                                                                                    <?php if(isset($department_classes)):?>
                                                                                                    <table id="dept_classes_tab" class="table table-stats table-condensed table-striped table-sortable">
                                                                                                        <thead>
                                                                                                          <tr>
                                                                                                                <th colspan="5" class="{sorter: true}">Classes under <?php echo $curr_deptname;?> department</th>
                                                                                                          </tr>
                                                                                                          <tr>
                                                                                                                <th>Class Code</th>

                                                                                                                <th>Class</th>

                                                                                                                <th>Section</th>

                                                                                                                <th>Device Serial Number</th>

                                                                                                          </tr>
                                                                                                        </thead>

                                                                                                        <tbody>
                                                                                                            <?php $i =0;?>
                                                                                                            <?php foreach($department_classes as $department_class):?>
                                                                                                                <tr class="<?php if($i%2==0) echo 'ss_tr_even';?>">
                                                                                                                    <td><?php echo $department_class['class_code'];?></td>
                                                                                                                    <td><?php echo $department_class['class'];?></td>
                                                                                                                    <td><?php echo $department_class['section'];?></td>
                                                                                                                    <td><?php echo $department_class['device_serial_number'];?></td>
                                                                                                                </tr>
                                                                                                                <?php $i++;?>
                                                                                                            <?php endforeach;?>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <?php else:?>
                                                                                                        <h4>No class found in <?php echo $curr_deptname;?> department.</h4>
                                                                                                    <?php endif;?>
                                                                                                </div>
                                                                                                <div class="dept_teachers">
                                                                                                    <?php if(isset($department_teachers)):?>
                                                                                                    <table id="dept_teachers_tab" class="table table-stats table-condensed table-striped table-sortable">
                                                                                                        <thead>
                                                                                                          <tr>
                                                                                                                <th colspan="6" class="{sorter: true}">Teachers under <?php echo $curr_deptname;?> department</th>
                                                                                                          </tr>
                                                                                                          <tr>
                                                                                                                <th>First Name</th>

                                                                                                                <th>Middle Name</th>

                                                                                                                <th>Last Name</th>

                                                                                                                <th>Privilege</th>

                                                                                                                <th>Contact Nos.</th>
                                                                                                                
                                                                                                                <th>Email</th>
                                                                                                          </tr>
                                                                                                        </thead>

                                                                                                        <tbody>
                                                                                                            <?php $i =0;?>
                                                                                                            <?php foreach($department_teachers as $department_teacher):?>
                                                                                                                <tr class="<?php if($i%2==0) echo 'ss_tr_even';?>">
                                                                                                                    <td><?php echo $department_teacher['firstname'];?></td>
                                                                                                                    <td><?php echo $department_teacher['middlename'];?></td>
                                                                                                                    <td><?php echo $department_teacher['lastname'];?></td>
                                                                                                                    <td><?php echo strtoupper($department_teacher['prv_type']);?></td>
                                                                                                                    <td><?php echo $department_teacher['contact_nos'];?></td>
                                                                                                                    <td><?php echo $department_teacher['email'];?></td>
                                                                                                                </tr>
                                                                                                                <?php $i++;?>
                                                                                                            <?php endforeach;?>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <?php else:?>
                                                                                                        <h4>No teacher found in <?php echo $curr_deptname;?> department.</h4>
                                                                                                    <?php endif;?>
                                                                                                </div>
                                                                                            <?php else:?>
                                                                                            <h4>No department found in our database. Please click <a href="<?php echo base_url('secure/create_department');?>">here</a> to create one.</h4>
                                                                                            <?php endif;?>
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
        <!-- TABLE CLOTH -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/tablecloth/js/jquery.tablecloth.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('resources/js/tablecloth/js/jquery.tablesorter.min.js');?>"></script>
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
                        $("#dept_classes_tab").tablecloth({
                            theme:"stats",
                            sortable:true,
                            condensed:true,
                            striped:true,
                            clean:true
                          });
                          $("#dept_teachers_tab").tablecloth({
                            theme:"stats",
                            sortable:true,
                            condensed:true,
                            striped:true,
                            clean:true
                          });
		});
	</script>
        <script>
    
            jQuery(document).ready(function(){
                $( "#select_department" ).change(function() {
                    jQuery("#department_form").submit();
                });
            });
        </script>
        
        <!-- COMMON END FOOTER JAVASCRIPT INCLUDES -->
	<?php include_once('templates/common_end_footer_scripts.php');?>
        
	<!-- /JAVASCRIPTS -->
</body>
</html>