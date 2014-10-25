<?php   include_once('templates/header_bar.php');
        include_once('templates/left_sidebar.php');
?>
<!-- PAGE SPECIFIC CSS -->
<style>
    .highlighted
    {
        background: #FFFFB0;
    }
    
    .att_modal .modal
    {
        overflow-y: hidden;
    }
    
    .att_modal input
    {
        margin-bottom: 10px;
    }
    .att_markable
    {
        cursor:pointer;
        display: block;
        width: 100%;
        min-height: 67px;
    }
    table.inout_att_table tbody h6
    {
        margin-top: 5px;
        margin-bottom: 5px;
    }
    table td
    {
        min-width: 48px;
    }
</style>
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
                                                                                            <form class="form-horizontal" id="manage_classes" name="manage_classes" method="post" action="<?php echo base_url('secure/manage_classes');?>">
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
                                                                                                                             <option value="<?php echo $class['class_code'];?>" <?php if(isset($thisclasscode) && $thisclasscode==$class['class_code']) { echo " selected "; $curr_class=$class['classname']." ".$class['section'];}?>> <?php echo $class['classname']." ".$class['section']; ?></option>
                                                                                                                         <?php endforeach;?>
                                                                                                                     <?php endif; ?>
                                                                                                                 </select>
                                                                                                             </div>
                                                                                                        </div>
                                                                                                        <?php if($this->session->userdata('atttype')=="lecturewise"):?>
                                                                                                            <div class="form-group">
                                                                                                                <label class="col-md-2 control-label">Select Subject</label> 
                                                                                                                 <div class="col-md-10">
                                                                                                                     <select id="subject" name="thissubject" data-placeholder="Choose a Subject..." class="form-control">
                                                                                                                         <?php if(isset($subjects_of_this_class)):?>
                                                                                                                             <?php foreach($subjects_of_this_class as $subject):?>
                                                                                                                                 <option value="<?php echo $subject['subject'];?>" <?php if(isset($thissubject) && $thissubject==$subject['subject']) { echo " selected "; $curr_subject = $subject['subject'];}?>> <?php echo $subject['subject']; ?></option>
                                                                                                                             <?php endforeach;?>
                                                                                                                         <?php endif; ?>
                                                                                                                     </select>
                                                                                                                 </div>
                                                                                                            </div>
                                                                                                        <?php endif;?>
                                                                                                        
                                                                                                        <div class="form-group">
                                                                                                            <label class="col-md-2 control-label">Select Month & Year</label> 
                                                                                                             <div class="col-md-10">
                                                                                                                 <div class="col-sm-6" style="padding-left:0;"> 
                                                                                                                    <select id="month" name="month" data-placeholder="Choose Month..." class="form-control">
                                                                                                                        <?php for($i = 1; $i<=12; $i++):?>
                                                                                                                            <?php $monthNum = sprintf("%02s", $i);
                                                                                                                                  $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                                                                                                                                  $monthName = $dateObj->format('F'); // March
                                                                                                                            ?>
                                                                                                                            <option value="<?php echo $monthNum;?>" <?php if(isset($thismonth) && $thismonth==$monthNum) echo " selected ";?> ><?php echo $monthName;?></option>
                                                                                                                        <?php endfor; ?>    
                                                                                                                    </select>
                                                                                                                 </div>
                                                                                                                 <div class="col-sm-6" style="padding:0 0;"> 
                                                                                                                    <select id="year" name="year" data-placeholder="Choose Year..." class="form-control">
                                                                                                                        <?php for($i=2010; $i<=2050; $i++): ?>
                                                                                                                            <option value="<?php echo $i;?>" <?php if(isset($thisyear) && $thisyear==$i) echo " selected " ?>><?php echo $i;?></option>
                                                                                                                        <?php endfor;?>
                                                                                                                    </select>
                                                                                                                 </div>
                                                                                                             </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </form>
                                                                                            <div class="form-actions clearfix"> 
                                                                                                <input type="submit" value="Show Records" id="btn_show_records" class="btn btn-primary pull-right"> 
                                                                                                <button id="assign_rollnos" class="btn btn-grey pull-right" style="margin-right:10px;"><i class="fa fa-pencil-square-o"></i> Assign / Re-Assign Roll Nos in Alphabetical Order</button>
                                                                                            </div>
                                                                                            
											</div>
										</div>
									</div>
                                                                </div>
                                                        </div>
                                                </div>
                                                <div class="att_modal">
                                                    <div class="bootbox modal fade in hide" tabindex="-1" role="dialog" style="display: block;" aria-hidden="false">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <button type="button" class="bootbox-close-button close" style="margin-top: -10px;">×</button>
                                                                    <div class="bootbox-body">
                                                                        <h3 style="margin:10px 0 0 0;">Enter Attendance Details</h3>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <div class="form-group">
                                                                        <label class="col-md-2 control-label">Date</label> 
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" id="att_date" placeholder="Enter date as yyyy-mm-dd" />
                                                                            <span id="att_date_error" class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                    <?php if($this->session->userdata('atttype')=="lecturewise"):?>
                                                                        <div class="form-group">
                                                                            <label class="col-md-2 control-label">Time</label> 
                                                                            <div class="col-md-10">
                                                                                <input type="text" class="form-control" id="att_time" placeholder="Enter time as hh:mm e.g. 15:00" />
                                                                                <span id="att_time_error" class="help-block"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-2 control-label">Slot</label> 
                                                                            <div class="col-md-10">
                                                                                <input type="text" class="form-control" id="att_slot" placeholder="Enter slot number" />
                                                                                <span id="att_slot_error" class="help-block"></span>
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <?php if($this->session->userdata('atttype')=="inout"):?>
                                                                        <div class="form-group">
                                                                            <label class="col-md-2 control-label">In-Time</label> 
                                                                            <div class="col-md-10">
                                                                                <input type="text" class="form-control" id="att_intime" placeholder="Enter in-time as hh:mm e.g. 15:00" />
                                                                                <span id="att_intime_error" class="help-block"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-2 control-label">Out-Time</label> 
                                                                            <div class="col-md-10">
                                                                                <input type="text" class="form-control" id="att_outtime" placeholder="Enter out-time as hh:mm e.g. 20:00" />
                                                                                <span id="att_outtime_error" class="help-block"></span>
                                                                            </div>
                                                                        </div>
                                                                    <?php endif;?>
                                                                    <input type="hidden" id="att_bioid" />
                                                                    <button data-bb-handler="ok" type="button" class="btn btn-primary btn_mark_attendance">MARK ATTENDANCE</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-backdrop fade in hide"></div>
                                                </div>
                                                <?php if(isset($students)):?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h3><?php if(isset($curr_class)) echo "<strong>Class : </strong>".$curr_class;?> <?php if(isset($curr_subject)) echo "<strong> Subject : </strong>".$curr_subject;?> </h3>
                                                        <button id="btn_bulk_att_modal" class="btn btn-default" style="margin-bottom:10px;"><i class="fa fa-bar-chart-o"></i> Mark Bulk Attendance</button>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <?php if(isset($students)):?>
                                                            <table class="table table-bordered inout_att_table" style="background:#fff; overflow: auto;">
                                                                <thead>
                                                                        <tr>
                                                                                <th style="min-width:70px; vertical-align: middle;">
                                                                                    <input type="checkbox" value="" id="bulk_selector" />
                                                                                    Roll#
                                                                                </th>
                                                                                <th style="text-align:center; vertical-align: middle;">Name</th>
                                                                                <?php 
                                                                                        $dateTime = new DateTime($date_from);
                                                                                        $year = $dateTime->format('Y');
                                                                                        $month = $dateTime->format('m');
                                                                                ?>

                                                                                <?php for($i=1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++):?>
                                                                                    <?php $timestamp = strtotime($year."-".$month."-".$i); ?>
                                                                                    <th style="text-align:center;"><h5><strong><?php echo date('D',$timestamp);?></strong></h5><h5><?php echo $i;?></h5></th>
                                                                                <?php endfor;?>

                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach($students as $student):?>
                                                                        <tr id="<?php echo $student['bioid'];?>">
                                                                            <td>
                                                                                <input type="checkbox" value="<?php echo $student['bioid'];?>" name="bulk_check[]" />
                                                                                <?php echo $student['rollno'];?>
                                                                            </td>
                                                                            <td><?php echo $student['firstname']." ".$student['lastname'];?></td>
                                                                            <?php 
                                                                                    $dateTime = new DateTime($date_from);
                                                                                    $year = $dateTime->format('Y');
                                                                                    $month = $dateTime->format('m');
                                                                            ?>

                                                                            <?php for($i=1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++):?>
                                                                                <?php $day = sprintf("%02s", $i); ?>
                                                                                <td class="<?php echo $year."-".$month."-".$day;?>" style="text-align:center; padding:2px;">
                                                                                    <span class="att_markable"></span>
                                                                                </td>
                                                                            <?php endfor;?>
                                                                        </tr>
                                                                    <?php endforeach;?>
                                                                </tbody>
                                                            </table>
                                                        <?php endif;?>
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
                
                <?php if($this->session->userdata('atttype')=="lecturewise"):?>
                    jQuery( "#class_code" ).change(function() {
                        var el = jQuery(this).parents(".box");
                        App.blockUI(el);
                        var dataString = "class_code="+jQuery("#class_code").val();
                        var url = "<?php echo base_url('secure/get_subjects_ofa_class');?>";
                               jQuery.ajax({
                                    type: "POST",
                                    url: url,
                                    data: dataString, 
                                    dataType: "json",
                                    success: function(data)
                                    {
                                       jQuery("#subject option").remove();
                                       if(data)
                                       {
                                            for(var i = 0; i < data.length; i++)
                                            {
                                               var obj = data[i];
                                               var option = new Option(obj.subject,obj.subject);
                                               /// jquerify the DOM object 'option' so we can use the html method
                                               jQuery(option).html(obj.subject);
                                               jQuery("#subject").append(option);
                                            }
                                       }
                                       App.unblockUI(el);
                                    }
                               });
                    });
                <?php endif; ?>
                    <?php if(isset($inout_att_records)): ?>
                        <?php foreach($inout_att_records as $record):?>
                            <?php $in = "<h6><strong>In </strong><span style='color:#942170;font-weight:600;'>".substr($record['in_time'],0,5)."</span></h6>";?>
                            <?php
                                if($record['out_time']=="00:00:00")
                                    $out="";
                                else
                                    $out = "<h6><strong>Out </strong><span style='color:#942170;font-weight:600;'>".substr($record['out_time'],0,5)."</span></h6>"; 
                            ?>
                            jQuery(".inout_att_table tr#<?php echo $record['bio_id'];?> td.<?php echo $record['date'];?>").html("<?php echo $in.$out;?>");
                        <?php endforeach;?>
                    <?php endif;?>
                        
                    <?php if(isset($subj_att_records)): ?>
                        <?php foreach($subj_att_records as $record):?>
                            <?php $tick = "<h6><i class='fa fa-check'></i><h6>"; ?>
                            <?php $time = "<h6><strong>Time </strong><span style='color:#942170;font-weight:600;'>".substr($record['time'],0,5)."</span></h6>";?>
                            <?php
                                if($record['slot']=="0")
                                    $slot="";
                                else
                                    $slot = "<h6><strong>Slot </strong><span style='color:#942170;font-weight:600;'>".$record['slot']."</span></h6>"; 
                            ?>
                            if(jQuery(".inout_att_table tr#<?php echo $record['bio_id'];?> td.<?php echo $record['date'];?> span").hasClass('att_markable'))
                                jQuery(".inout_att_table tr#<?php echo $record['bio_id'];?> td.<?php echo $record['date'];?>").html("");
                            jQuery(".inout_att_table tr#<?php echo $record['bio_id'];?> td.<?php echo $record['date'];?>").append("<?php echo $tick.$time.$slot;?>");
                        <?php endforeach;?>
                    <?php endif;?>
                        
                    jQuery(".inout_att_table th").css( 'cursor', 'url('+base_url+'/resources/img/arrow-down.png), auto' );
                    jQuery(".inout_att_table tr td:first-child").css( 'cursor', 'url('+base_url+'/resources/img/arrow-right.png), auto' );

                    jQuery(".inout_att_table th").mouseenter(function(){
                        var index = jQuery(".inout_att_table th").index(this);
                        jQuery(".inout_att_table tr > :nth-child("+parseInt(index+1)+")").css({'backgroundColor': '#FFFFB0'});
                    });
                    
                    jQuery(".inout_att_table th").mouseleave(function(){
                        var index = jQuery(".inout_att_table th").index(this);
                        if(! jQuery(".inout_att_table tr > :nth-child("+parseInt(index+1)+")").hasClass('highlighted'))
                            jQuery(".inout_att_table tr > :nth-child("+parseInt(index+1)+")").css({'backgroundColor': 'transparent'});
                    });
                    
                    jQuery(".inout_att_table th").click(function(){
                        var index = jQuery(".inout_att_table th").index(this);
                        if(jQuery(".inout_att_table tr > :nth-child("+parseInt(index+1)+")").hasClass('highlighted'))
                        {
                            jQuery(".inout_att_table tr > :nth-child("+parseInt(index+1)+")").removeClass('highlighted');
                            jQuery(".inout_att_table tr > :nth-child("+parseInt(index+1)+")").css({'backgroundColor': 'transparent'});
                        }
                        else
                        {
                            jQuery(".inout_att_table tr > :nth-child("+parseInt(index+1)+")").addClass('highlighted');
                            jQuery(".inout_att_table tr > :nth-child("+parseInt(index+1)+")").css({'backgroundColor': '#FFFFB0'});
                        }
                    });
                    
                    
                    
                    jQuery(".inout_att_table tr td:first-child").mouseenter(function(){
                        var index = jQuery(".inout_att_table tr td:first-child").index(this);
                        jQuery(".inout_att_table tr").eq(parseInt(index+1)).css({'backgroundColor': '#FFFFB0'});
                    });
                    
                    jQuery(".inout_att_table tr td:first-child").mouseleave(function(){
                        var index = jQuery(".inout_att_table tr td:first-child").index(this);
                        if(! jQuery(".inout_att_table tr").eq(parseInt(index+1)).hasClass('highlighted'))
                            jQuery(".inout_att_table tr").eq(parseInt(index+1)).css({'backgroundColor': 'transparent'});
                    });
                    
                    jQuery(".inout_att_table tr td:first-child").click(function(){
                        var index = jQuery(".inout_att_table tr td:first-child").index(this);
                        if(jQuery(".inout_att_table tr").eq(parseInt(index+1)).hasClass('highlighted'))
                        {
                            jQuery(".inout_att_table tr").eq(parseInt(index+1)).removeClass('highlighted');
                            jQuery(".inout_att_table tr").eq(parseInt(index+1)).css({'backgroundColor': 'transparent'});
                        }
                        else
                        {
                            jQuery(".inout_att_table tr").eq(parseInt(index+1)).addClass('highlighted');
                            jQuery(".inout_att_table tr").eq(parseInt(index+1)).css({'backgroundColor': '#FFFFB0'});
                        }
                    });
                    
                    jQuery("#btn_show_records").click(function(){
                        jQuery("form#manage_classes").submit();
                    });
                    
                    jQuery(".att_modal .modal .bootbox-close-button").click(function(){
                        jQuery(".att_modal .bootbox").addClass('hide');
                        jQuery(".att_modal .modal-backdrop").addClass('hide');
                    });
                    
                    jQuery(".att_markable").mouseenter(function(){
                        var index = jQuery(".att_markable").index(this);
                        jQuery(".att_markable").eq(index).css({'backgroundColor': '#ddd'});
                    });
                    
                    jQuery(".att_markable").mouseleave(function(){
                        var index = jQuery(".att_markable").index(this);
                        jQuery(".att_markable").eq(index).css({'backgroundColor': 'transparent'});
                    });
                    
                    jQuery(".att_markable").click(function(){
                        jQuery('#att_date').parent().parent().removeClass("has-error");
                        jQuery('#att_date_error').text(''); 
                        jQuery('#att_intime').parent().parent().removeClass("has-error");
                        jQuery('#att_intime_error').text(''); 
                        jQuery('#att_outtime').parent().parent().removeClass("has-error");
                        jQuery('#att_outtime_error').text(''); 
                        jQuery("#att_date").val('');
                        jQuery("#att_intime").val('');
                        jQuery("#att_outtime").val('');
                        
                        var index = jQuery(".att_markable").index(this);
                        var classes = jQuery(".att_markable").eq(index).parent().attr('class').split(' ');
                        jQuery("#att_date").val(classes[0]);
                        jQuery("#att_bioid").val(jQuery(".att_markable").eq(index).parent().parent().attr('id'));
                        jQuery(".att_modal .bootbox").removeClass('hide');
                        jQuery(".att_modal .modal-backdrop").removeClass('hide');
                        jQuery("#att_date").focus();
                    });
                    
                    jQuery("#btn_bulk_att_modal").click(function(){
                        if(! (jQuery('input[name="bulk_check[]"]:checked').length > 0))
                        {
                            var mytheme = "flat";
                            var mypos = "messenger-on-top messenger-on-right";
                            //Set theme
                            Messenger.options = {
                                    extraClasses: 'messenger-fixed '+mypos,
                                    theme: mytheme
                            }
                            Messenger().post({
                                    message:"Please select atleast one student",
                                    type: "error",
                                    showCloseButton: true
                            });
                        }
                        else
                        {
                            jQuery('#att_date').parent().parent().removeClass("has-error");
                            jQuery('#att_date_error').text(''); 
                            jQuery('#att_intime').parent().parent().removeClass("has-error");
                            jQuery('#att_intime_error').text(''); 
                            jQuery('#att_outtime').parent().parent().removeClass("has-error");
                            jQuery('#att_outtime_error').text(''); 
                            jQuery("#att_date").val('');
                            jQuery("#att_intime").val('');
                            jQuery("#att_outtime").val('');

                            jQuery("#att_bioid").val('multi');
                            jQuery(".att_modal .bootbox").removeClass('hide');
                            jQuery(".att_modal .modal-backdrop").removeClass('hide');
                            jQuery("#att_date").focus();
                        }
                    });
                    
                    jQuery(".btn_mark_attendance").click(function(){
                        var error_flag = 0;
                        jQuery('#att_date').parent().parent().removeClass("has-error");
                        jQuery('#att_date_error').text(''); 
                        <?php if($this->session->userdata('atttype')=="inout"):?>
                            jQuery('#att_intime').parent().parent().removeClass("has-error");
                            jQuery('#att_intime_error').text(''); 
                            jQuery('#att_outtime').parent().parent().removeClass("has-error");
                            jQuery('#att_outtime_error').text(''); 
                        <?php endif;?>
                        <?php if($this->session->userdata('atttype')=="lecturewise"):?>
                            jQuery('#att_time').parent().parent().removeClass("has-error");
                            jQuery('#att_time_error').text(''); 
                            jQuery('#att_slot').parent().parent().removeClass("has-error");
                            jQuery('#att_slot_error').text(''); 
                        <?php endif;?>    
                        var re = /^\d{4}-((0\d)|(1[012]))-(([012]\d)|3[01])$/;
                        if(!re.test(jQuery('#att_date').val()))
                        {
                            error_flag = 1;
                            jQuery('#att_date').parent().parent().addClass("has-error");
                            jQuery('#att_date_error').text('This date is invalid.');
                        }    
                        <?php if($this->session->userdata('atttype')=="inout"):?>
                            var in_time = jQuery('#att_intime').val();
                            var t = in_time.split(':');
                            re = /^\d\d:\d\d$/;
                            if(re.test(in_time) && t[0] >= 0 && t[0] < 25 && t[1] >= 0 && t[1] < 60)
                                   error_flag = 0;
                            else
                            {
                                error_flag = 1;
                                jQuery('#att_intime').parent().parent().addClass("has-error");
                                jQuery('#att_intime_error').text('This time format is invalid.');
                            }   

                            var out_time = jQuery('#att_outtime').val();
                            var t = out_time.split(':');
                            re = /^\d\d:\d\d$/;
                            if(!(re.test(out_time) && t[0] >= 0 && t[0] < 25 && t[1] >= 0 && t[1] < 60))
                            {
                                error_flag = 1;
                                jQuery('#att_outtime').parent().parent().addClass("has-error");
                                jQuery('#att_outtime_error').text('This time format is invalid.');
                            }   
                        <?php endif; ?>
                        <?php if($this->session->userdata('atttype')=="lecturewise"):?> 
                            var att_time = jQuery('#att_time').val();
                            var t = att_time.split(':');
                            re = /^\d\d:\d\d$/;
                            if(re.test(att_time) && t[0] >= 0 && t[0] < 25 && t[1] >= 0 && t[1] < 60)
                                   error_flag = 0;
                            else
                            {
                                error_flag = 1;
                                jQuery('#att_time').parent().parent().addClass("has-error");
                                jQuery('#att_time_error').text('This time format is invalid.');
                            }   
                            
                            if(jQuery('#att_slot').val()=="")
                            {
                                error_flag = 1;
                                jQuery('#att_slot').parent().parent().addClass("has-error");
                                jQuery('#att_slot').text('Please enter the slot number.');
                            }
                        <?php endif;?>
                            
                        if(error_flag == 0)
                        {
                            if(jQuery("#att_bioid").val()!="multi")
                            {
                                <?php if($this->session->userdata('atttype')=="inout"):?> 
                                    var dataString = 'bio_id='+jQuery("#att_bioid").val()+'&date='+jQuery("#att_date").val()+'&in_time='+jQuery("#att_intime").val()+'&out_time='+jQuery("#att_outtime").val()+'&class_code=<?php echo $thisclasscode;?>';
                                <?php endif; ?>
                                <?php if($this->session->userdata('atttype')=="lecturewise" && isset($thissubject)):?> 
                                    var dataString = 'bio_id='+jQuery("#att_bioid").val()+'&date='+jQuery("#att_date").val()+'&time='+jQuery("#att_time").val()+'&att_slot='+jQuery("#att_slot").val()+'&class_code=<?php echo $thisclasscode;?>&subject=<?php echo $thissubject;?>';
                                <?php endif; ?>    
                                var url = "<?php echo base_url('secure/mark_attendance');?>";
                                jQuery.ajax({
                                     type: "POST",
                                     url: url,
                                     data: dataString, // serializes the form's elements.
                                     success: function()
                                     {
                                         <?php if($this->session->userdata('atttype')=="inout"):?> 
                                            var IN = "<h6><strong>In </strong><span style='color:#942170;font-weight:600;'>"+in_time+"</span></h6>";
                                            var OUT = "<h6><strong>Out </strong><span style='color:#942170;font-weight:600;'>"+out_time+"</span></h6>"; 
                                            jQuery(".inout_att_table tr#"+jQuery("#att_bioid").val()+" td."+jQuery('#att_date').val()).html(IN + OUT);
                                         <?php endif; ?>
                                         <?php if($this->session->userdata('atttype')=="lecturewise"):?>
                                            var tick = "<h6><i class='fa fa-check'></i><h6>";
                                            var time = "<h6><strong>Time </strong><span style='color:#942170;font-weight:600;'>"+att_time+"</span></h6>";
                                            var slot = "<h6><strong>Slot </strong><span style='color:#942170;font-weight:600;'>"+jQuery('#att_slot').val()+"</span></h6>"; 
                                            jQuery(".inout_att_table tr#"+jQuery("#att_bioid").val()+" td."+jQuery('#att_date').val()).html(tick + time + slot);
                                         <?php endif; ?>
                                     }
                                });
                                
                            }
                            else
                            {
                                jQuery.each($("input[name='bulk_check[]']:checked"), function() {
                                    var bio_id = jQuery(this).val();
                                    <?php if($this->session->userdata('atttype')=="inout"):?> 
                                        var dataString = 'bio_id='+bio_id+'&date='+jQuery("#att_date").val()+'&in_time='+jQuery("#att_intime").val()+'&out_time='+jQuery("#att_outtime").val()+'&class_code=<?php echo $thisclasscode;?>';
                                    <?php endif; ?>
                                    <?php if($this->session->userdata('atttype')=="lecturewise"  && isset($thissubject)):?>
                                        var dataString = 'bio_id='+bio_id+'&date='+jQuery("#att_date").val()+'&time='+jQuery("#att_time").val()+'&att_slot='+jQuery("#att_slot").val()+'&class_code=<?php echo $thisclasscode;?>&subject=<?php echo $thissubject;?>';
                                    <?php endif;?>    
                                    var url = "<?php echo base_url('secure/mark_attendance');?>";
                                    jQuery.ajax({
                                         type: "POST",
                                         url: url,
                                         data: dataString, // serializes the form's elements.
                                         success: function()
                                         {
                                             <?php if($this->session->userdata('atttype')=="inout"):?> 
                                                var IN = "<h6><strong>In </strong><span style='color:#942170;font-weight:600;'>"+in_time+"</span></h6>";
                                                var OUT = "<h6><strong>Out </strong><span style='color:#942170;font-weight:600;'>"+out_time+"</span></h6>"; 
                                                jQuery(".inout_att_table tr#"+bio_id+" td."+jQuery('#att_date').val()).html(IN + OUT);
                                             <?php endif;?>
                                             <?php if($this->session->userdata('atttype')=="lecturewise"):?> 
                                                var tick = "<h6><i class='fa fa-check'></i><h6>";
                                                var time = "<h6><strong>Time </strong><span style='color:#942170;font-weight:600;'>"+time+"</span></h6>";
                                                var slot = "<h6><strong>Slot </strong><span style='color:#942170;font-weight:600;'>"+jQuery('#att_slot').val()+"</span></h6>"; 
                                                jQuery(".inout_att_table tr#"+bio_id+" td."+jQuery('#att_date').val()).html(tick + time + slot);
                                             <?php endif;?>    
                                         }
                                    });
                                });
                            }
                            jQuery(".att_modal .bootbox").addClass('hide');
                            jQuery(".att_modal .modal-backdrop").addClass('hide');
                        }
                    });
                    
                    jQuery("#bulk_selector").click(function(){
                        if( jQuery(this).is(':checked') )
                            jQuery("input[name=bulk_check\\[\\]]").prop('checked', true);
                        else
                            jQuery("input[name=bulk_check\\[\\]]").prop('checked', false);
                    });
                    
                    jQuery("#assign_rollnos").click(function(){
                        if(confirm("Are you sure you wish to asign / re-assign roll numbers to\nstudents in ascending alphabetical order."))
                        {
                            var el = jQuery(this).parents(".box");
                            App.blockUI(el);
                            var dataString = 'class_code='+jQuery('#class_code').val();
                            var url = "<?php echo base_url('secure/assign_rollnos');?>";
                            jQuery.ajax({
                                 type: "POST",
                                 url: url,
                                 data: dataString, // serializes the form's elements.
                                 success: function()
                                 {
                                     jQuery("form#manage_classes").submit();
                                 }
                            });
                        }
                    });
            });
        </script>
        
        <!-- COMMON END FOOTER JAVASCRIPT INCLUDES -->
	<?php include_once('templates/common_end_footer_scripts.php');?>
        
	<!-- /JAVASCRIPTS -->
</body>
</html>