	<!-- PAGE -->
	<section id="page">
				<!-- SIDEBAR -->
				<div id="sidebar" class="sidebar sidebar-fixed">
					<div class="sidebar-menu nav-collapse">
						<div class="divide-20"></div>
						<!-- SEARCH BAR -->
						<div id="search-bar">
							<input class="search" type="text" placeholder="Search"><i class="fa fa-search search-icon"></i>
						</div>
						<!-- /SEARCH BAR -->
                                                
                                                <?php if($this->session->userdata('multilanguage')=='T'):?>
                                                <!-- GOOGLE MULTILANGUAGE TRANSLATE -->
                                                <div class="google_translate_outer">
                                                    <div id="google_translate_element"></div>
                                                    <script type="text/javascript">
                                                    function googleTranslateElementInit() {
                                                      new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                                                    }
                                                    </script>
                                                </div>
							<!-- STYLE FOR GOOGLE TRANSLATE -->
                                                <style>
                                                    /* GOOGLE TRANSLATE*/
                                                    .google_translate_outer
                                                    {
                                                        text-align: center;
                                                    }
                                                    .goog-te-gadget-simple
                                                    {
                                                        padding: 6px;
                                                        width: 90%;
                                                        border: none;
                                                        border-radius: 4px;
                                                    }
                                                    .goog-te-gadget-simple img
                                                    {
                                                        margin-right: 18px;
                                                    }
                                                    a.goog-te-menu-value, a.goog-te-menu-value:hover
                                                    {
                                                        text-decoration: none;
                                                    }
                                                </style>
                                                <?php endif; ?>
                                                <?php $prv = $this->session->userdata('privilege');?>
						<!-- SIDEBAR MENU -->
						<ul>
							<li>
								<a href="index.html">
									<i class="fa fa-tachometer fa-fw"></i> <span class="menu-text">Dashboard</span>
								</a>					
							</li>
                                                        <?php if($prv==PRV_GUARDIAN):?>
                                                        <li <?php if($this->session->userdata('selected_menu')=='my_childs_profile') echo ' class="active" ';?> >
								<a href="<?php echo base_url('secure/manage_students_profile');?>">
									<i class="fa fa-user fa-fw"></i> <span class="menu-text">My Child's Profile</span>
								</a>					
							</li>
                                                        <?php endif; ?>
                                                        <?php if($prv==PRV_ADMIN):?>
                                                        <li <?php if($this->session->userdata('selected_menu')=='institute_setup') echo ' class="active" ';?> >
								<a href="<?php echo base_url('secure/institute_setup');?>">
									<i class="fa fa-gears fa-fw"></i> <span class="menu-text">Institute Setup</span>
								</a>					
							</li>
                                                        <li class="has-sub <?php if($this->session->userdata('selected_menu')=='view_departments' || $this->session->userdata('selected_menu')=='create_department' || $this->session->userdata('selected_menu')=='update_department') echo ' active ';?>">
								<a href="javascript:;" class="">
								<i class="fa fa-sitemap fa-fw"></i> <span class="menu-text">Manage Departments</span>
								<span class="arrow"></span>
								</a>
								<ul class="sub">
                                                                        <li <?php if($this->session->userdata('selected_menu')=='view_departments') echo ' class="current" ';?> ><a class="" href="<?php echo base_url('secure/view_departments');?>"><span class="sub-menu-text">View Departments</span></a></li>
									<li <?php if($this->session->userdata('selected_menu')=='create_department') echo ' class="current" ';?> ><a class="" href="<?php echo base_url('secure/create_department');?>"><span class="sub-menu-text">Create New Department</span></a></li>
									<li <?php if($this->session->userdata('selected_menu')=='update_department') echo ' class="current" ';?> ><a class="" href="<?php echo base_url('secure/update_department');?>"><span class="sub-menu-text">Edit Department</span></a></li>
								</ul>
							</li>
                                                        <?php endif; ?>
                                                        
                                                        <?php if($prv==PRV_ADMIN || $prv==PRV_HEAD_TEACHER):?>
                                                        <li <?php if($this->session->userdata('selected_menu')=='manage_teachers') echo ' class="active" ';?> >
								<a href="<?php echo base_url('secure/manage_teachers');?>">
									<i class="fa fa-user fa-fw"></i> <span class="menu-text">Manage Teachers</span>
								</a>					
							</li>
                                                        <?php endif; ?>
                                                        
                                                        <?php if($this->session->userdata('atttype')=="inout" && ($prv==PRV_ADMIN || $prv==PRV_HEAD_TEACHER || $prv==PRV_GFM_TEACHER || $prv==PRV_GEN_TEACHER)):?>
                                                        <li <?php if($this->session->userdata('selected_menu')=='monitor_inouttime') echo ' class="active" ';?> >
								<a href="<?php echo base_url('secure/monitor_inouttime');?>">
									<i class="fa fa-clock-o fa-fw"></i> <span class="menu-text">Monitor In & Out-Time</span>
								</a>					
							</li>
                                                        <li <?php if($this->session->userdata('selected_menu')=='intime_stats') echo ' class="active" ';?> >
								<a href="<?php echo base_url('secure/intime_stats');?>">
									<i class="fa fa-download fa-fw"></i> <span class="menu-text">In-Time Statistics</span>
								</a>					
							</li>
                                                        <li <?php if($this->session->userdata('selected_menu')=='outtime_stats') echo ' class="active" ';?> >
								<a href="<?php echo base_url('secure/outtime_stats');?>">
									<i class="fa fa-upload fa-fw"></i> <span class="menu-text">Out-Time Statistics</span>
								</a>					
							</li>
                                                        <?php endif; ?>
                                                        
							<li class="has-sub">
								<a href="javascript:;" class="">
								<i class="fa fa-bookmark-o fa-fw"></i> <span class="menu-text">UI Features</span>
								<span class="arrow"></span>
								</a>
								<ul class="sub">
									<li><a class="" href="elements.html"><span class="sub-menu-text">Elements</span></a></li><li><a class="" href="notifications.html"><span class="sub-menu-text">Hubspot Notifications</span></a></li>
									<li><a class="" href="buttons_icons.html"><span class="sub-menu-text">Buttons & Icons</span></a></li>
									<li><a class="" href="sliders_progress.html"><span class="sub-menu-text">Sliders & Progress</span></a></li>
									<li><a class="" href="typography.html"><span class="sub-menu-text">Typography</span></a></li>
									<li><a class="" href="tabs_accordions.html"><span class="sub-menu-text">Tabs & Accordions</span></a></li>
									<li><a class="" href="treeview.html"><span class="sub-menu-text">Treeview</span></a></li>
									<li><a class="" href="nestable_lists.html"><span class="sub-menu-text">Nestable Lists</span></a></li>
									<li class="has-sub-sub">
										<a href="javascript:;" class=""><span class="sub-menu-text">Third Level Menu</span>
										<span class="arrow"></span>
										</a>
										<ul class="sub-sub">
											<li><a class="" href="#"><span class="sub-sub-menu-text">Item 1</span></a></li>
											<li><a class="" href="#"><span class="sub-sub-menu-text">Item 2</span></a></li>
										</ul>
									</li>
								</ul>
							</li>
							
						</ul>
						<!-- /SIDEBAR MENU -->
					</div>
				</div>
				<!-- /SIDEBAR -->
                                <div id="main-content">
                                    <div class="container">
                                            <div class="row">
                                                    <div id="content" class="col-lg-12">
                                                            <!-- PAGE HEADER-->
                                                            <div class="row">
                                                                    <div class="col-sm-12">
                                                                            <div class="page-header">
                                                                                    <!-- STYLER -->

                                                                                    <!-- /STYLER -->
                                                                                    <!-- BREADCRUMBS 
                                                                                    <div style="display:block; height:12px;"></div>
                                                                                    <div class="ci_breadcrumb">< ?php echo "<i class='fa fa-home'></i> &nbsp;". set_breadcrumb(); ?></div>
                                                                                    <div style="display:block; height:10px;"></div>
                                                                                     /BREADCRUMBS -->