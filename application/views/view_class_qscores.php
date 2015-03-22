<?php   include_once('templates/header_bar.php');
        include_once('templates/left_sidebar.php');
?>
<!-- DATA TABLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/datatables/media/css/jquery.dataTables.min.css');?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/datatables/media/assets/css/datatables.min.css');?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/datatables/extras/TableTools/media/css/TableTools.min.css');?>" />

									<div class="clearfix">
										<h3 class="content-title pull-left">View Classes' Performance</h3>
									</div>
									<div class="description">Quiz Scores</div>
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
												<h4><i class="fa fa-bars"></i>Select a Quiz and see students' performance</h4>
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
                                                                                            <?php if(isset($thisquizid)):?>
                                                                                                <form class="form-horizontal" id="edit_quiz" name="edit_quiz" method="post" action="<?php echo base_url('secure/edit_quiz_db');?>">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="form-group">
                                                                                                                <label class="col-md-2 control-label">Select a Quiz</label> 
                                                                                                                <div class="col-md-10">
                                                                                                                    <select id="thisquizid" name="thisquizid" data-placeholder="Choose Quiz..." class="form-control" style="cursor:pointer;">
                                                                                                                        <?php if(isset($quizes)):?>
                                                                                                                            <?php foreach($quizes as $quiz):?>
                                                                                                                                <option value="<?php echo $quiz['quiz_id'];?>" <?php if($thisquizid==$quiz['quiz_id']) echo " selected ";?> > <?php echo $quiz['title']."&nbsp;&nbsp;&nbsp;Created On: ".$quiz['created_datetime']; ?> </option>
                                                                                                                            <?php endforeach;?>
                                                                                                                        <?php endif; ?>
                                                                                                                    </select>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label class="col-md-2 control-label">Select a Class</label> 
                                                                                                                 <div class="col-md-10">
                                                                                                                     <select id="class_code" name="thisclassidq" data-placeholder="Choose a Class..." class="form-control">
                                                                                                                         <?php if(isset($quiz_classes)):?>
                                                                                                                             <?php foreach($quiz_classes as $class):?>
                                                                                                                                 <option value="<?php echo $class['id'];?>" <?php if(isset($thisclassidq) && $thisclassidq==$class['id']) { echo " selected "; $curr_class=$class['classname']." ".$class['section'];}?>> <?php echo $class['classname']." ".$class['section']; ?></option>
                                                                                                                             <?php endforeach;?>
                                                                                                                         <?php endif; ?>
                                                                                                                     </select>
                                                                                                                 </div>
                                                                                                            </div>
                                                                                                            
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </form>
                                                                                                <div class="form-actions clearfix"> 
                                                                                                    <input type="submit" value="Show Records" id="btn_show_records" class="btn btn-primary pull-right"> 
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class="col-md-12">
                                                                                                        <?php if(isset($quiz_scores) && count($quiz_scores)>0):?>
                                                                                                            <table id="datatable1" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered table-hover">
                                                                                                                <thead>
                                                                                                                        <tr>
                                                                                                                                <th>Roll No.</th>
                                                                                                                                <th>Name</th>
                                                                                                                                <th>Total Questions</th>
                                                                                                                                <th>Questions Attempted</th>
                                                                                                                                <th>Correctly Answered</th>
                                                                                                                                <th>Time Taken</th>
                                                                                                                                <th>Score Obtained</th>
                                                                                                                                <th>Date Time Attended</th>
                                                                                                                        </tr>
                                                                                                                </thead>
                                                                                                                <tbody>
                                                                                                                    <?php foreach($quiz_scores as $detail):?>
                                                                                                                        <tr>
                                                                                                                            <td><?php if($detail['rollno']!=0 && $detail['rollno']!=null) echo $detail['rollno'];?></td>
                                                                                                                            <td><?php echo $detail['firstname']." ".$detail['middlename']." ".$detail['lastname'];?></td>
                                                                                                                            <td><?php echo $detail['total'];?></td>
                                                                                                                            <td><?php echo $detail['questions_attempted'];?></td>
                                                                                                                            <td><?php echo $detail['correctly_answered'];?></td>
                                                                                                                            <td><?php echo $detail['time_taken'];?></td>
                                                                                                                            <td><?php echo round($detail['score'],2)."%";?></td>
                                                                                                                            <td><?php echo $detail['datetime'];?></td>
                                                                                                                        </tr> 
                                                                                                                    <?php endforeach;?>
                                                                                                                </tbody>
                                                                                                                <tfoot>
                                                                                                                        <tr>
                                                                                                                                <th>Roll No.</th>
                                                                                                                                <th>Name</th>
                                                                                                                                <th>Total Questions</th>
                                                                                                                                <th>Questions Attempted</th>
                                                                                                                                <th>Correctly Answered</th>
                                                                                                                                <th>Time Taken</th>
                                                                                                                                <th>Score Obtained</th>
                                                                                                                                <th>Date Time Attended</th>
                                                                                                                        </tr>
                                                                                                                </tfoot>
                                                                                                            </table>
                                                                                                         <?php else:?>
                                                                                                                <h4>No details found for selected quiz and class.</h4>
                                                                                                         <?php endif;?>
                                                                                                    </div>
                                                                                                </div>
                                                                                            <?php else:?>
                                                                                                <h4>No quiz found in our database. Please click <a href="<?php echo base_url('secure/create_quiz');?>">here</a> to create one.</h4>
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
                        
                jQuery("#btn_show_records").click(function(){
                    window.location.href="<?php echo base_url('secure/view_class_qscores');?>"+"/"+jQuery("#thisquizid").val()+"/"+jQuery("#class_code").val();
                });
                jQuery( "#thisquizid" ).change(function() {
                   var el = jQuery(this).parents(".box");
                   App.blockUI(el);
                   var dataString = "quiz_id="+jQuery("#thisquizid").val();
                   var url = "<?php echo base_url('secure/get_quiz_classes');?>";
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
                                       for(var j = 0; j < data.length; j++)
                                        {
                                            var obj = data[j];
                                            var option = new Option(obj.classname + " " + obj.section,obj.id);
                                            /// jquerify the DOM object 'option' so we can use the html method
                                            jQuery(option).html(obj.classname + " " + obj.section);
                                            jQuery("#class_code").append(option);
                                        }
                                   }
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