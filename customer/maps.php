<?php include './../layouts/session.php'; ?>
<?php

if(isset($_SESSION["islogged"])){

    if($_SESSION['user']=='admin'){
        header('location: ./../admin/dashboard.php');
    }else if($_SESSION['user']=='saloon'){
        header('location: ./../saloon/dashboard.php');
    }
}else{
    header('location: ./../login.php');
}
?>

<?php

if(isset($_SESSION['success'])){
    echo '
                            <div class="alert btn-success message-alert"> '
        .$_SESSION['success'].'
                            </div>';
    unset($_SESSION['success']);
}

if(isset($_SESSION['error'])){
    echo '
                            <div class="alert btn-danger message-alert"> '
        .$_SESSION['error'].'
                            </div>';
    unset($_SESSION['error']);
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include './../layouts/header.php'; ?>


<style>
    body {
        padding: 0;
        margin: 0;
    }

    html,
    body,
    #map {
        height: 100%;
        position: sticky !important;
    }

</style>
<body style="display: flex">
<div style="width:100%;display:flex;background: #2d3035;">
    <?php include './../layouts/navbar.php'; ?>

    <div class="page-content">
        <div class="page-header no-margin-bottom">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Maps</h2>
            </div>
        </div>
       <div id="map"></div>
    </div>

</div>
<script src="../maps/JS/maps.js" type="text/javascript"></script>
<?php include('./../layouts/footer.php') ?>
</body>

</html>

