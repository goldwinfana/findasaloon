<?php $img = empty(isset($_SESSION['image']))? '../assets/img/profile.png' : '../assets/img/profile/'.isset($_SESSION['image']); ?>
<!-- Sidebar Navigation-->
<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="img_cont">
            <img src="<?php echo $img; ?>" class="rounded-circle user_img">
            <span class="online_icon"></span>
        </div>
<!--{{--        <div class="avatar"><img src="{{asset('ask/img/profile.png')}}" alt="..." class="img-fluid rounded-circle"></div>--}}-->
        <div class="title" style="padding: 20px;">
            <h1 class="h5"><?php if($_SESSION['user']) echo $_SESSION['user'] ?></h1>
            <p><?php if(isset($_SESSION['name'])) echo $_SESSION['name'] ?></p>
        </div>
    </div>
<!--     Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">

        <?php
        if($_SESSION['user'] == 'admin'){
            echo '
            <li class="active"><a href="./../admin/dashboard.php"> <i class="fa fa-home"></i>Home </a></li>
            <li><a id="'.$_SESSION['id'].'" class="update-user-profile edit-admin"> <i class="fa fa-user-circle"></i>Profile</a></li>
            <li><a href="./../admin/users.php" class="view-students"> <i class="fa fa-users"></i>Users</a></li>
        
       ';}

        if($_SESSION['user'] == 'customer'){
            echo '
            <li class="active"><a href="./../customer/dashboard.php"> <i class="fa fa-home"></i>Home </a></li>
            <li><a href="./bookings.php"> <i class="fa fa-first-order"></i>Bookings</a></li>
            <li><a id="'.$_SESSION['id'].'" class="update-user-profile edit-profile"> <i class="fa fa-user-circle"></i>Profile</a></li>
            <li><a href="./maps.php" class="maps"> <i class="fa fa-map"></i>Maps</a></li>
            <li ><a class="upload-image"> <i class="fa fa-search-plus"></i>Upload</a></li>
       ';}

        if($_SESSION['user'] == 'saloon'){
            echo '
            <li class="active"><a href="./../saloon/dashboard.php"> <i class="fa fa-home"></i>Home </a></li>
            <li><a id="'.$_SESSION['id'].'" class="update-user-profile edit-profile"> <i class="fa fa-user-circle"></i>Profile</a></li>
            <li hidden><a class="create-shout book-session"> <i class="fa fa-plus-circle"></i>Book Session</a></li>
            <li ><a href="stuff.php"> <i class="fa fa-users"></i>Stuff</a></li>
            <li ><a class="upload-image"> <i class="fa fa-search-plus"></i>Uploads</a></li>
            
       ';}
        ?>
        <li><a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>

    </ul>
</nav>
<!-- Sidebar Navigation end-->

<!--<li><a class="view-books"> <i class="fa fa-book"></i>Issued Books</a></li>-->
