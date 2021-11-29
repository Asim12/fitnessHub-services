<!doctype html>
<html lang="en">
  <head>
        <meta charset="utf-8" />
        <title>Log In | Fitness-Hub</title>
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <!-- <meta content="Fitness-Hub" name="description" /> -->
        <!-- <meta content="Coderthemes" name="author" /> -->
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge" /> -->
        <!-- App favicon -->
        <!-- <link rel="shortcut icon" href="<?php echo SURL;?>assets/images/favicon.png"> -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <link rel="stylesheet" href="<?php echo SURL;?>assets/css/style.css">
	</head>
	<body class="img" style=" background-color:#8a8a8a7d ;background-image: url(<?php echo SURL;?>assets/images/newback.png);background-size: 148% 100%;">
    
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <img  style="margin-left: -1%"src="<?php echo SURL;?>assets/images/front.png" alt="" height="20%" width="8%">

                    <div style="margin-left: 30%">
                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center mb-5">
                                
                                <img src="<?php echo SURL;?>assets/images/Group.png" alt="" height="90%" width="50%">
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center mb-5">
                                <h2 class="heading-section" style="font-size :48px; color: black">Sign in</h2>
                                <h3 style="font-size: 16px; color: #b3b3b3"> Enter Your details below</h3>
                            </div>
                        </div>
                        
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-lg-4">
                                <div class="login-wrap p-0">
                                    <form action="<?php echo base_url();?>index.php/admin/Login/VerifyLogin" method="post" class="signin-form">
                                        <div class="mt-2"> <?php if($this->session->flashdata('error')) echo $this->session->flashdata('error'); ?></div>

                                        <div class="form-group">
                                            <label style="color:black">Username or Email</label>
                                            <input style="color:black; border-radius:13px; background-color:white" name="email" type="text" class="form-control" placeholder="Username" required>
                                        </div>
                                        <div class="form-group">
                                            <label style="color:black"> Password </label> <span style="float: right"> <a href="#" style="color: #00CC52; font-size:14px">Forgot Password?</a> </span>
                                            <input style="color:black; border-radius:13px;background-color:white" name="password" id="password-field" type="password" class="form-control" placeholder="Password" required>
                                            <span style="top: 70%;color:black" toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                        <div class="form-group" style="margin-top:13%">

                                            <button type="submit" style="background-color: #00CC52;border-radius:13px"  class="form-control submit px-3">Sign In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img  style="margin-left: 92%;"src="<?php echo SURL;?>assets/images/end.png" alt="" height="30%" width="15%">
        <script src="<?php echo SURL; ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo SURL; ?>assets/js/popper.js"></script>
        <script src="<?php echo SURL; ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo SURL; ?>assets/js/main.js"></script>
	</body>
</html>

