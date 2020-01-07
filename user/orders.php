<?php include ('inc/header.php'); ?>
    <div class="main-wrapper">
        <?php include ('inc/topbar.php');?>
        <?php include ('inc/sidebar.php');?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Order History</h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                       <table class="table table-border table-striped custom-table datatable mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Product Price</th>
                                    <th>Total Price</th>
                                    <th>Date Availabe</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                        $results = $object->allMyOrders($_SESSION['user']);
                                        if(!empty($results)){
                                        $i=1;
                                        foreach($results as $value) { 
                                    ?> 
                                <tr>
                                <td><?=$i;?></td>
                                  <td><?=$object->getProductName($value['productID'])?></td>
                                  <td><?=$value['quantity']?></td>
                                  <td><?=$object->getProductPrice($value['productID'])?></td>
                                  <td><?=($object->getProductPrice($value['productID'])) * ($value['quantity'])?></td>
                                  <td><?=$value['date_create']?></td>
                                  <td><?php if ($value['status']==1) {
                                        echo "<small class='badge badge-success text-white'>Processed</small>";
                                  }else{
                                    echo "<small class='badge badge-warning text-white'>pending</small>";
                                    } ?></td>
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
<?php include ('inc/footer.php'); ?>