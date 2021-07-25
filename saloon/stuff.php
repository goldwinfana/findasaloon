<?php include './../layouts/session.php'; ?>
<?php

if(isset($_SESSION["islogged"])){

    if($_SESSION['user']=='admin'){
        header('location: ./../admin/dashboard.php');
    }else if($_SESSION['user']=='customer'){
        header('location: ./../customer/dashboard.php');
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
<body style="display: flex">
<div style="width:100%;display:flex;background: #2d3035;">
    <?php include './../layouts/navbar.php'; ?>

    <!--    {{--BODY --}}-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Admin Dashboard</h2>
            </div>
        </div>

        <div style="margin:15px">
            <button class="btn btn-primary add-staff">Add Staff</button>
        </div>


        <!--        {{--Table--}}-->

        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">

                    <table id="ticket_table" class="table table-bordered" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Staff Number</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="students">

                        <?php

                        $init = $pdo->open();
                        $sql = $init->prepare("SELECT * FROM staff,saloon WHERE staff.saloonID=saloon.id AND saloonID=:id");
                        $sql->execute(['id'=>$_SESSION['id']]);

                        if($sql->rowCount() > 0){
                            foreach ($sql as $data){

                                echo '
                                     <tr>
                                        <td>'.$data["staffName"].'</td>
                                        <td>'.$data["staffName"].'</td>
                                        <td>'.$data["staffEmail"].'</td>
                                        <td>
                                            <div class="d-flex" >
                                                <a id="'.$data["stuffID"].'" class="contributions bg-warning text-white action_spans edit-student" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a id="'.$data["stuffID"].'" class="contributions bg-danger text-white action_spans delete-student" title="Delete"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                     </tr>
                                ';
                            }

                        }
                        $pdo->close();
                        ?>

                        </tbody>

                    </table>

                </div>
            </div>
        </section>

        <!--        {{--        ENd Table--}}-->
    </div>
    <!--    {{--END BODY--}}-->
</div>

<?php include('./../layouts/footer.php') ?>
<script src="saloon.js"></script>
</body>
</html>



