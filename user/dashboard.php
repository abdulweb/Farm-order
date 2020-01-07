<?php include ('inc/header.php'); ?>
    <div class="main-wrapper">
        <?php include ('inc/topbar.php');?>
        <?php include ('inc/sidebar.php');?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-3">
                        <!-- <div class="dash-widget">
							<span class="dash-widget-bg1"><i class="fa fa-male" aria-hidden="true"></i></span>
							<div class="dash-widget-info text-right">
								<h3>98</h3>
								<span class="widget-title1">staff <i class="fa fa-check" aria-hidden="true"></i></span>
							</div>
                        </div> -->
                        <div class="card">
                            <div class="card-title"></div>
                            <div class="card-body">
                                <h4><?=$_SESSION['user'];?></h4>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
<?php include ('inc/footer.php'); ?>