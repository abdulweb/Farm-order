<?php include ('inc/header.php'); ?>
    <div class="main-wrapper">
        <?php include ('inc/topbar.php');?>
        <?php include ('inc/sidebar.php');?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-title">Manage Category</h4>
            </div>
            <div class="col-sm-12 col-12 text-right m-b-20">
                <a  href="#" data-toggle="modal" data-target="#delete_patient" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> New Category</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
	            <?php
                    if (isset($_POST['cat_add'])) {
                        // echo "<script>alert('working')</script>";
                        $cat_name = $_POST['cat_name'];
                        $object->insertCategory($cat_name);
                    }
                    if (isset($_POST['Update']) ) {

                        $name = $_POST['catName'];
                        $cat_edit = $_POST['cat_edit'];
                        $object->updateCategory($name,$cat_edit);
                    }

                    if (isset($_POST['delete'])) {
                        // echo "<script>alert('working')</script>";
                        $id = $_POST['id'];
                        $object->deleteCat($id);
                    }

                ?>
               <div class="col-md-12">
                    <div class="table-responsive">
                       <table class="table table-border table-striped custom-table datatable mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Date Add</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                        $results = $object->allcategory();
                                        if(!empty($results)){
                                        $i=1;
                                        foreach($results as $value) { 
                                    ?> 
                                <tr>
                                <td><?=$i;?></td>
                                  <td><?=$value['name']?></td>
                                  <td><?=$value['date_create']?></td>
                                  <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                 <button type="button" class="btn btn-link btn-sm" data-toggle="modal"
                                                        data-target="#cat_edit"
                                                        onclick="preload_modal('<?= $value['name'] ?>','<?=$value['id']?>')">Edit Record
                                                </button>
                                                <form method="post" action="manageCategory.php">
                                                    <input type="hidden" name="id" value="<?=$value['id']?>" />
                                                     <button type="submit" name="delete" class="btn btn-link"> Delete Record </button>
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
                <div id="cat_edit" class="modal fade delete-modal" role="dialog">
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
                </div>
                <!-- edit form end -->
            </div>
        </div>
    </div>
</div>

<?php include ('inc/footer.php'); ?>