<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
        <link rel="icon" type="image/ico" href="<?php echo base_url('favicon.ico');?>"/>
	<title>Edbeans - The Seeds of Success</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- STYLESHEETS --><!--[if lt IE 9]><script src="<?php echo base_url('resources/js/flot/excanvas.min.js');?>"></script><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
        <!-- INITIAL CSS ADDON -->
        <style>
        #main-content
        {
            margin-top: 50px;
        }
        </style>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/css/cloud-admin.css');?>" >
	<link rel="stylesheet" type="text/css"  href="<?php echo base_url('resources/css/themes/default.css');?>" id="skin-switcher" >
	<link rel="stylesheet" type="text/css"  href="<?php echo base_url('resources/css/responsive.css');?>" >
        <!-- HUBSPOT MESSENGER -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/hubspot-messenger/css/messenger.min.css');?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/hubspot-messenger/css/messenger-spinner.min.css');?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/hubspot-messenger/css/messenger-theme-flat.min.css');?>" />
        <!-- Count down timer -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/countdowntimer/jquery.countdownTimer.css');?>" />
        <!-- UNIFORM -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/uniform/css/uniform.default.min.css');?>">
        
	<link href="<?php echo base_url('resources/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">
        <style>
            .question
            {
                font-size: 2em;
            }
            .wrapper
            {
                position: relative;
                width: 1024px;
                margin: 0 auto;
            }
            .question
            {
                position: relative;
                padding: 20px 20px 20px 20px;
                border: 2px solid #454545;
            }
            .qno
            {
                position: absolute;
                left: -80px;
            }
            .options
            {
                margin-top: 40px;
                font-size: 1.5em;
            }
            .divoption
            {
                padding: 10px;
                margin: 20px 0;
                border: #CBCBCB 1px solid;
            }
            input[type=radio] { 
            margin: 4px 16px; 
            transform: scale(3, 3); 
            -moz-transform: scale(3, 3); 
            -ms-transform: scale(3, 3); 
            -webkit-transform: scale(3, 3); 
            -o-transform: scale(3, 3); 
            }
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
        <script>
            var base_url = "<?php echo base_url('');?>";
        </script>
