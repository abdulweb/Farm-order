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
                <h4 class="page-title">Medication</h4>
            </div>
            <div class="col-sm-12 col-12 text-right m-b-20">
                <a  href="#" data-toggle="modal" data-target="#myModal" class="btn btn btn-success btn-rounded float-right"><i class="fa fa-plus"></i>  New Medication Record</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
	            <?php
                    if (isset($_POST['AddBtn'])) {
                        // echo "<script>alert('working')</script>";
                        $medName = $_POST['medName'];
                        $number = $_POST['number'];
                        $description = $_POST['description'];
                        $object->insertMedication($medName,$number,$description);
                    }
                    if (isset($_POST['delete'])) {
                        // echo "<script>alert('working')</script>";
                        $id = $_POST['id'];
                        $object->deleteMedication($id);
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
                                    <th>Medication <small>(Name of medicine)</small></th>
                                    <th>No. of Flock</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                        $results = $object->allMedication();
                                        if(!empty($results)){
                                        $i=1;
                                        foreach($results as $value) { 
                                    ?> 
                                <tr>
                                <td><?=$i;?></td>
                                  <td><?=$value['name']?></td>
                                  <td><?=$value['noFlock']?></td>
                                  <td><?=$value['description']?></td>
                                  <td><?=$value['date_create']?></td>
                                  <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <form method="post" action="editMedication.php">
                                                    <input type="hidden" name="id" value="<?=$value['id']?>" />
                                                     <button type="submit" name="edit" class="btn btn-link"> Edit Record </button>
                                                </form>
                                                <form method="post" action="medication.php">
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
                            <h4 class="modal-title">New Medication Record</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Medication <small>(medicine)</small> : <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text"  name="medName" required>
                                            </div>
                                             <div class="form-group">
                                                <label>No. of Flock : <span class="text-danger">*</span></label>
                                                 <input class="form-control" type="number"  name="number" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Description: <span class="text-danger">*</span></label>
                                                <textarea name="description" rows="3" class="form-control" required></textarea>
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