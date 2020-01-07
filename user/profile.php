<?php include ('inc/header.php'); ?>
    <div class="main-wrapper">
        <?php include ('inc/topbar.php');?>
        <?php include ('inc/sidebar.php');?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Profile</h4>
                    </div>
                </div>
                <?php
                        if(isset($_POST['profileBtn']))
                        {
                            $fname = $_POST['fname'];
                            $lname = $_POST['lname'];
                            $dob = $_POST['dob'];
                            $gender = $_POST['gender'];
                            $address = $_POST['address'];
                            $phoneNo = $_POST['phoneNo'];
                            $email = $_POST['email'];
                           $object->userProfile($fname,$lname,$dob,$gender,$address,$phoneNo,$email);
                        }
                    ?>
                    <?php
                    $result = $object->allOneUser($_SESSION['user']);
                        if (!empty($result)) {
                            include ('viewProfile.php');
                        }
                        else{
                            ?>
                <form method="post" action="profile.php" enctype="multipart/form-data">
                    <div class="card-box">
                        <h3 class="card-title">Basic Informations</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-img-wrap">
                                    <img class="inline-block" src="assets/img/user.jpg" alt="user">
                                    <div class="fileupload btn">
                                        <span class="btn-text">Upload</span>
                                        <input class="upload" type="file" name="passport">
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">First Name</label>
                                                <input type="text" class="form-control floating" name="fname" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Last Name</label>
                                                <input type="text" class="form-control floating" name="lname" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Birth Date</label>
                                                <div class="cal-icon">
                                                    <input class="form-control floating" type="date" name="dob" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus select-focus">
                                                <label class="focus-label">Gendar</label>
                                                <select class="select form-control floating" name="gender" required>
                                                    <option value="">Select Gender</option>
                                                    <option value="male selected">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-box">
                        <h3 class="card-title">Contact Informations</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Address</label>
                                    <input type="text" class="form-control floating" name="address" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Phone Number</label>
                                    <input type="text" class="form-control floating" name="phoneNo" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Email</label>
                                    <input type="text" class="form-control floating" name="email" value="<?=$_SESSION['user']?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center m-t-20">
                        <button class="btn btn-success submit-btn" type="submit" name="profileBtn">Update</button>
                    </div>
                </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php include ('inc/footer.php'); ?>