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
                <h4 class="page-title">Manage Expenses</h4>
            </div>
            <div class="col-sm-12 col-12 text-right m-b-20">
                <a  href="#" data-toggle="modal" data-target="#myModal" class="btn btn btn-success btn-rounded float-right"><i class="fa fa-plus"></i> Add New Expenses</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
	            <?php
                    if (isset($_POST['addBtn'])) {
                        // echo "<script>alert('working')</script>";
                        $title = $_POST['title'];
                        $category = $_POST['category'];
                        $quantity = $_POST['quantity'];
                        $amount =$_POST['amount'];
                        $pMethod =$_POST['pMethod'];
                        $pFrom =$_POST['pFrom'];
                        $date_spend =$_POST['date_spend'];
                        $object->insertExpenses($title,$category,$quantity,$amount,$pMethod,$pFrom,$date_spend);
                    }
                    if (isset($_POST['delete'])) {
                        // echo "<script>alert('working')</script>";
                        $id = $_POST['id'];
                        $object->deleteExpenses($id);
                    }

                    if (isset($_POST['updateBtn'])) {
                        $title = $_POST['title'];
                        $category = $_POST['category'];
                        $quantity = $_POST['quantity'];
                        $amount =$_POST['amount'];
                        $pMethod =$_POST['pMethod'];
                        $pFrom =$_POST['pFrom'];
                        $getID = $_POST['id'];
                        $object->updateExpenses($title,$category,$quantity,$amount,$pMethod,$pFrom,$getID);
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
                                    <th>Item</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>payment Method</th>
                                    <th>Purchase From</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                        $results = $object->allExpenses();
                                        if(!empty($results)){
                                        $i=1;
                                        foreach($results as $value) { 
                                    ?> 
                                <tr>
                                <td><?=$i;?></td>
                                  <td><?=$value['title']?></td>
                                  <td><?=$value['category']?></td>
                                  <td><?=$value['quantity']?></td>
                                  <td><?=$value['amount']?></td>
                                  <td><?=$value['pMethod']?></td>
                                  <td><?=$value['pFrom']?></td>
                                  <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button type="button" class="btn btn-link btn-sm" data-toggle="modal"
                                                        data-target="#editVaccine"
                                                        onclick="expenses_load('<?= $value['title'] ?>','<?=$value['category']?>','<?=$value['quantity']?>','<?= $value['amount'] ?>','<?= $value['pMethod'] ?>','<?= $value['pFrom'] ?>','<?= $value['id'] ?>')">Edit Record
                                                </button>
                                                <form method="post" action="expenses.php">
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
            </div>
        </div>
    </div>
</div>
<!-- modal -->
                    <!-- Modal -->
                      <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog modal-lg">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                            <h4 class="modal-title">New Expenses Record</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Expenses Title: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text"  name="title" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Expenses Category: <span class="text-danger">*</span></label>
                                                <select class="form-control" name="category" required>
                                                <option value="">Select Category</option>
                                                <option value="Feed">Feed</option>
                                                <option value="Medication">Medication</option>
                                                <option value="Vaccination">Vaccination</option>
                                                <option value="Flock">Flock</option>
                                                   
                                               </select>
                                            </div>
                                             <div class="form-group">
                                                <label>Quantity: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="number"  name="quantity" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Expenses Amount: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="number"  name="amount" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Payment Method: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text"  name="pMethod" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Purchase From: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text"  name="pFrom" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Date: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="date"  name="date_spend" required>
                                            </div>
                                            
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                               <button type="submit" name="addBtn" class="btn btn-success text-white">Create</button>
                            </div>
                            </form>
                          </div>
                          
                        </div>
                      </div>
                <!-- end of modal -->

<!-- Edit modal -->
                    <!-- Modal -->
                      <div class="modal fade" id="editVaccine" role="dialog">
                        <div class="modal-dialog modal-lg">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                            <h4 class="modal-title">Update Expenses Record</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Expenses Title: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" id="title"  name="title" required>
                                            </div>
                                            <div class="form-group">
                                               <label>Expenses Category: <span class="text-danger">*</span></label>
                                                <select class="form-control" id="cat" name="category" required>
                                                <option value="">Select Category</option>
                                                <option value="Feed">Feed</option>
                                                <option value="Medication">Medication</option>
                                                <option value="Vaccination">Vaccination</option>
                                                <option value="Flock">Flock</option>
                                                   
                                               </select>
                                            </div>
                                             <div class="form-group">
                                                 <label>Quantity: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="number" id="quantity" name="quantity" required>
                                            </div>
                                            <div class="form-group">
                                               <label>Expenses Amount: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="number" id="amount" name="amount" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Payment Method: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" id="method"  name="pMethod" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Purchase From: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" id="from"  name="pFrom" required>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="hidden" id="id" name="id" required>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                               <button type="submit" name="updateBtn" class="btn btn-success text-white">Update</button>
                            </div>
                            </form>
                          </div>
                          
                        </div>
                      </div>
                <!-- end of modal -->

<?php include ('inc/footer.php'); ?>