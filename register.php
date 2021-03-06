<?php include 'layouts/session.php';
if(isset($_SESSION["islogged"])){

    if($_SESSION['user']=='admin'){
        header('location: ./admin/dashboard.php');
    }else if($_SESSION['user']=='saloon'){
        header('location: ./saloon/dashboard.php');
    }
    else if($_SESSION['user']=='customer'){
        header('location: ./customer/dashboard.php');
    }
}
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Find A Saloon</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="assets/assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="assets/assets/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="assets/assets/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="assets/assets/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="assets/assets/css/custom.css">
    <link rel="stylesheet" href="assets/assets/css/chats.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="assets/assets/img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9] -->

</head>

<?php include 'layouts/header.php'; ?>
<body style="background: darkslategrey">


<div style="width:100%;position:absolute;">
    <div class="row justify-content-center register-card">
        <div class="col-md-8">
            <div class="card" style="height: auto;">
                <div class="card-header" style="border-bottom: 1px dark solid;">Register User</div>

                <div class="card-body">
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

                    <form id="regForm" method="POST" action="customRegister.php" onsubmit="return sendForm()">
                        <input name="register" value="register" hidden>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Account Type</label>

                            <div class="col-md-6">
                                <select type="text" class="form-control" name="accountType" required>
                                    <option value="">Select account type</option>
                                    <option value="business">Business Account</option>
                                    <option value="customer">Customer Account</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control is-invalid" name="name" onkeypress="return /[a-z]/i.test(event.key)" required autocomplete="false">
                            </div>
                            <span class="text-center" role="alert" style="display: block">
                            </span>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control is-invalid" name="email" maxlength="30" onkeyup="validateEmail()"  required autocomplete="off">
                            </div>
                            <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="verifyEmail"></strong>
                            </span>
                        </div>


                        <div class="form-group row regNo" >
                            <label class="col-md-4 col-form-label text-md-right">Registration No</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control is-invalid regNo" name="regNo" minlength="8" maxlength="13" onkeypress="return /[0-9]/i.test(event.key)" autocomplete="off">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">Mobile</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control is-invalid" name="mobile" onkeyup="validateMobile('mobile')" onkeypress="return /[0-9]/i.test(event.key)" required autocomplete="off">
                            </div>
                            <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="verifyMobile"></strong>
                            </span>
                        </div>



                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password&nbsp;</label>

                            <div  class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" placeholder="e.g 1234*Abcd" minlength="8" onkeyup="createPassword()" required autocomplete="off">
                                <span class="fa fa-eye" style="margin-top: -30px;position: absolute;right: 25px;"></span>
                            </div>

                            <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="verifyPass"></strong>
                            </span>
                        </div>



                        <div class="form-group row">
                            <label for="passwordMatch" class="col-md-4 col-form-label text-md-right">Confirm Password&nbsp;</label>

                            <div class="col-md-6">
                                <input id="passwordMatch" type="password" class="form-control" name="passwordMatch" minlength="8" onkeyup="matchPassword()" required autocomplete="off">
                            </div>
                            <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="verifyMatch"></strong>
                            </span>
                        </div>



<!--                        <div class="form-group row">-->
<!--                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Account Type') }}</label>-->
<!---->
<!--                            <div class="col-md-6">-->
<!--                                <select name="role" class="form-control is-invalid" required>-->
<!--                                    <option value="" selected disabled>{{ __('Choose Account Type') }}</option>-->
<!--                                    <option value="2" >{{ __('Employer') }}</option>-->
<!--                                    <option value="3" >{{ __('Job Seeker') }}</option>-->
<!--                                </select>-->
<!--                            </div>-->
<!--                        </div>-->




                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success form-control text-white">
                                    Register
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'layouts/footer.php'; ?>
</body>
</html>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/assets/js/custom.js"></script>


