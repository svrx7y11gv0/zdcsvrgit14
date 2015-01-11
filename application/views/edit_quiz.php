<?php   include_once('templates/header_bar.php');
        include_once('templates/left_sidebar.php');
?>
<style>
    .question_icon
    {
        margin-right: 10px;
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
    .cke_textarea_inline 
    {
         border:1px #ABBAC3 solid;
    }
</style>
									<div class="clearfix">
										<h3 class="content-title pull-left">Edit Quiz</h3>
									</div>
									<div class="description">Edit / Update Quiz - Add Questions to created "Quiz"</div>
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
												<h4><i class="fa fa-bars"></i>Add / Update Questions in created Quiz</h4>
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
                                                                                                            <label class="col-md-2 control-label">Quiz Type</label> 
                                                                                                            <div class="col-md-10">
                                                                                                                <select id="quiz_type" name="quiz_type" class="form-control" style="cursor:pointer;">
                                                                                                                    <option class="quiz_type_p" <?php if($quiz_details['quiz_type'] == 'p') echo " selected ";?> value="p">Practice</option>
                                                                                                                    <option class="quiz_type_e" <?php if($quiz_details['quiz_type'] == 'e') echo " selected ";?> value="e">Exam</option>
                                                                                                                </select>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                            <label class="col-md-2 control-label">Quiz Title</label> 
                                                                                                            <div class="col-md-10">
                                                                                                                <input type="text" name="quiz_title" id="quiz_title" value="<?php echo $quiz_details['title'];?>" class="form-control" placeholder="Enter Quiz Title / Name" />
                                                                                                                <span id="quiz_title_error" class="help-block"></span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                            <label class="col-md-2 control-label">Number of Questions to be solved</label> 
                                                                                                            <div class="col-md-10">
                                                                                                                <input type="text" name="num_questions" id="num_questions" value="<?php echo $quiz_details['questions_tobe_solved'];?>" class="form-control" placeholder="Enter number of questions which should appear in quiz" />
                                                                                                                <span id="num_questions_error" class="help-block"></span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                            <label class="col-md-2 control-label">Is it Time Based?</label> 
                                                                                                            <div class="col-md-10">
                                                                                                                <select id="is_timed" name="is_timed" class="form-control" style="cursor:pointer;">
                                                                                                                    <option class="is_timed_yes" <?php if($quiz_details['is_timed'] == 1) echo " selected ";?> value="1">Yes</option>
                                                                                                                    <option class="is_timed_no" <?php if($quiz_details['is_timed'] == 0) echo " selected ";?> value="0">No</option>
                                                                                                                </select>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                            <label class="col-md-2 control-label">Time Period of Quiz (in minutes)</label> 
                                                                                                            <div class="col-md-10">
                                                                                                                <input type="text" <?php if($quiz_details['is_timed'] == 0) echo " disabled "; else echo 'value="'.$quiz_details['time_period'].'"';?> name="time_period" id="time_period" class="form-control" placeholder="Enter number of minutes for which quiz is to be conducted" />
                                                                                                                <span id="time_period_error" class="help-block"></span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                            <label class="col-md-2 control-label">Publish Quiz</label> 
                                                                                                            <div class="col-md-10">
                                                                                                                <select id="is_active" name="is_active" class="form-control" style="cursor:pointer;">
                                                                                                                    <option class="is_active_yes" <?php if($quiz_details['is_active'] == 1) echo " selected ";?> value="1">Yes</option>
                                                                                                                    <option class="is_active_no" <?php if($quiz_details['is_active'] == 0) echo " selected ";?> value="0">No</option>
                                                                                                                </select>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </form>
                                                                                            <div class="form-actions clearfix"> 
                                                                                                <input type="submit" value="Update the Quiz" id="btn_update_quiz" class="btn btn-primary pull-right" style="margin-left:10px;" /> 
                                                                                                <input type="submit" value="Publish Quiz and Notify Students" id="btn_publish_notify" class="btn btn-primary pull-right" /> 
                                                                                            </div>
                                                                                            <hr/><br/>
                                                                                            <form class="form-horizontal" name="question_form" id="question_form" method="post" action="<?php echo base_url('secure/submit_question');?>">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-12">
                                                                                                        <div style="position:relative">
                                                                                                            <div style="position:absolute; left:78px; top:-26px;">
                                                                                                                <img class="img-responsive" src="<?php echo base_url('resources/img/arrow.png');?>" />
                                                                                                                
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Question</label> 
                                                                                                                <textarea class="form-control" name="question" id="question" rows="10" cols="80" height="100px;">
                                                                                                                    Enter detailed question here. Image / URL / Animation, etc things can be put here.
                                                                                                                </textarea>
                                                                                                                <span id="question_error" class="help-block"></span>
                                                                                                                <input name="question_id_flag" id="question_id_flag" type="hidden" value="" />
                                                                                                                <input name="quiz_id" id="quiz_id" type="hidden" value="<?php echo $thisquizid;?>" />
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Option 1</label> 
                                                                                                                <div class="col-md-10">
                                                                                                                    <!--<input type="text" name="opt_1" id="opt_1" class="form-control" placeholder="Enter Option 1" />-->
                                                                                                                    <textarea name="opt_1" id="opt_1"></textarea>
                                                                                                                    <span id="opt_1_error" class="help-block"></span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Option 2</label> 
                                                                                                                <div class="col-md-10">
                                                                                                                    <!--<input type="text" name="opt_2" id="opt_2" class="form-control" placeholder="Enter Option 2" />-->
                                                                                                                    <textarea name="opt_2" id="opt_2"></textarea>
                                                                                                                    <span id="opt_2_error" class="help-block"></span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Option 3</label> 
                                                                                                                <div class="col-md-10">
                                                                                                                    <!--<input type="text" name="opt_3" id="opt_3" class="form-control" placeholder="Enter Option 3" />-->
                                                                                                                    <textarea name="opt_3" id="opt_3"></textarea>
                                                                                                                    <span id="opt_3_error" class="help-block"></span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Option 4</label> 
                                                                                                                <div class="col-md-10">
                                                                                                                    <!--<input type="text" name="opt_4" id="opt_4" class="form-control" placeholder="Enter Option 4" />-->
                                                                                                                    <textarea name="opt_4" id="opt_4"></textarea>
                                                                                                                    <span id="opt_4_error" class="help-block"></span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Select Correct Option</label> 
                                                                                                                <div class="col-md-10">
                                                                                                                    <select id="answer" name="answer" class="form-control" style="cursor:pointer;">
                                                                                                                        <option disabled selected> -- select an option -- </option>
                                                                                                                        <option value="1">Option 1</option>
                                                                                                                        <option value="2">Option 2</option>
                                                                                                                        <option value="3">Option 3</option>
                                                                                                                        <option value="4">Option 4</option>
                                                                                                                    </select>
                                                                                                                    <span id="answer_error" class="help-block"></span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Answer Explanation</label> 
                                                                                                                
                                                                                                                <textarea name="explanation" id="explanation" style="height: 200px;">
                                                                                                                    <em>Click Here To Edit Explanation</em>
                                                                                                                </textarea>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </form>
                                                                                            <div class="form-actions clearfix"> 
                                                                                                <input type="submit" value="Save the Question" id="btn_save_question" class="btn btn-primary pull-right"> 
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12" id="questions_panel">
                                                                                                    <?php if(isset($quiz_question_numbers)):?>
                                                                                                        <?php $i=1; ?>
                                                                                                        <?php foreach($quiz_question_numbers as $quiz_question_number):?>
                                                                                                            <div class="question_icon" id="qid_<?php echo $quiz_question_number['id'];?>">
                                                                                                                <?php echo $i++; ?>
                                                                                                            </div>
                                                                                                        <?php endforeach;?>
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
	<!-- ANNYANG SPEECH RECOGNITION -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/annyang/1.4.0/annyang.min.js"></script>
        <!-- CKeditor -->
        <script src="<?php echo base_url('resources/ckeditor/ckeditor.js');?>"></script>
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
                
                jQuery("#btn_publish_notify").click(function(){
                    if(confirm("Are you sure you wish to publish quiz and notify all students about the quiz?"))
                    {
                        var el = jQuery(this).parents(".box");
                        App.blockUI(el);
                        var dataString = "quiz_id="+jQuery("#thisquizid").val();
                        var url = "<?php echo base_url('secure/publishquiz_notify');?>";
                           jQuery.ajax({
                                type: "POST",
                                url: url,
                                data: dataString, 
                                success: function(data)
                                {
                                    jQuery("#is_active").val("1");
                                    
                                    var mytheme = "flat";
                                    var mypos = "messenger-on-top messenger-on-right";
                                    //Set theme
                                    Messenger.options = {
                                            extraClasses: 'messenger-fixed '+mypos,
                                            theme: mytheme
                                    }
                                    if(data=="success")
                                    {
                                        //Call
                                        Messenger().post({
                                                message:"Quiz Published and Notifications Sent Successfully!",
                                                showCloseButton: true
                                        });
                                    }
                                    App.unblockUI(el);
                                }
                            });
                    }
                });
                $(document).on('click', '.question_icon', function(){
                   var el = jQuery(this).parents(".box");
                   App.blockUI(el);
                   var question_id = jQuery(this).attr('id').split("_").pop();
                   var dataString = "quiz_id="+jQuery("#thisquizid").val()+"&question_id="+question_id;
                   var url = "<?php echo base_url('secure/get_specific_question');?>";
                           jQuery.ajax({
                                type: "POST",
                                url: url,
                                data: dataString, 
                                dataType: "json",
                                success: function(data)
                                {
                                    CKEDITOR.instances['question'].setData(data.question);
                                    CKEDITOR.instances['opt_1'].setData(data.opt_1);
                                    CKEDITOR.instances['opt_2'].setData(data.opt_2);
                                    CKEDITOR.instances['opt_3'].setData(data.opt_3);
                                    CKEDITOR.instances['opt_4'].setData(data.opt_4);
                                    jQuery("#answer").val(data.answer);
                                    CKEDITOR.instances['explanation'].setData(data.explanation);
                                    jQuery("#question_id_flag").val(question_id);
                                    jQuery(".question_icon").css('background-color','#FFBF39');
                                    jQuery("#qid_"+question_id).css('background-color','#999999');
                                    App.unblockUI(el);
                                }
                            });
                });
                
                function save_question()
                {
                    jQuery('#question').parent().removeClass("has-error");
                            jQuery('#question_error').text(''); 
                            jQuery('#opt_1').parent().parent().removeClass("has-error");
                            jQuery('#opt_1_error').text(''); 
                            jQuery('#opt_2').parent().parent().removeClass("has-error");
                            jQuery('#opt_2_error').text(''); 
                            jQuery('#opt_3').parent().parent().removeClass("has-error");
                            jQuery('#opt_3_error').text(''); 
                            jQuery('#opt_4').parent().parent().removeClass("has-error");
                            jQuery('#opt_4_error').text(''); 
                            jQuery('#answer').parent().parent().removeClass("has-error");
                            jQuery('#answer_error').text(''); 
                            
                            var error_flag = 0;
                            var question = CKEDITOR.instances['question'].getData();
                            var question = jQuery.trim(question);
                            if(question=="<p>Enter detailed question here. Image / URL / Animation, etc things can be put here.</p>")
                            {
                                error_flag = 1;
                                jQuery('#question').parent().addClass("has-error");
                                jQuery('#question_error').text('Please edit the question');
                            }
                            var opt_1 = CKEDITOR.instances['opt_1'].getData();
                            opt_1 = jQuery.trim(opt_1);
                            if(opt_1=="")
                            {
                                error_flag = 1;
                                jQuery('#opt_1').parent().addClass("has-error");
                                jQuery('#opt_1_error').text('Please enter option 1');
                            }
                            var opt_2 = CKEDITOR.instances['opt_2'].getData();
                            opt_2 = jQuery.trim(opt_2);
                            if(opt_2=="")
                            {
                                error_flag = 1;
                                jQuery('#opt_2').parent().addClass("has-error");
                                jQuery('#opt_2_error').text('Please enter option 2');
                            }
                            var opt_3 = CKEDITOR.instances['opt_3'].getData();
                            opt_3 = jQuery.trim(opt_3);
                            if(opt_3=="")
                            {
                                error_flag = 1;
                                jQuery('#opt_3').parent().addClass("has-error");
                                jQuery('#opt_3_error').text('Please enter option 3');
                            }
                            var opt_4 = CKEDITOR.instances['opt_4'].getData();
                            opt_4 = jQuery.trim(opt_4);
                            if(opt_4=="")
                            {
                                error_flag = 1;
                                jQuery('#opt_4').parent().addClass("has-error");
                                jQuery('#opt_4_error').text('Please enter option 4');
                            }
                            if(jQuery("#answer").val()==null)
                            {
                                error_flag = 1;
                                jQuery('#answer').parent().addClass("has-error");
                                jQuery('#answer_error').text('Please select correct option');
                            }
                            
                            if(error_flag == 1)
                            {
                                return false;
                            }
                            var explanation = CKEDITOR.instances['explanation'].getData();
                            explanation = jQuery.trim(explanation);
                            if(explanation == '<p><em>Click Here To Edit Explanation</em></p>')
                                CKEDITOR.instances['explanation'].setData('');
                            return true;
                }
                jQuery("#btn_save_question").click(function(){
                    var return_type = save_question();
                    if(return_type==true)
                        jQuery("form#question_form").submit();
                });
                CKEDITOR.inline( 'opt_1' );
                CKEDITOR.inline( 'opt_2' );
                CKEDITOR.inline( 'opt_3' );
                CKEDITOR.inline( 'opt_4' );
                CKEDITOR.replace( 'question', {
                    on: 
                    {
                        save: function(evt)
                        {
                            // Do something here, for example:
                            //console.log(evt.editor.getData());
                            
                            var return_type = save_question();
                            if(return_type==false)
                                return false;
                            
                        }
                    }
                });
                CKEDITOR.inline( 'explanation' );
                
                jQuery("#is_timed").change(function() {
                    if(jQuery("#is_timed").val()==0)
                        jQuery("#time_period").attr("disabled", "disabled");
                    else
                        jQuery("#time_period").removeAttr("disabled"); 
                });
                jQuery( "#thisquizid" ).change(function() {
                    var el = jQuery(this).parents(".box");
                    App.blockUI(el);
                    var dataString = "quiz_id="+jQuery("#thisquizid").val();
                    var url = "<?php echo base_url('secure/get_created_quizes');?>";
                           jQuery.ajax({
                                type: "POST",
                                url: url,
                                data: dataString, 
                                dataType: "json",
                                success: function(data)
                                {
                                   if(data)
                                   {
                                        jQuery("#quiz_id").val(jQuery("#thisquizid").val());
                                        if(data['quiz_details'].quiz_type == 'p')
                                           jQuery("#quiz_type").val("p");
                                        else
                                           jQuery("#quiz_type").val("e");
                                       
                                        jQuery("#quiz_title").val(data['quiz_details'].title);
                                        jQuery("#num_questions").val(data['quiz_details'].questions_tobe_solved);
                                       
                                        if(data['quiz_details'].is_timed == 1)
                                        {
                                           jQuery("#is_timed").val("1");
                                           jQuery("#time_period").removeAttr("disabled"); 
                                           jQuery("#time_period").val(data['quiz_details'].time_period);
                                        }
                                        else
                                        {
                                           jQuery("#is_timed").val("0");
                                           jQuery("#time_period").attr("disabled", "disabled");
                                           jQuery("#time_period").val("");
                                        }
                                       
                                        if(data['quiz_details'].is_active == 1)
                                           jQuery("#is_active").val("1");
                                        else
                                           jQuery("#is_active").val("0");
                                       
                                        jQuery("#questions_panel").empty();
                                        for(var j = 0; j < data['quiz_question_numbers'].length; j++)
                                        {
                                            var obj = data['quiz_question_numbers'][j];
                                            var html = '<div class="question_icon" id="qid_'+data['quiz_question_numbers'][j].id+'">'+ parseInt(parseInt(j)+1) + '</div>';
                                            jQuery("#questions_panel").append(html);
                                        }
                                       
                                       CKEDITOR.instances['question'].setData('Enter detailed question here. Image / URL / Animation, etc things can be put here.');
                                       jQuery('#opt_1').val('');
                                       jQuery('#opt_2').val('');
                                       jQuery('#opt_3').val('');
                                       jQuery('#opt_4').val('');
                                       jQuery("#answer").val(null);
                                       CKEDITOR.instances['explanation'].setData('<em>Click Here To Edit Explanation</em>');
                                   }
                                   App.unblockUI(el);
                                }
                           });
                    });
                    
                    jQuery("#btn_update_quiz").click(function(){
                        var el = jQuery(this).parents(".box");
                        App.blockUI(el);
                        jQuery('#quiz_title').parent().parent().removeClass("has-error");
                        jQuery('#quiz_title_error').text(''); 
                        jQuery('#num_questions').parent().parent().removeClass("has-error");
                        jQuery('#num_questions_error').text(''); 
                        jQuery('#time_period').parent().parent().removeClass("has-error");
                        jQuery('#time_period_error').text(''); 
                        var error_flag = 0;
                        if(jQuery('#quiz_title').val()=="")
                        {
                            error_flag = 1;
                            jQuery('#quiz_title').parent().parent().addClass("has-error");
                            jQuery('#quiz_title_error').text('Please enter the quiz title.');
                        }
                        if(jQuery('#num_questions').val()=="")
                        {
                            error_flag = 1;
                            jQuery('#num_questions').parent().parent().addClass("has-error");
                            jQuery('#num_questions_error').text('Please enter number of questions to be asked.');
                        }
                        if(jQuery("#is_timed").val()==1 && jQuery('#time_period').val()=="")
                        {
                            error_flag = 1;
                            jQuery('#time_period').parent().parent().addClass("has-error");
                            jQuery('#time_period_error').text('Please enter time period / duration of quiz (in minutes).');
                        }
                        if(error_flag==0)
                        {
                            var dataString = "quiz_id="+jQuery("#thisquizid").val()+"&quiz_type="+jQuery("#quiz_type").val()+"&quiz_title="+jQuery("#quiz_title").val()+"&num_questions="+jQuery("#num_questions").val()+"&is_timed="+jQuery("#is_timed").val()+"&time_period="+jQuery("#time_period").val()+"&is_active="+jQuery("#is_active").val();
                            var url = "<?php echo base_url('secure/update_quiz_db');?>";
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
                                                //Call
                                                Messenger().post({
                                                        message:"Information Saved!",
                                                        showCloseButton: true
                                                });
                                            }
                                            App.unblockUI(el);
                                        }
                                    });
                        }
                        else
                            App.unblockUI(el);
                    });
            });
        </script>
        <!-- SPEECH RECOGNITION SCRIPT -->
        <script>
            if (annyang) {
              // Let's define our first command. First the text we expect, and then the function it should call
              var commands = {
                'query *term': function(term) {
                  CKEDITOR.instances['question'].setData(term);
                },
                'empty query': function() {
                  CKEDITOR.instances['question'].setData('');
                },
                'append query *term': function(term) {
                  var data  = CKEDITOR.instances['question'].getData();
                  CKEDITOR.instances['question'].setData(data + " " + term);
                },
                'option one *term': function(term) {
                  CKEDITOR.instances['opt_1'].setData(term);
                },
                'empty option one': function() {
                  CKEDITOR.instances['opt_1'].setData('');
                },
                'append option one *term': function(term) {
                  var data  = CKEDITOR.instances['opt_1'].getData();
                  CKEDITOR.instances['opt_1'].setData(data + " " + term);
                },
                'option two *term': function(term) {
                  CKEDITOR.instances['opt_2'].setData(term);
                },
                'empty option two': function() {
                  CKEDITOR.instances['opt_2'].setData('');
                },
                'append option two *term': function(term) {
                  var data  = CKEDITOR.instances['opt_2'].getData();
                  CKEDITOR.instances['opt_2'].setData(data + " " + term);
                },
                'option three *term': function(term) {
                  CKEDITOR.instances['opt_3'].setData(term);
                },
                'empty option three': function() {
                  CKEDITOR.instances['opt_3'].setData('');
                },
                'append option three *term': function(term) {
                  var data  = CKEDITOR.instances['opt_3'].getData();
                  CKEDITOR.instances['opt_3'].setData(data + " " + term);
                },
                'option four *term': function(term) {
                  CKEDITOR.instances['opt_4'].setData(term);
                },
                'empty option four': function() {
                  CKEDITOR.instances['opt_4'].setData('');
                },
                'append option four *term': function(term) {
                  var data  = CKEDITOR.instances['opt_4'].getData();
                  CKEDITOR.instances['opt_4'].setData(data + " " + term);
                },
              };

              // Add our commands to annyang
              annyang.addCommands(commands);

              // Start listening. You can call this here, or attach this call to an event, button, etc.
              annyang.start();
            }
        </script>
        <!-- COMMON END FOOTER JAVASCRIPT INCLUDES -->
	<?php include_once('templates/common_end_footer_scripts.php');?>
        
	<!-- /JAVASCRIPTS -->
</body>
</html>