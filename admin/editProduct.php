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
                     
                        if(isset($_POST['updateProduct']))
                        {
                            $name = $_POST['name'];
                            $description = $_POST['description'];
                            $price = $_POST['price'];
                            $eDate = $_POST['eDate'];
                            $catID = $_POST['catID'];
                            $getID = $_POST['getID'];
                           $object->updateProduct($name,$description,$price,$eDate,$catID,$getID);
                        }
                    ?>
                    <?php 
                        $getID = $_POST['id'];
                        // echo $getID;
                     if (empty($getID)) {
                         header('location:manageProduct.php');
                     }

                        $result = $object->allOneProduct($getID);
                    ?>
                <form method="post" action="editproduct.php" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" value="<?=$result['name']?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description: <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="3" name="description"><?=$result['description']?></textarea>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                               <label>Price: <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="price" value="<?=$result['price']?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                               <label>Expired Date: <span class="text-danger">*</span></label>
                                <input class ="form-control" type="date" name="eDate" value="<?=$result['expried_date']?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Category <span class="text-danger">*</span></label>
                                <select class="form-control select" name="catID" required>
                                    <option value='<?=$result['cat_id']?>' selected><?=$object->getProductCat($result['cat_id'])?> </option>
                                    <option value="">Select Category</option>
                                       <?php
                                            $catgories = $object->allcategory();
                                            foreach ($catgories as $catgory) {
                                               echo '<option value='.$catgory['id'].'>'.$catgory['name'].'</option>';
                                    }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <input type="hidden" name="getID" value="<?=$result['id']?>">
                        <button class="btn btn-success submit-btn" name="updateProduct">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include ('inc/footer.php'); ?>