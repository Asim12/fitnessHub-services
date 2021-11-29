<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Dashboard | Fitness-Hub</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Fitness-Hub" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <!-- <link rel="shortcut icon" href="<?php echo SURL;?>assets/images/logo2.png"> -->
        <!-- jvectormap -->
        <link href="<?php echo SURL;?>assets/libs/jqvmap/jqvmap.min.css" rel="stylesheet" />
        <!-- DataTables -->
        <link href="<?php echo SURL;?>assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo SURL;?>assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        <!-- App css -->
        <link href="<?php echo SURL;?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo SURL;?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo SURL;?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <style>
            .cardDisplay{
                display: inline-block;
                width: max-content;
            }
            .boxStyle {
                border-radius: 25px;
                border: 2px solid #e9ecef;
                width: 100%;
            }

            .button1{
                height: 30px;
                width: 119px;
                left: 1334px;
                top: 1188px;
                border-radius: 30.30092430114746px;
				background-color:  #B3F0CB;
				color: #00CC52;
				font-weight: bold;
                border: none;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                cursor: pointer;
            }
            .button2{
				background-color:  #FFE2E2;
				color: #FF5C5F;
				font-weight: bold;
                border: none;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                cursor: pointer;
                margin-top : 6%;
                height: 30px;
                width: 119px;
                left: 1334px;
                top: 1188px;
                border-radius: 30.30092430114746px;
            }

            .button3{
				background-color:  #FF6A6A;
				color: white;
				font-weight: bold;
                border: none;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                cursor: pointer;
                margin-top : 6%;
                height: 30px;
                width: 119px;
                left: 1334px;
                top: 1188px;
                border-radius: 30.30092430114746px;
            }
            .starFilled {
                height: 12.349213600158691px;
                width: 12.468695640563965px;
                left: 916.500244140625px;
                top: 1126.89990234375px;
                border-radius: 0px;
                color: #57B0AF; 
            }
            .unfilledStar{
                height: 12.349213600158691px;
                width: 12.468695640563965px;
                left: 916.500244140625px;
                top: 1126.89990234375px;
                border-radius: 0px;
                color: rgba(87, 176, 175, 0.5);
            }

            .images{ 
                height: 92.63783264160156px;
                width: 88.85176849365234px;
                left: 382.917724609375px;
                top: 1115.6809692382812px;
                border-radius: 0px;
            }

            .textStyle{ 
                height: 17px;
                width: 122.76869201660156px;
                left: 689.000244140625px;
                top: 1125px;
                border-radius: nullpx;
                color:black;
            }

            .nameStyle{ 
                height: 17px;
                width: 148.66522216796875px;
                left: 480.0958251953125px;
                top: 1124px;
                border-radius: nullpx;
                font-family: Gilroy;
                font-size: 20px;
                font-style: normal;
                font-weight: 700;
                line-height: 17px;
                letter-spacing: -0.18896104395389557px;
            }

            .timeAgo{
                position: absolute;
                width: 121.81px;
                height: 14px;
                left: 37%;
                top: 22%;
                font-family: Gilroy;
                font-style: normal;
                font-weight: normal;
                font-size: 14px;
                line-height: 16px;
                letter-spacing: -0.0944805px;
                color: #8C8C8C;
            }
            .parent {
                position: relative;
                top: 0;
                left: 0;
            }
            .image2 {
                position: relative;
                top: 0;
                left: 0;
                border: 1px white solid;
            }
            .image1 {
                position: absolute;
                top: 54%;
                left: 20%;
                width: 59px;
                height: 56px;
                border: 1px white solid;
            }


            .pagination a {
                color: black;
                float: left;
                padding: 8px 16px;
                text-decoration: none;
            }

            .pagination a.active {
                background-color: #4CAF50;
                color: white;
                border-radius: 5px;
            }

            .pagination a:hover:not(.active) {
                background-color: #ddd;
                border-radius: 5px;
            }

            .nameDesign{
                position: absolute;
                width: 158px;
                height: 22px;
                font-style: normal;
                font-weight: 600;
                font-size: 18px;
                line-height: 22px;
                color: #18243C;
            }
            .desigination{
              
              position: absolute;
              width: 158px;
              color: #7A7A7A;
          }
        </style>
    </head>
    <body>
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Topbar Start -->
            <?php include('includes/topbar.php');?>
            <!-- end Topbar -->
            <!-- ========== Left Sidebar Start ========== -->
            <?php include('includes/sidebar.php');?>
            <!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <div class="content">
                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                </div>
                            </div>
                        </div>     
                            <!-- end page title --> 

                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="card-box boxStyle">  

                                        <img src="<?php echo SURL;?>assets/images/3 User.png" alt="money" class="rounded-circle avatar-sm bx-shadow-lg" style= "background-color: rgba(0, 204, 82, 0.3)"/>
                                        
                                        <?php  $percentage = ($totalUser / 100) * 100; ?>
                                        <div class="row">
                                            <div class="col-xl-3">
                                                <h5 style= "color: black;font-weight: bold ;font-size: 20px;margin-left : 6%;"><?php echo $totalUser; ?></h5> 
                                            </div>
                                            <div class="col-xl-9" style="float:right;margin-top: 3%;">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percentage;?>%; background: linear-gradient(270deg, #B3F0CB 0%, #00CC52 112.41%);">
                                                    <span class="sr-only"><?php echo number_format($percentage, 1); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <h4 class="header-title" style="font-size:15px;margin-left:1%;">Signed Up Users</h4>
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-xl-4">
                                    <div class="card-box boxStyle">
                                        <img src="<?php echo SURL;?>assets/images/box.png" alt="money" class="rounded-circle avatar-sm bx-shadow-lg" />

                                        <div class="row">
                                            <div class="col-xl-3">
                                                <h5 style = "color: black;font-weight: bold ;font-size: 20px; margin-left:10%;">20</h5>
                                            </div>
                                            <div class="col-xl-9" style="float:right;margin-top: 3%;">

                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:20%; background: linear-gradient(270deg, #B3F0CB 0%, #00CC52 112.41%);">
                                                    <span class="sr-only">20</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <h4 class="header-title" style="font-size:15px; margin-left:2%;">Active Users</h4>
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-xl-4">
                                    <div class="card-box boxStyle">
                                        <img src="<?php echo SURL;?>assets/images/box.png" alt="money" class="rounded-circle avatar-sm bx-shadow-lg" />
                                        <div class="row">
                                            <div class="col-xl-3">
                                                <h5 style= "color: black;font-weight: bold;font-size: 20px; margin-left : 15%;">7</h5>
                                            </div>
                                            <div class="col-xl-9" style="float:right;margin-top: 3%;">

                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:7%;background: linear-gradient(270deg, #B3F0CB 0%, #00CC52 112.41%);">
                                                    <span class="sr-only">7</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="header-title" style="font-size:15px; margin-left : 4%;">Inactive Users</h4>
                                    </div>
                                </div> <!-- end col -->
                            </div>

                            <!-- end row -->

                            <div class= "row">
                                <div class="col-xl-9">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card-box boxStyle">
                                                <h4 class="header-title mb-3" style="color: black; font-size: 30px">Active Users</h4>
                                                <div class="boxStyle" style ="max-width: 95%">
                                                    <canvas id="activeUsers" width="800" height="300"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card-box boxStyle filters_style">
                                                <div class="table-responsive"> 
                                                    <table class="table table-centered table-hover mb-0" id="datatable">
                                                        <thead>
                                                            <tr>
                                                                <th class="border-top-0">Users</th>
                                                                <th class="border-top-0"></th>
                                                                <th class="border-top-0">Flagged</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>  
                                                            <?php foreach ($flagUsers as $flag){ ?>
                                                                <tr>
                                                                    <td>  
                                                                        <img src="<?php echo SURL;?>assets/images/male.png" alt="" class="rounded-circle images avatar-sm bx-shadow-lg image2">
                                                                    </td>
                                                                    <td>
                                                                        <span style="padding-left: 2%; color:black"><?php echo $flag['name']; ?></span><br />
                                                                        <span style="padding-left: 2%; color:black"><?php echo $flag['email']; ?></span>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                        
                                                                            $time_zone = date_default_timezone_get();
                                                                            $last_time_ago = time_elapsed_string($flag['flag_status_date'] , $time_zone);                                                                    
                                                                        ?>
                                                                        <span class="" title="<?php echo $flag['flag_status_date'];?>"> <?php echo $last_time_ago;?> </span>
                                                                    </td>
                                                                </tr>
                                                           <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3">

                                    <div class="row card-box boxStyle" style= "background-color :rgba(119, 228, 52, 1); height: fit-content">
                                        
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <h4 class="header-title" style="color:white; font-size :20px; font-weight:bold">30 Days</h4>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <h5 style= "color: white; font-size: 12px;">Money Make Last</h5>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-12" >
                                                    <h5 style= "color: white; font-weight: bold; font-size: 45px"><?php echo (empty($payment)) ? 0: $payment; ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <img src="<?php echo SURL;?>assets/images/phone.png" alt="money" class="rounded-circle bx-shadow-lg"style="float:right;" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card-box boxStyle">
                                                <div class="media">
                                                    <div class="media-body table-responsive">
                                                        <h5 class="mt-0">Recent Activity</h5>
                                                        <p class="text-muted"><?php echo date('Y-m-d'); ?></p>
                                                        <table class="">
                                                            <?php foreach ($activities as $activity) {?>
                                                                <tr>
                                                                    <td>
                                                                        <div class="row" style= "margin-top: 30%">
                                                                            <div class="col-xl-6">
                                                                                <?php if(empty($activity['profile_data'][0]['imageUrl']) || $activity['profile_data'][0]['imageUrl'] == ''|| is_null($activity['profile_data'][0]['imageUrl']) ){ 
                                                                    
                                                                                    $imageSource = SURL.'assets/images/male.png';
                                                                                }else{

                                                                                    $imageSource = $activity['profileData'][0]['imageUrl'];
                                                                                } ?>
                                                                           
                                                                                <img src="<?php echo $imageSource;?>" class="rounded-circle avatar-sm bx-shadow-lg">
                                                                            </div>
                                                                            <div class="col-xl-6">
                                                                                <div class="row">
                                                                                    <div class="col-xl-12">
                                                                                        
                                                                                        <span class="nameDesign" ><?php echo $activity['profile_data'][0]['name']; ?></span><br/>
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="row">
                                                                                    <div class="col-xl-8">
                                                                                        <span class="text-muted desigination"><?php echo $activity['activity_name']; ?></span>
                                                                                    </div>
                                                                                    <div class="col-xl-4">
                                                                                      
                                                                                        <?php
                                                                                            $time_zone = date_default_timezone_get();

                                                                                            $last_time_ago = time_elapsed_string($activity['created_date'] , $time_zone);                                                                    
                                                                                        ?>
                                                                                        <span style="margin-left: 168px;top: 5px;" class="timeAgo text-muted" title="<?php echo $activity['created_date'];?>"> <?php echo $last_time_ago;?> </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                        <div class="pagination" style= "padding-top: 6%;" ><?php  echo $this->pagination->create_links(); ?></div>
                                                    </div>
                                                </div>
                                            </div> <!-- end card-box-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- container -->
                    </div> <!-- content -->
                <!-- Footer Start -->
                <?php include('includes/footer.php');?>
                <!-- end Footer -->
            </div>
        </div>
        <!-- END wrapper -->
        <!-- Vendor js -->
        <script src="<?php echo SURL;?>assets/js/vendor.min.js"></script>
        <!-- KNOB JS -->
        <script src="<?php echo SURL;?>assets/libs/jquery-knob/jquery.knob.min.js"></script>
        <!-- Chart JS -->
        <script src="<?php echo SURL;?>assets/libs/chart-js/Chart.bundle.min.js"></script>
        <!-- Jvector map -->
        <script src="<?php echo SURL;?>assets/libs/jqvmap/jquery.vmap.min.js"></script>
        <script src="<?php echo SURL;?>assets/libs/jqvmap/jquery.vmap.usa.js"></script>
        <!-- Datatable js -->
        <script src="<?php echo SURL;?>assets/libs/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo SURL;?>assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo SURL;?>assets/libs/datatables/dataTables.responsive.min.js"></script>
        <script src="<?php echo SURL;?>assets/libs/datatables/responsive.bootstrap4.min.js"></script>
        <!-- Dashboard Init JS -->
        <script src="<?php echo SURL;?>assets/js/pages/dashboard.init.js"></script>
        <!-- App js -->
        <script src="<?php echo SURL;?>assets/js/app.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
        <script>

            window.onload = function() {
                new Chart(document.getElementById("activeUsers"), {
                    type: 'line',
                    
                    data: {
                        labels: ['12AM', '1AM', '2AM', '3AM', '4AM', '5AM', '6AM','7AM','8AM', '12AM','12AM','12AM','12AM','12AM','12AM','12AM','12AM'],
                        datasets: [
                            { 
                                data: [1, 2, 3, 4, 0, 6, 7, 2, 9, 3, 11, 9 , 13, 40, 1, 3,7],
                                label: "users",
                                borderColor: "#51C741",
                                fill: true,
                                // backgroundColor: gradient,
                                display:false,
                            }
                        ]
                    },
                    options: {
                        title: {
                        }, scales: {
                        yAxes: [{
                            ticks: {
                            },gridLines: {
                                display: false
                            }
                        }],
                        xAxes: [{
                            ticks: {
                            },gridLines: {
                                display: false
                            }    
                        }]
                    }
                    }
                });
            
            }
            $(document).ready(function() {
            });
        </script>
    </body>
</html>