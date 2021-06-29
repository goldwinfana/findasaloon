<div class="modal fade" id="view-student-profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>User Profile</span>
            </div>
            <div class="modal-body">


                <div style="text-align: center"><img src="../assets/img/profile.png" alt="..." class="img-fluid rounded-circle"></div>

                <hr/>
                <div style="display: grid;float: left;">
                    <label class=" col-form-label">Student Number: <span class="student-number"></span></label>
                    <label class=" col-form-label">Name: <span class="student-name"></span></label>
                    <label class=" col-form-label">E-Mail Address: <span class="student-email"></span></label>
                    <label class=" col-form-label">ID Number: <span class="student-idNo"></span></label>
                    <label class=" col-form-label">Age: <span class="student-age"></span></label>
                    <label class=" col-form-label">Gender: <span class="student-gender"></span></label>

                </div>

            </div>
        </div>
    </div>
</div></div>

<div class="modal fade" id="edit-student">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Edit Student</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data"  onsubmit="return sendForm('editStudent')">
                    <input class="form-control" type="text" name="edit-student" hidden>

                    <div class="form-group row">
                        <label for="edit-name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="edit-name" type="text" class="form-control is-invalid" name="edit-name" required autocomplete="false">
                        </div>
                        <span class="text-center" role="alert" style="display: block">
                            </span>
                    </div>

                    <div class="form-group row">
                        <label for="edit-email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="edit-email" type="email" class="form-control is-invalid" name="edit-email" maxlength="30" onkeyup="validateEmail('editStudent')"  required autocomplete="">
                        </div>
                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="edit-verifyEmail"></strong>
                            </span>
                    </div>


                    <div class="form-group row">
                        <label for="edit-idNo" class="col-md-4 col-form-label text-md-right">ID Number</label>

                        <div class="col-md-6">
                            <input id="edit-idNo" type="text" class="form-control is-invalid" name="edit-idNo" minlength="13" maxlength="13" onkeypress="return /[0-9]/i.test(event.key)" onkeyup="validateID('editStudent')" required autocomplete="off">
                        </div>
                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="edit-verifyID"></strong>
                            </span>
                    </div>


                    <input id="edit-gender" type="text" class="form-control is-invalid" name="edit-gender" hidden>



                    <div class="form-group row">
                        <label for="edit-password" class="col-md-4 col-form-label text-md-right">Password&nbsp;</label>

                        <div  class="col-md-6">
                            <input id="edit-password" type="text" class="form-control" name="edit-password" placeholder="e.g 1234*Abcd" minlength="8" onkeyup="createPassword('editStudent')" required autocomplete="off">
                        </div>

                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="edit-verifyPass"></strong>
                            </span>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>

<div class="modal fade" id="book-session">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Book Session</span>
            </div>
            <div class="modal-body">



                    <div style="margin:15px">


                <?php
                $init = $pdo->open();
                $sql = $init->prepare("SELECT * FROM session where studNumber=:studNumber");
                $sql->execute(['studNumber'=>$_SESSION['studentNo']]);
                $results = $sql->fetch();

                if($sql->rowCount() > 0){
                    echo '<p>Time Left: <span class="countDown"></span></p>
                          <p>Start Time: '.$results['startTime'].'</p>
                          <p>End Time: <span  class="time-left">'.$results['endTime'].'</span></p>
                           <p>Duration: <span  class="session-dur">'.$results['duration'].'</span> Hour(s)</p>
                          <p>Table: '.$results['tblNumber'].'</p>
                           <form class="form-horizontal" method="POST" action="sql.php" >
                             <input name="end-book" value="end" hidden>
                              <button type="submit" class="btn btn-danger btn-flat" name="endBooking"><i class="fa fa-close-o"></i>End Session</button>
                           </form>';
                }else{
                    $sql = $init->prepare("SELECT * FROM desk where status=:status");
                    $sql->execute(['status'=>'available']);
                    $results = $sql->fetchAll();

                    if($sql->rowCount() > 0){
                        echo '
                        <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data">
                              <select class="form-control" style="width: 100%" name="book-hours" required>
                                    <option value="" selected disabled>Choose hours of study</option>
                                    <option value="1" >1 hour</option>
                                    <option value="2" >2 hours</option>
                                    <option value="3">3 hours</option>
                                    <option value="4">4 hours</option>
                                    <option value="5" >5 hours</option>
                                </select><br/>
                        <select class="form-control" style="width: 100%" name="book-session" required>
                        <option value="" selected disabled>Available Slots</option>';
                        foreach ($results as $data){

                            echo '<option value="'.$data['tblNumber'].'">Table '.$data['tblNumber'].'</option>';
                        }
                        echo ' 
                             </select>
                          <div class="modal-footer">
                           <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Confirm</button></div>
                        </form>';
                    }else{
                        echo '<span>There are no slots available for booking</span>';
                    }
                }

                $pdo->close();
                ?>
                    </div>


        </div>
    </div>
</div></div>
