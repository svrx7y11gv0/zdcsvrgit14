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
                   <div class="tab-pane active" id="tab1">
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
                                                <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1_4"><strong> 81 -- Privilege value of a Class Teacher</strong></a> </h3>
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
                                                <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1_5"><strong> 80 -- Privilege value of Subject Teacher</strong></a> </h3>
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
                                                <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1_8"><strong> 8 -- Privilege value of Guardian / Parent</strong></a> </h3>
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
                                  <div class="panel panel-default">
                                         <div class="panel-heading">
                                                <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1_9"><strong> 4 -- Privilege value of Student</strong></a> </h3>
                                         </div>
                                         <div id="collapse1_9" class="panel-collapse collapse">
                                                <div class="panel-body"> 
                                                    Privilege value of 4 gives student following rights: 
                                                    <ul>

                                                    </ul> 
                                                 </div>
                                         </div>
                                  </div>
                                  <div class="panel panel-default">
                                         <div class="panel-heading">
                                                <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1_10"><strong> 2 -- Privilege value of Alumni</strong></a> </h3>
                                         </div>
                                         <div id="collapse1_10" class="panel-collapse collapse">
                                                <div class="panel-body"> 
                                                    Privilege value of 2 gives alumni following rights: 
                                                    <ul>

                                                    </ul> 
                                                 </div>
                                         </div>
                                  </div>
                           </div>
                   </div>
                   <div class="tab-pane" id="tab2">
                          <div class="panel-group" id="accordion">
                                  <div class="panel panel-default">
                                         <div class="panel-heading">
                                                <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2_1">1. Screen resolution can be adjusted very easily. </a> </h3>
                                         </div>
                                         <div id="collapse2_1" class="panel-collapse collapse in">
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
                                                <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2_2">2. Slow Internet? </a> </h3>
                                         </div>
                                         <div id="collapse2_2" class="panel-collapse collapse in">
                                                <div class="panel-body"> If you are facing problem in loading time of edbeans pages, then disabling multi-language support may help to improve the loading time because multi-language support requires high speed Internet connection.
                                                    In order to disable multi-language support go to Accounts Settings / Edit Account and select disable multi-language support.
                                                 </div>
                                         </div>
                                  </div>

                           </div>
                   </div>
                   <div class="tab-pane" id="tab3">
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
                   <div class="tab-pane" id="tab4">
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
                   <div class="tab-pane" id="tab5">
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