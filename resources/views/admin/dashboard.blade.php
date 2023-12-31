<!-- Main Header -->
@include('admin.layouts.header')
<!-- Sidebar -->
@include('admin.layouts.sidebar')
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
   <div class="pcoded-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
         <div class="page-block">
            <div class="row align-items-center">
               <div class="col-md-12">
                  <div class="page-header-title">
                     <h5 class="m-b-10">Dashboard Analytics</h5>
                  </div>
                  <ul class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                     <li class="breadcrumb-item"><a href="#!">Home</a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <!-- [ breadcrumb ] end -->
      <!-- [ Main Content ] start -->
      <div class="row">
         <!-- table card-1 start -->
         <div class="col-md-12 col-xl-3">
            <div class="card flat-card">
               <div class="row-table">
                  <div class="col-sm-6 card-body br">
                     <div class="row">
                        <!--                                 <div class="col-sm-4">
                           <i class="icon feather icon-eye text-c-green mb-1 d-block"></i>
                           </div> -->
                        <div class="col-sm-8 text-md-center">
                           <h5><?php echo $board_count;?></h5>
                           <span>All Board</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- widget primary card start -->
            <!--<div class="card flat-card widget-primary-card">-->
            <!--    <div class="row-table">-->
            <!--        <div class="col-sm-3 card-body">-->
            <!--            <i class="feather icon-star-on"></i>-->
            <!--        </div>-->
            <!--        <div class="col-sm-9">-->
            <!--            <h4>4000 +</h4>-->
            <!--            <h6>Ratings Received</h6>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!-- widget primary card end -->
         </div>
         <!-- table card-1 end -->
         <!-- table card-2 start -->
         <div class="col-md-12 col-xl-3">
            <div class="card flat-card">
               <div class="row-table">
                  <div class="col-sm-6 card-body br">
                     <div class="row">
                        <!--  <div class="col-sm-4">
                           <i class="icon feather icon-share-2 text-c-blue mb-1 d-block"></i>
                           </div> -->
                        <div class="col-sm-8 text-md-center">
                           <h5><?php echo $medium_count;?></h5>
                           <span>All Medium </span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- widget-success-card start -->
            <!--<div class="card flat-card widget-purple-card">-->
            <!--    <div class="row-table">-->
            <!--        <div class="col-sm-3 card-body">-->
            <!--            <i class="fas fa-trophy"></i>-->
            <!--        </div>-->
            <!--        <div class="col-sm-9">-->
            <!--            <h4>17</h4>-->
            <!--            <h6>Achievements</h6>-->
            <!--        </div>-->
            <!--    </div> -->
            <!--</div>-->
            <!-- widget-success-card end -->
         </div>
         <!-- table card-2 end -->
         <!-- table card-2 start -->
         <div class="col-md-12 col-xl-3">
            <div class="card flat-card">
               <div class="row-table">
                  <div class="col-sm-6 card-body br">
                     <div class="row">
                        <!--  <div class="col-sm-4">
                           <i class="icon feather icon-share-2 text-c-blue mb-1 d-block"></i>
                           </div> -->
                        <div class="col-sm-8 text-md-center">
                           <h5><?php echo $class_count;?></h5>
                           <span>All Class </span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- widget-success-card start -->
            <!--<div class="card flat-card widget-primary-card">-->
            <!--    <div class="row-table">-->
            <!--        <div class="col-sm-3 card-body">-->
            <!--            <i class="fas fa-trophy"></i>-->
            <!--        </div>-->
            <!--        <div class="col-sm-9">-->
            <!--            <h4>17</h4>-->
            <!--            <h6>Achievements</h6>-->
            <!--        </div>-->
            <!--    </div> -->
            <!--</div>-->
            <!-- widget-success-card end -->
         </div>
         <div class="col-md-12 col-xl-3">
            <div class="card flat-card">
               <div class="row-table">
                  <div class="col-sm-6 card-body br">
                     <div class="row">
                        <!--  <div class="col-sm-4">
                           <i class="icon feather icon-share-2 text-c-blue mb-1 d-block"></i>
                           </div> -->
                        <div class="col-sm-8 text-md-center">
                           <h5><?php echo $subject_count;?></h5>
                           <span>All Subjects </span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- widget-success-card start -->
            <!--<div class="card flat-card widget-primary-card">-->
            <!--    <div class="row-table">-->
            <!--        <div class="col-sm-3 card-body">-->
            <!--            <i class="fas fa-trophy"></i>-->
            <!--        </div>-->
            <!--        <div class="col-sm-9">-->
            <!--            <h4>17</h4>-->
            <!--            <h6>Achievements</h6>-->
            <!--        </div>-->
            <!--    </div> -->
            <!--</div>-->
            <!-- widget-success-card end -->
         </div>
         <!-- seo start -->
         <!--<div class="col-xl-4 col-md-12">-->
         <!--    <div class="card">-->
         <!--        <div class="card-body">-->
         <!--            <div class="row align-items-center">-->
         <!--                <div class="col-6">-->
         <!--                    <h3>$16,756</h3>-->
         <!--                    <h6 class="text-muted m-b-0">Visits<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>-->
         <!--                </div>-->
         <!--   <div class="col-6"> -->
         <!--                    <div id="seo-chart1" class="d-flex align-items-end"></div>-->
         <!--                </div> -->
         <!--            </div>-->
         <!--        </div>-->
         <!--    </div>-->
         <!--</div>-->
         <!--<div class="col-xl-4 col-md-6">-->
         <!--    <div class="card">-->
         <!--        <div class="card-body">-->
         <!--            <div class="row align-items-center">-->
         <!--                <div class="col-6">-->
         <!--                    <h3>49.54%</h3>-->
         <!--                    <h6 class="text-muted m-b-0">Bounce Rate<i class="fa fa-caret-up text-c-green m-l-10"></i></h6>-->
         <!--                </div>-->
         <!--  <div class="col-6">-->
         <!--                    <div id="seo-chart2" class="d-flex align-items-end"></div>-->
         <!--                </div> -->
         <!--            </div>-->
         <!--        </div>-->
         <!--    </div>-->
         <!--</div>-->
         <!--<div class="col-xl-4 col-md-6">-->
         <!--    <div class="card">-->
         <!--        <div class="card-body">-->
         <!--            <div class="row align-items-center">-->
         <!--                <div class="col-6">-->
         <!--                    <h3>1,62,564</h3>-->
         <!--                    <h6 class="text-muted m-b-0">Products<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>-->
         <!--                </div>-->
         <!--  <div class="col-6">-->
         <!--                    <div id="seo-chart3" class="d-flex align-items-end"></div>-->
         <!--                </div> -->
         <!--            </div>-->
         <!--        </div>-->
         <!--    </div>-->
         <!--</div>-->
         <!-- seo end -->
         <!-- prject ,team member start -->
         <!--<div class="col-xl-6 col-md-12">-->
         <!--    <div class="card table-card">-->
         <!--        <div class="card-header">-->
         <!--            <h5>Projects</h5>-->
         <!--            <div class="card-header-right">-->
         <!--                <div class="btn-group card-option">-->
         <!--                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
         <!--                        <i class="feather icon-more-horizontal"></i>-->
         <!--                    </button>-->
         <!--                    <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">-->
         <!--                        <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>-->
         <!--                        <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>-->
         <!--                        <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>-->
         <!--                        <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>-->
         <!--                    </ul>-->
         <!--                </div>-->
         <!--            </div>-->
         <!--        </div>-->
         <!--        <div class="card-body p-0">-->
         <!--            <div class="table-responsive">-->
         <!--                <table class="table table-hover mb-0">-->
         <!--                    <thead>-->
         <!--                        <tr>-->
         <!--                            <th>-->
         <!--                                <div class="chk-option">-->
         <!--                                    <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">-->
         <!--                                        <input type="checkbox" class="custom-control-input">-->
         <!--                                        <span class="custom-control-label"></span>-->
         <!--                                    </label>-->
         <!--                                </div>-->
         <!--                                Assigned-->
         <!--                            </th>-->
         <!--                            <th>Name</th>-->
         <!--                            <th>Due Date</th>-->
         <!--                            <th class="text-right">Priority</th>-->
         <!--                        </tr>-->
         <!--                    </thead>-->
         <!--                    <tbody>-->
         <!--                        <tr>-->
         <!--                            <td>-->
         <!--                                <div class="chk-option">-->
         <!--                                    <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">-->
         <!--                                        <input type="checkbox" class="custom-control-input">-->
         <!--                                        <span class="custom-control-label"></span>-->
         <!--                                    </label>-->
         <!--                                </div>-->
         <!--                                <div class="d-inline-block align-middle">-->
         <!--                                    <img src="{{asset('public/assets/images/user/avatar-4.jpg')}}" alt="user image" class="img-radius wid-40 align-top m-r-15">-->
         <!--                                    <div class="d-inline-block">-->
         <!--                                        <h6>John Deo</h6>-->
         <!--                                        <p class="text-muted m-b-0">Graphics Designer</p>-->
         <!--                                    </div>-->
         <!--                                </div>-->
         <!--                            </td>-->
         <!--                            <td>Able Pro</td>-->
         <!--                            <td>Jun, 26</td>-->
         <!--                            <td class="text-right"><label class="badge badge-light-danger">Low</label></td>-->
         <!--                        </tr>-->
         <!--                        <tr>-->
         <!--                            <td>-->
         <!--                                <div class="chk-option">-->
         <!--                                    <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">-->
         <!--                                        <input type="checkbox" class="custom-control-input">-->
         <!--                                        <span class="custom-control-label"></span>-->
         <!--                                    </label>-->
         <!--                                </div>-->
         <!--                                <div class="d-inline-block align-middle">-->
         <!--                                    <img src="assets/images/user/avatar-2.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">-->
         <!--                                    <div class="d-inline-block">-->
         <!--                                        <h6>Jenifer Vintage</h6>-->
         <!--                                        <p class="text-muted m-b-0">Web Designer</p>-->
         <!--                                    </div>-->
         <!--                                </div>-->
         <!--                            </td>-->
         <!--                            <td>Mashable</td>-->
         <!--                            <td>March, 31</td>-->
         <!--                            <td class="text-right"><label class="badge badge-light-primary">high</label></td>-->
         <!--                        </tr>-->
         <!--                        <tr>-->
         <!--                            <td>-->
         <!--                                <div class="chk-option">-->
         <!--                                    <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">-->
         <!--                                        <input type="checkbox" class="custom-control-input">-->
         <!--                                        <span class="custom-control-label"></span>-->
         <!--                                    </label>-->
         <!--                                </div>-->
         <!--                                <div class="d-inline-block align-middle">-->
         <!--                                    <img src="assets/images/user/avatar-3.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">-->
         <!--                                    <div class="d-inline-block">-->
         <!--                                        <h6>William Jem</h6>-->
         <!--                                        <p class="text-muted m-b-0">Developer</p>-->
         <!--                                    </div>-->
         <!--                                </div>-->
         <!--                            </td>-->
         <!--                            <td>Flatable</td>-->
         <!--                            <td>Aug, 02</td>-->
         <!--                            <td class="text-right"><label class="badge badge-light-success">medium</label></td>-->
         <!--                        </tr>-->
         <!--                        <tr>-->
         <!--                            <td>-->
         <!--                                <div class="chk-option">-->
         <!--                                    <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">-->
         <!--                                        <input type="checkbox" class="custom-control-input">-->
         <!--                                        <span class="custom-control-label"></span>-->
         <!--                                    </label>-->
         <!--                                </div>-->
         <!--                                <div class="d-inline-block align-middle">-->
         <!--                                    <img src="{{asset('public/assets/images/user/avatar-2.jpg')}}" alt="user image" class="img-radius wid-40 align-top m-r-15">-->
         <!--                                    <div class="d-inline-block">-->
         <!--                                        <h6>David Jones</h6>-->
         <!--                                        <p class="text-muted m-b-0">Developer</p>-->
         <!--                                    </div>-->
         <!--                                </div>-->
         <!--                            </td>-->
         <!--                            <td>Guruable</td>-->
         <!--                            <td>Sep, 22</td>-->
         <!--                            <td class="text-right"><label class="badge badge-light-primary">high</label></td>-->
         <!--                        </tr>-->
         <!--                    </tbody>-->
         <!--                </table>-->
         <!--            </div>-->
         <!--        </div>-->
         <!--    </div>-->
         <!--</div>-->
         <!--<div class="col-xl-6 col-md-12">-->
         <!--    <div class="card latest-update-card">-->
         <!--        <div class="card-header">-->
         <!--            <h5>Latest Updates</h5>-->
         <!--            <div class="card-header-right">-->
         <!--                <div class="btn-group card-option">-->
         <!--                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
         <!--                        <i class="feather icon-more-horizontal"></i>-->
         <!--                    </button>-->
         <!--                    <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">-->
         <!--                        <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>-->
         <!--                        <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>-->
         <!--                        <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>-->
         <!--                        <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>-->
         <!--                    </ul>-->
         <!--                </div>-->
         <!--            </div>-->
         <!--        </div>-->
         <!--        <div class="card-body">-->
         <!--            <div class="latest-update-box">-->
         <!--                <div class="row p-t-30 p-b-30">-->
         <!--                    <div class="col-auto text-right update-meta">-->
         <!--                        <p class="text-muted m-b-0 d-inline-flex">2 hrs ago</p>-->
         <!--                        <i class="feather icon-twitter bg-twitter update-icon"></i>-->
         <!--                    </div>-->
         <!--                    <div class="col">-->
         <!--                        <a href="#!">-->
         <!--                            <h6>+ 1652 Followers</h6>-->
         <!--                        </a>-->
         <!--                        <p class="text-muted m-b-0">You’re getting more and more followers, keep it up!</p>-->
         <!--                    </div>-->
         <!--                </div>-->
         <!--                <div class="row p-b-30">-->
         <!--                    <div class="col-auto text-right update-meta">-->
         <!--                        <p class="text-muted m-b-0 d-inline-flex">4 hrs ago</p>-->
         <!--                        <i class="feather icon-briefcase bg-c-red update-icon"></i>-->
         <!--                    </div>-->
         <!--                    <div class="col">-->
         <!--                        <a href="#!">-->
         <!--                            <h6>+ 5 New Products were added!</h6>-->
         <!--                        </a>-->
         <!--                        <p class="text-muted m-b-0">Congratulations!</p>-->
         <!--                    </div>-->
         <!--                </div>-->
         <!--                <div class="row p-b-0">-->
         <!--                    <div class="col-auto text-right update-meta">-->
         <!--                        <p class="text-muted m-b-0 d-inline-flex">2 day ago</p>-->
         <!--                        <i class="feather icon-facebook bg-facebook update-icon"></i>-->
         <!--                    </div>-->
         <!--                    <div class="col">-->
         <!--                        <a href="#!">-->
         <!--                            <h6>+1 Friend Requests</h6>-->
         <!--                        </a>-->
         <!--                        <p class="text-muted m-b-10">This is great, keep it up!</p>-->
         <!--                        <div class="table-responsive">-->
         <!--                            <table class="table table-hover">-->
         <!--                                <tr>-->
         <!--                                    <td class="b-none">-->
         <!--                                        <a href="#!" class="align-middle">-->
         <!--                                            <img src="{{asset('public/assets/images/user/avatar-2.jpg')}}" alt="user image" class="img-radius wid-40 align-top m-r-15">-->
         <!--                                            <div class="d-inline-block">-->
         <!--                                                <h6>Jeny William</h6>-->
         <!--                                                <p class="text-muted m-b-0">Graphic Designer</p>-->
         <!--                                            </div>-->
         <!--                                        </a>-->
         <!--                                    </td>-->
         <!--                                </tr>-->
         <!--                            </table>-->
         <!--                        </div>-->
         <!--                    </div>-->
         <!--                </div>-->
         <!--            </div>-->
         <!--            <div class="text-center">-->
         <!--                <a href="#!" class="b-b-primary text-primary">View all Projects</a>-->
         <!--            </div>-->
         <!--        </div>-->
         <!--    </div>-->
         <!--</div>-->
         <!-- prject ,team member start -->
      </div>
      <!-- [ Main Content ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
         <!-- table card-1 start -->
         <div class="col-md-12 col-xl-3">
            <div class="card flat-card">
               <div class="row-table">
                  <div class="col-sm-6 card-body br">
                     <div class="row">
                        <!--                                 <div class="col-sm-4">
                           <i class="icon feather icon-eye text-c-green mb-1 d-block"></i>
                           </div> -->
                        <div class="col-sm-8 text-md-center">
                           <h5><?php echo $chapter_count;?></h5>
                           <span>All Chapter</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- widget primary card start -->
            <!--<div class="card flat-card widget-primary-card">-->
            <!--    <div class="row-table">-->
            <!--        <div class="col-sm-3 card-body">-->
            <!--            <i class="feather icon-star-on"></i>-->
            <!--        </div>-->
            <!--        <div class="col-sm-9">-->
            <!--            <h4>4000 +</h4>-->
            <!--            <h6>Ratings Received</h6>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!-- widget primary card end -->
         </div>
         <!-- table card-1 end -->
         <!-- table card-2 start -->
         <div class="col-md-12 col-xl-3">
            <div class="card flat-card">
               <div class="row-table">
                  <div class="col-sm-6 card-body br">
                     <div class="row">
                        <!--  <div class="col-sm-4">
                           <i class="icon feather icon-share-2 text-c-blue mb-1 d-block"></i>
                           </div> -->
                        <div class="col-sm-8 text-md-center">
                           <h5><?php echo $topic_count;?></h5>
                           <span>All Topics </span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- widget-success-card start -->
            <!--<div class="card flat-card widget-purple-card">-->
            <!--    <div class="row-table">-->
            <!--        <div class="col-sm-3 card-body">-->
            <!--            <i class="fas fa-trophy"></i>-->
            <!--        </div>-->
            <!--        <div class="col-sm-9">-->
            <!--            <h4>17</h4>-->
            <!--            <h6>Achievements</h6>-->
            <!--        </div>-->
            <!--    </div> -->
            <!--</div>-->
            <!-- widget-success-card end -->
         </div>
         <!-- table card-2 end -->
         <!-- table card-2 start -->
         <div class="col-md-12 col-xl-3">
            <div class="card flat-card">
               <div class="row-table">
                  <div class="col-sm-6 card-body br">
                     <div class="row">
                        <!--  <div class="col-sm-4">
                           <i class="icon feather icon-share-2 text-c-blue mb-1 d-block"></i>
                           </div> -->
                        <div class="col-sm-8 text-md-center">
                           <h5><?php echo $question_type_count;?></h5>
                           <span>All Question Type </span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- widget-success-card start -->
            <!--<div class="card flat-card widget-primary-card">-->
            <!--    <div class="row-table">-->
            <!--        <div class="col-sm-3 card-body">-->
            <!--            <i class="fas fa-trophy"></i>-->
            <!--        </div>-->
            <!--        <div class="col-sm-9">-->
            <!--            <h4>17</h4>-->
            <!--            <h6>Achievements</h6>-->
            <!--        </div>-->
            <!--    </div> -->
            <!--</div>-->
            <!-- widget-success-card end -->
         </div>
         <!-- seo start -->
         <div class="col-md-12 col-xl-3">
            <div class="card flat-card">
               <div class="row-table">
                  <div class="col-sm-6 card-body br">
                     <div class="row">
                        <!--  <div class="col-sm-4">
                           <i class="icon feather icon-share-2 text-c-blue mb-1 d-block"></i>
                           </div> -->
                        <div class="col-sm-8 text-md-center">
                           <h5><?php echo $question_bank_count;?></h5>
                           <span>All Question List </span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- widget-success-card start -->
            <!--<div class="card flat-card widget-primary-card">-->
            <!--    <div class="row-table">-->
            <!--        <div class="col-sm-3 card-body">-->
            <!--            <i class="fas fa-trophy"></i>-->
            <!--        </div>-->
            <!--        <div class="col-sm-9">-->
            <!--            <h4>17</h4>-->
            <!--            <h6>Achievements</h6>-->
            <!--        </div>-->
            <!--    </div> -->
            <!--</div>-->
            <!-- widget-success-card end -->
         </div>
         <!--<div class="col-xl-4 col-md-12">-->
         <!--    <div class="card">-->
         <!--        <div class="card-body">-->
         <!--            <div class="row align-items-center">-->
         <!--                <div class="col-6">-->
         <!--                    <h3>$16,756</h3>-->
         <!--                    <h6 class="text-muted m-b-0">Visits<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>-->
         <!--                </div>-->
         <!--   <div class="col-6"> -->
         <!--                    <div id="seo-chart1" class="d-flex align-items-end"></div>-->
         <!--                </div> -->
         <!--            </div>-->
         <!--        </div>-->
         <!--    </div>-->
         <!--</div>-->
         <!--<div class="col-xl-4 col-md-6">-->
         <!--    <div class="card">-->
         <!--        <div class="card-body">-->
         <!--            <div class="row align-items-center">-->
         <!--                <div class="col-6">-->
         <!--                    <h3>49.54%</h3>-->
         <!--                    <h6 class="text-muted m-b-0">Bounce Rate<i class="fa fa-caret-up text-c-green m-l-10"></i></h6>-->
         <!--                </div>-->
         <!--  <div class="col-6">-->
         <!--                    <div id="seo-chart2" class="d-flex align-items-end"></div>-->
         <!--                </div> -->
         <!--            </div>-->
         <!--        </div>-->
         <!--    </div>-->
         <!--</div>-->
         <!--<div class="col-xl-4 col-md-6">-->
         <!--    <div class="card">-->
         <!--        <div class="card-body">-->
         <!--            <div class="row align-items-center">-->
         <!--                <div class="col-6">-->
         <!--                    <h3>1,62,564</h3>-->
         <!--                    <h6 class="text-muted m-b-0">Products<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>-->
         <!--                </div>-->
         <!--  <div class="col-6">-->
         <!--                    <div id="seo-chart3" class="d-flex align-items-end"></div>-->
         <!--                </div> -->
         <!--            </div>-->
         <!--        </div>-->
         <!--    </div>-->
         <!--</div>-->
         <!-- seo end -->
         <!-- prject ,team member start -->
         <!--<div class="col-xl-6 col-md-12">-->
         <!--    <div class="card table-card">-->
         <!--        <div class="card-header">-->
         <!--            <h5>Projects</h5>-->
         <!--            <div class="card-header-right">-->
         <!--                <div class="btn-group card-option">-->
         <!--                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
         <!--                        <i class="feather icon-more-horizontal"></i>-->
         <!--                    </button>-->
         <!--                    <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">-->
         <!--                        <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>-->
         <!--                        <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>-->
         <!--                        <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>-->
         <!--                        <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>-->
         <!--                    </ul>-->
         <!--                </div>-->
         <!--            </div>-->
         <!--        </div>-->
         <!--        <div class="card-body p-0">-->
         <!--            <div class="table-responsive">-->
         <!--                <table class="table table-hover mb-0">-->
         <!--                    <thead>-->
         <!--                        <tr>-->
         <!--                            <th>-->
         <!--                                <div class="chk-option">-->
         <!--                                    <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">-->
         <!--                                        <input type="checkbox" class="custom-control-input">-->
         <!--                                        <span class="custom-control-label"></span>-->
         <!--                                    </label>-->
         <!--                                </div>-->
         <!--                                Assigned-->
         <!--                            </th>-->
         <!--                            <th>Name</th>-->
         <!--                            <th>Due Date</th>-->
         <!--                            <th class="text-right">Priority</th>-->
         <!--                        </tr>-->
         <!--                    </thead>-->
         <!--                    <tbody>-->
         <!--                        <tr>-->
         <!--                            <td>-->
         <!--                                <div class="chk-option">-->
         <!--                                    <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">-->
         <!--                                        <input type="checkbox" class="custom-control-input">-->
         <!--                                        <span class="custom-control-label"></span>-->
         <!--                                    </label>-->
         <!--                                </div>-->
         <!--                                <div class="d-inline-block align-middle">-->
         <!--                                    <img src="{{asset('public/assets/images/user/avatar-4.jpg')}}" alt="user image" class="img-radius wid-40 align-top m-r-15">-->
         <!--                                    <div class="d-inline-block">-->
         <!--                                        <h6>John Deo</h6>-->
         <!--                                        <p class="text-muted m-b-0">Graphics Designer</p>-->
         <!--                                    </div>-->
         <!--                                </div>-->
         <!--                            </td>-->
         <!--                            <td>Able Pro</td>-->
         <!--                            <td>Jun, 26</td>-->
         <!--                            <td class="text-right"><label class="badge badge-light-danger">Low</label></td>-->
         <!--                        </tr>-->
         <!--                        <tr>-->
         <!--                            <td>-->
         <!--                                <div class="chk-option">-->
         <!--                                    <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">-->
         <!--                                        <input type="checkbox" class="custom-control-input">-->
         <!--                                        <span class="custom-control-label"></span>-->
         <!--                                    </label>-->
         <!--                                </div>-->
         <!--                                <div class="d-inline-block align-middle">-->
         <!--                                    <img src="assets/images/user/avatar-2.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">-->
         <!--                                    <div class="d-inline-block">-->
         <!--                                        <h6>Jenifer Vintage</h6>-->
         <!--                                        <p class="text-muted m-b-0">Web Designer</p>-->
         <!--                                    </div>-->
         <!--                                </div>-->
         <!--                            </td>-->
         <!--                            <td>Mashable</td>-->
         <!--                            <td>March, 31</td>-->
         <!--                            <td class="text-right"><label class="badge badge-light-primary">high</label></td>-->
         <!--                        </tr>-->
         <!--                        <tr>-->
         <!--                            <td>-->
         <!--                                <div class="chk-option">-->
         <!--                                    <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">-->
         <!--                                        <input type="checkbox" class="custom-control-input">-->
         <!--                                        <span class="custom-control-label"></span>-->
         <!--                                    </label>-->
         <!--                                </div>-->
         <!--                                <div class="d-inline-block align-middle">-->
         <!--                                    <img src="assets/images/user/avatar-3.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">-->
         <!--                                    <div class="d-inline-block">-->
         <!--                                        <h6>William Jem</h6>-->
         <!--                                        <p class="text-muted m-b-0">Developer</p>-->
         <!--                                    </div>-->
         <!--                                </div>-->
         <!--                            </td>-->
         <!--                            <td>Flatable</td>-->
         <!--                            <td>Aug, 02</td>-->
         <!--                            <td class="text-right"><label class="badge badge-light-success">medium</label></td>-->
         <!--                        </tr>-->
         <!--                        <tr>-->
         <!--                            <td>-->
         <!--                                <div class="chk-option">-->
         <!--                                    <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">-->
         <!--                                        <input type="checkbox" class="custom-control-input">-->
         <!--                                        <span class="custom-control-label"></span>-->
         <!--                                    </label>-->
         <!--                                </div>-->
         <!--                                <div class="d-inline-block align-middle">-->
         <!--                                    <img src="{{asset('public/assets/images/user/avatar-2.jpg')}}" alt="user image" class="img-radius wid-40 align-top m-r-15">-->
         <!--                                    <div class="d-inline-block">-->
         <!--                                        <h6>David Jones</h6>-->
         <!--                                        <p class="text-muted m-b-0">Developer</p>-->
         <!--                                    </div>-->
         <!--                                </div>-->
         <!--                            </td>-->
         <!--                            <td>Guruable</td>-->
         <!--                            <td>Sep, 22</td>-->
         <!--                            <td class="text-right"><label class="badge badge-light-primary">high</label></td>-->
         <!--                        </tr>-->
         <!--                    </tbody>-->
         <!--                </table>-->
         <!--            </div>-->
         <!--        </div>-->
         <!--    </div>-->
         <!--</div>-->
         <!--<div class="col-xl-6 col-md-12">-->
         <!--    <div class="card latest-update-card">-->
         <!--        <div class="card-header">-->
         <!--            <h5>Latest Updates</h5>-->
         <!--            <div class="card-header-right">-->
         <!--                <div class="btn-group card-option">-->
         <!--                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
         <!--                        <i class="feather icon-more-horizontal"></i>-->
         <!--                    </button>-->
         <!--                    <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">-->
         <!--                        <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>-->
         <!--                        <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>-->
         <!--                        <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>-->
         <!--                        <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>-->
         <!--                    </ul>-->
         <!--                </div>-->
         <!--            </div>-->
         <!--        </div>-->
         <!--        <div class="card-body">-->
         <!--            <div class="latest-update-box">-->
         <!--                <div class="row p-t-30 p-b-30">-->
         <!--                    <div class="col-auto text-right update-meta">-->
         <!--                        <p class="text-muted m-b-0 d-inline-flex">2 hrs ago</p>-->
         <!--                        <i class="feather icon-twitter bg-twitter update-icon"></i>-->
         <!--                    </div>-->
         <!--                    <div class="col">-->
         <!--                        <a href="#!">-->
         <!--                            <h6>+ 1652 Followers</h6>-->
         <!--                        </a>-->
         <!--                        <p class="text-muted m-b-0">You’re getting more and more followers, keep it up!</p>-->
         <!--                    </div>-->
         <!--                </div>-->
         <!--                <div class="row p-b-30">-->
         <!--                    <div class="col-auto text-right update-meta">-->
         <!--                        <p class="text-muted m-b-0 d-inline-flex">4 hrs ago</p>-->
         <!--                        <i class="feather icon-briefcase bg-c-red update-icon"></i>-->
         <!--                    </div>-->
         <!--                    <div class="col">-->
         <!--                        <a href="#!">-->
         <!--                            <h6>+ 5 New Products were added!</h6>-->
         <!--                        </a>-->
         <!--                        <p class="text-muted m-b-0">Congratulations!</p>-->
         <!--                    </div>-->
         <!--                </div>-->
         <!--                <div class="row p-b-0">-->
         <!--                    <div class="col-auto text-right update-meta">-->
         <!--                        <p class="text-muted m-b-0 d-inline-flex">2 day ago</p>-->
         <!--                        <i class="feather icon-facebook bg-facebook update-icon"></i>-->
         <!--                    </div>-->
         <!--                    <div class="col">-->
         <!--                        <a href="#!">-->
         <!--                            <h6>+1 Friend Requests</h6>-->
         <!--                        </a>-->
         <!--                        <p class="text-muted m-b-10">This is great, keep it up!</p>-->
         <!--                        <div class="table-responsive">-->
         <!--                            <table class="table table-hover">-->
         <!--                                <tr>-->
         <!--                                    <td class="b-none">-->
         <!--                                        <a href="#!" class="align-middle">-->
         <!--                                            <img src="{{asset('public/assets/images/user/avatar-2.jpg')}}" alt="user image" class="img-radius wid-40 align-top m-r-15">-->
         <!--                                            <div class="d-inline-block">-->
         <!--                                                <h6>Jeny William</h6>-->
         <!--                                                <p class="text-muted m-b-0">Graphic Designer</p>-->
         <!--                                            </div>-->
         <!--                                        </a>-->
         <!--                                    </td>-->
         <!--                                </tr>-->
         <!--                            </table>-->
         <!--                        </div>-->
         <!--                    </div>-->
         <!--                </div>-->
         <!--            </div>-->
         <!--            <div class="text-center">-->
         <!--                <a href="#!" class="b-b-primary text-primary">View all Projects</a>-->
         <!--            </div>-->
         <!--        </div>-->
         <!--    </div>-->
         <!--</div>-->
         <!-- prject ,team member start -->
      </div>
      <!-- [ Main Content ] end -->
   </div>
</div>
<!-- [ Main Content ] end -->
<!-- Footer -->
@include('admin.layouts.footer')