 <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar theme-horizontal menu-light">
        <div class="navbar-wrapper container">
            <div class="navbar-content sidenav-horizontal" id="layout-sidenav">
                <ul class="nav pcoded-inner-navbar sidenav-inner">
                    <!-- <li class="nav-item pcoded-menu-caption">
                    	<label>Dashboard</label>
                    </li> -->
                    <li class="nav-item">
                        <a href="index.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Page layouts</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="layout-vertical.php" target="_blank">Vertical</a></li>
                            <li><a href="layout-horizontal.php" target="_blank">Horizontal</a></li>
                        </ul>
                    </li>
                    <li class="nav-item pcoded-menu-caption">
                    <label>Academic</label>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Board</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="board_details.php">Board List</a></li>
                        <li><a href="medium_deatils.php">Medium List</a></li>
                        <li><a href="class_details.php">Class List</a></li>
                        <li><a href="subject_details.php">Subject List</a></li>
                        <li><a href="chapters_details.php">Chapters List</a></li>
                        <li><a href="topics_details.php">Topics List</a></li>
                        <li><a href="question_type.php">Question Type</a></li>
                        <li><a href="question_bank.php">Question Bank </a></li>
                    </ul>
                </li>
                <!-- Class Managment Here -->
                <li class="nav-item pcoded-hasmenu">    
                <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext"> Class Management</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="student_details.php">Student List</a></li>
                        <li><a href="batch_details.php">Batch List</a></li>
                        <li><a href="test_details.php">Test List</a></li>
                        <li><a href="chapters_details.php">Attandance List</a></li>
                    </ul>
                </li>
                <!-- End Class Managment -->
                <!-- Test Managment Here -->
                <li class="nav-item pcoded-hasmenu">    
                <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext"> Test Management</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="#">MCQ (CBSE) List</a></li>
                        <li><a href="#">Objective (MHSB) List</a></li>
                        <li><a href="#">Premlims List</a></li>
                    </ul>
                </li>
                <!-- End Test Managment -->
                <!-- Test Managment Here -->
                <li class="nav-item pcoded-hasmenu">    
                <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext"> Report Management</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="#">Daily Reports List</a></li>
                        <li><a href="#">Weekly Report List</a></li>
                        <li><a href="#">Unit I List</a></li>
                        <li><a href="#">Semi One List</a></li>
                        <li><a href="#">Unit II  List</a></li>
                        <li><a href="#">Final List</a></li>
                    </ul>
                </li>
                <!-- End Test Managment -->    

                </ul>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->
    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">
        <div class="container">
            <div class="m-header">
                <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
                <a href="#!" class="b-brand">
                    <!-- ========   change your logo hear   ============ -->
                    <img src="assets/images/logo.png" alt="" class="logo">
                    <img src="assets/images/logo-icon.png" alt="" class="logo-thumb">
                </a>
                <a href="#!" class="mob-toggler">
                    <i class="feather icon-more-vertical"></i>
                </a>
            </div>
            <div class="collapse navbar-collapse">
               <!--  <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                        <div class="search-bar">
                            <input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
                            <button type="button" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </li>
                </ul> -->
                <ul class="navbar-nav ml-auto">
                    <li>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                                <i class="icon feather icon-bell"></i>
                                <span class="badge badge-pill badge-danger">5</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right notification">
                                <div class="noti-head">
                                    <h6 class="d-inline-block m-b-0">Notifications</h6>
                                    <div class="float-right">
                                        <a href="#!" class="m-r-10">mark as read</a>
                                        <a href="#!">clear all</a>
                                    </div>
                                </div>
                                <ul class="noti-body">
                                    <li class="n-title">
                                        <p class="m-b-0">NEW</p>
                                    </li>
                                    <li class="notification">
                                        <div class="media">
                                            <img class="img-radius" src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <p><strong>John Doe</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>5 min</span></p>
                                                <p>New ticket Added</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="n-title">
                                        <p class="m-b-0">EARLIER</p>
                                    </li>
                                    <li class="notification">
                                        <div class="media">
                                            <img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>10 min</span></p>
                                                <p>Prchace New Theme and make payment</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="notification">
                                        <div class="media">
                                            <img class="img-radius" src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>12 min</span></p>
                                                <p>currently login</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="notification">
                                        <div class="media">
                                            <img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                                <p>Prchace New Theme and make payment</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="noti-footer">
                                    <a href="#!">show all</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown drp-user">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="feather icon-user"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-notification">
                                <div class="pro-head">
                                    <img src="assets/images/user/avatar-1.jpg" class="img-radius" alt="User-Profile-Image">
                                    <span>John Doe</span>
                                    <a href="auth-signin.html" class="dud-logout" title="Logout">
                                        <i class="feather icon-log-out"></i>
                                    </a>
                                </div>
                                <ul class="pro-body">
                                    <li><a href="user-profile.html" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                                    <li><a href="email_inbox.html" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li>
                                    <li><a href="auth-signin.html" class="dropdown-item"><i class="feather icon-lock"></i> Lock Screen</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- [ Header ] end -->
