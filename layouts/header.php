
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Find A Saloon</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">
        <meta name="_token" content="{{{ csrf_token() }}}"/>
        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="../assets/assets/vendor/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome CSS-->
        <link rel="stylesheet" href="../assets/assets/vendor/font-awesome/css/font-awesome.min.css">
        <!-- Custom Font Icons CSS-->
        <link rel="stylesheet" href="../assets/assets/css/font.css">
        <!-- Google fonts - Muli-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
        <!-- theme stylesheet-->
        <link rel="stylesheet" href="../assets/assets/css/style.default.css" id="theme-stylesheet">
        <!-- Custom stylesheet - for your changes-->
        <link rel="stylesheet" href="../assets/assets/css/custom.css">
        <link rel="stylesheet" href="../assets/assets/css/chats.css">
        <!-- Favicon-->
        <link rel="shortcut icon" href="../assets/assets/img/favicon.ico">
        <!-- Tweaks for older IEs--><!--[if lt IE 9] -->

        <!-- Load Leaflet: http://leafletjs.com/ -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" integrity="sha512-M2wvCLH6DSRazYeZRIm1JnYyh22purTM+FDB5CsyxtQJYeKq83arPe5wgbNmcFXGqiSH2XR8dT/fJISVA1r/zQ==" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js" integrity="sha512-lInM/apFSqyy1o6s89K4iQUKg6ppXEgsVxT35HbzUupEVRh2Eu9Wdl4tHj7dZO0s1uvplcYGmt3498TtHq+log==" crossorigin=""></script>

        <!-- Esri Leaflet Plugin: https://esri.github.io/esri-leaflet/ -->
        <script src="https://unpkg.com/esri-leaflet@2.1.3/dist/esri-leaflet.js" integrity="sha512-pijLQd2FbV/7+Jwa86Mk3ACxnasfIMzJRrIlVQsuPKPCfUBCDMDUoLiBQRg7dAQY6D1rkmCcR8286hVTn/wlIg==" crossorigin=""></script>

        <!-- ESRI Renderer Plugin: https://github.com/Esri/esri-leaflet-renderers -->
        <!-- Renders feature layer using default symbology as defined by ArcGIS REST service -->
        <!-- Currently doesn't work with ESRI cluster plugin -->
        <script src="https://unpkg.com/esri-leaflet-renderers@2.0.6/dist/esri-leaflet-renderers.js" integrity="sha512-mhpdD3igvv7A/84hueuHzV0NIKFHmp2IvWnY5tIdtAHkHF36yySdstEVI11JZCmSY4TCvOkgEoW+zcV/rUfo0A==" crossorigin=""></script>

        <!-- Load Leaflet Basemap Providers: https://github.com/leaflet-extras/leaflet-providers -->
        <!-- Modified to include USGS TNM web services -->
        <script src="../maps/JS/leaflet-providers.js"></script>

        <!-- 2.5D OSM Buildings Classic: https://github.com/kekscom/osmbuildings -->
        <script src="https://cdn.osmbuildings.org/OSMBuildings-Leaflet.js"></script>

        <!-- Load Font Awesome icons -->
        <script src="https://use.fontawesome.com/a64989e3a8.js"></script>

        <!-- Grouped Layer Plugin: https://github.com/ismyrnow/leaflet-groupedlayercontrol  -->
        <link rel="stylesheet" href="../maps/CSS/leaflet.groupedlayercontrol.min.css">
        <script src="../maps/JS/leaflet.groupedlayercontrol.min.js" type="text/javascript"></script>


        <!-- Overview mini map Plugin: https://github.com/Norkart/Leaflet-MiniMap -->
        <link rel="stylesheet" href="../maps/CSS/Control.MiniMap.css">
        <script src="../maps/JS/Control.MiniMap.min.js" type="text/javascript"></script>

        <!-- Leaflet Drawing Plugin: https://github.com/codeofsumit/leaflet.pm -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet.pm@latest/dist/leaflet.pm.css">
        <script src="https://unpkg.com/leaflet.pm@latest/dist/leaflet.pm.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Leaflet WMS Plugin: https://github.com/heigeo/leaflet.wms -->
        <script src="../maps/JS/leaflet.wms.js"></script>

        <!-- Logo Credit Plugin: https://github.com/gregallensworth/L.Control.Credits -->
        <link rel="stylesheet" href="../maps/CSS/leaflet-control-credits.css" />
        <script type="text/javascript" src="../maps/JS/leaflet-control-credits.js"></script>

    </head>
    <?php

