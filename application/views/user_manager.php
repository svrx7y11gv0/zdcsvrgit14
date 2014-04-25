<?php   include_once('templates/header_bar.php');
        include_once('templates/left_sidebar.php');
?>
<!-- PAGE SPECIFIC STYLE -->
<!-- TYPEAHEAD CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/js/typeahead/typeahead.css');?>">
                                                                        <div class="clearfix">
										<h3 class="content-title pull-left">User Manager</h3>
									</div>
									<div class="description">User Profile, Skills, Activities and other Statistics</div>
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						<!-- USER PROFILE -->
						<div class="row">
							<div class="col-md-12">
								<!-- BOX -->
								<div class="box border">
									<div class="box-title">
										<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">Hello, <?php echo ucfirst($this->session->userdata('firstname')); ?>!</span></h4>
									</div>
									<div class="box-body">
										<div class="tabbable header-tabs user-profile">
											<ul class="nav nav-tabs">
                                                                                           <li><a href="#pro_help" data-toggle="tab"><i class="fa fa-question"></i> <span class="hidden-inline-mobile"> Help</span></a></li>
											   <li <?php if(isset($mode) && $mode == "account") echo ' class="active" ';?> ><a href="#acc_edit" data-toggle="tab"><i class="fa fa-cogs"></i> <span class="hidden-inline-mobile"> Edit Account</span></a></li>
											   <li <?php if($mode == null || $mode == "profile") echo ' class="active" ';?> ><a href="#pro_edit" data-toggle="tab"><i class="fa fa-edit"></i> <span class="hidden-inline-mobile"> Edit Profile</span></a></li>
											   <li <?php if(isset($mode) && $mode == "overview") echo ' class="active" ';?> ><a href="#pro_overview" data-toggle="tab"><i class="fa fa-dot-circle-o"></i> <span class="hidden-inline-mobile"> Overview</span></a></li>
											</ul>
											<div class="tab-content">
											   <!-- OVERVIEW -->
											   <div class="tab-pane fade <?php if(isset($mode) && $mode == "overview") echo ' in active ';?>" id="pro_overview">
												  <div class="row">
													<!-- PROFILE PIC -->
													<div class="col-md-3">
														<div class="list-group">
														  <li class="list-group-item zero-padding">
															<img style="margin: 0 auto;" alt="" class="img-responsive" src="<?php if($this->session->userdata('photourl')=="") echo base_url('uploads/profiles/default.png'); else echo base_url('uploads/profiles/').$this->session->userdata('photourl'); ?>">
														  </li>
														  <div class="list-group-item profile-details">
																<h2><?php echo ucfirst($this->session->userdata('firstname'))." ".ucfirst($this->session->userdata('lastname'));?></h2>
																<p><i class="fa fa-circle text-green"></i> Online</p>
																<p><?php if(isset($user_details)) echo $user_details->about_me; ?></p>
																<p><?php if(isset($user_details) && $user_details->email!=""):?><a title="<?php echo $user_details->email;?>" href="mailto:<?php echo $user_details->email;?>"><?php if(strlen($user_details->email)>19) echo substr($user_details->email,0,19).'...'; else echo $user_details->email;?></a><?php endif; ?></p>
																<ul class="list-inline">
																   <li><i class="fa fa-facebook fa-2x"></i></li>
																   <li><i class="fa fa-twitter fa-2x"></i></li>
																   <li><i class="fa fa-dribbble fa-2x"></i></li>
																   <li><i class="fa fa-bitbucket fa-2x"></i></li>
																</ul>
														 </div>
														  <a href="#" class="list-group-item"><i class="fa fa-user fa-fw"></i> Profile</a>
														  <a href="#" class="list-group-item">
															<span class="badge badge-red">9</span>
															<i class="fa fa-calendar fa-fw"></i> Events
														  </a>
														  <a href="#" class="list-group-item"><i class="fa fa-comment-o fa-fw"></i> Messages</a>
														  <a href="#" class="list-group-item"><i class="fa fa-picture-o fa-fw"></i> Photos</a>
														  <a href="#" class="list-group-item"><i class="fa fa-cog fa-fw"></i> Settings</a>
														</div>														
													</div>
													<!-- /PROFILE PIC -->
													<!-- PROFILE DETAILS -->
													<div class="col-md-9">
														<!-- ROW 1 -->
														<div class="row">
															<div class="col-md-12 profile-details">																
																<h3>My Skills</h3>
																<div class="row">
																	<div class="col-md-4 text-center">
																		<div id="pie_1" class="piechart" data-percent="76">
																			<span class="percent"></span>
																		</div>
																		<div class="skill-name">Graphic Design</div>
																	</div>
																	<div class="col-md-4 text-center">
																		<div id="pie_2" class="piechart" data-percent="82">
																			<span class="percent"></span>
																		</div>
																		<div class="skill-name">Web Design</div>
																	</div>
																	<div class="col-md-4 text-center">
																		<div id="pie_3" class="piechart" data-percent="66">
																			<span class="percent"></span>
																		</div>
																		<div class="skill-name">Javascript</div>
																	</div>
																</div>
																<div class="divide-20"></div>
																<!-- BUTTONS -->
																<div class="row">
																	<div class="col-md-3">
																		<a class="btn btn-danger btn-icon input-block-level" href="javascript:void(0);">
																			<i class="fa fa-google-plus-square fa-2x"></i>
																			<div>Google Plus</div>
																			<span class="label label-right label-warning">4</span>
																		</a>
																	</div>
																	<div class="col-md-3">
																		<a class="btn btn-primary btn-icon input-block-level" href="javascript:void(0);">
																			<i class="fa fa-facebook-square fa-2x"></i>
																			<div>Facebook</div>
																			<span class="label label-right label-danger">7+</span>
																		</a>
																	</div>
																	<div class="col-md-3">
																		<a class="btn btn-pink btn-icon input-block-level" href="javascript:void(0);">
																			<i class="fa fa-dribbble fa-2x"></i>
																			<div>Dribbble</div>
																			<span class="label label-right label-info">1</span>
																		</a>
																	</div>
																	<div class="col-md-3">
																		<a class="btn btn-success btn-icon input-block-level" href="javascript:void(0);">
																			<i class="fa fa-github fa-2x"></i>
																			<div>Github</div>
																		</a>
																	</div>
																</div>
																<!-- /BUTTONS -->
															</div>
														</div>
														<!-- /ROW 1 -->
														<div class="divide-40"></div>
														<!-- ROW 2 -->
														<div class="row">
															<div class="col-md-12">
															<div class="box border blue">
															<div class="box-title">
																<h4><i class="fa fa-columns"></i> <span class="hidden-inline-mobile">Profile Summary</span></h4>																
															</div>
															<div class="box-body">
																<div class="tabbable">
																	<ul class="nav nav-tabs">
																	   <li class="active"><a href="#sales" data-toggle="tab"><i class="fa fa-signal"></i> <span class="hidden-inline-mobile">Sales Table</span></a></li>
																	   <li><a href="#feed" data-toggle="tab"><i class="fa fa-rss"></i> <span class="hidden-inline-mobile">Recent Activities</span></a></li>
																	</ul>
																	<div class="tab-content">
																	   <div class="tab-pane active" id="sales">
																		  <table class="table table-striped table-bordered table-hover">
																			 <thead>
																				<tr>
																				   <th><i class="fa fa-user"></i> Client</th>
																				   <th class="hidden-xs"><i class="fa fa-quote-left"></i> Sales Item</th>
																				   <th><i class="fa fa-dollar"></i> Amount</th>
																				   <th><i class="fa fa-bars"></i> Status</th>
																				</tr>
																			 </thead>
																			 <tbody>
																				<tr>
																				   <td><a href="#">Fortune 500</a></td>
																				   <td class="hidden-xs">Gold Level Virtual Server</td>
																				   <td>$ 2310.23</td>
																				   <td><span class="label label-success label-sm">Paid</span></td>
																				</tr>
																				<tr>
																				   <td><a href="#">Cisco Inc.</a></td>
																				   <td class="hidden-xs">Platinum Level Virtual Server</td>
																				   <td>$ 5502.67</td>
																				   <td><span class="label label-warning label-sm">Pending</span></td>
																				</tr>
																				<tr>
																				   <td><a href="#">VMWare Ltd.</a></td>
																				   <td class="hidden-xs">Hardware Switch</td>
																				   <td>$ 3472.54</td>
																				   <td><span class="label label-success label-sm">Paid</span></td>
																				</tr>
																				<tr>
																				   <td><a href="#">Wall-Mart Stores</a></td>
																				   <td class="hidden-xs">Branding & Marketing</td>
																				   <td>$ 6653.25</td>
																				   <td><span class="label label-success label-sm">Paid</span></td>
																				</tr>
																				<tr>
																				   <td><a href="#">Exxon Mobil</a></td>
																				   <td class="hidden-xs">UX and UI Services</td>
																				   <td>$ 45645.45</td>
																				   <td><span class="label label-danger label-sm">Overdue</span></td>
																				</tr>
																				<tr>
																				   <td><a href="#">General Electric</a></td>
																				   <td class="hidden-xs">Web Designing</td>
																				   <td>$ 3432.11</td>
																				   <td><span class="label label-warning label-sm">Pending</span></td>
																				</tr>
																			 </tbody>
																		  </table>
																	   </div>
																	   <div class="tab-pane" id="feed">
																		  <div class="scroller" data-height="250px" data-always-visible="1" data-rail-visible="1">
																			  <div class="feed-activity clearfix">
																				<div>
																					<i class="pull-left roundicon fa fa-check btn btn-info"></i>
																					<a class="user" href="#"> John Doe </a>
																					accepted your connection request.
																					<br>
																					<a href="#">View profile</a>
																					
																				</div>
																				<div class="time">
																					<i class="fa fa-clock-o"></i>
																					5 hours ago
																				</div>
																			  </div>
																			  <div class="feed-activity clearfix">
																				<div>
																					<i class="pull-left roundicon fa fa-picture-o btn btn-danger"></i>
																					<a class="user" href="#"> Jack Doe </a>
																					uploaded a new photo.
																					<br>
																					<a href="#">Take a look</a>
																					
																				</div>
																				<div class="time">
																					<i class="fa fa-clock-o"></i>
																					5 hours ago
																				</div>
																			  </div>
																			  <div class="feed-activity clearfix">
																				<div>
																					<i class="pull-left roundicon fa fa-edit btn btn-pink"></i>
																					<a class="user" href="#"> Jess Doe </a>
																					edited their skills.
																					<br>
																					<a href="#">Endorse them</a>
																					
																				</div>
																				<div class="time">
																					<i class="fa fa-clock-o"></i>
																					5 hours ago
																				</div>
																			  </div>
																			  <div class="feed-activity clearfix">
																				<div>
																					<i class="pull-left roundicon fa fa-bitcoin btn btn-yellow"></i>
																					<a class="user" href="#"> Divine Doe </a>
																					made a bitcoin payment.
																					<br>
																					<a href="#">Check your financials</a>
																					
																				</div>
																				<div class="time">
																					<i class="fa fa-clock-o"></i>
																					6 hours ago
																				</div>
																			  </div>
																			  <div class="feed-activity clearfix">
																				<div>
																					<i class="pull-left roundicon fa fa-dropbox btn btn-primary"></i>
																					<a class="user" href="#"> Lisbon Doe </a>
																					saved a new document to Dropbox.
																					<br>
																					<a href="#">Download</a>
																					
																				</div>
																				<div class="time">
																					<i class="fa fa-clock-o"></i>
																					1 day ago
																				</div>
																			  </div>
																			  <div class="feed-activity clearfix">
																				<div>
																					<i class="pull-left roundicon fa fa-pinterest btn btn-inverse"></i>
																					<a class="user" href="#"> Bob Doe </a>
																					pinned a new photo to Pinterest.
																					<br>
																					<a href="#">Take a look</a>
																					
																				</div>
																				<div class="time">
																					<i class="fa fa-clock-o"></i>
																					2 days ago
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
														<!-- /ROW 2 -->
													</div>
													<!-- /PROFILE DETAILS -->
												  </div>
											   </div>
											   <!-- /OVERVIEW -->
											   
											   <!-- EDIT PROFILE -->
											   <div class="tab-pane fade <?php if($mode == null || $mode == "profile") echo ' in active" ';?> " id="pro_edit">
												  <form class="form-horizontal" id="user_profile_form" method="post" action="<?php echo base_url('secure/update_profile');?>" enctype="multipart/form-data">
													<div class="row">
														 <div class="col-md-12">
															
                                                                                                                                <div class="col-md-12">
                                                                                                                                       <h4>Basic Information</h4>
                                                                                                                                       <div class="form-group">
                                                                                                                                          <label class="col-md-2 control-label">First Name *</label> 
                                                                                                                                          <div class="col-md-10">
                                                                                                                                              <input type="text" name="firstName" class="form-control" placeholder="Enter your first name" value="<?php if(isset($user_details)) echo ucfirst($user_details->firstname); ?>" <?php if($this->session->userdata('privilege')==PRV_STUDENT) echo " disabled "; ?> />
                                                                                                                                              <span id="firstName_error" class="help-block"></span>
                                                                                                                                          </div>
                                                                                                                                       </div>
                                                                                                                                       <div class="form-group">
                                                                                                                                          <label class="col-md-2 control-label">Middle Name</label> 
                                                                                                                                          <div class="col-md-10"><input type="text" name="middleName" class="form-control" placeholder="Enter your middle name" value="<?php if(isset($user_details)) echo ucfirst($user_details->middlename); ?>" <?php if($this->session->userdata('privilege')==PRV_STUDENT) echo " disabled "; ?> /></div>
                                                                                                                                       </div>
                                                                                                                                       <div class="form-group">
                                                                                                                                          <label class="col-md-2 control-label">Last Name *</label> 
                                                                                                                                          <div class="col-md-10">
                                                                                                                                              <input type="text" name="lastName" class="form-control" placeholder="Enter your last name" value="<?php if(isset($user_details)) echo ucfirst($user_details->lastname); ?>" <?php if($this->session->userdata('privilege')==PRV_STUDENT) echo " disabled "; ?> />
                                                                                                                                              <span id="lastName_error" class="help-block"></span>
                                                                                                                                          </div>
                                                                                                                                       </div>
                                                                                                                                       <div class="form-group">
                                                                                                                                          <label class="col-md-2 control-label">Birthday</label> 
                                                                                                                                          <div class="col-md-10">
                                                                                                                                              <input  class="form-control" type="text" name="dob" data-mask="9999-99-99" size="10" value="<?php if(isset($user_details)) echo $user_details->dob; ?>" <?php if($this->session->userdata('privilege')==PRV_STUDENT) echo " disabled "; ?> />
                                                                                                                                              <span id="dob_error" class="help-block">yyyy-mm-dd</span>
                                                                                                                                          </div>
                                                                                                                                       </div>
                                                                                                                                       <div class="form-group">
                                                                                                                                          <label class="col-md-2 control-label">Gender</label> 
                                                                                                                                          <div class="col-md-4">
                                                                                                                                                        <label class="radio">
                                                                                                                                                               <input type="radio" name="gender" value="M" data-title="Male" class="uniform"  <?php if(isset($user_details) && $user_details->gender == 'M') echo " checked "; ?>  <?php if($this->session->userdata('privilege')==PRV_STUDENT) echo " disabled "; ?> />
                                                                                                                                                        Male
                                                                                                                                                        </label>
                                                                                                                                                        <label class="radio">
                                                                                                                                                               <input type="radio" name="gender" value="F" data-title="Female" class="uniform"  <?php if(isset($user_details) && $user_details->gender == 'F') echo " checked "; ?>  <?php if($this->session->userdata('privilege')==PRV_STUDENT) echo " disabled "; ?> />
                                                                                                                                                        Female
                                                                                                                                                        </label>														  
                                                                                                                                          </div>
                                                                                                                                       </div>
                                                                                                                                       <h4>Contact Information</h4>
                                                                                                                                       <div class="form-group">
                                                                                                                                          <label class="col-md-2 control-label">Email</label> 
                                                                                                                                          <div class="col-md-10"><input type="text" name="email" class="form-control" placeholder="Enter your email address" value="<?php if(isset($user_details)) echo $user_details->email; ?>" /><span id="email_error" class="help-block"></span></div>
                                                                                                                                       </div>
                                                                                                                                       <div class="form-group">
                                                                                                                                          <label class="col-md-2 control-label">Phone</label> 
                                                                                                                                          <div class="col-md-10"><input type="text" name="phone" class="form-control" placeholder="Enter your contact numbers" value="<?php if(isset($user_details)) echo $user_details->contact_nos; ?>"  <?php if($this->session->userdata('privilege')==PRV_STUDENT) echo " disabled "; ?> /><span class="help-block">Write multiple numbers separated by comma.</span></div>
                                                                                                                                       </div>

                                                                                                                                       <div class="form-group">
                                                                                                                                          <label class="col-md-2 control-label">Address</label> 
                                                                                                                                          <div class="col-md-10"><textarea name="address" class="autosize form-control"  <?php if($this->session->userdata('privilege')==PRV_STUDENT) echo " disabled "; ?> ><?php if(isset($user_details)) echo $user_details->address; ?></textarea></div>
                                                                                                                                       </div>
                                                                                                                                       
                                                                                                                                       <h4>Personal Information</h4>
                                                                                                                                       
                                                                                                                                       <div class="form-group">
                                                                                                                                          <label class="col-md-2 control-label">Blood Group</label> 
                                                                                                                                          <div class="col-md-10"><input type="text" name="bloodGroup" class="form-control" id="bloodgroup"  placeholder="Enter your blood group" value="<?php if(isset($user_details)) echo $user_details->blood_group; ?>"  <?php if($this->session->userdata('privilege')==PRV_STUDENT) echo " disabled "; ?> /> <span class="help-block">Your blood group is required to be known in case of emergency.</span></div>
                                                                                                                                       </div>
                                                                                                                                       
                                                                                                                                       <div class="form-group">
                                                                                                                                          <label class="col-md-2 control-label">Languages</label> 
                                                                                                                                          <div class="col-md-10"><input type="text" name="languages" class="form-control" placeholder="Enter languages you know" value="<?php if(isset($user_details)) echo $user_details->languages; ?>"><span class="help-block">Write multiple languages separated by comma.</span></div>
                                                                                                                                       </div>
                                                                                                                                       
                                                                                                                                       <div class="form-group">
                                                                                                                                          <label class="col-md-2 control-label">Nationality</label> 
                                                                                                                                          <div class="col-md-10"><input type="text" name="nationality" class="form-control" id="nationality"  placeholder="Enter your nationality" value="<?php if(isset($user_details)) echo $user_details->nationality; ?>" <?php if($this->session->userdata('privilege')==PRV_STUDENT) echo " disabled "; ?> /></div>
                                                                                                                                       </div>
                                                                                                                                       
                                                                                                                                       <div class="form-group">
                                                                                                                                          <label class="col-md-2 control-label">Category</label> 
                                                                                                                                          <div class="col-md-10"><input type="text" name="category" class="form-control" placeholder="Enter your category" value="<?php if(isset($user_details)) echo $user_details->category; ?>" <?php if($this->session->userdata('privilege')==PRV_STUDENT) echo " disabled "; ?> /></div>
                                                                                                                                       </div>
                                                                                                                                       
                                                                                                                                       <div class="form-group">
                                                                                                                                          <label class="col-md-2 control-label">Religion</label> 
                                                                                                                                          <div class="col-md-10"><input type="text" name="religion" class="form-control" placeholder="Enter your religion" value="<?php if(isset($user_details)) echo $user_details->religion; ?>" <?php if($this->session->userdata('privilege')==PRV_STUDENT) echo " disabled "; ?> /></div>
                                                                                                                                       </div>
                                                                                                                                       
                                                                                                                                       <div class="form-group">
                                                                                                                                          <label class="col-md-2 control-label">Something About You</label> 
                                                                                                                                          <div class="col-md-10"><textarea name="aboutMe" class="countable autosize form-control" data-limit="250"><?php if(isset($user_details)) echo $user_details->about_me; ?></textarea><p class="help-block">You have <span id="counter"></span> characters left.</p></div>
                                                                                                                                       </div>
                                                                                                                                       
                                                                                                                                       <div class="form-group">
                                                                                                                                          <label class="col-md-2 control-label">Upload / Change photo</label> 
                                                                                                                                          <div class="col-md-10">
                                                                                                                                              <a class="btn btn-default btn-file" style="padding:10px 12px;">
                                                                                                                                                  <input type="file" class="file-input" name="userfile" size="20" />
                                                                                                                                              </a>
                                                                                                                                              <span id="userfile_error" class="help-block">File size should be less than 2 MB. Allowed file types are 'gif','png','jpg','jpeg' only.</span>
                                                                                                                                          </div>
                                                                                                                                       </div>
                                                                                                                                </div>
														 </div>
														 
													 </div>
												  </form>
												  <div class="form-actions clearfix"> <input type="submit" value="Update Profile" id="btn_update_profile" class="btn btn-primary pull-right"> </div>
											   </div>
											   <!-- /EDIT PROFILE -->
											   
											   <!-- EDIT ACCOUNT -->
											   <div class="tab-pane fade <?php if(isset($mode) && $mode == "account") echo ' in active ';?>" id="acc_edit">
												  <form class="form-horizontal" id="user_account_form" method="post" action="<?php echo base_url('secure/update_account');?>">
													<div class="row">
														 <div class="col-md-12">
															
                                                                                                                                <div class="col-md-12">
                                                                                                                                       <div class="panel panel-default">
                                                                                                                                            <div class="panel-heading">
                                                                                                                                                    <h3 class="panel-title">Important Information</h3>
                                                                                                                                            </div>
                                                                                                                                            <div class="panel-body">
                                                                                                                                                    <ul>
                                                                                                                                                            <li>Fields marked with <strong>*</strong> are compulsory for any update.</li>
                                                                                                                                                            <li>By changing your username, you will need the new username to login next time.</li>
                                                                                                                                                            <li>By changing your password, you will need the new password to login next time.</li>
                                                                                                                                                            <li>After disabling multi-language support, you won't be able to see "Select Language" at the left side.</li>
                                                                                                                                                            <li>Multi-language support can be enabled again if you wish to use the feature.</li>
                                                                                                                                                    </ul>
                                                                                                                                            </div>
                                                                                                                                       </div>
                                                                                                                                       <h4>Account Information</h4>
                                                                                                                                       <div class="form-group">
                                                                                                                                          <label class="col-md-3 control-label">Current Username *</label> 
                                                                                                                                          <div class="col-md-9">
                                                                                                                                              <input type="text" name="curr_username" class="form-control" value="<?php echo $this->session->userdata('username'); ?>">
                                                                                                                                              <span id="curr_username_error" class="help-block"></span>
                                                                                                                                          </div>
                                                                                                                                       </div>
                                                                                                                                       <div class="form-group">
                                                                                                                                          <label class="col-md-3 control-label">Current Password *</label> 
                                                                                                                                          <div class="col-md-9">
                                                                                                                                              <input type="password" name="curr_password" class="form-control" >
                                                                                                                                              <span id="curr_pass_error" class="help-block"></span>
                                                                                                                                          </div>
                                                                                                                                       </div>
                                                                                                                                       <div class="form-group">
                                                                                                                                          <label class="col-md-3 control-label">New Username</label> 
                                                                                                                                          <div class="col-md-9">
                                                                                                                                              <input type="text" name="new_username" class="form-control" >
                                                                                                                                              <span id="new_username_error" class="help-block">Keep this field blank for not changing the username.</span>
                                                                                                                                          </div>
                                                                                                                                       </div>
                                                                                                                                       <div class="form-group">
                                                                                                                                          <label class="col-md-3 control-label">New Password</label> 
                                                                                                                                          <div class="col-md-9">
                                                                                                                                              <input type="password" name="new_password" class="form-control" >
                                                                                                                                              <span id="new_pass_error" class="help-block">Keep this field blank for not changing the password.</span>
                                                                                                                                          </div>
                                                                                                                                       </div>
                                                                                                                                       <div class="form-group hide">
                                                                                                                                          <label class="col-md-3 control-label">Confirm New Password</label> 
                                                                                                                                          <div class="col-md-9">
                                                                                                                                              <input type="password" name="con_new_password" class="form-control" >
                                                                                                                                              <span id="con_new_pass_error" class="help-block"></span>
                                                                                                                                          </div>
                                                                                                                                       </div>
                                                                                                                                       <div class="form-group">
                                                                                                                                          <label class="col-md-3 control-label">Multi-Language Support</label> 
                                                                                                                                          <div class="col-md-5">
                                                                                                                                                        <label class="radio">
                                                                                                                                                               <input type="radio" name="multilanguage" value="T" data-title="Enable" class="uniform"  <?php if(isset($user_details) && $user_details->multilanguage == 'T') echo " checked "; ?> />
                                                                                                                                                        Enable
                                                                                                                                                        </label>
                                                                                                                                                        <label class="radio">
                                                                                                                                                               <input type="radio" name="multilanguage" value="F" data-title="Disable" class="uniform"  <?php if(isset($user_details) && $user_details->multilanguage == 'F') echo " checked "; ?> />
                                                                                                                                                        Disable
                                                                                                                                                        </label>
                                                                                                                                                        <span class="help-block">Press F5 after update to observe the change in multi-language support.</span>
                                                                                                                                          </div>
                                                                                                                                       </div>
                                                                                                                                       
                                                                                                                                </div>
                                                                                                                 </div>
                                                                                                        </div>
                                                                                                  </form>
                                                                                               <div class="form-actions clearfix"> <input type="submit" value="Update Account" id="btn_update_account" class="btn btn-primary pull-right"> </div>
											   </div>
											   <!-- /EDIT ACCOUNT -->
                                                                                           
                                                                                           <!-- HELP -->
                                                                                           <div class="tab-pane fade" id="pro_help">
												  <!-- FAQ -->
													<div class="row">
														<!-- NAV -->
														<div id="list-toggle" class="col-md-3">
															<div class="list-group">
															  <a href="#tab1" data-toggle="tab" class="list-group-item active">
																<i class="fa fa-user"></i> User Privilege
															  </a>
															  <a href="#tab2" data-toggle="tab" class="list-group-item"><i class="fa fa-desktop"></i> Web Display</a>
															  <a href="#tab3" data-toggle="tab" class="list-group-item"><i class="fa fa-suitcase"></i> Terms of Service</a>
															  <a href="#tab4" data-toggle="tab" class="list-group-item"><i class="fa fa-sitemap"></i> Account Queries</a>
															  <a href="#tab5" data-toggle="tab" class="list-group-item"><i class="fa fa-arrows"></i> Other Questions</a>
															</div>
														</div>
														<!-- /NAV -->
														<!-- CONTENT -->
														<div class="col-md-9">
															<div class="tab-content">
															   <div class="tab-pane active" id="tab1" style="margin-top:30px;">
																  <div class="panel-group" id="accordion">
                                                                                                                                      <div class="well well-sm"><h4>Your privilege value is <em> <?php if($this->session->userdata('privilege')) echo $this->session->userdata('privilege');?></em></h4> </div>
																	  <div class="panel panel-info">
																		 <div class="panel-heading">
                                                                                                                                                     <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1_1"><strong>Privilege values and roles of users.</strong></a> </h3>
																		 </div>
																		 <div id="collapse1_1" class="panel-collapse collapse in">
                                                                                                                                                     <div class="panel-body"> 
                                                                                                                                                         edbeans&reg; provides ACL (Access Control List) by assigning privilege numbers to all users, which define several access roles and limitations.
                                                                                                                                                     </div>
																		 </div>
																	  </div>
																	  <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1_2"><strong> 99 -- Privilege value of administrator</strong></a> </h3>
																		 </div>
																		 <div id="collapse1_2" class="panel-collapse collapse">
																			<div class="panel-body"> 
                                                                                                                                                            Privilege value of 99 gives administrator full access to: 
                                                                                                                                                            <ul>
                                                                                                                                                                <li>All students data</li>
                                                                                                                                                                <li>Creating and updating user profiles</li>
                                                                                                                                                                <li>Creating and updating fee structure</li>
                                                                                                                                                            </ul> 
																			 </div>
																		 </div>
																	  </div>
																	  <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1_3"><strong> 82 -- Privilege value of a Head Teacher (e.g. H.O.D)</strong></a> </h3>
																		 </div>
																		 <div id="collapse1_3" class="panel-collapse collapse">
																			<div class="panel-body"> 
                                                                                                                                                            Privilege value of 82 gives a teacher following rights: 
                                                                                                                                                            <ul>
                                                                                                                                                                <li>Update profile data of any student of any class (or department).</li>
                                                                                                                                                                <li>Mark / Unmark attendance of any student of any class (or department).</li>
                                                                                                                                                                <li>Add / Update assessment marks of any student for any subject of any class (or department).</li>
                                                                                                                                                                <li>Assign a task to any student of any class (or department).</li>
                                                                                                                                                            </ul> 
																			 </div>
																		 </div>
																	  </div>
                                                                                                                                          <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1_4"><strong> 81 -- Privilege value of a Class Teacher or GFM</strong></a> </h3>
																		 </div>
																		 <div id="collapse1_4" class="panel-collapse collapse">
																			<div class="panel-body"> 
                                                                                                                                                            Privilege value of 81 gives a teacher following rights: 
                                                                                                                                                            <ul>
                                                                                                                                                                <li>Update profile data of any student of his/her own class.</li>
                                                                                                                                                                <li>Mark / Unmark attendance of any student of his/her own class.</li>
                                                                                                                                                                <li>Add / Update assessment marks of any student for any subject of his/her own class.</li>
                                                                                                                                                                <li>Assign a task to any student of his/her own class</li>
                                                                                                                                                            </ul> 
																			 </div>
																		 </div>
																	  </div>
                                                                                                                                          <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1_5"><strong> 80 -- Privilege value of NON Class Teacher</strong></a> </h3>
																		 </div>
																		 <div id="collapse1_5" class="panel-collapse collapse">
																			<div class="panel-body"> 
                                                                                                                                                            Privilege value of 80 gives a teacher following rights: 
                                                                                                                                                            <ul>
                                                                                                                                                                <li>Mark / Unmark attendance of any student for specific subject of his/her own field and assigned classes.</li>
                                                                                                                                                                <li>Add / Update assessment marks of any student for specific subject of his/her own field and assigned classes.</li>
                                                                                                                                                                <li>Assign a task to any student for specific subject of his/her own field and assigned classes.</li>
                                                                                                                                                            </ul> 
																			 </div>
																		 </div>
																	  </div>
                                                                                                                                          <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1_6"><strong> 35 -- Privilege value of Account's Head</strong></a> </h3>
																		 </div>
																		 <div id="collapse1_6" class="panel-collapse collapse">
																			<div class="panel-body"> 
                                                                                                                                                            Privilege value of 35 gives a Account's Head following rights: 
                                                                                                                                                            <ul>
                                                                                                                                                                <li>Create / Update fee categories.</li>
                                                                                                                                                                <li>Create / Update fee particulars.</li>
                                                                                                                                                                <li>Assign / Monitor fee of all students</li>
                                                                                                                                                            </ul> 
																			 </div>
																		 </div>
																	  </div>
                                                                                                                                          <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1_7"><strong> 30 -- Privilege value of Account's Clerk</strong></a> </h3>
																		 </div>
																		 <div id="collapse1_7" class="panel-collapse collapse">
																			<div class="panel-body"> 
                                                                                                                                                            Privilege value of 30 gives a Account's Clerk following rights: 
                                                                                                                                                            <ul>
                                                                                                                                                                <li>Assign / Monitor fee of all students</li>
                                                                                                                                                            </ul> 
																			 </div>
																		 </div>
																	  </div>
                                                                                                                                          <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1_8"><strong> 8 -- Privilege value of Guardian</strong></a> </h3>
																		 </div>
																		 <div id="collapse1_8" class="panel-collapse collapse">
																			<div class="panel-body"> 
                                                                                                                                                            Privilege value of 8 gives guardian following rights: 
                                                                                                                                                            <ul>
                                                                                                                                                                <li>Update contact information of his/her own ward.</li>
                                                                                                                                                                <li>Approve / Reject events / notifications.</li>
                                                                                                                                                                <li>Approve / Reject consents.</li>
                                                                                                                                                                <li>Monitor ward's attendance, performance and tasks.</li>
                                                                                                                                                            </ul> 
																			 </div>
																		 </div>
																	  </div>
																   </div>
															   </div>
															   <div class="tab-pane" id="tab2" style="margin-top:30px;">
																  <div class="panel-group" id="accordion">
																	  <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2_1">1. Screen resolution can be adjusted very easily. </a> </h3>
																		 </div>
																		 <div id="collapse2_1" class="panel-collapse">
																			<div class="panel-body">
                                                                                                                                                            If there is any problem in viewability of icons, layout, tables, graphs or images, please adjust your browser resolution in following ways:
                                                                                                                                                            <ol>
                                                                                                                                                                <li>Press "Ctrl" and "+" keys together to increase size of icons, images, etc. And Press "Ctrl" and "-" keys together to decrease size of icons, images, etc.</li>
                                                                                                                                                                <li>Press "Ctrl" and scroll mouse ball up together to increase size of icons, images, etc. And Press "Ctrl" and scroll mouse ball down together to decrease size of icons, images, etc.</li>
                                                                                                                                                            </ol>
                                                                                                                                                        </div>
																		 </div>
																	  </div>
																	  <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2_2">2. How can I control whether my public community posts appear on my profile page? </a> </h3>
																		 </div>
																		 <div id="collapse2_2" class="panel-collapse collapse">
																			<div class="panel-body"> While in communities:
																				Place your cursor in the top left corner for the main menu.
																				Select  Settings.
																				Scroll to 'Profile'.
																				Check or uncheck the box next to Show your Google+ communities posts on your Google+ profile
																			 </div>
																		 </div>
																	  </div>
																	  
																   </div>
															   </div>
															   <div class="tab-pane" id="tab3" style="margin-top:30px;">
																  <div class="panel-group" id="accordion">
																	  <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3_1">1. If I post to a public community, does that mean all my friends and followers can see it? </a> </h3>
																		 </div>
																		 <div id="collapse3_1" class="panel-collapse collapse">
																			<div class="panel-body"> No, the posts you share to a public community will not show up in your friends and followers’ Home streams, unless your friends and followers are also members of the same community.
																			Your public community posts will be visible to people who navigate to your profile page unless you have set your settings for them not to appear. Visitors will see text indicating that it was shared to a community.
																			Remember that your private community posts will only be visible to people in those communities, regardless of whether or not you show community posts on your profile. </div>
																		 </div>
																	  </div>
																	  <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3_2">2. How can I control whether my public community posts appear on my profile page? </a> </h3>
																		 </div>
																		 <div id="collapse3_2" class="panel-collapse collapse">
																			<div class="panel-body"> While in communities:
																				Place your cursor in the top left corner for the main menu.
																				Select  Settings.
																				Scroll to 'Profile'.
																				Check or uncheck the box next to Show your Google+ communities posts on your Google+ profile
																			 </div>
																		 </div>
																	  </div>
																	  <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3_3">3. Can I change my community from public to private, or vice versa? </a> </h3>
																		 </div>
																		 <div id="collapse3_3" class="panel-collapse collapse">
																			<div class="panel-body">You can turn your community notifications on or off by clicking on the  icon on a community’s page.
																			Community members can use notifications to know when new things are shared with their communities. If notifications are On you’ll get a notification by email, on your device, and by the Google toolbar when someone posts something new. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
																		 </div>
																	  </div>
																	  <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3_4">4. Why aren't people seeing my invites? </a> </h3>
																		 </div>
																		 <div id="collapse3_4" class="panel-collapse collapse">
																			<div class="panel-body"> You can turn your community notifications on or off by clicking on the  icon on a community’s page.
																			Community members can use notifications to know when new things are shared with their communities. If notifications are On you’ll get a notification by email, on your device, and by the Google toolbar when someone posts something new.
																			Notifications default on in communities where the membership is moderated - that is, private communities, or public communities where you need to ask to join. It's also on by default for any community you create.
																			 </div>
																		 </div>
																	  </div>
																	  <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3_5">5. If I moderate a post out of my community, is it deleted? </a> </h3>
																		 </div>
																		 <div id="collapse3_5" class="panel-collapse collapse in">
																			<div class="panel-body">Notifications default on in communities where the membership is moderated - that is, private communities, or public communities where you need to ask to join. It's also on by default for any community you create.A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
																		 </div>
																	  </div>
																	  <div class="panel panel-info">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3_6">6. Are community names unique? If someone else has a "Software" community, does that prevent me from owning one? </a> </h3>
																		 </div>
																		 <div id="collapse3_6" class="panel-collapse collapse">
																			<div class="panel-body"> They may not see your invites if they don’t have you in their circles, or if they’ve limited the “Who can send you notifications?” setting. Learn more about who can send you notifications. They may not see your invites if they don’t have you in their circles, or if they’ve limited the “Who can send you notifications?” setting. Learn more about who can send you notifications.
																			 </div>
																		 </div>
																	  </div>
																	  <div class="panel panel-success">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3_7">7. How can I control how many community invitations I receive? </a> </h3>
																		 </div>
																		 <div id="collapse3_7" class="panel-collapse collapse">
																			<div class="panel-body">A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
																		 </div>
																	  </div>
																   </div>
															   </div>
															   <div class="tab-pane" id="tab4" style="margin-top:30px;">
																  <div class="panel-group" id="accordion">
																	  <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4_1">1. If I post to a public community, does that mean all my friends and followers can see it? </a> </h3>
																		 </div>
																		 <div id="collapse4_1" class="panel-collapse collapse in">
																			<div class="panel-body"> No, the posts you share to a public community will not show up in your friends and followers’ Home streams, unless your friends and followers are also members of the same community.
																			Your public community posts will be visible to people who navigate to your profile page unless you have set your settings for them not to appear. Visitors will see text indicating that it was shared to a community.
																			Remember that your private community posts will only be visible to people in those communities, regardless of whether or not you show community posts on your profile. </div>
																		 </div>
																	  </div>
																	  <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4_2">2. How can I control whether my public community posts appear on my profile page? </a> </h3>
																		 </div>
																		 <div id="collapse4_2" class="panel-collapse collapse">
																			<div class="panel-body"> While in communities:
																				Place your cursor in the top left corner for the main menu.
																				Select  Settings.
																				Scroll to 'Profile'.
																				Check or uncheck the box next to Show your Google+ communities posts on your Google+ profile
																			 </div>
																		 </div>
																	  </div>
																	  <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4_3">3. Can I change my community from public to private, or vice versa? </a> </h3>
																		 </div>
																		 <div id="collapse4_3" class="panel-collapse collapse">
																			<div class="panel-body">You can turn your community notifications on or off by clicking on the  icon on a community’s page.
																			Community members can use notifications to know when new things are shared with their communities. If notifications are On you’ll get a notification by email, on your device, and by the Google toolbar when someone posts something new. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
																		 </div>
																	  </div>
																	  <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4_4">4. Why aren't people seeing my invites? </a> </h3>
																		 </div>
																		 <div id="collapse4_4" class="panel-collapse collapse">
																			<div class="panel-body"> You can turn your community notifications on or off by clicking on the  icon on a community’s page.
																			Community members can use notifications to know when new things are shared with their communities. If notifications are On you’ll get a notification by email, on your device, and by the Google toolbar when someone posts something new.
																			Notifications default on in communities where the membership is moderated - that is, private communities, or public communities where you need to ask to join. It's also on by default for any community you create.
																			 </div>
																		 </div>
																	  </div>
																	  <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4_5">5. If I moderate a post out of my community, is it deleted? </a> </h3>
																		 </div>
																		 <div id="collapse4_5" class="panel-collapse collapse">
																			<div class="panel-body">Notifications default on in communities where the membership is moderated - that is, private communities, or public communities where you need to ask to join. It's also on by default for any community you create.A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
																		 </div>
																	  </div>
																	  <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4_6">6. Are community names unique? If someone else has a "Software" community, does that prevent me from owning one? </a> </h3>
																		 </div>
																		 <div id="collapse4_6" class="panel-collapse collapse">
																			<div class="panel-body"> They may not see your invites if they don’t have you in their circles, or if they’ve limited the “Who can send you notifications?” setting. Learn more about who can send you notifications. They may not see your invites if they don’t have you in their circles, or if they’ve limited the “Who can send you notifications?” setting. Learn more about who can send you notifications.
																			 </div>
																		 </div>
																	  </div>
																	  <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4_7">7. How can I control how many community invitations I receive? </a> </h3>
																		 </div>
																		 <div id="collapse4_7" class="panel-collapse collapse">
																			<div class="panel-body">A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
																		 </div>
																	  </div>
																   </div>
															   </div>
															   <div class="tab-pane" id="tab5" style="margin-top:30px;">
																  <div class="panel-group" id="accordion">
																	  <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5_1">1. If I post to a public community, does that mean all my friends and followers can see it? </a> </h3>
																		 </div>
																		 <div id="collapse5_1" class="panel-collapse collapse">
																			<div class="panel-body"> No, the posts you share to a public community will not show up in your friends and followers’ Home streams, unless your friends and followers are also members of the same community.
																			Your public community posts will be visible to people who navigate to your profile page unless you have set your settings for them not to appear. Visitors will see text indicating that it was shared to a community.
																			Remember that your private community posts will only be visible to people in those communities, regardless of whether or not you show community posts on your profile. </div>
																		 </div>
																	  </div>
																	  <div class="panel panel-success">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5_2">2. How can I control whether my public community posts appear on my profile page? </a> </h3>
																		 </div>
																		 <div id="collapse5_2" class="panel-collapse collapse">
																			<div class="panel-body"> While in communities:
																				Place your cursor in the top left corner for the main menu.
																				Select  Settings.
																				Scroll to 'Profile'.
																				Check or uncheck the box next to Show your Google+ communities posts on your Google+ profile
																			 </div>
																		 </div>
																	  </div>
																	  <div class="panel panel-info">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5_3">3. Can I change my community from public to private, or vice versa? </a> </h3>
																		 </div>
																		 <div id="collapse5_3" class="panel-collapse collapse">
																			<div class="panel-body">You can turn your community notifications on or off by clicking on the  icon on a community’s page.
																			Community members can use notifications to know when new things are shared with their communities. If notifications are On you’ll get a notification by email, on your device, and by the Google toolbar when someone posts something new. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
																		 </div>
																	  </div>
																	  <div class="panel panel-warning">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5_4">4. Why aren't people seeing my invites? </a> </h3>
																		 </div>
																		 <div id="collapse5_4" class="panel-collapse collapse">
																			<div class="panel-body"> You can turn your community notifications on or off by clicking on the  icon on a community’s page.
																			Community members can use notifications to know when new things are shared with their communities. If notifications are On you’ll get a notification by email, on your device, and by the Google toolbar when someone posts something new.
																			Notifications default on in communities where the membership is moderated - that is, private communities, or public communities where you need to ask to join. It's also on by default for any community you create.
																			 </div>
																		 </div>
																	  </div>
																	  <div class="panel panel-danger">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5_5">5. If I moderate a post out of my community, is it deleted? </a> </h3>
																		 </div>
																		 <div id="collapse5_5" class="panel-collapse collapse">
																			<div class="panel-body">Notifications default on in communities where the membership is moderated - that is, private communities, or public communities where you need to ask to join. It's also on by default for any community you create.A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
																		 </div>
																	  </div>
																	  <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5_6">6. Are community names unique? If someone else has a "Software" community, does that prevent me from owning one? </a> </h3>
																		 </div>
																		 <div id="collapse5_6" class="panel-collapse collapse">
																			<div class="panel-body"> They may not see your invites if they don’t have you in their circles, or if they’ve limited the “Who can send you notifications?” setting. Learn more about who can send you notifications. They may not see your invites if they don’t have you in their circles, or if they’ve limited the “Who can send you notifications?” setting. Learn more about who can send you notifications.
																			 </div>
																		 </div>
																	  </div>
																	  <div class="panel panel-default">
																		 <div class="panel-heading">
																			<h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5_7">7. How can I control how many community invitations I receive? </a> </h3>
																		 </div>
																		 <div id="collapse5_7" class="panel-collapse collapse">
																			<div class="panel-body">A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. A communit's privacy settings currently can't be changed once it's been created. Please pick your desired setting from the start. </div>
																		 </div>
																	  </div>
																   </div>
															   </div>

																   </div>
															   </div>
															</div>
															<!-- /FAQ -->
														<div class="divide-40"></div>
											   </div>
                                                                                           <!-- /HELP -->
											</div>
										</div>
										<!-- /USER PROFILE -->
									</div>
								</div>
							</div>
						</div>
						
						<div class="footer-tools">
							<span class="go-top">
								<i class="fa fa-chevron-up"></i> Top
							</span>
						</div>
					</div><!-- /CONTENT-->
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
	<!-- SLIMSCROLL -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/js/jQuery-slimScroll-1.3.0/slimScrollHorizontal.min.js');?>"></script>
	<!-- BLOCK UI -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/jQuery-BlockUI/jquery.blockUI.min.js');?>"></script>
	<!-- EASY PIE CHART -->
	<script src="<?php echo base_url('resources/js/jquery-easing/jquery.easing.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('resources/js/easypiechart/jquery.easypiechart.min.js');?>"></script>
	<!-- SPARKLINES -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/sparklines/jquery.sparkline.min.js');?>"></script>
        <!-- INPUT MASK -->
        <script type="text/javascript" src="<?php echo base_url('resources/js/bootstrap-inputmask/bootstrap-inputmask.min.js');?>"></script>
	<!-- UNIFORM -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/uniform/jquery.uniform.min.js');?>"></script>
        <!-- TYPEHEAD -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/typeahead/typeahead.min.js');?>"></script>
        <!-- AUTOSIZE -->
        <script type="text/javascript" src="<?php echo base_url('resources/js/autosize/jquery.autosize.min.js');?>"></script>
        <!-- COUNTABLE -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/countable/jquery.simplyCountable.min.js');?>"></script>
	<!-- COOKIE -->
	<script type="text/javascript" src="<?php echo base_url('resources/js/jQuery-Cookie/jquery.cookie.min.js');?>"></script>
	<!-- CUSTOM SCRIPT -->
	<script src="<?php echo base_url('resources/js/script.js');?>"></script>
	<script>
		jQuery(document).ready(function() {		
			App.setPage("user_profile");  //Set current page
			App.init(); //Initialise plugins and elements
                        
                        <?php 
                        $message_type = "";
                        $message="";
                        if($this->session->flashdata('upload_error1'))
                        {
                                $message = strip_tags($this->session->flashdata('upload_error1'))." ";
                                $message_type = 'error';
                        }
                        else if($this->session->flashdata('upload_error2'))
                        {
                                $message .= strip_tags($this->session->flashdata('upload_error2'));
                                $message_type = 'error';
                        }
                        else if($this->session->flashdata('upload_success'))
                        {
                                $message .= $this->session->flashdata('upload_success');
                                $message_type = 'success';
                        }
                        ?>
                        <?php if($message_type=='error'):?>
                            var mytheme = "flat";
                            var mypos = "messenger-on-top messenger-on-right";
                            //Set theme
                            Messenger.options = {
                                    extraClasses: 'messenger-fixed '+mypos,
                                    theme: mytheme
                            }
                            Messenger().post({
                                    message: "<?php echo $message;?>",
                                    type: "error",
                                    showCloseButton: true
                            });
                        <?php endif; ?>
                        <?php if($message_type=='success'):?>
                            var mytheme = "flat";
                            var mypos = "messenger-on-top messenger-on-right";
                            //Set theme
                            Messenger.options = {
                                    extraClasses: 'messenger-fixed '+mypos,
                                    theme: mytheme
                            }
                            Messenger().post({
                                    message: "<?php echo $message;?>",
                                    showCloseButton: true
                            });
                        <?php endif; ?>
                        
                        jQuery('textarea.autosize').autosize();
                        jQuery('.countable').simplyCountable({maxCount:250});
                        jQuery('#bloodgroup').typeahead({
                                name: 'bloodgroup',
                                local: ["A1 -ve", "A1 +ve", "A1B -ve", "A1B +ve", "A2 -ve", "A2 +ve", "A2B -ve", "A2B +ve", "B -ve", "B +ve", "B1 +ve", "O -ve", "O +ve"]
                        });
                        jQuery('#nationality').typeahead({
                                name: 'nationality',
                                local: ["African", "American", "Argentinian", "Australian", "Bangladesh(i)", "British", "Chinese", "Indian", "Indonesian", "Iranian", "Iraqi", "Irish", "Israeli", "Japanese", "Russian", "Thai"]
                        });
                        /* Update Profile Button Click Event */
                        jQuery("#btn_update_profile").click(function(){
                           var el = jQuery(this).parents(".box");
                           App.blockUI(el);
                           var error_flag = 0;
                           jQuery('input[name=userfile]').parent().parent().parent().removeClass("has-error");
                           jQuery('#userfile_error').text('');
                           jQuery('textarea[name=aboutMe]').parent().parent().removeClass("has-error");
                           jQuery('input[name=firstName]').parent().parent().removeClass("has-error");
                           jQuery('#firstName_error').text('');
                           jQuery('input[name=lastName]').parent().parent().removeClass("has-error");
                           jQuery('#lastName_error').text('');
                           jQuery('input[name=email]').parent().parent().removeClass("has-error");
                           jQuery('#email_error').text('');
                           jQuery('input[name=dob]').parent().parent().removeClass("has-error");
                           jQuery('#dob_error').text('');
                           
                           if(jQuery('input[name=userfile]').val()!="")
                           {
                               if(jQuery('input[name=userfile]')[0].files[0].size > 2097152)
                               {
                                    error_flag = 2;
                                    jQuery('input[name=userfile]').parent().parent().parent().addClass("has-error");
                                    jQuery('#userfile_error').text('File size should not exceed 2 MB.');
                               }
                               
                               var ext = $('input[name=userfile]').val().split('.').pop().toLowerCase();
                               if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
                               {
                                    error_flag = 2;
                                    jQuery('input[name=userfile]').parent().parent().parent().addClass("has-error");
                                    jQuery('#userfile_error').text('Invalid file extension.');
                               }
                           }
                            
                           if(parseInt(jQuery("span#counter").text())<0)
                           {
                               error_flag = 2;
                               jQuery('textarea[name=aboutMe]').parent().parent().addClass("has-error");
                           }    
                           if(jQuery.trim(jQuery('input[name=firstName]').val())=="")
                           {
                               error_flag = 1;
                               jQuery('input[name=firstName]').parent().parent().addClass("has-error");
                               jQuery('#firstName_error').text('This field is required.');
                           }
                           if(jQuery.trim(jQuery('input[name=lastName]').val())=="")
                           {
                               error_flag = 1;
                               jQuery('input[name=lastName]').parent().parent().addClass("has-error");
                               jQuery('#lastName_error').text('This field is required.');
                           }
                           var re = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
                           if(!re.test(jQuery('input[name=email]').val()) && jQuery.trim(jQuery('input[name=email]').val())!="")
                           {
                               error_flag = 1;
                               jQuery('input[name=email]').parent().parent().addClass("has-error");
                               jQuery('#email_error').text('This email address is invalid.');
                           } 
                           var re = /^\d{4}-((0\d)|(1[012]))-(([012]\d)|3[01])$/; // RE for birthdate (yyyy-mm-dd)
                           if(!re.test(jQuery('input[name=dob]').val()) && jQuery.trim(jQuery('input[name=dob]').val())!="")
                           {
                               error_flag = 1;
                               jQuery('input[name=dob]').parent().parent().addClass("has-error");
                               jQuery('#dob_error').text('This date is invalid.');
                           }    
                           if(error_flag == 1)
                           {
                               App.scrollTo();
                           }
                           if(error_flag == 0)
                           {
                               jQuery('form#user_profile_form').submit();
                           }
                           if(error_flag!=0)
                           {
                               App.unblockUI(el);
                           }
                        });
                        
                        /* Update Account Button Click Event */
                        jQuery("#btn_update_account").click(function(){
                            var el = jQuery(this).parents(".box");
                            App.blockUI(el);
                            var error_flag = 0;
                            jQuery('input[name=curr_username]').parent().parent().removeClass("has-error");
                            jQuery('#curr_username_error').text('');
                            jQuery('input[name=curr_password]').parent().parent().removeClass("has-error");
                            jQuery('#curr_pass_error').text('');
                            jQuery('input[name=new_password]').parent().parent().removeClass("has-error");
                            jQuery('input[name=con_new_password]').parent().parent().removeClass("has-error");
                            jQuery('#con_new_pass_error').text('');
                            
                            if(jQuery.trim(jQuery('input[name=curr_username]').val())=="")
                            {
                                error_flag = 1;
                                jQuery('input[name=curr_username]').parent().parent().addClass("has-error");
                                jQuery('#curr_username_error').text('This field is compulsory.');
                            }
                            if(jQuery.trim(jQuery('input[name=curr_password]').val())=="")
                            {
                                error_flag = 1;
                                jQuery('input[name=curr_password]').parent().parent().addClass("has-error");
                                jQuery('#curr_pass_error').text('This field is compulsory.');
                            }
                            if(jQuery.trim(jQuery('input[name=new_password]').val())!="")
                            {
                                if(jQuery('input[name=new_password]').val() != jQuery('input[name=con_new_password]').val())
                                {
                                    error_flag = 1;
                                    jQuery('input[name=new_password]').parent().parent().addClass("has-error");
                                    jQuery('input[name=con_new_password]').parent().parent().addClass("has-error");
                                    jQuery('#con_new_pass_error').text('Passwords do not match.');
                                }
                            }
                            if(error_flag==0)
                            {
                                var multilanguage = jQuery('input[name=multilanguage]:checked', '#user_account_form').val();
                                var dataString = 'currUsername='+jQuery('input[name=curr_username]').val()+'&currPassword='+jQuery('input[name=curr_password]').val()+'&multilanguage='+multilanguage;
                                if(jQuery.trim(jQuery('input[name=new_username]').val())!="")
                                    dataString += '&newUsername='+jQuery('input[name=new_username]').val();
                                if(jQuery.trim(jQuery('input[name=new_password]').val())!="")
                                    dataString += '&newPassword='+jQuery('input[name=new_password]').val();
                             
                                var url = "<?php echo base_url('secure/update_account');?>";
                                jQuery.ajax({
                                     type: "POST",
                                     url: url,
                                     data: dataString, // serializes the form's elements.
                                     success: function(data)
                                     {
                                         var mytheme = "flat";
                                         var mypos = "messenger-on-top messenger-on-right";
                                         //Set theme
                                         Messenger.options = {
                                                 extraClasses: 'messenger-fixed '+mypos,
                                                 theme: mytheme
                                         }
                                         if(data=="all_good")
                                         {
                                             //Call
                                             Messenger().post({
                                                     message:"Information Saved!",
                                                     showCloseButton: true
                                             });
                                         }
                                         else
                                         {
                                             //Call
                                             Messenger().post({
                                                     message:data,
                                                     type: "error",
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
                        
                        jQuery("input[name=new_password]").on('input',function(e){
                            if(jQuery.trim(jQuery('input[name=new_password]').val())!="" && jQuery('input[name=con_new_password]').parent().parent().hasClass("hide"))
                            {
                                jQuery('input[name=con_new_password]').parent().parent().removeClass("hide");
                            }
                            else if(jQuery.trim(jQuery('input[name=new_password]').val())=="")
                            {
                                jQuery('input[name=con_new_password]').val('');
                                jQuery('input[name=con_new_password]').parent().parent().addClass("hide");
                            }    
                        });
                        
                        /* Toggling of left menu in help tab */
                        jQuery("#pro_help #list-toggle a.list-group-item").click(function(){
                            var index = jQuery("#pro_help #list-toggle a.list-group-item").index(this);
                            jQuery("#pro_help #list-toggle a.list-group-item").removeClass('active');
                            jQuery("#pro_help #list-toggle a.list-group-item").eq(index).addClass('active');
                        });
		});
	</script>
        
        
        <!-- COMMON END FOOTER JAVASCRIPT INCLUDES -->
	<?php include_once('templates/common_end_footer_scripts.php');?>
       
	<!-- /JAVASCRIPTS -->
</body>
</html>