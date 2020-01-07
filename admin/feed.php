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
                <h4 class="page-title">Manage Feed</h4>
            </div>
            <div class="col-sm-12 col-12 text-right m-b-20">
                <a  href="#" data-toggle="modal" data-target="#myModal" class="btn btn btn-success btn-rounded float-right"><i class="fa fa-plus"></i> Add New Feed</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
	            <?php
                    if (isset($_POST['AddBtn'])) {
                        // echo "<script>alert('working')</script>";
                        $c_type = $_POST['c_type'];
                        $f_type = $_POST['f_type'];
                        $quantity = $_POST['quantity'];
                        $object->insertFeed($c_type,$f_type,$quantity);
                    }
                    if (isset($_POST['delete'])) {
                        // echo "<script>alert('working')</script>";
                        $id = $_POST['id'];
                        $object->deleteFeed($id);
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
                                    <th>Chicken Type</th>
                                    <th>Feed Type</th>
                                    <th>Quantity <small>(in bags)</small></th>
                                    <th>Date</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                        $results = $object->allFeed();
                                        if(!empty($results)){
                                        $i=1;
                                        foreach($results as $value) { 
                                    ?> 
                                <tr>
                                <td><?=$i;?></td>
                                  <td><?=$value['chicken_type']?></td>
                                  <td><?=$value['feed_type']?></td>
                                  <td><?=$value['quantity']?></td>
                                  <td><?=$value['date_create']?></td>
                                  <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <form method="post" action="editFeed.php">
                                                    <input type="hidden" name="id" value="<?=$value['id']?>" />
                                                     <button type="submit" name="edit" class="btn btn-link"> Edit Record </button>
                                                </form>
                                                <form method="post" action="feed.php">
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
                            <h4 class="modal-title">New Vaccination Record</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Chicken Type: <span class="text-danger">*</span></label>
                                                <select name="c_type" class="form-control">
                                                    <option value="">Select Chiecken Type</option>
                                                    <option>Broiler</option>
                                                    <option>Layers</option>
                                                    <option>Chick</option>
                                                </select>
                                            </div>
                                             <div class="form-group">
                                                <label>No. Flock Vaccinated: <span class="text-danger">*</span></label>
                                                <select name="f_type" class="form-control">
                                                    <option value="">Select Feed Type</option>
                                                    <option >feed1</option>
                                                    <option >feed2</option>
                                                    <option >feed3</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Quantity: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="number"  name="quantity" required>
                                            </div>
                                            
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                               <button type="submit" name="AddBtn" class="btn btn-success text-white">Add</button>
                            </div>
                            </form>
                          </div>
                          
                        </div>
                      </div>
                <!-- end of modal -->

<!-- Edit modal -->
             

<?php include ('inc/footer.php'); ?>