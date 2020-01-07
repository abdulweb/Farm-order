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
                <h4 class="page-title">Manage Vaccination</h4>
            </div>
            <div class="col-sm-12 col-12 text-right m-b-20">
                <a  href="#" data-toggle="modal" data-target="#myModal" class="btn btn btn-success btn-rounded float-right"><i class="fa fa-plus"></i> Add New Vaccine</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
	            <?php
                    if (isset($_POST['vaccBtn'])) {
                        // echo "<script>alert('working')</script>";
                        $vac_date = $_POST['vac_date'];
                        $vac_reason = $_POST['vac_reason'];
                        $vac_no = $_POST['vac_no'];
                        $description =$_POST['description'];
                        $object->insertVaccine($vac_date,$vac_reason,$vac_no,$description);
                    }
                    if (isset($_POST['delete'])) {
                        // echo "<script>alert('working')</script>";
                        $id = $_POST['id'];
                        $object->deleteVaccine($id);
                    }

                    if (isset($_POST['updateBtn'])) {
                        $vac_date = $_POST['vac_date'];
                        $vac_reason = $_POST['vac_reason'];
                        $vac_no = $_POST['vac_no'];
                        $description =$_POST['description'];
                        $id = $_POST['id'];
                        $object->updateVaccine($vac_date,$vac_reason,$vac_no,$description,$id);
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
                                    <th>Date</th>
                                    <th>Reason</th>
                                    <th>No of flock vaccinated</th>
                                    <th>Description</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                        $results = $object->allVaccination();
                                        if(!empty($results)){
                                        $i=1;
                                        foreach($results as $value) { 
                                    ?> 
                                <tr>
                                <td><?=$i;?></td>
                                  <td><?=$value['vac_date']?></td>
                                  <td><?=$value['vac_reason']?></td>
                                  <td><?=$value['no_vac']?></td>
                                  <td><?=$value['description']?></td>
                                  <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button type="button" class="btn btn-link btn-sm" data-toggle="modal"
                                                        data-target="#editVaccine"
                                                        onclick="vaccine_load('<?= $value['vac_date'] ?>','<?=$value['vac_reason']?>','<?=$value['no_vac']?>','<?= $value['description'] ?>','<?= $value['id'] ?>')">Edit Record
                                                </button>
                                                <form method="post" action="vaccination.php">
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
                                                <label>Vacination Date: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="date"  name="vac_date" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Vacination Reason: <span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="vac_reason"  rows="3"></textarea>
                                            </div>
                                             <div class="form-group">
                                                <label>No. Flock Vaccinated: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="number"  name="vac_no" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Vacination Description: <span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="description"  rows="3"></textarea>
                                            </div>
                                            
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                               <button type="submit" name="vaccBtn" class="btn btn-success text-white">Add</button>
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
                            <h4 class="modal-title">Update Vaccination Record</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Vacination Date: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="date" id="date" name="vac_date" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Vacination Reason: <span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="vac_reason" id="resason" rows="3"></textarea>
                                            </div>
                                             <div class="form-group">
                                                <label>No. Flock Vaccinated: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="number" id="no" name="vac_no" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Vacination Description: <span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="description" id="desc" rows="3"></textarea>
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