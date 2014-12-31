<?php   include_once('templates/header_bar.php');
        include_once('templates/left_sidebar.php');
?>
<!-- Page Specific CSS -->
<link rel="stylesheet" href="<?php echo base_url('resources/js/kendochart/kendo.common.min.css');?>" />
<link rel="stylesheet" href="<?php echo base_url('resources/js/kendochart/kendo.default.min.css');?>" />
<link rel="stylesheet" href="<?php echo base_url('resources/js/kendochart/kendo.dataviz.min.css');?>" />
<link rel="stylesheet" href="<?php echo base_url('resources/js/kendochart/kendo.dataviz.default.min.css');?>" />
									<div class="clearfix">
										<h3 class="content-title pull-left">Student Dashboard</h3>
									</div>
									<div class="description">A common panel for student's updates</div>
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
                                                <!-- FORMS -->
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
                                                                                <div class='box border green'>
                                                                                    <div class="box-title">
                                                                                            <h4><i class="fa fa-bars"></i>Attendance for this Month</h4>
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
                                                                                        <div class="quick-pie panel panel-default">
                                                                                            <div class="panel-body">
                                                                                                <?php if(isset($subjects) & count($subjects)>0):?>
                                                                                                    <?php $agg_per = 0;?>
                                                                                                    <?php for($i=0;$i<count($subjects);$i++):?>
                                                                                                        <?php if($subjects[$i]['attended']==0)
                                                                                                                $percent = 0;
                                                                                                              else
                                                                                                              {
                                                                                                                $percent = ($subjects[$i]['attended'] / $subjects[$i]['total']) * 100;
                                                                                                                $agg_per += $percent;
                                                                                                              }
                                                                                                        ?>
                                                                                                        <div class="col-md-4 text-center">
                                                                                                                <div id="dash_pie_<?php echo ($i+1);?>" class="piechart" data-percent="<?php echo $percent;?>">
                                                                                                                        <span class="percent"></span>
                                                                                                                </div>
                                                                                                                <h5><?php echo $subjects[$i]['subject'];?></h5>
                                                                                                                <h6><b>Attended Slots: <?php echo $subjects[$i]['attended'];?></b></h6>
                                                                                                                <h6><b>Total Slots: <?php echo $subjects[$i]['total'];?></b></h6>
                                                                                                        </div>
                                                                                                    <?php endfor;?>
                                                                                                    <div class="clearfix"></div>
                                                                                                    <div class="well well-lg" style="text-align:center;">
                                                                                                        <h4><b><?php if($this->session->userdata('type')==STUDENT_TYPE) echo 'Your'; else echo "Your ward's";?> Aggregate Attendance Percentage for this month is <?php echo round($agg_per/($i+1),2);?>%</b></h4>
                                                                                                    </div>
                                                                                                <?php else:?>
                                                                                                    <h4>No subjects found in our database OR no classes have been conducted for the class.</h4>
                                                                                                <?php endif;?>    
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
										<div class="box border red">
											<div class="box-title">
												<h4><i class="fa fa-bars"></i>Exam Quizzes</h4>
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
                                                                                            <?php if(isset($escores) & count($escores)>0):?>
                                                                                                <div id='equiz_chart'></div>
                                                                                            <?php else: ?>
                                                                                                <h4>No records found for quizzes</h4>
                                                                                            <?php endif;?>
											</div>
										</div>
                                                                                <!--<div class="box border primary">
											<div class="box-title">
												<h4><i class="fa fa-bars"></i>Practice Quizzes</h4>
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
                                                                                            <div id='pquiz_chart'></div>
											</div>
										</div>
                                                                                -->
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
        <!-- EASY PIE CHART FOR ATTENDANCE -->
	<script src="<?php echo base_url('resources/js/jquery-easing/jquery.easing.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('resources/js/easypiechart/jquery.easypiechart.min.js');?>"></script>
        <!-- KENDO CHART -->
        <script src="<?php echo base_url('resources/js/kendochart/kendo.all.min.js');?>"></script>
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
                <?php if(isset($subjects)):?>
                    <?php for($i=0;$i<count($subjects);$i++):?>
                        <?php if($subjects[$i]['attended']==0)
                                $percent = 0;
                              else
                                $percent = ($subjects[$i]['attended'] / $subjects[$i]['total']) * 100;
                        ?>
                        $('#dash_pie_<?php echo ($i+1);?>').easyPieChart({
                            easing: 'easeOutBounce',
                            onStep: function() {
                                    $(this.el).find('.percent').text(<?php echo round($percent,2);?>);
                            },
                            lineWidth: 3,
                            barColor: '#<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,4).rand(0,5).rand(3,9);?>'
                        });
                    <?php endfor;?>
                <?php endif; ?>
                    
                    <?php 
                    $titles = "";
                    $score = "";
                    $highest = "";
                    $avg = "";
                    if(isset($escores))
                    {
                        foreach($escores as $escore)
                        {
                            $titles .= "'".$escore['title']."',";
                            $score .= $escore['score'].",";
                            $highest .= $escore['maxscore'].",";
                            $avg .= $escore['avgscore'].",";
                        }
                    }
                    ?>
                    $("#equiz_chart").kendoChart({
                        title: {
                            text: "Score Comparision Chart of Latest 10 Quizzes"
                        },
                        legend: {
                            position: "top"
                        },
                        seriesDefaults: {
                            type: "column"
                        },
                        series: [{
                            name: "<?php if($this->session->userdata('type')==STUDENT_TYPE) echo 'Your Score'; else echo 'Your ward&#39s score';?>",
                            color: "#3F51B5",
                            data: [<?php echo $score;?>],
                        }, {
                            name: "Highest Score",
                            color: "#03A9F4",
                            data: [<?php echo $highest;?>]
                        }, {
                            name: "Average Score",
                            color: "#F9CE1D",
                            data: [<?php echo $avg;?>]
                        }],
                        valueAxis: {
                            labels: {
                                format: "{0}%"
                            },
                            line: {
                                visible: false
                            },
                            axisCrossingValue: 0
                        },
                        categoryAxis: {
                            categories: [<?php echo $titles;?>],
                            line: {
                                visible: false
                            },
                            labels: {
                                padding: {top: 20}
                            }
                        },
                        tooltip: {
                            visible: true,
                            format: "{0}%",
                            template: "#= series.name #: #= value #"
                        }
                    });
            });
        </script>
        
        <!-- COMMON END FOOTER JAVASCRIPT INCLUDES -->
	<?php include_once('templates/common_end_footer_scripts.php');?>
        
	<!-- /JAVASCRIPTS -->
</body>
</html>