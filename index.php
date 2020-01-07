<?php
    include('dbh.php');
    include('user.php');
?>
<?php include ('inc/header.php'); ?>

    <div class="main-wrapper account-wrapper">
        <div class="account-page">
			<div class="account-center">
				<div class="account-box">
                    <?php
                        if(isset($_POST['login_btn']))
                        {
                            $username = $_POST['email'];
                            $password = $_POST['password'];
                            $object = new user();
                           $object->login($username,$password);
                        }
                    ?>
                    <form action="index.php" class="form-signin" method="post">
						<div class="account-logo">
                            <a href="#"><img src="assets/img/logo-dark.png" alt=""></a>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" autofocus="" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group text-right">
                            <a href="forgot-password.html">Forgot your password?</a>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="login_btn" class="btn btn-success account-btn">Login</button>
                        </div>
                        <div class="text-center register-link">
                            Don’t have an account? <a href="register.php">Register Now</a>
                        </div>
                    </form>
                </div>
			</div>
        </div>
    </div>
    <?php include ('inc/footer.php'); ?>
