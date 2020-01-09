<?php include ('inc/header.php'); ?>
    <div class="main-wrapper">
        <?php include ('inc/topbar.php');?>
        <?php include ('inc/sidebar.php');?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-title">Manage Staff</h4>
            </div>
            <div class="col-sm-12 col-12 text-right m-b-20">
                <a href="addStaff.php" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Staff</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
	            <?php
                    if (isset($_POST['delete'])) {
                        // echo "<script>alert('working')</script>";
                        $id = $_POST['id'];
                        $object->deleteCustomer($id);
                    }
                ?>
               <div class="col-md-12">
                    <div class="table-responsive">
                       <table class="table table-border table-striped custom-table datatable mb-0">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Gender</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                        $results = $object->getAllCustomers();
                                        if(!empty($results)){
                                        $i=1;
                                        foreach($results as $value) { 
                                            $getDetails = $object->getCustomerdeatils($value['email']);
                                            foreach ($getDetails as $getDetail) {
                                                
                                            
                                    ?> 
                                <tr>
                                  <td><img width="28" height="28" src="<?=$getDetail['passport']?>" class="rounded-circle m-r-5" alt=""><?=$getDetail['fname']. " ". $getDetail['lname']?></td>
                                  <td><?=$value['email']?></td>
                                  <td><?=$getDetail['phone']?></td>
                                  <td><?=$getDetail['gender']?></td>
                                  <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <form method="post" action="viewCustomer.php">
                                                    <input type="hidden" name="id" value="<?=$value['id']?>" />
                                                     <button type="submit" name="edit" class="btn btn-link"> View Record </button>
                                                </form>
                                                <form method="post" action="manageCustomer.php">
                                                    <input type="hidden" name="id" value="<?=$value['email']?>" />
                                                     <button type="submit" name="delete" class="btn btn-link"> Delete Record </button>
                                                </form>
                                                
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php }
                                $i++; 
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
                                <img src="assets/img/sent.png" alt="" width="50" height="46">
                                <h3>Are you sure want to delete this Staff?</h3>
                                <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include ('inc/footer.php'); ?>