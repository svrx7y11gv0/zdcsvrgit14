<?php   include_once('templates/header_bar.php');
        include_once('templates/left_sidebar.php');
?>
<!-- PAGE SPECIFIC CSS -->
        <!-- TABLE CLOTH -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/tablecloth/css/tablecloth.min.css');?>" />
        <style>
            .question_icon
            {
                margin: 20px 0 0 15px;
                float: left;
                height: 50px;
                width: 50px;
                text-align: center;
                padding-top: 10px;
                color: #fff;
                font-size: 1.5em;
                background: #FFBF39;
                cursor: pointer;
                -webkit-border-radius: 600px;
                -webkit-border-top-left-radius: 0;
                -moz-border-radius: 600px;
                -moz-border-radius-topleft: 0;
                border-radius: 600px;
                border-top-left-radius: 0;
            }
            .current_question
            {
                background: #999999;
                box-shadow: 4px 4px 10px #474747;
            }
            .answered
            {
                background: #4F9B36;
            }
            .bookmarked
            {
                background: #88275C;
            }
        </style>
<!-- PAGE SPECIFIC CSS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Quizzes</h3>
									</div>
									<div class="description">Brush your brain and begin with a quiz</div>
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
                                                                                <div class="panel panel-default">
                                                                                        <div class="panel-heading">
                                                                                               <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1_1"><strong> READ Instructions for Quizzes</strong></a> </h3>
                                                                                        </div>
                                                                                        <div id="collapse1_1" class="panel-collapse in" style="height: auto;">
                                                                                               <div class="panel-body"> 
                                                                                                   <ul>
                                                                                                       <li>Each EXAM QUIZ can be attempted only once.</li>
                                                                                                       <li>A PRACTICE QUIZ can be attempted as many number of times.</li>
                                                                                                       <li>In case of any mal-functional shutdown or browser failure or any other system failure, Re-login, go to quizzes and then click on "Request Teacher for Retry" for re-attempting the specific exam quiz.</li>
                                                                                                       <li>You will get 1 score for each correct question and there will be NO negative marking.</li>
                                                                                                       <li>If the quiz is timed, then quiz will be automatically submitted after the expiration of time, however quiz can be submitted manually by clicking "Submit Quiz" button.</li>
                                                                                                       <li>A feature of bookmarking a question is provided such that, student can review the question later. A bookmarked question will be considered for evaluation.</li>
                                                                                                       <li>In the quiz following icons are used :</li>
                                                                                                   </ul> 
                                                                                                   
                                                                                                   <ul>
                                                                                                       <li><div class="question_icon current_question">#</div> For Current Question</li>
                                                                                                       <li><div class="question_icon">#</div> For Un-Attempted Question</li>
                                                                                                       <li><div class="question_icon answered">#</div> For Answered Question</li>
                                                                                                       <li><div class="question_icon bookmarked">#</div> For Bookmarked Question</li>
                                                                                                   </ul>
                                                                                                </div>
                                                                                        </div>
                                                                                 </div>
										<div class="box border orange">
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
                                                                                            <?php if(count($exam_quizzes)>0):?>
												<table id="exam-quizzes" class="table table-hover">
                                                                                                    <thead>
                                                                                                      <tr>
                                                                                                            <th>Quiz Title</th>
                                                                                                            <th># of Questions</th>
                                                                                                            <th>Is Timed</th>
                                                                                                            <th>Time Period</th>
                                                                                                            <th># of Attempts</th>
                                                                                                            <th>Score in %</th>
                                                                                                            <th>Action</th>
                                                                                                      </tr>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                        <?php foreach($exam_quizzes as $quiz):?>
                                                                                                            <tr>
                                                                                                                <td><?php echo $quiz['title'];?></td>
                                                                                                                <td><?php echo $quiz['questions_tobe_solved'];?></td>
                                                                                                                <td><?php if($quiz['is_timed']==1) echo 'Yes'; else echo 'No';?></td>
                                                                                                                <td><?php if($quiz['is_timed']==1) echo $quiz['time_period'].' minutes'; else echo '-';?></td>
                                                                                                                <td><?php echo $quiz['attempts'];?></td>
                                                                                                                <td><?php if($quiz['avgscore']!='') echo round($quiz['avgscore'],2),' %'; else echo '-';?></td>
                                                                                                                <td><?php if($quiz['attempts']>0) 
                                                                                                                {
                                                                                                                            echo '<i class="fa fa-times-circle"> Not Allowed</i>';
                                                                                                                            echo '<br/>';
                                                                                                                            echo '<a href="#" class="request_link">Request Teacher for Retry</a>';
                                                                                                                }
                                                                                                                          else
                                                                                                                              echo '<a class="attempt_quiz" href="'.base_url("secure/attempt_quiz/").'/'.$quiz['id'].'/'.$quiz['quiz_id'].'"><i class="fa fa-play-circle"> Attempt Quiz</i></a>';
                                                                                                                ?>
                                                                                                                <?php if($quiz['attempts']>0): ?>
                                                                                                                    <div class="hide request_dialog">  
                                                                                                                        <br/>
                                                                                                                        <form class="form-horizontal" role="form">
                                                                                                                            <div class="form-group" style="max-width:235px;">
                                                                                                                                <label>Username</label> 
                                                                                                                                <input type="text" name="teacher_username" class="teacher_username form-control" readonly value="<?php echo $quiz['creator'];?>" />
                                                                                                                                <input type="hidden" name="idq" class="idq" value="<?php echo $quiz['id'];?>" />
                                                                                                                            </div>
                                                                                                                            <div class="form-group" style="max-width:235px;">
                                                                                                                                <label>Password</label> 
                                                                                                                                <input type="password" name="teacher_password" class="teacher_password form-control" />
                                                                                                                            </div>
                                                                                                                            <div class="form-group">
                                                                                                                                <button type="submit" class="btn btn-success btn_grant">Grant</button>
                                                                                                                                <button type="submit" class="btn btn-inverse btn_cancel">Cancel</button>
                                                                                                                            </div>
                                                                                                                        </form>
                                                                                                                    </div>
                                                                                                                <?php endif;?>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        <?php endforeach; ?>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            <?php else:?>
                                                                                                <h4>No exam quiz found in our database.</h4>
                                                                                            <?php endif; ?>
											</div>
										</div>
                                                                                <div class="box border green">
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
                                                                                            <?php if(count($practice_quizzes)>0):?>
												<table id="practice-quizzes" class="table table-hover">
                                                                                                    <thead>
                                                                                                      <tr>
                                                                                                            <th>Quiz Title</th>
                                                                                                            <th># of Questions</th>
                                                                                                            <th>Is Timed</th>
                                                                                                            <th>Time Period</th>
                                                                                                            <th># of Attempts</th>
                                                                                                            <th>Average Score in %</th>
                                                                                                            <th>Action</th>
                                                                                                      </tr>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                        <?php foreach($practice_quizzes as $quiz):?>
                                                                                                            <tr>
                                                                                                                <td><?php echo $quiz['title'];?></td>
                                                                                                                <td><?php echo $quiz['questions_tobe_solved'];?></td>
                                                                                                                <td><?php if($quiz['is_timed']==1) echo 'Yes'; else echo 'No';?></td>
                                                                                                                <td><?php if($quiz['is_timed']==1) echo $quiz['time_period'].' minutes'; else echo '-';?></td>
                                                                                                                <td><?php echo $quiz['attempts'];?></td>
                                                                                                                <td><?php if($quiz['avgscore']!='') echo round($quiz['avgscore'],2).' %'; else echo '-';?></td>
                                                                                                                <td><?php echo '<a class="attempt_quiz" href="'.base_url("secure/attempt_quiz").'/'.$quiz['id'].'/'.$quiz['quiz_id'].'"><i class="fa fa-play-circle"> Attempt Quiz</i></a>';?></td>
                                                                                                            </tr>
                                                                                                        <?php endforeach; ?>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            <?php else:?>
                                                                                                <h4>No practice quiz found in our database.</h4>
                                                                                            <?php endif; ?>
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
	<!-- CUSTOM SCRIPT -->
	<script src="<?php echo base_url('resources/js/script.js');?>"></script>
	<script>
		jQuery(document).ready(function() {		
			App.setPage("fixed_header_sidebar");  //Set current page
			App.init(); //Initialise plugins and elements
                        $("#quizzes-list").tablecloth({ 
                            theme: "dark"
                        });
		});
	</script>
        <script>
    
            jQuery(document).ready(function(){
                 jQuery(".request_link").click(function(){
                     var index = jQuery(".request_link").index(this);
                     jQuery(".request_dialog").eq(index).removeClass('hide');
                     return false;
                 });
                 
                 jQuery(".btn_cancel").click(function(){
                     var index = jQuery(".btn_cancel").index(this);
                     jQuery(".request_dialog").eq(index).addClass('hide');
                     return false;
                 });
                 
                 jQuery(".btn_grant").click(function(){
                     App.blockUI(el);
                     var index = jQuery(".btn_grant").index(this);
                     var username = jQuery(".teacher_username").eq(index).val();
                     var password = jQuery(".teacher_password").eq(index).val();
                     var idq = jQuery(".idq").eq(index).val();
                     var bioid = <?php echo $this->session->userdata('bioid');?>;
                     
                     jQuery('.teacher_password_error').eq(index).text(''); 
                     jQuery('.teacher_password').eq(index).parent().parent().removeClass("has-error");
                     var el = jQuery(this).parents(".box");
                     var error_flag = 0;
                     
                     if(password=="")
                     {
                         error_flag = 1;
                         jQuery('.teacher_password').eq(index).parent().addClass("has-error");
                        App.unblockUI(el);
                        return false;
                     }
                     if(error_flag==0)
                     {   
                        var dataString = "username="+username+"&password="+password+"&idq="+idq+"&bioid="+bioid;
                        var url = "<?php echo base_url('secure/grant_specific_quiz');?>";
                           jQuery.ajax({
                                type: "POST",
                                url: url,
                                data: dataString, 
                                success: function(data)
                                {
                                    var mytheme = "flat";
                                    var mypos = "messenger-on-top messenger-on-right";
                                    //Set theme
                                    Messenger.options = {
                                            extraClasses: 'messenger-fixed '+mypos,
                                            theme: mytheme
                                    }
                                    if(data=="success")
                                    {
                                        window.location.href="<?php echo base_url('secure/quizzes');?>";
                                    }
                                    else
                                    {
                                        //Call
                                        Messenger().post({
                                                message:"Incorrect Credentials",
                                                type: "error",
                                                showCloseButton: true
                                        });
                                    }
                                    App.unblockUI(el);
                                }
                            });
                     }
                     return false;
                 });
                 
                 jQuery(".attempt_quiz").click(function(){
                    if(confirm("Are you ready to attempt this quiz? \nAs soon as 'Ok' is clicked, the quiz will start."))
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                 });
            });
        </script>
        
        <!-- COMMON END FOOTER JAVASCRIPT INCLUDES -->
	<?php include_once('templates/common_end_footer_scripts.php');?>
        
	<!-- /JAVASCRIPTS -->
</body>
</html>