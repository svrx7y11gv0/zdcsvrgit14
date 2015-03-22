<!-- JAVASCRIPTS -->
	<!-- Placed at the end of the document so the pages load faster -->
	<!-- JQUERY -->
	<script src="<?php echo base_url('resources/js/jquery/jquery-2.0.3.min.js');?>"></script>
	<!-- JQUERY UI-->
	<script src="<?php echo base_url('resources/js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js');?>"></script>
	<!-- BOOTSTRAP -->
	<script src="<?php echo base_url('resources/bootstrap-dist/js/bootstrap.min.js');?>"></script>
        <!-- HUBSPOT MESSENGER -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/hubspot-messenger/js/messenger.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('resources/js/hubspot-messenger/js/messenger-theme-flat.js');?>"></script>

        
        <!-- NOTIFICATIONS AJAX QUERY -->
        <script>
            jQuery(document).ready(function(){
                jQuery("#btn_notifications").click(function(){
                   var dataString = "user_id=<?php echo $this->session->userdata('id');?>";
                   var url = "<?php echo base_url('secure/get_notifications');?>";
                           jQuery.ajax({
                                type: "POST",
                                url: url,
                                data: dataString, 
                                dataType: "json",
                                success: function(data)
                                {
                                    jQuery("ul.notification").text("");
                                    var html = '<li class="dropdown-title">' + 
                                                            '<span><i class="fa fa-bell"></i> '+ data['total_notifications_count'] + ' Notifications</span>' +
                                                       '</li>';
                                    jQuery("ul.notification").append(html);
                                    
                                    if(data['notifications']['quiz_notifications'])
                                    {
                                        //Quiz Notifications
                                        for(var i = 0; i < data['notifications']['quiz_notifications'].length; i++)
                                        {
                                            var obj = data['notifications']['quiz_notifications'][i];
                                            
                                            html = '<li>';
                                            if(obj.read_flag==0)
                                                html += '<a href="'+base_url+'secure/quizzes" class="unread">';
                                            else
                                                html += '<a href="'+base_url+'secure/quizzes">';
                                                           html +=  '<span class="label label-success"><i class="fa fa-puzzle-piece"></i></span>' +
                                                                    '<span class="body">' +
                                                                            '<span class="message">'+obj.notification+'</span>'+
                                                                            '<span class="time">'+
                                                                                    '<i class="fa fa-clock-o"></i>'+
                                                                                    '<span> '+obj.datetime+'</span>'+
                                                                            '</span>'+
                                                                    '</span>'+
                                                            '</a>'+
                                                    '</li>';
                                            jQuery("ul.notification").append(html);
                                        }
                                        
                                        //Attendance Notifications
                                        for(var i = 0; i < data['notifications']['att_notifications'].length; i++)
                                        {
                                            var obj = data['notifications']['att_notifications'][i];
                                            
                                            html = '<li>' +
                                                            '<a href="#">' +
                                                                    '<span class="label label-success"><i class="fa fa-puzzle-piece"></i></span>' +
                                                                    '<span class="body">' +
                                                                            '<span class="message">'+obj.notification+'</span>'+
                                                                            '<span class="time">'+
                                                                                    '<i class="fa fa-clock-o"></i>'+
                                                                                    '<span> '+obj.datetime+'</span>'+
                                                                            '</span>'+
                                                                    '</span>'+
                                                            '</a>'+
                                                    '</li>';
                                            jQuery("ul.notification").append(html);
                                        }
                                        
                                        if(data['total_notifications_count'] > 5)
                                        {
                                            html = '<li class="footer">' +
                                                            '<a href="#">See all notifications <i class="fa fa-arrow-circle-right"></i></a>' +
                                                    '</li>';
                                            jQuery("ul.notification").append(html);
                                        }
                                    }
                                }
                            });
                });
            });
        </script>
        <!-- END NOTIFICATIONS AJAX QUERY -->
        
        <!-- GOOGLE ANALYTICS SCRIPT -->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-59211225-2', 'auto');
            ga('send', 'pageview');

        </script>