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
                <h4 class="page-title">Manage Egg</h4>
            </div>
            <div class="col-sm-12 col-12 text-right m-b-20">
                <a  href="#" data-toggle="modal" data-target="#myModal" class="btn btn btn-success btn-rounded float-right"><i class="fa fa-plus"></i> Add New Egg</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
	            <?php
                    if (isset($_POST['addBtn'])) {
                        // echo "<script>alert('working')</script>";
                        $collected = $_POST['collected'];
                        $good = $_POST['good'];
                        $bad = $_POST['bad'];
                        $date_create =$_POST['date_create'];
                        $object->insertEgg($collected,$good,$bad,$date_create);
                    }
                    if (isset($_POST['delete'])) {
                        // echo "<script>alert('working')</script>";
                        $id = $_POST['id'];
                        $object->deleteEgg($id);
                    }

                    if (isset($_POST['updateBtn'])) {
                        $collected = $_POST['collected'];
                        $good = $_POST['good'];
                        $bad = $_POST['bad'];
                        $date_create =$_POST['date_create'];
                        $getID = $_POST['id'];
                        $object->updateEgg($collected,$good,$bad,$date_create,$getID);
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
                                    <th>Collected</th>
                                    <th>Good</th>
                                    <th>Spoil/Damage</th>
                                    <th>Date Create</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                        $results = $object->allEgg();
                                        if(!empty($results)){
                                        $i=1;
                                        foreach($results as $value) { 
                                    ?> 
                                <tr>
                                <td><?=$i;?></td>
                                  <td><?=$value['collected']?></td>
                                  <td><?=$value['good']?></td>
                                  <td><?=$value['bad']?></td>
                                  <td><?=$value['date_create']?></td>
                                  <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button type="button" class="btn btn-link btn-sm" data-toggle="modal"
                                                        data-target="#editVaccine"
                                                        onclick="egg_load('<?= $value['collected'] ?>','<?=$value['good']?>','<?=$value['bad']?>','<?= $value['date_create'] ?>','<?= $value['id'] ?>')">Edit Record
                                                </button>
                                                <form method="post" action="egg.php">
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
                            <h4 class="modal-title">New Egg Record</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Collected: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="number"   name="collected" required>
                                            </div>
                                             <div class="form-group">
                                                <label>Good: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="number"  name="good" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Spoil/Damage: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="number"   name="bad" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Date: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="date"   name="date_create" required>
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
                            <h4 class="modal-title">Update Egg Record</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Collected: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="number" id="collected"  name="collected" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Good: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="number" id="good" name="good" required>
                                            </div>
                                             <div class="form-group">
                                                <label>Spoil/Damage: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="number" id="bad"  name="bad" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Date: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="date" id="date_create"  name="date_create" required>
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