</head>
<body>
                                                                        
    <div class="row">
            <div class="col-md-12">
                    <div class="row">
                            <div class="col-md-12">
                                    <!-- BASIC -->
                                    <div class="box border blue">
                                        <div class="box-title">
                                                <h4><i class="fa fa-bars"></i><?php echo $quiz_details['title'];?></h4>
                                                <div class="tools hidden-xs">
                                                </div>
                                        </div>
                                        <div class="box-body big">
                                            <div class="row">
                                                <?php if($quiz_details['is_timed']==1):?>
                                                    <div class="col-md-2" style="text-align: center;">
                                                        <div id="countdowntimer"><span id="future_date"><span></div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <hr/>
                                                <?php endif;?>
                                                <div class="clearfix"></div>
                                                <div class="wrapper">
                                                    <form class="form-horizontal" id="quiz_over" name="quiz_over" method="post" action="<?php echo base_url('secure/quiz_over');?>">
                                                        <input type="hidden" name="idq" value="<?php echo $idq;?>" />
                                                        <input type="hidden" name="quiz_id" value="<?php echo $quiz_details['quiz_id'];?>" />
                                                        <input type="hidden" name="attempt_id" value="<?php echo $attempt_id;?>" />
                                                        <input type="hidden" name="start_time" value="<?php echo $start_time;?>" />
                                                        <input type="hidden" name="num_questions" value="<?php echo count($questions);?>" />
                                                        <?php for($i=0; $i<count($questions); $i++): ?>
                                                            <div class="inner_wrapper hide">
                                                                <div class="question">
                                                                    <input type="hidden" name="qid_<?php echo $i;?>" value="<?php echo $questions[$i]['id'];?>" />
                                                                    <div class="qno">
                                                                        <?php echo 'Q. '.($i+1).'. ';?>
                                                                    </div>
                                                                    <?php echo $questions[$i]['question'];?>
                                                                </div>
                                                                <div class="options">
                                                                    <div class="divoption divoption1">
                                                                        <input name="qop_<?php echo $i;?>" type="radio" value="1" class="opt_1" />
                                                                        <?php echo $questions[$i]['opt_1'];?>
                                                                    </div>
                                                                    <div class="divoption divoption2">
                                                                        <input name="qop_<?php echo $i;?>" type="radio" value="2" class="opt_2" />
                                                                        <?php echo $questions[$i]['opt_2'];?>
                                                                    </div>
                                                                    <div class="divoption divoption3">
                                                                        <input name="qop_<?php echo $i;?>" type="radio" value="3" class="opt_3" />
                                                                        <?php echo $questions[$i]['opt_3'];?>
                                                                    </div>
                                                                    <div class="divoption divoption4">
                                                                        <input name="qop_<?php echo $i;?>" type="radio" value="4" class="opt_4" />
                                                                        <?php echo $questions[$i]['opt_4'];?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endfor; ?>
                                                        <br/>
                                                        <div style="text-align: right;">
                                                            <button class="btn btn-purple btn-lg" id="btn_bookmark"><i class="fa fa-bookmark"></i><span> Bookmark this question</span></button>
                                                        </div>
                                                        
                                                        <?php for($i=1; $i<=count($questions); $i++): ?>
                                                            <div class="question_icon"><?php echo $i;?></div>
                                                        <?php endfor; ?>    
                                                    </form>
                                                    <div class="clearfix"></div>
                                                    <div class="form-actions clearfix"> 
                                                        <input type="submit" value="Submit the Quiz" id="btn_submit_quiz" class="btn btn-primary pull-right"> 
                                                    </div>
                                                    <div class="bookmarker hide"></div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                            </div>
                    </div>
            </div>
    </div>
					
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
	<!-- COUNT DOWN TIMER -->
        <script type="text/javascript" src="<?php echo base_url('resources/js/countdowntimer/jquery.countdownTimer.min.js');?>"></script>
        
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
                var currentq_index = 0;
                var is_over = 0;
                
                jQuery(".inner_wrapper").eq(currentq_index).removeClass('hide');
                jQuery(".question_icon").eq(currentq_index).addClass('current_question');
                
                jQuery(".divoption").css('cursor','pointer');
                
                jQuery(".question_icon").click(function(){
                    var index = jQuery(".question_icon").index(this);
                    jQuery(".inner_wrapper").eq(currentq_index).addClass('hide');
                    jQuery(".question_icon").eq(currentq_index).removeClass('current_question')
                    
                    jQuery(".inner_wrapper").eq(index).removeClass('hide');
                    jQuery(".question_icon").eq(index).addClass('current_question');
                    currentq_index = index;
                    
                    if(jQuery(".question_icon").eq(currentq_index).hasClass('bookmarked'))
                    {
                        jQuery("#btn_bookmark span").text(' Un-bookmark this question');
                        jQuery(".bookmarker").removeClass('hide');
                    }
                    else
                    {
                        jQuery("#btn_bookmark span").text(' Bookmark this question');
                        jQuery(".bookmarker").addClass('hide');
                    }
                });
                
                jQuery(".divoption").click(function(){
                   jQuery(".question_icon").eq(currentq_index).addClass('answered');
                });
                
                jQuery("#btn_bookmark").click(function(){
                    if(jQuery("#btn_bookmark span").text()==' Bookmark this question')
                    {
                        jQuery("#btn_bookmark span").text(' Un-bookmark this question');
                        jQuery(".question_icon").eq(currentq_index).addClass('bookmarked');
                        jQuery(".bookmarker").removeClass('hide');
                    }
                    else
                    {
                        jQuery("#btn_bookmark span").text(' Bookmark this question');
                        jQuery(".question_icon").eq(currentq_index).removeClass('bookmarked');
                        jQuery(".bookmarker").addClass('hide');
                    }
                    return false;
                });
                
                jQuery(".divoption1").click(function(){
                    var index = jQuery(".divoption1").index(this);
                    
                    jQuery(".opt_1").eq(index).prop("checked", true);
                    
                    jQuery(".opt_2").eq(index).prop("checked", false);
                    jQuery(".opt_3").eq(index).prop("checked", false);
                    jQuery(".opt_4").eq(index).prop("checked", false);
                });
                jQuery(".divoption2").click(function(){
                    var index = jQuery(".divoption2").index(this);
                    
                    jQuery(".opt_2").eq(index).prop("checked", true);
                    
                    jQuery(".opt_1").eq(index).prop("checked", false);
                    jQuery(".opt_3").eq(index).prop("checked", false);
                    jQuery(".opt_4").eq(index).prop("checked", false);
                });
                jQuery(".divoption3").click(function(){
                    var index = jQuery(".divoption3").index(this);
                    
                    jQuery(".opt_3").eq(index).prop("checked", true);
                    
                    jQuery(".opt_1").eq(index).prop("checked", false);
                    jQuery(".opt_2").eq(index).prop("checked", false);
                    jQuery(".opt_4").eq(index).prop("checked", false);
                });
                jQuery(".divoption4").click(function(){
                    var index = jQuery(".divoption4").index(this);
                    jQuery(".opt_4").eq(index).prop("checked", true);
                    
                    jQuery(".opt_1").eq(index).prop("checked", false);
                    jQuery(".opt_2").eq(index).prop("checked", false);
                    jQuery(".opt_3").eq(index).prop("checked", false);
                });
                
                <?php if($quiz_details['is_timed']==1):?>
                    //Countdown timer function
                    $(function(){
                            $("#countdowntimer").countdowntimer({
                                    minutes : <?php echo $quiz_details['time_period'];?>,
                                    size : "lg",
                                    borderColor : "#FAC009",
                                    backgroundColor : "#09C3FA",
                                    fontColor : "#FFF",
                                    timeUp : timeisUp
                            });
                            function timeisUp() {
                                    is_over = 1;
                                    jQuery("form#quiz_over").submit();
                            }
                    });
                <?php endif;?>
                
                //F5 disabling function
                function disable_f5(e)
                {
                  if ((e.which || e.keyCode) == 116)
                  {
                      e.preventDefault();
                  }
                }
                //calling disable_f5 to disable refresh key
                $(document).bind("keydown", disable_f5);   
                
                $(window).on('beforeunload',function()
                {
                    if(is_over==0)
                        return 'On leaving this page, your test will be terminated.';
                });
                                
                $(window).on('contextmenu',function(){
                    return false;
                });
                
                jQuery("#btn_submit_quiz").click(function(){
                    if(confirm("Hey <?php echo $this->session->userdata('firstname');?>! Are you sure that you wish to submit the quiz?"))
                    {
                        is_over = 1;
                        jQuery("form#quiz_over").submit();
                    }
                });
            });
        </script>
        
        
	<!-- /JAVASCRIPTS -->
</body>
</html>