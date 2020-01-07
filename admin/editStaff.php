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
                     
                        if(isset($_POST['updateStaff']))
                        {
                            $lastName = $_POST['lastName'];
                            $otherName = $_POST['otherName'];
                            $gender = $_POST['gender'];
                            $email = $_POST['email'];
                            $phoneNo = $_POST['phoneNo'];
                            $getID = $_POST['getID'];
                           $object->updateStaff($lastName,$otherName,$gender,$email,$phoneNo,$getID);
                        }
                    ?>
                    <?php 
                        $getID = $_POST['id'];
                        // echo $getID;
                     if (empty($getID)) {
                         header('location:manageStaff.php');
                     }

                        $result = $object->allOneStaff($getID);
                    ?>
                <form method="post" action="editStaff.php" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="lastName" value="<?=$result['lastName']?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Other Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="otherName" value="<?=$result['otherName']?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
								<label>Gender <span class="text-danger">*</span></label>
								<select class="form-control select" name="gender" required>
                                    <option value="Male" <?php if($result['gender']=='Male') echo 'selected' ?>>Male</option>
                                    <option value="Female" <?php if($result['gender']=='Female') echo 'selected' ?>>Female</option>
								</select>
							</div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" value="<?=$result['email']?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Phone No <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="phoneNo" maxlength="11" value="<?=$result['phoneNo']?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <input type="hidden" name="getID" value="<?=$result['id']?>">
                        <button class="btn btn-success submit-btn" name="updateStaff">Update Staff</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include ('inc/footer.php'); ?>