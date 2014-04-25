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
						<!-- SIDEBAR MENU -->
						<ul>
							<li>
								<a href="index.html">
									<i class="fa fa-tachometer fa-fw"></i> <span class="menu-text">Dashboard</span>
								</a>					
							</li>
                                                        <?php if($this->session->userdata('type')==ADMIN_TYPE):?>
                                                        <li>
								<a href="<?php echo base_url('secure/institute_setup');?>">
									<i class="fa fa-gears fa-fw"></i> <span class="menu-text">Institute Setup</span>
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
							<li><a class="" href="frontend_theme/index.html" target="_blank"><i class="fa fa-desktop fa-fw"></i> <span class="menu-text">Frontend Theme</span></a></li><li><a class="" href="inbox.html"><i class="fa fa-envelope-o fa-fw"></i> <span class="menu-text">Inbox</span></a></li>
							<li class="has-sub">
								<a href="javascript:;" class="">
								<i class="fa fa-table fa-fw"></i> <span class="menu-text">Tables</span>
								<span class="arrow"></span>
								</a>
								<ul class="sub">
									<li><a class="" href="simple_table.html"><span class="sub-menu-text">Simple Tables</span></a></li>
									<li><a class="" href="dynamic_tables.html"><span class="sub-menu-text">Dynamic Tables</span></a></li>
									<li><a class="" href="jqgrid_plugin.html"><span class="sub-menu-text">jqGrid Plugin</span></a></li>
								</ul>
							</li>
							<li class="has-sub">
								<a href="javascript:;" class="">
								<i class="fa fa-pencil-square-o fa-fw"></i> <span class="menu-text">Form Elements</span>
								<span class="arrow"></span>
								</a>
								<ul class="sub">
									<li><a class="" href="forms.html"><span class="sub-menu-text">Forms</span></a></li>
									<li><a class="" href="wizards_validations.html"><span class="sub-menu-text">Wizards & Validations</span></a></li>
									<li><a class="" href="rich_text_editors.html"><span class="sub-menu-text">Rich Text Editors</span></a></li>
									
									<li><a class="" href="dropzone_file_upload.html"><span class="sub-menu-text">Dropzone File Upload</span></a></li>
								</ul>
							</li>
							<li><a class="" href="widgets_box.html"><i class="fa fa-th-large fa-fw"></i> <span class="menu-text">Widgets & Box</span></a></li>
							<li class="has-sub">
								<a href="javascript:;" class="">
								<i class="fa fa-bar-chart-o fa-fw"></i> <span class="menu-text">Visual Charts</span>
								<span class="arrow"></span>
								</a>
								<ul class="sub">
									<li><a class="" href="flot_charts.html"><span class="sub-menu-text">Flot Charts</span></a></li>
									<li><a class="" href="xcharts.html"><span class="sub-menu-text">xCharts</span></a></li>
									
									<li><a class="" href="others.html"><span class="sub-menu-text">Others</span></a></li>
								</ul>
							</li>
							<li class="has-sub">
								<a href="javascript:;" class="">
								<i class="fa fa-columns fa-fw"></i> <span class="menu-text">Layouts</span>
								<span class="arrow"></span>
								</a>
								<ul class="sub">
									<li><a class="" href="mini_sidebar.html"><span class="sub-menu-text">Mini Sidebar</span></a></li>
									<li><a class="" href="fixed_header.html"><span class="sub-menu-text">Fixed Header</span></a></li>
									
									<li><a class="" href="fixed_header_sidebar.html"><span class="sub-menu-text">Fixed Header & Sidebar</span></a></li>
								</ul>
							</li>
							<li><a class="" href="calendar.html"><i class="fa fa-calendar fa-fw"></i> 
								<span class="menu-text">Calendar 
									<span class="tooltip-error pull-right" title="" data-original-title="3 New Events">
										<span class="label label-success">New</span>
									</span>
								</span>
								</a>
							</li>
							<li class="has-sub">
								<a href="javascript:;" class="">
								<i class="fa fa-map-marker fa-fw"></i> <span class="menu-text">Maps</span>
								<span class="arrow"></span>
								</a>
								<ul class="sub">
									<li><a class="" href="google_maps.html"><span class="sub-menu-text">Google Maps</span></a></li>
									<li><a class="" href="vector_maps.html"><span class="sub-menu-text">Vector Maps</span></a></li>
								</ul>
							</li>
							<li><a class="" href="gallery.html"><i class="fa fa-picture-o fa-fw"></i> <span class="menu-text">Gallery</span></a></li>
							<li class="has-sub">
								<a href="javascript:;" class="">
								<i class="fa fa-file-text fa-fw"></i> <span class="menu-text">More Pages</span>
								<span class="arrow"></span>
								</a>
								<ul class="sub">
									<li><a class="" href="login.html"><span class="sub-menu-text">Login & Register Option 1</span></a></li><li><a class="" href="login_bg.html"><span class="sub-menu-text">Login & Register Option 2</span></a></li>
									<li><a class="" href="user_profile.html"><span class="sub-menu-text">User profile</span></a></li>
									
									<li><a class="" href="chats.html"><span class="sub-menu-text">Chats</span></a></li>
									<li><a class="" href="todo_timeline.html"><span class="sub-menu-text">Todo & Timeline</span></a></li>
									<li><a class="" href="address_book.html"><span class="sub-menu-text">Address Book</span></a></li>
									
									<li><a class="" href="pricing.html"><span class="sub-menu-text">Pricing</span></a></li>
									<li><a class="" href="invoice.html"><span class="sub-menu-text">Invoice</span></a></li>
									<li><a class="" href="orders.html"><span class="sub-menu-text">Orders</span></a></li>
								</ul>
							</li>
							<li class="has-sub active">
								<a href="javascript:;" class="">
								<i class="fa fa-briefcase fa-fw"></i> <span class="menu-text">Other Pages <span class="badge pull-right">9</span></span>
								<span class="arrow open"></span>
								<span class="selected"></span>
								</a>
								<ul class="sub">
									<li><a class="" href="search_results.html"><span class="sub-menu-text">Search Results</span></a></li>
									<li><a class="" href="email_templates.html"><span class="sub-menu-text">Email Templates</span></a></li>
									
									<li><a class="" href="error_404.html"><span class="sub-menu-text">Error 404 Option 1</span></a></li><li><a class="" href="error_404_2.html"><span class="sub-menu-text">Error 404 Option 2</span></a></li><li><a class="" href="error_404_3.html"><span class="sub-menu-text">Error 404 Option 3</span></a></li>
									<li><a class="" href="error_500.html"><span class="sub-menu-text">Error 500 Option 1</span></a></li><li><a class="" href="error_500_2.html"><span class="sub-menu-text">Error 500 Option 2</span></a></li>
									<li><a class="" href="faq.html"><span class="sub-menu-text">FAQ</span></a></li>
									<li class="current"><a class="" href="blank_page.html"><span class="sub-menu-text">Blank Page</span></a></li>
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