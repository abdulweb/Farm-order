<?php include ('inc/header.php'); ?>
    <div class="main-wrapper">
        <?php include ('inc/topbar.php');?>
        <?php include ('inc/sidebar.php');?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Edit Product</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
	            	 <?php
                     
                        if(isset($_POST['updateBtn']))
                        {
                            $medName = $_POST['medName'];
                            $number = $_POST['number'];
                            $description = $_POST['description'];
                            $getID = $_POST['getID'];
                           $object->updateMedication($medName,$number,$description,$getID);
                        }
                    ?>
                    <?php 
                        $getID = $_POST['id'];
                        // echo $getID;
                     if (empty($getID)) {
                         header('location:manageProduct.php');
                     }

                        $result = $object->allOneMedication($getID);
                    ?>
                <form method="post" action="" enctype="multipart/form-data">
                     <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Medication <small>(medicine)</small> : <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" value="<?=$result['name']?>" name="medName" required>
                                </div>
                                 <div class="form-group">
                                    <label>No. of Flock : <span class="text-danger">*</span></label>
                                     <input class="form-control" type="number" value="<?=$result['noFlock']?>" name="number" required>
                                </div>
                                <div class="form-group">
                                    <label>Description: <span class="text-danger">*</span></label>
                                    <textarea name="description" rows="3" class="form-control" required><?=$result['description']?></textarea>
                                </div>
                                
                            </div>
                        </div>
                    <div class="m-t-20 text-center">
                    <input type="hidden" name="getID" value="<?=$result['id']?>">
                    <button class="btn btn-success submit-btn" name="updateBtn">Update Record</button>
                </div>
            </form>
                                
            </div>
        </div>
    </div>
</div>
<?php include ('inc/footer.php'); ?>