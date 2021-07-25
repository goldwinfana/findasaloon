<?php include './../layouts/session.php'; include './../layouts/alerts.php';
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
                <h2 class="h5 no-margin-bottom">All Bookings</h2>
            </div>
        </div>
        <!--        {{--Table--}}-->

        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">

                    <table id="example1" class="table table-bordered" style="width: 100%;">
                        <thead>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Duration</th>
                        <th>Service</th>
                        <th>Price</th>
                        <th>Saloon</th>
                        <th>Status</th>
                        <th>Action</th>
                        </thead>
                        <tbody>

                        <?php
                        $init = $pdo->open();
                        $sql = $init->prepare("SELECT *,session.id AS bookID,session.status AS st FROM session,saloon,service 
                                                        WHERE customerID=:id 
                                                        AND session.service=service.id AND saloon.id=session.saloonID ORDER BY date");
                        $sql->execute(['id'=>$_SESSION['id']]);

                        if($sql->rowCount() > 0){
                            foreach ($sql as $data){

                                $hide= 'hidden';
                                $noView= '';
                                if($data["st"] =='cancelled'){
                                    $color = 'style="color:red"';
                                }else if($data["st"] =='complete'){
                                    $color = 'style="color:green"';
                                }else{
                                    $hide= '';
                                    $noView= 'hidden';
                                    $color = 'style="color:yellow"';
                                }

                                echo '

                                <tr>
                                    <td>'.$data["date"].'</td>
                                    <td>'.$data["startTime"].'</td>
                                    <td>'.$data["endTime"].'</td>
                                    <td>'.$data["duration"].'</td>
                                    <td>'.$data["serviceName"].'</td>
                                    <td>'.$data["price"].'</td>
                                    <td>'.$data["name"].'</td>
                                    <td '.$color.'>'.$data["st"].'</td>
                                    <td>
                                      <button '.$hide.'  class="btn btn-danger cancel-booking" id="'.$data["bookID"].'" for="'.$data["serviceName"].' @ '.$data["name"].'"><i class="fa fa-close"></i> Cancel</button>
                                      <button '.$noView.' class="btn btn-warning view-booking" id="'.$data["bookID"].'"><i class="fa fa-eye"></i> View</button>
                                   
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
<script type="text/javascript">
    $(document).ready(function () {

        $('.cancel-booking').on('click',function () {

            $('.lbl-service').text('Are you sure you want to cancel booking for '+$(this).attr('for')+'?');
            $('input[name=cancelBooking]').val(this.id);

            $('#cancelBooking').modal('show');
        });

        $('.view-booking').on('click',function () {

            window.location.href="view_booking.php?booking_id="+this.id;
        });
    });

</script>

</body>
</html>



