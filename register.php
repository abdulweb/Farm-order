<?php
    include('dbh.php');
    include('user.php');
?>
<?php include ('inc/header.php'); ?>
    <div class="main-wrapper  account-wrapper">
        <div class="account-page">
            <div class="account-center">
                <div class="account-box">
                <?php
                        if(isset($_POST['registerBtn']))
                        {
                            $username = $_POST['email'];
                            $password = $_POST['password'];
                            $confirmpassword = $_POST['confirmpassword'];
                            $object = new user();
                           $object->registerUser($username,$password,$confirmpassword);
                        }
                    ?>
                    <form action="" class="form-signin" method="post">
						<div class="account-logo">
                            <a href="index.php"><img src="assets/img/logo-dark.png" alt=""></a>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                       <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="confirmpassword">
                        </div>
                       
                        <div class="form-group text-center">
                            <button class="btn btn-success account-btn" name="registerBtn" type="submit">Signup</button>
                        </div>
                        <div class="text-center login-link">
                            Already have an account? <a href="index.php">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include ('inc/footer.php'); ?>