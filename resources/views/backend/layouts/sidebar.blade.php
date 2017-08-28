<?php
$thisAdminRightsString = Auth::User()->rights;
$thisAdminRightsArray = explode(",", $thisAdminRightsString);

$userDataArray	=	Auth::User();;

?>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">

            <a class="site_title" href="{{ backend_url('dashboard') }}"><i class="fa fa-paw"></i> {{ constants('global.site.name') }}</a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile">
            <div class="profile_pic">
            
                <img src="{{ backend_asset('img.jpg')}}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>Admin</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">

                    {{--<li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li>
                      <a href="{{ backend_url('dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
                                </ul>
                            </li>--}}

                            <li> <a href="{{ backend_url('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                            <?php if (Auth::User()->userType == 'admin') { ?>

                                <li>
                                <a><i class="fa fa-group fa-fw"></i> Admins <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                <li><a href="{{ backend_url('admin') }}"> View SubAdmin</a></li>
                                <li><a href="{{ backend_url('admin/add') }}"> Add SubAdmin</a></li>
                                </ul>
                                </li>
                            <?php } ?> 
                            <?php if (in_array('user', $thisAdminRightsArray)) { ?>       <?php } ?> 
                            <li>
                                <a><i class="fa fa-group fa-fw"></i> User <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ backend_url('user') }}"> View User</a></li>
                                    <li><a href="{{ backend_url('user/add') }}"> Add User</a></li>
                                </ul>
                            </li>
                            <li>
                                    <a><i class="fa fa-shopping-basket fa-fw"></i> Orders <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ backend_url('orders') }}"> View Orders</a></li>
                                    </ul>
                            </li>

                            <?php if (in_array('product', $thisAdminRightsArray)) { ?>  
                                <li>
                                    <a><i class="fa fa-shopping-basket fa-fw"></i> Products <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ backend_url('product') }}"> View Products</a></li>
                                        <li><a href="{{ backend_url('product/add') }}"> Add Products</a></li>
                                    </ul>
                                </li>

                            <?php } ?>  
                            

                            <?php if (in_array('category', $thisAdminRightsArray)) { ?>        
                                <li>
                                    <a><i class="fa fa-list fa-fw"></i> Categories <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ backend_url('category') }}"> View Categories</a></li>
                                        <li><a href="{{ backend_url('category/add') }}"> Add Category</a></li>
                                    </ul>
                                </li>
                                
                                <li>
                                    <a><i class="fa fa-list fa-fw"></i> Sub Categories <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ backend_url('subcategory') }}"> View Sub Categories</a></li>
                                        <li><a href="{{ backend_url('subcategory/add') }}"> Add Sub Categories</a></li>
                                    </ul>
                                </li>
                            <?php } ?>   
                            <?php if (in_array('brand', $thisAdminRightsArray)) { ?>        
                                <li>
                                    <a><i class="fa fa-list fa-fw"></i> Brands <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ backend_url('category') }}"> View Brands</a></li>
                                        <li><a href="{{ backend_url('category/add') }}"> Add Brand</a></li>
                                    </ul>
                                </li>
                                
                                
                            <?php } ?>  
                            <?php if (in_array('cms', $thisAdminRightsArray)) { ?><?php } ?>   
                            
							<li><a><i class="fa fa-book fa-book"></i> Feedbacks <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ backend_url('feedback') }}"> View Feedbacks</a></li>
                                </ul>
                            </li>
                    <li>
                        <a><i class="fa fa-picture-o"></i> Slider <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ backend_url('slider') }}"> Image List</a></li>
                            <li><a href="{{ backend_url('slider/add') }}"> Add New</a></li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-picture-o"></i> Advertisement <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ backend_url('advertisement') }}"> Image List</a></li>
                            {{--<li><a href="{{ backend_url('slider/add') }}"> Add New</a></li>--}}
                        </ul>
                    </li>
                            <li><a><i class="fa fa-book fa-book"></i> Cms <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ backend_url('cms') }}"> Pages List</a></li>
                                    <li><a href="{{ backend_url('cms/add') }}"> Add New</a></li>
                                </ul>
                            </li>
                            
                            


                            {{--<li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="form.html">General Form</a></li>
                      <li><a href="form_advanced.html">Advanced Components</a></li>
                      <li><a href="form_validation.html">Form Validation</a></li>
                      <li><a href="form_wizards.html">Form Wizard</a></li>
                      <li><a href="form_upload.html">Form Upload</a></li>
                      <li><a href="form_buttons.html">Form Buttons</a></li>
                    </ul>
                  </                            li>
                                            <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
                        <u                        l class="nav child_menu">
                            <li><a href=                            "general_elements.html">General Elemen                            ts</a></li>
                            <li><a href="media_gallery.html">M                                                      edia Gallery</a></li>
                            <li><a                            href="typography.html">Typog                                   raphy</a></li>
                            <li><a href=                            "icons.h                            tml">Icons</a>                            </li>
                            <li><a href="glyph                                                        icons.html">Glyp                            hicons</a></li>
                            <li><a href="widgets.htm                                l">Widgets                            </a></li>
                            <li><a href="inv                            oice.html">Inv                            oice                                                      </a></li>
                            <li><a href="inbox.html">Inbox</a></                                                      li>
                            <li>                                  <a href="calen                            dar.html">Calendar</a></                                                li>
                                </ul>
                                                                    </li>
                                                    <li><a                        ><i class="fa fa-t                    able"></i> Tables <span cl                    ass="fa fa-chevron-down"                    ></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tables.html">Tables</a></li>
                      <li><a href="tables_dynamic.html">Table Dynamic</a></li>
                    </ul>
                                                                                                                                                        </li>
                                                            <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="chartjs.html">Chart JS</a></li>
                      <li><a href="chartjs2.html">Chart JS2</a></li>
                      <li><a href="morisjs.html">Moris JS</a></li>
                      <li><a href="echarts.html">ECharts</a></li>
                      <li><a href="other_charts.html">Other Charts</a></li>
                    </ul>
                                                                                                                                              </li>
                                                    <li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
                                                                    <ul class="n                                                        av child_menu">
                                                        <li><a href="f                                                        ixed_sidebar.html">Fixed Sidebar</                                                                a></li>
                                                                                <li><a href=                                            "fixed_footer.html">Fixed Footer</a></li>
                                                                            </ul>
                                            </                                                    li>--}}
                                                    </ul>
                                                    </div>
                                                    {{--<div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="e_commerce.html">E-commerce</a></li>
                      <li><a href="projects.html">Projects</a></li>
                      <li><a href="project_detail.html">Project Detail</a></li>
                      <li><a href="contacts.html">Contacts</a></li>
                      <li><a href="profile.html">Profile</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="page_403.html">403 Error</a></li>
                      <li><a href="page_404.html">404 Error</a></li>
                      <li><a href="page_500.html">500 Error</a></li>
                      <li><a href="plain_page.html">Plain Page</a></li>
                      <li><a href="login.html">Login Page</a></li>
                      <li><a href="pricing_tables.html">Pricing Tables</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li>                  
                  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                </ul>
              </div>--}}

                                            </div>
                                            <!-- /sidebar menu -->

                                            <!-- /menu footer buttons -->
                                            <div class="sidebar-footer hidden-small">
                                                <a data-toggle="tooltip" data-placement="top" title="Settings">
                                                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                                                </a>
                                                <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                                                    <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                                                </a>
                                                <a data-toggle="tooltip" data-placement="top" title="Lock">
                                                    <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                                                </a>
                                                <a data-toggle="tooltip" data-placement="top" title="Logout">
                                                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                                                </a>
                                            </div>
                                            <!-- /menu footer buttons -->
                                            </div>
                                            </div>

                                            <!-- top navigation -->
                                            <div class="top_nav">
                                                <div class="nav_menu">
                                                    <nav>
                                                        <div class="nav toggle">
                                                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                                                        </div>

                                                        <ul class="nav navbar-nav navbar-right">
                                                            <li class="">
                                                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                    <img src="{{ backend_asset('img.jpg')}}" alt="">{{$userDataArray->first_name}}
                                                                    <span class=" fa fa-angle-down"></span>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                                                    
                                                                    <li><a href="{{ backend_url('logout') }}"><i class="fa fa-sign-out pull-right"></i> Logout</a></li>
                                                                </ul>
                                                            </li>


                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                            <!-- /top navigation -->

