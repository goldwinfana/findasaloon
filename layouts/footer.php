
<footer class="footer">
    <div class="footer__block block no-margin-bottom">
        <div class="container-fluid text-center">
            <p class="no-margin-bottom">2021 &copy; <strong>The Find A Saloon Team</strong>.</p>
        </div>
    </div>
</footer>
<?php
if(isset($_SESSION['islogged'])) {

    if($_SESSION['user']=='customer'){
        include('./../customer/modal.php');
    }else if($_SESSION['user']=='admin'){
        include('./../admin/modal.php');
    }else{
        include('./../saloon/modal.php');
    }
    include('./../layouts/scripts.php');
}?>

<script>
    setTimeout(function () {
        $('.message-alert').fadeOut('slow');
    },8000);


    $('.upload-image').on('click', function () {
        $('#upload-image').modal('show');
    });
</script>





