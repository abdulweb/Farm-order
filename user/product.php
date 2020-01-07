<?php include ('inc/header.php'); ?>
    <div class="main-wrapper">
        <?php include ('inc/topbar.php');?>
        <?php include ('inc/sidebar.php');?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Orders</h4>
                    </div>
                </div>
                <?php
                        if(isset($_POST['profileBtn']))
                        {
                            $fname = $_POST['fname'];
                            $lname = $_POST['lname'];
                            $dob = $_POST['dob'];
                            $gender = $_POST['gender'];
                            $address = $_POST['address'];
                            $phoneNo = $_POST['phoneNo'];
                            $email = $_POST['email'];
                           $object->userProfile($fname,$lname,$dob,$gender,$address,$phoneNo,$email);
                        }

                        if (isset($_POST['CheckOut']) && !empty($_SESSION['shopping_cart'])) {
                          // echo "<script>alert('coming here')</script>";
                            foreach ($_SESSION['shopping_cart'] as $values) 
                            {

                                $productID = $values['item_id'];
                                  $cust_id = $_SESSION['user'];
                                  $quantity = $values['item_quantity'];
                                $object->cartOrder($productID, $cust_id, $quantity);
                            }
                            echo "<script>alert('Order Placed Success ')</script>";
                            echo '<script>window.location = "product.php"</script>';
                            unset($_SESSION['shopping_cart']);

                        }

                        if (isset($_POST['add_to_cart'])) {
  
                          if (isset($_SESSION['shopping_cart'])) {
                            # code...
                            $item_array_id = array_column($_SESSION['shopping_cart']  , 'item_id');
                            if (!in_array($_GET['id'], $item_array_id)) {
                              # code...
                              $count = count($_SESSION['shopping_cart']);
                              $item_array = array('item_id' => $_GET['id'], 
                                                'item_name' => $_POST['cart'],
                                                'item_price' => $_POST['price'],
                                                'item_quantity' => $_POST['quantity'],
                            );
                            $_SESSION['shopping_cart'] [$count] = $item_array;
                            }
                            else{
                                echo "<script>alert('Item Already Added ')</script>";
                                echo '<script>window.location = "product.php"</script>';
                            }

                          }
                          else{
                            
                            
                            $item_array = array('item_id' => $_GET['id'], 
                                                'item_name' => $_POST['cart'],
                                                'item_price' => $_POST['price'],
                                                'item_quantity' => $_POST['quantity'],
                            );
                            $_SESSION['shopping_cart'] [0] = $item_array;
                          }
                        }

                        if (isset($_GET["action"])) {
                          # code...
                          if ($_GET["action"] == "delete") {
                            # code...
                            foreach ($_SESSION['shopping_cart'] as $keys => $values) {
                              if ($values['item_id'] == $_GET['id']) {
                                # code...
                                unset($_SESSION['shopping_cart'][$keys]);
                                echo '<script>alert("Item Removed")</script>';
                                echo '<script>window.location="product.php"</script>';
                              }
                              // echo '<script>alert("Item Not Removed")</script>';
                              // //unset($_SESSION['shopping_cart']);
                            }
                          }
                        }


                    ?>
                    <?php
                    $result = $object->allOneUser($_SESSION['user']);
                        if (empty($result)) {
                           header('location:profile.php');
                        }
                ?>
                <?php if (!empty($_SESSION['shopping_cart'])) {?>
                  <h3 style="text-align: center;">Order Carts</h3>
                  <div class="table-responsive">
                    <table class="table table-bordered"  border="1">
                        <thead>
                          <tr>
                            <!-- <th>S/N</th> -->
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                             <th>Total</th>
                             <th style="">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                      <?php

                      $total = 0;
                      foreach ($_SESSION['shopping_cart'] as $keys => $values) {
                        # code...
                      
                      ?>
                             <form method="post" action="product.php">
                              <tr>
                                            <td><?php echo $values['item_name']; ?></td>
                                <td><?php echo $values['item_quantity']; ?></td>
                                 <td><?php echo $values['item_price']; ?></td>
                                  <td><?php echo number_format($values['item_quantity'] * $values['item_price'] , 2); ?></td>
                                  <td><a href="product.php?action=delete&id=<?php echo $values['item_id']; ?>"><span style="font-size: 19px;" class="text-align fa fa-trash" title="delete"></span></a></td>
                              </tr>
                              <?php

                              $total = $total + ($values['item_quantity'] * $values['item_price']);
                            }
                            ?>
                            <input type="hidden" name="mytotal" id="mytotal" value="<?php echo "$total";?>"/>
                            <tr>
                              <td colspan="3" align="right" style="font-weight: bold;">Total : </td>
                              <td align="right" style="font-weight: bold;"><?php echo '#'. number_format($total,2); ?></td>
                              <td  style="margin-left: -30px;"><a href="product.php?action=CheckOut"> <button type="submit" name="CheckOut" class="btn btn-success fa fa-shopping-cart" style="width: 107px;"> CheckOut</button></a></td>
                            </tr>
                         <?php }
                         // else
                         //  echo "<script>alert('shopping cart empty')</script>";
                          ?>
                          </form>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                       <table class="table table-border table-striped custom-table datatable mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Quantity Availabe</th>
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
                                  <td class="text-right">
                                        <form method="POST" action="product.php?action=add&id=<?php echo $value['id']?>">
                                            <input type="number" name="quantity" id="quantity" placeholder="0" required="required" title="Please Enter a Number" style="width: 60px;">
                                          <input type="hidden" name="cart" value="<?=$value['name']?>">
                                          <input type="hidden" name="price" value="<?=$value['price']?>">
                                          <button class="btn btn-sm btn-success" name="add_to_cart" type="submit"><i class="fa fa-plus"></i> Add to cart</button> 
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
<?php include ('inc/footer.php'); ?>