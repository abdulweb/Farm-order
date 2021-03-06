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
                <h4 class="page-title">Orders</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
	            <?php
                    if (isset($_POST['process'])) {
                        // echo "<script>alert('working')</script>";
                        $id = $_POST['id'];
                        $productID = $_POST['productID'];
                        $quantity = $_POST['quantity'];
                        // echo "<script>alert('$quantity')</script>";
                        $object->treatRequestProduct($id,$productID,$quantity);
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
                                    <th>Customer</th>
                                    <th>product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Category</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                        $results = $object->allOrders();
                                        if(!empty($results)){
                                        $i=1;
                                        foreach($results as $value) { 
                                    ?> 
                                <tr>
                                <td><?=$i;?></td>
                                  <td><?=$object->allOneCustomer($value['custID'])?></td>
                                  <td><?=$object->getProductName($value['productID'])?></td>
                                  <td><?=$object->getProductPrice($value['productID'])?></td>
                                  <td><?=$value['quantity']?></td>
                                  <td>
                                      <?php if ($value['status']==1) {
                                            echo "<small class='badge badge-success text-white'>Processed</small>";
                                      }else{
                                        echo "<small class='badge badge-warning text-white'>pending</small>";
                                        } ?>
                                    </td>

                                  <td><?=$object->getProductCat($value['productID'])?></td>
                                  <td class="text-right">
                                        <form method="post" action="orders.php">
                                            <input type="hidden" name="id" value="<?=$value['id']?>" />
                                            <input type="hidden" name="productID" value="<?=$value['productID']?>" />
                                            <input type="hidden" name="quantity" value="<?=$value['quantity']?>" />
                                             <button type="submit" onclick="return confirm('Ready to sell?')" name="process" class="btn btn-info"> Procees Request </button>
                                        </form>
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
                      <div class="modal fade" id="updateProduct" role="dialog">
                        <div class="modal-dialog modal-lg">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                            <h4 class="modal-title">Update Quantity</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Quantity: <span class="text-danger">*</span></label>
                                                <input class="form-control" type="number" id="quantity" name="quantity" required>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="hidden" id="productID" name="productID" required>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                               <button type="submit" name="updateQuantity" class="btn btn-success text-white">Add</button>
                            </div>
                            </form>
                          </div>
                          
                        </div>
                      </div>
                <!-- end of modal -->

<?php include ('inc/footer.php'); ?>