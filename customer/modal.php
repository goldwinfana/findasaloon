<div class="modal fade" id="view-profile">
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
                    <label class=" col-form-label">Name: <?php echo $_SESSION['name'] ?></label>
                    <label class=" col-form-label">E-Mail Address: <?php echo $_SESSION['email'] ?></label>
                    <label class=" col-form-label">Mobile Number: <?php echo $_SESSION['mobile'] ?></label>
                </div>

            </div>
        </div>
    </div>
</div>
</div></div>

<div class="modal fade" id="edit-profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Edit Profile</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal customer-form" method="POST" action="sql.php" enctype="multipart/form-data"  onsubmit="return customerForm()">
                    <input class="form-control" type="text" name="edit-customer" value="<?php echo ($_SESSION['id']);  ?>"  hidden>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control is-invalid" value="<?php echo ($_SESSION['name']);  ?>" name="name" required autocomplete="false">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="edit-email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control is-invalid" value="<?php echo ($_SESSION['email']);  ?>" name="email" maxlength="30" onkeyup="validateEmail('editStudent')"  required autocomplete="">
                        </div>
                        <span class="valid-feedback text-center" role="alert" style="display: block">
                                <strong id="verifyEmail"></strong>
                            </span>
                    </div>


                    <div class="form-group row">
                        <label for="edit-idNo" class="col-md-4 col-form-label text-md-right">Mobile</label>

                        <div class="col-md-6">
                            <input id="mobile" type="text" class="form-control is-invalid" value="<?php echo ($_SESSION['mobile']);  ?>" name="mobile" minlength="10" maxlength="13" onkeypress="return /[0-9]/i.test(event.key)" onkeyup="customerMobile()" required autocomplete="off">
                        </div>
                        <span class="valid-feedback text-center" role="alert" style="display: block">
                                <strong id="verifyMobile"></strong>
                            </span>
                    </div>


                    <div class="form-group row">
                        <label for="edit-password" class="col-md-4 col-form-label text-md-right">Password&nbsp;</label>

                        <div  class="col-md-6">
                            <input id="password" type="text" class="form-control" value="<?php echo ($_SESSION['password']);  ?>" name="password" placeholder="e.g 1234*Abcd" minlength="8" onkeyup="createPassword('editStudent')" required autocomplete="off">
                        </div>

                        <span class="valid-feedback text-center" role="alert" style="display: block">
                                <strong id="custPassword"></strong>
                            </span>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Confirm&nbsp;</label>

                        <div  class="col-md-6">
                            <input id="confirm" type="text" class="form-control"  name="passMatch" minlength="8" onkeyup="customerMatch()" required autocomplete="off">
                        </div>

                        <span class="valid-feedback text-center" role="alert" style="display: block">
                                <strong id="custMatch"></strong>
                            </span>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>


<div class="modal fade" id="cancelBooking">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Cancel Booking</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php">

                    <div class="form-group row">
                        <h3 style="padding: 15px" class="lbl-service"></h3>

                        <div class="col-md-6">
                            <input type="text" class="form-control is-invalid" name="cancelBooking" hidden>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-close"></i> Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>


<div class="modal fade" id="view-saloon">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Cancel Booking</span>
            </div>
            <div class="modal-body text-center">

                <div class="d-block align-items-center">
                    <strong class="d-block">
                        <a class="post-title lbl-saloon" style="color: cadetblue;"></a>

                    </strong>
                    <div class="row margin-bottom-sm margin-top-sm">
                        <div style="margin: auto">
                            <img class="" src="./../assets/img/profile.png">
                        </div>

                        <div class="margin-top-sm contributions">

                            <strong class="lbl-about"></strong><hr>
                            <p>Services offered</p>
                            <div class="service-offered">
                            </div>

                        </div>
                    </div>

                </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div></div>


<div class="modal fade" id="upload-image">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Search by Image</span>
            </div>
            <div class="modal-body">

                <form action="sql.php" method="POST" enctype="multipart/form-data" class="text-center">
                    <div>
                        <label>Description Of hair-Style You Wish To Search For...</label>
                        <textarea class="form-control" type="text" name="description" required>
                        </textarea>
                    </div>
                    <div>
                        <label>Upload Picture Of hair-Style You Wish To Search For...</label>
                        <input class="form-control" type="file" name="photo" required>
                    </div>

                    <div class="modal-footer">

                    <button type="submit" name="upload-image" class="btn btn-success"><i class="fa fa-check-circle"></i> Upload Image</button>
                </form>
            </div>
        </div>
    </div></div>
</div></div>

<div class="modal fade" id="book-session">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Book Session</span>
            </div>
            <div class="modal-body">

                <div style="margin:15px;display: grid">
                    <span class="saloon"></span>
                    <span class="category"></span>
                    <span class="service"></span>
                    <span class="duration"></span>
                    <span class="price"></span>
                    <span class="date"></span>
                    <span class="start"></span>
                    <span class="end"></span>
                    <span class="error"></span>
                    <span class="stuff"></span>
                </div>

                <form action="sql.php" method="POST" class="text-center">
                    <div>
                        <label>Pick Date and Time</label>
                        <input class="form-control" type="datetime-local" name="date-time" onchange="changeStuff()" required>
                    </div>

                    <div hidden>
                        <label>Pick Stuff</label>
                        <select id="stuff" class="form-control" name="stuff" onchange="$('.stuff').text('Stuff Name: '+$('#stuff option:selected').text());">
                            <option value="" selected disabled>Select Available Stuff</option>
                        </select>
                    </div>

                    <input name="saloon" hidden>
                    <input name="category" hidden>
                    <input name="service" hidden>
                    <input name="duration" hidden>
                    <input name="price" hidden>
                    <input name="date" hidden>
                    <input name="start" hidden>
                    <input name="end" hidden>
                    <hr/>
                    <button type="submit" name="booking" class="btn btn-success"><i class="fa fa-check-circle"></i> Confirm Booking</button>
                </form>

        </div>
    </div>
</div></div>
</div></div>

<script src="js/main.js"></script>
