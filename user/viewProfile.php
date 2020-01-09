
<div class="content">
<div class="row">
    <div class="col-sm-7 col-6">
        <h4 class="page-title">My Profile</h4>
    </div>
    <?php
         
    ?>
    <div class="col-sm-5 col-6 text-right m-b-30">
        <a href="editprofile.php?id=<?php echo htmlentities($result['email']);?>" class="btn btn-success btn-rounded"><i class="fa fa-plus"></i> Edit Profile</a>
    </div>
</div>
<div class="card-box profile-header">
    <div class="row">
        <div class="col-md-12">
        <?php
            if (!empty($_SESSION['update_succ_msg'])) {
               echo $_SESSION['update_succ_msg'];
            }
            if (!empty($_SESSION['update_err_msg'])) {
               echo $_SESSION['update_err_msg'];
            }
        ?>
            <div class="profile-view">
                <div class="profile-img-wrap">
                    <div class="profile-img">
                        <a href="#"><img class="avatar" src="<?=$result['passport']?>" alt=""></a>
                    </div>
                </div>
                <div class="profile-basic">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="profile-info-left">
                                <h3 class="user-name m-t-0 mb-0" ><?=$result['fname'] . " ", $result['lname']?></h3>
                                
                            </div>
                        </div>
                        <div class="col-md-7">
                            <ul class="personal-info">
                                <li>
                                    <span class="title">Phone:</span>
                                    <span class="text"><a href="#"><?=$result['phone']?></a></span>
                                </li>
                                <li>
                                    <span class="title">Email:</span>
                                    <span class="text"><a href="#"><?=$result['email']?></a></span>
                                </li>
                                <li>
                                    <span class="title">Birthday:</span>
                                    <span class="text"><?=$result['dob']?></span>
                                </li>
                                <li>
                                    <span class="title">Address:</span>
                                    <span class="text"><?=$result['address']?></span>
                                </li>
                                <li>
                                    <span class="title">Gender:</span>
                                    <span class="text"><?=$result['gender']?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
    </div>
</div>
<div class="profile-tabs">
    <ul class="nav nav-tabs nav-tabs-bottom">
        <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">About</a></li>
    </ul>

</div>
</div>
<?php
    unset($_SESSION['update_succ_msg']);
    unset($_SESSION['update_err_msg']);
 ?>