//    if(isset($_SESSION["islogged"])){
//        $_SESSION['user']=='user'? header('location: user/dashboard.php'):header('location: admin/dashboard.php');
//    }else{
//        header('location: ./../login.php');
//    }

    $pth = isset($_SESSION['islogged'])? '../assets' : 'assets';

    $img = empty(isset($_SESSION['image']))? '../assets/img/profile.png' : '../assets/img/profile/'.isset($_SESSION['image']);
    if(isset($_SESSION['islogged'])){

        $id = $_SESSION['user'] =='student'? $_SESSION['studentNo'] : $_SESSION['id'];
    }
    ?>
    <!-- Header Navigation-->
    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <div class="search-panel">
                <div class="search-inner d-flex align-items-center justify-content-center">
                    <div class="close-btn">Close <i class="fa fa-close"></i></div>
                    <form id="searchForm" action="#">
                        <div class="form-group">
                            <input type="search" name="search" placeholder="What are you searching for...">
                            <button type="submit" class="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container-fluid d-flex align-items-center justify-content-between">
                <div class="navbar-header">
                    <!-- Navbar Header-->
                    <a href="#" class="navbar-brand" style="display: flex">
                        <div class="brand-text brand-big visible text-uppercase">
                            <strong class="text-primary full-logo">Find A Saloon <i class="fa fa-location-arrow"></i></strong>
<!--                            <strong class="text-primary short-logo"><img src='--><?php //echo $pth.'/img/short-logo.png'; ?><!--' width="100"></strong>-->
                        </div>

<!--                     Sidebar Toggle Btn-->
                        <?php if(isset($_SESSION['islogged'])) {
                            echo '<button class="sidebar-toggle btn-secondary">☰</button>';
                        }?>
                    </a></div>
                <div class="right-menu list-inline no-margin-bottom">
                    <!-- Notifications-->
                    <?php
                    if(isset($_SESSION['islogged'])){

                        echo '<div hidden class="list-inline-item dropdown"><a id="navbarDropdownMenuLink1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link messages-toggle"><i class="fa fa-bell"></i><span class="badge dashbg-2">5</span></a>
                                    <div aria-labelledby="navbarDropdownMenuLink1" class="dropdown-menu messages"><a href="#" class="dropdown-item message d-flex align-items-center">
                                            <div class="profile"><img src="img/avatar-3.jpg" alt="..." class="img-fluid">
                                                <div class="status online"></div>
                                            </div>
                                            <div class="content">   <strong class="d-block">Nadia Halsey</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">9:30am</small></div></a><a href="#" class="dropdown-item message d-flex align-items-center">
                                            <div class="profile"><img src="img/avatar-2.jpg" alt="..." class="img-fluid">
                                                <div class="status away"></div>
                                            </div>
                                            <div class="content">   <strong class="d-block">Peter Ramsy</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">7:40am</small></div></a><a href="#" class="dropdown-item message d-flex align-items-center">
                                            <div class="profile"><img src="img/avatar-1.jpg" alt="..." class="img-fluid">
                                                <div class="status busy"></div>
                                            </div>
                                            <div class="content">   <strong class="d-block">Sam Kaheil</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">6:55am</small></div></a><a href="#" class="dropdown-item message d-flex align-items-center">
                                            <div class="profile"><img src="img/avatar-5.jpg" alt="..." class="img-fluid">
                                                <div class="status offline"></div>
                                            </div>
                                            <div class="content">   <strong class="d-block">Sara Wood</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">10:30pm</small></div></a><a href="#" class="dropdown-item text-center message"> <strong>See All Messages <i class="fa fa-angle-right"></i></strong></a></div>
                                </div>';

                    ?>
                <!-- End Notifications-->



                <!-- Name-->

                        <div class="list-inline-item dropdown"><?php if($_SESSION['name']) echo $_SESSION['name'] ?></div>

                <!-- End Name-->

                    <!-- Profile-->
                    <?php

                    echo '<div class="list-inline-item dropdown"><a id="navbarDropdownMenuLink3" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link messages-toggle">
                            <div class="avatar">
                                <img src="'.$img.'" alt="..." width="25" class="img-fluid rounded-circle"></div></a>
                        <div aria-labelledby="navbarDropdownMenuLink3" class="dropdown-menu messages">
                            <a id="'.$id.'" href="#" class="dropdown-item message d-flex align-items-center view-profile">
                                <div class="content">   <strong class="d-block">View Profile  <span class="fa fa-eye"></span></strong>
                                </div>
                            </a>

                            <a href="../logout.php" class="dropdown-item message d-flex align-items-center">
                                <div class="content">   <strong class="d-block">Logout  <span class="fa fa-sign-out"></span></strong>
                                </div>
                            </a>
                        </div>
                    </div>';
                }
                else{
                    echo '
                        <div class="d-flex">
                            <a href="login.php" class="dropdown-item d-flex align-items-center">Login</a>
                            <a href="register.php" class=" dropdown-item d-flex align-items-center">Register</a>
                        </div>';
                }
                ?>
<!--                    @endif-->
                </div>
            </div>
        </nav>
    </header>
    <!-- Header Navigation end-->




