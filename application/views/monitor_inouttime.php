<?php   include_once('templates/header_bar.php');
        include_once('templates/left_sidebar.php');
?>
<!-- PAGE SPECIFIC STYLE / CSS -->
<!-- DATE PICKER -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/datepicker/themes/default.min.css');?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/datepicker/themes/default.date.min.css');?>" />
<!-- DATA TABLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/datatables/media/css/jquery.dataTables.min.css');?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/datatables/media/assets/css/datatables.min.css');?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/datatables/extras/TableTools/media/css/TableTools.min.css');?>" />
<style>
    ul.pagination li
    {
        cursor: pointer;
    }
    #datatable1_filter input
    {
        height: 28px;
    }
</style>
									<div class="clearfix">
										<h3 class="content-title pull-left">Monitor In & Out-Time</h3>
									</div>
									<div class="description">Monitor In and Out-time of students class wise</div>
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
										<div class="box border green">
											<div class="box-title">
												<h4><i class="fa fa-bars"></i>Monitor In and Out-Time</h4>
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
												<form class="form-horizontal" id="monitor_inouttime_form" name="monitor_inouttime_form" method="post" action="<?php echo base_url('secure/monitor_inouttime');?>">
													<div class="row">
														 <div class="col-md-12">
                                                                                                                    <div class="form-group">
                                                                                                                            <label class="col-md-2 control-label">Select Date</label>
                                                                                                                            <div class="col-md-10">
                                                                                                                                <?php $thisdate = date_create($thisdate);?>
                                                                                                                                    <input type="text" name="thisdate" class="form-control datepicker-fullscreen" value="<?php echo date_format($thisdate,'j F, Y');?>" />
                                                                                                                                    <span id="date_error" class="help-block"></span>
                                                                                                                            </div>
                                                                                                                    </div>
                                                                                                                    <div class="form-group">
                                                                                                                        <label class="col-md-2 control-label">Select Class</label> 
                                                                                                                         <div class="col-md-10">
                                                                                                                             <select id="class_code" name="thisclasscode" data-placeholder="Choose a Class..." class="form-control">
                                                                                                                                 <?php if(isset($classes)):?>
                                                                                                                                     <?php foreach($classes as $class):?>
                                                                                                                                         <option value="<?php echo $class['class_code'];?>" <?php if($thisclasscode==$class['class_code']) echo " selected "; ?> > <?php echo $class['class']." ".$class['section']; ?></option>
                                                                                                                                     <?php endforeach;?>
                                                                                                                                 <?php endif; ?>
                                                                                                                             </select>
                                                                                                                         </div>
                                                                                                                    </div>
                                                                                                                    
                                                                                                                 </div>
                                                                                                        </div>
                                                                                                </form>
                                                                                            <div class="form-actions clearfix"> <input type="submit" value="Show Records" id="btn_show_records" class="btn btn-primary pull-right"> </div>
                                                                                            <div class="row">
                                                                                            <div class="col-md-12">
                                                                                                <?php if(isset($students_inouttime_details)):?>
                                                                                                    <table id="datatable1" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered table-hover">
                                                                                                        <thead>
                                                                                                                <tr>
                                                                                                                        <th>First Name</th>
                                                                                                                        <th>Middle Name</th>
                                                                                                                        <th>Last Name</th>
                                                                                                                        <th>In Time</th>
                                                                                                                        <th>Out Time</th>
                                                                                                                        <th>Contact No.</th>
                                                                                                                </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
                                                                                                            <?php foreach($students_inouttime_details as $detail):?>
                                                                                                                <tr>
                                                                                                                    <td><?php echo $detail['firstname'];?></td>
                                                                                                                    <td><?php echo $detail['middlename'];?></td>
                                                                                                                    <td><?php echo $detail['lastname'];?></td>
                                                                                                                    <td><?php echo $detail['in_time'];?></td>
                                                                                                                    <td><?php echo $detail['out_time'];?></td>
                                                                                                                    <td><?php echo $detail['contact_nos'];?></td>
                                                                                                                </tr> 
                                                                                                            <?php endforeach;?>
                                                                                                        </tbody>
                                                                                                        <tfoot>
                                                                                                                <tr>
                                                                                                                        <th>First Name</th>
                                                                                                                        <th>Middle Name</th>
                                                                                                                        <th>Last Name</th>
                                                                                                                        <th>In Time</th>
                                                                                                                        <th>Out Time</th>
                                                                                                                        <th>Contact No.</th>
                                                                                                                </tr>
                                                                                                        </tfoot>
                                                                                                    </table>
                                                                                                 <?php else:?>
                                                                                                        <h4>No details found for selected date and class.</h4>
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
		</div>
	</section>
	<!--/PAGE -->
        
        <!-- COMMON JAVASCRIPT INCLUDES -->
	<?php include_once('templates/common_footer_scripts.php');?>
		
	<!-- SLIMSCROLL -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/js/jQuery-slimScroll-1.3.0/slimScrollHorizontal.min.js');?>"></script>
	<!-- BLOCK UI -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/jQuery-BlockUI/jquery.blockUI.min.js');?>"></script>
        <!-- COOKIE -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/jQuery-Cookie/jquery.cookie.min.js');?>"></script>
        <!-- DATE PICKER -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/datepicker/picker.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('resources/js/datepicker/picker.date.js');?>"></script>
	<!-- DATA TABLES -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/datatables/media/js/jquery.dataTables.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('resources/js/datatables/media/assets/js/datatables.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('resources/js/datatables/extras/TableTools/media/js/TableTools.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('resources/js/datatables/extras/TableTools/media/js/ZeroClipboard.min.js');?>"></script>
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
                 $('#datatable1').dataTable({
				"sPaginationType": "bs_full",
                                sDom: "<'row'<'dataTables_header clearfix'<'col-md-4'l><'col-md-8'Tf>r>>t<'row'<'dataTables_footer clearfix'<'col-md-6'i><'col-md-6'p>>>",
                                oTableTools: {
                                    aButtons: ["copy", "print", "pdf"],
                                    sSwfPath: "<?php echo base_url("/resources/js/datatables/extras/TableTools/media/swf/copy_csv_xls_pdf.swf");?>"
                                }
			});
                 $(".datepicker-fullscreen").pickadate();
                 
                 $( "#btn_show_records" ).click(function() {
                    var el = jQuery(this).parents(".box");
                    App.blockUI(el);
                    var error_flag = 0;
                    jQuery('#date_error').text('');
                    if(jQuery.trim(jQuery('input[name=thisdate]').val())=="")
                    {
                        error_flag = 1;
                        jQuery('input[name=thisdate]').parent().parent().addClass("has-error");
                        jQuery('#date_error').text('This field is compulsory.');
                    }
                    if(error_flag==0)
                    {
                        jQuery("#monitor_inouttime_form").submit();
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