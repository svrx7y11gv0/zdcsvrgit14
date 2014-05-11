<?php   include_once('templates/header_bar.php');
        include_once('templates/left_sidebar.php');
?>
<!-- PAGE SPECIFIC STYLE / CSS -->
<!-- DATE PICKER -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/datepicker/themes/default.min.css');?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/datepicker/themes/default.date.min.css');?>" />
<!-- XCHARTS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/xcharts/xcharts.min.css');?>" />
<style>
    #reportrange
    {
        border-radius: 4px;
    }
</style>
									<div class="clearfix">
										<h3 class="content-title pull-left">In-Time Statistics</h3>
									</div>
									<div class="description">View in-time statistics of any student of any class</div>
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
												<h4><i class="fa fa-bars"></i>In-Time Statistics</h4>
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
												<form class="form-horizontal" id="intime_stats_form" name="intime_stats_form" method="post" action="<?php echo base_url('secure/intime_stats');?>">
													<div class="row">
														 <div class="col-md-12">
                                                                                                                     <div class="stats-box form-group hide">
                                                                                                                            <figure class="chart" id="intime_chart" style="min-width:250px"></figure>
                                                                                                                     </div>
                                                                                                                    <div class="form-group">
                                                                                                                        <label class="col-md-2 control-label">Select Class</label> 
                                                                                                                         <div class="col-md-10">
                                                                                                                             <select id="class_code" name="thisclasscode" data-placeholder="Choose a Class..." class="form-control">
                                                                                                                                 <?php if(isset($classes)):?>
                                                                                                                                     <?php foreach($classes as $class):?>
                                                                                                                                         <option value="<?php echo $class['class_code'];?>"> <?php echo $class['class']." ".$class['section']; ?></option>
                                                                                                                                     <?php endforeach;?>
                                                                                                                                 <?php endif; ?>
                                                                                                                             </select>
                                                                                                                         </div>
                                                                                                                    </div>
                                                                                                                     <div class="form-group">
                                                                                                                        <label class="col-md-2 control-label">Select Student</label> 
                                                                                                                         <div class="col-md-10">
                                                                                                                             <select id="student_bioid" name="thisbioid" data-placeholder="Select Student Name" class="form-control">
                                                                                                                                 <?php if(isset($students)):?>
                                                                                                                                     <?php foreach($students as $student):?>
                                                                                                                                         <option value="<?php echo $student['bioid'];?>"> <?php echo ucfirst($student['firstname'])." ".ucfirst($student['middlename'])." ".ucfirst($student['lastname']); ?></option>
                                                                                                                                     <?php endforeach;?>
                                                                                                                                 <?php endif; ?>
                                                                                                                             </select>
                                                                                                                         </div>
                                                                                                                     </div>
                                                                                                                     <div class="form-group">
                                                                                                                         <label class="col-md-2 control-label">X-axis Type</label>
                                                                                                                         <div class="col-md-4">
                                                                                                                             <div class="input-group"> 
                                                                                                                                    <label class="radio-inline"> <input type="radio" class="uniform" name="XaxisType" value="day" checked >Day Format</label> 
                                                                                                                                    <label class="radio-inline"> <input type="radio" class="uniform" name="XaxisType" value="date" >Date Format</label>
                                                                                                                             </div>
                                                                                                                         </div>
                                                                                                                         <label class="col-md-2 control-label">Select Date</label>
                                                                                                                         <div class="col-md-4">
                                                                                                                            <span class="date-range">
                                                                                                                                <div class="btn-group">
                                                                                                                                        <a id="reportrange" class="btn reportrange">
                                                                                                                                                <i class="fa fa-calendar"></i>
                                                                                                                                                <span></span>
                                                                                                                                                <i class="fa fa-angle-down"></i>
                                                                                                                                        </a>
                                                                                                                                </div>
                                                                                                                            </span>
                                                                                                                         </div>
                                                                                                                     </div>
                                                                                                                 </div>
                                                                                                        </div>
                                                                                                </form>
                                                                                            <div class="form-actions clearfix"> <input type="submit" value="Show Statistics" id="btn_show_stats" class="btn btn-primary pull-right"> </div>
                                                                                            <div class="row">
                                                                                            <div class="col-md-12">
                                                                                                
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
        <!-- DATE RANGE PICKER -->
	<script src="<?php echo base_url('resources/js/bootstrap-daterangepicker/moment.min.js');?>"></script>
	<script src="<?php echo base_url('resources/js/bootstrap-daterangepicker/daterangepicker.min.js');?>"></script>
        <!-- D3 -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/d3/d3.v3.min.js');?>"></script>
	<!-- XCHARTS -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/xcharts/xcharts.min.js');?>"></script>
	<!-- CUSTOM SCRIPT -->
	<script src="<?php echo base_url('resources/js/script.js');?>"></script>
	<script>
		jQuery(document).ready(function() {		
			App.setPage("fixed_header_sidebar");  //Set current page
			App.init(); //Initialise plugins and elements
		});
	</script>
        <script>
            var date_from ="";
            var date_to ="";
            jQuery(document).ready(function(){
                 jQuery("#class_code").change(function(){
                    var el = jQuery(this).parents(".box");
                    App.blockUI(el);
                    var dataString = 'class_code='+jQuery(this).val();
                    
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
                                   var option = new Option(obj.firstname + " " + obj.middlename + " " + obj.lastname, obj.bioid);
                                   /// jquerify the DOM object 'option' so we can use the html method
                                   $(option).html(obj.firstname + " " + obj.middlename + " " + obj.lastname);
                                   $("#student_bioid").append(option);
                                }
                             }
                             App.unblockUI(el);
                         }
                    });
                 });
                 
                 $('#reportrange').daterangepicker(
                    {
                       startDate: moment().subtract('days', 29),
                       endDate: moment(),
                       minDate: '01/01/2012',
                       maxDate: '12/31/2014',
                       dateLimit: { days: 60 },
                       showDropdowns: true,
                       showWeekNumbers: true,
                       timePicker: false,
                       timePickerIncrement: 1,
                       timePicker12Hour: true,
                       ranges: {
                          
                          'Last 30 Days': [moment().subtract('days', 29), moment()]
                          
                       },
                       opens: 'left',
                       buttonClasses: ['btn btn-default'],
                       applyClass: 'btn-small btn-primary',
                       cancelClass: 'btn-small',
                       format: 'DD/MM/YYYY',
                       separator: ' to ',
                       locale: {
                           applyLabel: 'Submit',
                           fromLabel: 'From',
                           toLabel: 'To',
                           customRangeLabel: 'Custom Range',
                           daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                           monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                           firstDay: 1
                       }
                    },
                    function(start, end) {
                     console.log("Callback has been called!");
                     $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                     date_from = start.format('YYYY-MM-DD');
                     date_to = end.format('YYYY-MM-DD');
                    }
                 );
                 //Set the initial state of the picker label
                 $('#reportrange span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
                 date_from = moment().subtract('days', 29).format('YYYY-MM-DD');
                 date_to = moment().format('YYYY-MM-DD');
                 
                 //Show Statistics Button Click Event
                 jQuery("#btn_show_stats").click(function()
                 {
                     var el = jQuery(this).parents(".box");
                     App.blockUI(el);
                     if(jQuery("#class_code").val()==null)
                     {
                         var mytheme = "flat";
                         var mypos = "messenger-on-top messenger-on-right";
                         //Set theme
                         Messenger.options = {
                                 extraClasses: 'messenger-fixed '+mypos,
                                 theme: mytheme
                         }
                         Messenger().post({
                                message:"Please select a class",
                                type: "error",
                                showCloseButton: true
                         });
                         App.unblockUI(el);
                     }
                     else if(jQuery("#student_bioid").val()==null)
                     {
                         var mytheme = "flat";
                         var mypos = "messenger-on-top messenger-on-right";
                         //Set theme
                         Messenger.options = {
                                 extraClasses: 'messenger-fixed '+mypos,
                                 theme: mytheme
                         }
                         Messenger().post({
                                message:"Please select a student",
                                type: "error",
                                showCloseButton: true
                         });
                         App.unblockUI(el);
                     }
                     else
                     {
                         var XaxisType = jQuery('input[name=XaxisType]:checked', '#intime_stats_form').val();
                         var dataString = "class_code="+jQuery("#class_code").val()+"&bio_id="+jQuery("#student_bioid").val()+"&date_from="+date_from+"&date_to="+date_to;
                         var url = "<?php echo base_url('secure/get_intime_ofa_student');?>";
                                jQuery.ajax({
                                     type: "POST",
                                     url: url,
                                     data: dataString, 
                                     dataType: "json",
                                     success: function(data)
                                     {
                                        if(!data)
                                        {
                                            var mytheme = "flat";
                                            var mypos = "messenger-on-top messenger-on-right";
                                            //Set theme
                                            Messenger.options = {
                                                    extraClasses: 'messenger-fixed '+mypos,
                                                    theme: mytheme
                                            }
                                            Messenger().post({
                                                   message:"No records found for the given input",
                                                   showCloseButton: true
                                            });
                                        }
                                        else
                                        {
                                            jQuery(".stats-box").removeClass('hide');
                                            jQuery("#intime_chart").text('');
                                            /*********************** CHART GENERATION ************************/
                                                
                                                        var tt = document.createElement('div'),
                                                          leftOffset = -(~~$('html').css('padding-left').replace('px', '') + ~~$('body').css('margin-left').replace('px', '')),
                                                          topOffset = -32;
                                                        tt.className = 'ex-tooltip';
                                                        document.body.appendChild(tt);

                                                        if(XaxisType=="day")
                                                        {
                                                            var data = {
                                                              "xScale": "time",
                                                              "yScale": "ordinal",
                                                              "main": [
                                                                    {
                                                                      "className": ".pizza",
                                                                      "data": data 

                                                                    }
                                                                      ]
                                                            };
                                                            var opts = {
                                                              "dataFormatX": function (x) { return d3.time.format('%Y-%m-%d').parse(x); },
                                                              "tickFormatX": function (x) { return d3.time.format('%A')(x); },
                                                              "mouseover": function (d, i) {
                                                                    var pos = $(this).offset();
                                                                    $(tt).text(d3.time.format('%A')(d.x) + ': ' + d.y)
                                                                      .css({top: topOffset + pos.top, left: pos.left + leftOffset})
                                                                      .show();
                                                              },
                                                              "mouseout": function (x) {
                                                                    $(tt).hide();
                                                              }
                                                            };
                                                        }
                                                        else if(XaxisType=="date")
                                                        {
                                                            var data = {
                                                              "xScale": "ordinal",
                                                              "yScale": "ordinal",
                                                              "main": [
                                                                    {
                                                                      "className": ".pizza",
                                                                      "data": data 

                                                                    }
                                                                      ]
                                                            };
                                                            var opts = {
                                                              "mouseover": function (d, i) {
                                                                    var pos = $(this).offset();
                                                                    $(tt).text(d3.time.format('%A')(d.x) + ': ' + d.y)
                                                                      .css({top: topOffset + pos.top, left: pos.left + leftOffset})
                                                                      .show();
                                                              },
                                                              "mouseout": function (x) {
                                                                    $(tt).hide();
                                                              }
                                                            };
                                                        }
                                                        var myChart = new xChart('line-dotted', data, '#intime_chart', opts);
                                                
                                                
                                                /*********************** END CHART GENERATION ************************/
                                        }
                                        App.unblockUI(el);
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