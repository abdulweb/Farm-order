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
                     
                        if(isset($_POST['updateFeed']))
                        {
                            $c_type = $_POST['c_type'];
                            $f_type = $_POST['f_type'];
                            $quantity = $_POST['quantity'];
                            $getID = $_POST['getID'];
                           $object->updateFeed($c_type,$f_type,$quantity,$getID);
                        }
                    ?>
                    <?php 
                        $getID = $_POST['id'];
                        // echo $getID;
                     if (empty($getID)) {
                         header('location:manageProduct.php');
                     }

                        $result = $object->allOneFeed($getID);
                    ?>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Chicken Type: <span class="text-danger">*</span></label>
                                <select name="c_type" class="form-control">
                                <option selected><?=$result['chicken_type']?> </option>
                                    <option value="">Select Chiecken Type</option>
                                    <option>Broiler</option>
                                    <option>Layers</option>
                                    <option>Chick</option>
                                </select>
                            </div>
                             <div class="form-group">
                                <label>No. Flock Vaccinated: <span class="text-danger">*</span></label>
                                <select name="f_type" class="form-control">
                                <option selected><?=$result['feed_type']?> </option>
                                    <option value="">Select Feed Type</option>
                                    <option >feed1</option>
                                    <option >feed2</option>
                                    <option >feed3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Quantity: <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" value="<?=$result['quantity']?>"  name="quantity" required>
                            </div>
                            
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                    <input type="hidden" name="getID" value="<?=$result['id']?>">
                    <button class="btn btn-success submit-btn" name="updateFeed">Update Feed</button>
                </div>
            </form>
                                
            </div>
        </div>
    </div>
</div>
<?php include ('inc/footer.php'); ?>