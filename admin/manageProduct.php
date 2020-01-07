<?php include ('inc/header.php'); ?>
    <div class="main-wrapper">
        <?php include ('inc/topbar.php');?>
        <?php include ('inc/sidebar.php');?>

<style type="text/css">
    input{
        border: 1px solid black;
    }
</style>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-title">Manage Product</h4>
            </div>
            <div class="col-sm-12 col-12 text-right m-b-20">
                <a  href="#" data-toggle="modal" data-target="#myModal" class="btn btn btn-success btn-rounded float-right"><i class="fa fa-plus"></i> Add Product</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
	            <?php
                    if (isset($_POST['addProduct'])) {
                        // echo "<script>alert('working')</script>";
                        $name = $_POST['name'];
                        $description = $_POST['description'];
                        $price = $_POST['price'];
                        $eDate = $_POST['eDate'];
                        $catID = $_POST['catID'];
                        $object->insertProduct($name,$description,$price,$eDate,$catID);
                    }
                    if (isset($_POST['delete'])) {
                        // echo "<script>alert('working')</script>";
                        $id = $_POST['id'];
                        $object->deleteProduct($id);
                    }

                ?>
                <div>
                </div>
               <div class="col-md-12">
                    <div class="table-responsive">
                       <table class="table table-border table-striped custom-table datatable mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Expired Date</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Date Add</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                        $results = $object->allProduct();
                                        if(!empty($results)){
                                        $i=1;
                                        foreach($results as $value) { 
                                    ?> 
                                <tr>
                                <td><?=$i;?></td>
                                  <td><?=$value['name']?></td>
                                  <td><?=$value['description']?></td>
                                  <td><?=$value['price']?></td>
                                  <td><?=$value['quantity']?></td>
                                  <td><?=$value['expried_date']?></td>
                                  <td><?=$object->getProductCat($value['id'])?></td>
                                  <td></td>
                                  <td><?=$value['date_create']?></td>
                                  <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                 <form method="post" action="editProduct.php">
                                                    <input type="hidden" name="id" value="<?=$value['id']?>" />
                                                     <button type="submit" name="edit" class="btn btn-link"> Edit Record </button>
                                                </form>
                                                <form method="post" action="">
                                                    <input type="hidden" name="id" value="<?=$value['id']?>" />
                                                     <button type="submit" name="delete" onclick="return confirm('Ready to delete?')" class="btn btn-link"> Delete Record </button>
                                                </form>
                                                
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; 
                                }
                                        }
                                        else{

                                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="delete_patient" class="modal fade delete-modal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <form method="post" action="manageCategory.php" enctype="multipart/form-data">
                                    <div class="row">
                                        <h3 class="text-center">Add Category</h3>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Category Name: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="cat_name" required>
                                            </div>
                                        </div>
                                    </div>
                                
                                <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                    <button type="submit" name="cat_add" class="btn btn-success text-white">Add</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- edit form -->
              <!--   <div id="cat_edit" class="modal fade delete-modal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <form method="post" action="manageCategory.php" enctype="multipart/form-data">
                                    <div class="row">
                                        <h3 class="text-center">Edit Category</h3>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Category Name: <span class="text-danger">*</span></label>
                                                <input class="form-control" id="catName" type="text" name="catName" required>
                                                
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" id="catID" name="cat_edit" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                
                                <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                    <button type="submit" name="Update" class="btn btn-success text-white">Update</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- edit form end -->
                <!-- modal -->
                    <!-- Modal -->
                      <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog modal-lg">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                            <h4 class="modal-title">Add New Product</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Name: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="name" required>
                                            </div>
                                            <div class="form-group">
                                               <label>Description: <span class="text-danger">*</span></label>
                                                <textarea class="form-control" rows="3" name="description"></textarea>
                                            </div>
                                            <div class="form-group">
                                               <label>Price: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="number" name="price" required>
                                            </div>
                                            <div class="form-group">
                                               <label>Expired Date: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="date" name="eDate" required>
                                            </div>
                                            <div class="form-group">
                                               <label>Category: <span class="text-danger">*</span></label>
                                               <select class="form-control" name="catID" required>
                                                <option value="">Select Category</option>
                                                   <?php
                                                $catgories = $object->allcategory();
                                                foreach ($catgories as $catgory) {
                                                   echo '<option value='.$catgory['id'].'>'.$catgory['name'].'</option>';
                                                }
                                               ?>
                                               </select>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                               <button type="submit" name="addProduct" class="btn btn-success text-white">Add</button>
                            </div>
                            </form>
                          </div>
                          
                        </div>
                      </div>
                <!-- end of modal -->
            </div>
        </div>
    </div>
</div>

<?php include ('inc/footer.php'); ?>