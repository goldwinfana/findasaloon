<?php $img = empty(isset($_SESSION['image']))? '../assets/img/profile.png' : '../assets/img/profile/'.isset($_SESSION['image']); ?>
<!--books-->
<div class="modal fade" id="add-service">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Add Service</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data">

                    <input name="add-service" value="add-service" hidden>
                    <div class="form-group">
                        <label for="category" class="col-sm-3 control-label">Category</label>

                        <div class="col-sm-9">
                            <select class="form-control" id="category" name="category" required>
                                <option value="" selected disabled>Select Category</option>
                                <?php

                                $conn = $pdo->open();
                                $sql = $conn->prepare("SELECT * FROM category");
                                $sql->execute();

                                if($sql->rowCount() > 0){
                                    foreach ($sql as $data){
                                        echo '<option value="'.$data["id"].'">'.$data["categoryName"].'</option>';
                                    }
                                }
                                $pdo->close();
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="category" class="col-sm-3 control-label">Service&nbsp;</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="service" name="service" placeholder="Enter service name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category" class="col-sm-3 control-label">Price&nbsp;</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="price" placeholder="Enter service price" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>



<div class="modal fade" id="edit-service">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Edit Service</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data">

                    <input name="edit-service" hidden>
                    <div class="form-group">
                        <label for="category" class="col-sm-3 control-label">Category</label>

                        <div class="col-sm-9">
                            <select class="form-control" id="category" name="category" required>
                                <option value="" disabled>Select Category</option>
                                <?php

                                $conn = $pdo->open();
                                $sql = $conn->prepare("SELECT * FROM category");
                                $sql->execute();

                                if($sql->rowCount() > 0){
                                    foreach ($sql as $data){
                                        echo '<option value="'.$data["id"].'">'.$data["categoryName"].'</option>';
                                    }
                                }
                                $pdo->close();
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="book" class="col-sm-3 control-label">Service</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="service" placeholder="Enter service name"  required>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Price&nbsp;</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="price" placeholder="Enter service price" required>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>

<div class="modal fade" id="delete-service">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Delete Service</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data">

                    <input name="delete-service" hidden>

                    <span id="lbl-service"></span>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>

<!--student-->

<div class="modal fade" id="add-stuff">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Add new stuff</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data" onsubmit="return subForm()">

                    <div class="form-group row">
                        <label for="stuff-name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control is-invalid" name="staff-name" onkeypress="return /[a-z]/i.test(event.key)" required autocomplete="false">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="add-email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                        <div class="col-md-6">
                            <input type="email" class="form-control is-invalid" name="staff-email"  onkeyup="stuffEmail()"  required autocomplete="">
                        </div>
                        <span class="invalid-feedback text-center" role="alert" style="display: block">
                                <strong id="staffEmail"></strong>
                            </span>
                    </div>


                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Upload Image</label>

                        <div  class="col-md-6">
                            <input type="file" class="form-control" name="staff-img" required autocomplete="off">

                        </div>
                    </div>



                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat" name="add-stuff"><i class="fa fa-save"></i> Submit</button>
                </form>
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
                            <input id="edit-name" type="text" class="form-control is-invalid" name="edit-name" onkeypress="return /[a-z]/i.test(event.key)" required autocomplete="false">
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

<div class="modal fade" id="delete-student">
    <div class="modal-dialog">
        <div class="modal-content">
            <a type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
            <div class="modal-header">
                <span>Delete Book</span>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="sql.php" enctype="multipart/form-data">

                    <input name="delete-student" hidden>

                    <span id="lbl-student"></span>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div></div>




