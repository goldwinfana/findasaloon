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
                <h2 class="h5 no-margin-bottom">View Saloon</h2>
            </div>
        </div>


        <!--        {{--Table--}}-->

        <section class="" style="padding: 30px">
            <div class="container-fluid">
                <div class="row">

                  <?php
                  $saloonID = isset($_GET['saloon_id'])? $_GET['saloon_id']: 25000;
                  $categoryID = isset($_GET['category_id'])? $_GET['category_id']: 'nothing';
                  $init = $pdo->open();
                  $sql = $init->prepare("SELECT * FROM saloon WHERE id=:id");
                  $sql->execute(['id'=>$saloonID]);

                  if($sql->rowCount() > 0){
                  foreach ($sql as $data){

                  echo '
                    <div class="d-block align-items-center">
                        <strong class="d-block">
                            <a class="post-title lbl-saloon" style="color: cadetblue;">'.$data["name"].'
                            <small style="color: currentColor;background: black;padding: 5px;border-radius: 10px" class="contributions mar-5 text-white-50 font-weight-lighter"> '.$data["address"].'</small></a>

                        </strong>
                        <div class="row margin-bottom-sm margin-top-sm">
                            <div style="margin: auto;display: flex">
                                <img class="" src="./../assets/img/profile.png" style="margin-right: 100px">
                                
                                <div id="map" style="height: auto;width: 600px"></div>
                                
                            </div>

                            <div class="margin-top-sm contributions">

                                <strong class="lbl-about">About Us: '.$data["about"].'</strong><hr>
                                
                                <div style="width: 50%">
                                <p>Choose from the Categories list</p>
                                   <select class="form-control chooseCategory">
                                    <option value="" selected disabled>Select category</option>
                                   
                                   '?>

                                      <?php
                                       $categories = $init->prepare("SELECT * FROM category");
                                      $categories->execute();

                                      if($categories->rowCount() > 0) {
                                          foreach ($categories as $category) {
                                              echo ' <option value="'.$category["id"].'" onclick="updateUrl("category_id",'.$category["id"].')">'.$category["categoryName"].'</option>';
                                          }
                                      }else{
                                          echo 'No categories offered yet!!!';
                                      }

                                      ?>
                                      <?php echo '
                                   
                                   </select>
                                </div>
                                
                                <p>Services offered</p>
                                  <div class="service-offered">
                                  '?>

                                 <?php
                                    if($categoryID != 'nothing'){
                                        $services = $init->prepare("SELECT * FROM service WHERE saloonID=:id AND categoryID=:catID");
                                        $services->execute(['id'=>$saloonID,'catID'=>$categoryID]);

                                        if($services->rowCount() > 0) {
                                            foreach ($services as $service) {
                                                echo ' <span>'.$service["serviceName"].'  R'.$service["price"].'  <button id="'.$service["id"].'" class="btn btn-success book-btn"> Book</button></span>';
                                            }
                                        }else{
                                            echo 'No services offered ye!!!';
                                        }
                                    }

                               ?>
                                <?php echo '</div>

                            </div>
                        </div>

                    </div>

                  ';}
                  }else{
                      echo '<div style="margin: 200px;width: 100%;text-align: center"><h3>No Saloon Found !!!</h3></div>';
                  }
                  $pdo->close();?>
                </div>
            </div>
        </section>

<!--        {{--        ENd Table--}}-->
    </div>
<!--    {{--END BODY--}}-->
</div>


<script src="../maps/JS/drawMap.js" type="text/javascript"></script>
<?php include('./../layouts/footer.php') ?>
<script type="text/javascript">
    $(document).ready(function () {

        $('.book-btn').on('click',function () {

            $.ajax({
                type: 'POST',
                url: './sql.php',
                data: {getService:this.id},
                dataType: 'json',
                success: function(response){

                    $('.saloon').text('Saloon Name: '+response.name);
                    //$('.category').text('Category Name: '+response.categoryName);
                    $('.service').text('Service Name: '+response.serviceName);
                    $('.duration').text('Duration: '+response.duration+' Hours');
                    $('.price').text('Price: R'+response.price);

                    $('input[name=saloon]').val(response.saloonID);
                    $('input[name=category]').val(response.categoryID);
                    $('input[name=service] ').val(response.serID);
                    $('input[name=duration]').val(response.duration);
                    $('input[name=price]').val(response.price);
                }
            });

            $('#book-session').modal('show');
        });


        $('.test').on('click',function () {

            var start = $('input[name=start]').val();
            var end = $('input[name=end]').val();
            var date = $('input[name=date]').val();

            $.ajax({
                type: 'POST',
                url: './sql.php',
                data: {test:date, start:start,end:end},
                dataType: 'json',
                success: function(response){

                    console.log(response);
                }
            });

        });

        $('.view-saloon').on('click',function () {

            $('.service-offered').html('');
            $.ajax({
                type: 'POST',
                url: './sql.php',
                data: {getSaloon:this.id},
                dataType: 'json',
                success: function(response){

                    $('.lbl-saloon').html(response[0].name+
                        '<small style="color: currentColor;background: black !important;" class="contributions mar-5 text-white-50 font-weight-lighter">'+
                        response[0].address+'</small>');

                    $('.lbl-about').text('About Us: '+response[0].about);

                    $.each(response,function (key,data) {
                        $('.service-offered').append('<span>'+data.serviceName+' '+data.price+
                            '  <button id="'+data.serID+'" class="btn btn-success book-btn"> Book</button></span>');
                    });
                }
            });

            $('#view-saloon').modal('show');
        });

        $('.upload-image').on('click',function () {


            $('#upload-image').modal('show');
        });

        $('.chooseCategory').on('change',function () {

            var newUrl=updateQueryStringParameter(window.location.href,'category_id',$(this).val());
            window.history.pushState("", 'Saloon', newUrl);
            window.location.reload();
        });

    });


    function getAllStuff(id) {
        $('select[name=stuff]').html('<option value="" selected disabled>Select Available Stuff</option>');

        var start = $('input[name=start]').val();
        var end = $('input[name=end]').val();

        $.ajax({
            type: 'POST',
            url: './sql.php',
            data: {getAllStuff:id,
            start:start,
            end:end},
            dataType: 'json',
            success: function(response){
                console.log(response);
                console.log(start);
                $.each(response,function (key,data) {
                    $('select[name=stuff]').append('<option value="'+data.stuffID+'">'+data.stuffName+'</option>');
                });
            }
        });
    }

    function changeStuff() {

        $('select[name=stuff]').html('<option value="" selected disabled>Select Available Stuff</option>');
        $('.stuff').text('');

        var curDate = new Date();
        var duration = $('input[name=duration]').val();
        var date = new Date($('input[name=date-time]').val());
        if(curDate >= date){
            $('.error').css('color','red').text('Please fill in current or future date...');
            $('input[name=date]').val('');
            $('input[name=start]').val('');
            $('input[name=end]').val('');

            $('.date').text('');
            $('.start').text('');
            $('.end').text('');
        }else if(date.getHours()+parseInt(duration) > 20 || date.getHours()+parseInt(duration) <= 9){
            $('.error').css('color','red').text('Sorry you can not make your booking as saloons usually opens at 08:00 AM and close at 20:00 PM');
            $('input[name=date]').val('');
            $('input[name=start]').val('');
            $('input[name=end]').val('');

            $('.date').text('');
            $('.start').text('');
            $('.end').text('');
        }
        else{
            if(curDate==date && curDate.getHours()+2 >= date.getHours()){
                $('.error').css('color','red').text('You can only book from at least 2 hours in advance');
                $('input[name=date]').val('');
                $('input[name=start]').val('');
                $('input[name=end]').val('');

                $('.date').text('');
                $('.start').text('');
                $('.end').text('');
            }else{

                $('input[name=date]').val(date.toDateString());
                $('input[name=start]').val(date.getHours()+':00');
                $('input[name=end]').val((date.getHours()+parseInt(duration))+':00');

                $('.date').text('Date: '+date.toDateString());
                $('.start').text('Start Time: '+date.getHours()+':00');
                $('.end').text('End Time: '+(date.getHours()+parseInt(duration))+':00');
                $('.error').css('color','green').text('');

                getAllStuff($('input[name=saloon]').val());
            }

        }

    }

    function loadData(){
        $.ajax({
            type: 'POST',
            url: './sql.php',
            data: {loadData:1},
            dataType: 'json',
            success: function(response){

                console.log(response);
                var cancelled=0;
                var active = 0;

                 $.each(response,function (key,data) {
                     if(data.status=='active'){
                        active++;
                     }else{
                        cancelled++;
                     }
                 });

                $('.tot-booking').text('Total Bookings('+response.length+')');
                $('.act-booking').text('Scheduled Booking('+active+')');
                $('.can-booking').text('Cancelled Bookings('+cancelled+')');
            }
        });
    }
    loadData();

    function updateQueryStringParameter(uri, key, value) {
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        }
        else {
            return uri + separator + key + "=" + value;
        }
    }


</script>

</body>
</html>



