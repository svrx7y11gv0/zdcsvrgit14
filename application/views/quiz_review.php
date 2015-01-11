<?php   include_once('templates/header_bar.php');
        include_once('templates/left_sidebar.php');
?>
<!-- PAGE SPECIFIC STYLE -->
<style>
            .question
            {
                font-size: 2em;
                position: relative;
                padding: 20px 20px 20px 20px;
            }
            .options
            {
                margin-left: 30px;
                font-size: 1.5em;
            }
            .divoption
            {
                padding: 5px 5px 5px 30px;
                margin: 10px 0;
            }
            .correct
            {
                background-image: url('<?php echo base_url("resources/img/tick.png");?>');
                background-repeat: no-repeat;
                color: #009900;
            }
            .wrong
            {
                background-image: url('<?php echo base_url("resources/img/cross.png");?>');
                background-repeat: no-repeat;
                color: #800800;
            }
</style>
									<div class="clearfix">
										<h3 class="content-title pull-left">Quiz Answers Review</h3>
									</div>
									<div class="description">See Answer Details</div>
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
										<div class="box border orange">
											<div class="box-title">
												<h4><i class="fa fa-bars"></i>Correct Answers and Explanations</h4>
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
                                                                                            <div class="col-md-4">
                                                                                                <h3>Total Questions: <em><?php echo $num_questions;?></em></h3>
                                                                                                <h3>Questions Attempted: <em><?php echo $questions_attempted;?></em></h3>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <h3>Correctly Answered: <em><?php echo $correctly_answered;?></em></h3>
                                                                                                <h3>Your Score: <em><?php echo round($score,2)."%";?></em></h3>
                                                                                            </div>
                                                                                            <div class="clearfix"></div>
                                                                                            <hr/>
                                                                                            <?php for($i=0; $i<count($questions); $i++): ?>
                                                                                                <div class="question">
                                                                                                    <?php echo 'Q. '.($i+1).'. ';?>
                                                                                                    <?php echo $questions[$i]['tuple']['question'];?>
                                                                                                </div>
                                                                                                <div class="options">
                                                                                                    <div class="divoption <?php if($questions[$i]['useranswer']==1) if($questions[$i]['useranswer']==$questions[$i]['tuple']['answer']) echo 'correct'; else echo 'wrong'; ?>">
                                                                                                        Option 1: <span><?php echo $questions[$i]['tuple']['opt_1'];?></span>
                                                                                                    </div>
                                                                                                    <div class="divoption <?php if($questions[$i]['useranswer']==2) if($questions[$i]['useranswer']==$questions[$i]['tuple']['answer']) echo 'correct'; else echo 'wrong'; ?>">
                                                                                                        Option 2: <span><?php echo $questions[$i]['tuple']['opt_2'];?></span>
                                                                                                    </div>
                                                                                                    <div class="divoption <?php if($questions[$i]['useranswer']==3) if($questions[$i]['useranswer']==$questions[$i]['tuple']['answer']) echo 'correct'; else echo 'wrong'; ?>">
                                                                                                        Option 3: <span><?php echo $questions[$i]['tuple']['opt_3'];?></span>
                                                                                                    </div>
                                                                                                    <div class="divoption <?php if($questions[$i]['useranswer']==4) if($questions[$i]['useranswer']==$questions[$i]['tuple']['answer']) echo 'correct'; else echo 'wrong'; ?>">
                                                                                                        Option 4: <span><?php echo $questions[$i]['tuple']['opt_4'];?></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="well">
                                                                                                    <h4>Correct Answer: Option <?php echo $questions[$i]['tuple']['answer'];?></h4>
                                                                                                    <h4>Answer Explanation: </h4>
                                                                                                    <?php if($questions[$i]['tuple']['explanation']!="") echo $questions[$i]['tuple']['explanation']; else echo "No Explanation Present";?>
                                                                                                </div>
                                                                                                <hr/>
                                                                                            <?php endfor; ?>   

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
                 
            });
        </script>
        
        <!-- COMMON END FOOTER JAVASCRIPT INCLUDES -->
	<?php include_once('templates/common_end_footer_scripts.php');?>
        
	<!-- /JAVASCRIPTS -->
</body>
</html>