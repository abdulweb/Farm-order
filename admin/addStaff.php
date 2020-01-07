<?php include ('inc/header.php'); ?>
    <div class="main-wrapper">
        <?php include ('inc/topbar.php');?>
        <?php include ('inc/sidebar.php');?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Add Staff</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
	            	 <?php
                        if(isset($_POST['createStaff']))
                        {
                            $lastName = $_POST['lastName'];
                            $otherName = $_POST['otherName'];
                            $gender = $_POST['gender'];
                            $email = $_POST['email'];
                            $phoneNo = $_POST['phoneNo'];
                            $status = $_POST['status'];
                           $object->insertStaff($lastName,$otherName,$gender,$email,$phoneNo,$status);
                        }
                    ?>
                <form method="post" action="addStaff.php" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="lastName" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Other Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="otherName" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
								<label>Gender <span class="text-danger">*</span></label>
								<select class="form-control select" name="gender" required>
									<option>Male</option>
									<option>Female</option>
								</select>
							</div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Phone No <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="phoneNo" maxlength="11" required>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
							<div class="form-group">
								<label>Avatar</label>
								<div class="profile-upload">
									<div class="upload-img">
										<img alt="" src="assets/img/user.jpg">
									</div>
									<div class="upload-input">
										<input type="file" class="form-control" name="passport" required>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="display-block">Status</label>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="status" id="doctor_active" value="1" checked>
							<label class="form-check-label" for="doctor_active">
							Active
							</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="status" id="doctor_inactive" value="0">
							<label class="form-check-label" for="doctor_inactive">
							Inactive
							</label>
						</div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-success submit-btn" name="createStaff">Create Staff</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include ('inc/footer.php'); ?>