<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Dashboard | Fitness-Hub</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Impressions" name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <!-- <link rel="shortcut icon" href="<?php echo SURL;?>assets/images/favicon.png"> -->

        <!-- jvectormap -->
        <link href="<?php echo SURL;?>assets/libs/jqvmap/jqvmap.min.css" rel="stylesheet" />
        
        <!-- App css -->
        <link href="<?php echo SURL;?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo SURL;?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo SURL;?>assets/css/app.min.css" rel="stylesheet" type="text/css" />    

        <style>
            .userNameColorChange{
                color: black;
            }
            .filters_style {
                border-radius: 25px;
                border: 2px solid #e9ecef;
                width: 100%;
            }

            .filters_style_input {
                border-radius: 25px;
                border: 2px solid #e9ecef;
                width: 100%;
                background-color : #F9F9F9;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                border-bottom: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            .styleHeader{

                color: black;
                font-weight : bold
            }
           
            .styleShow{
                color       : black;
                font-weight : bold;
                margin-left : -11%;
            }

            .button{
              	border-radius: 25px;
				background-color:  #57B0AF;
				color: white;
				font-weight: bold;
                text-decoration: none;
                display: inline-block;
                cursor: pointer;
                width: 44%;
            }

            .buttonReset{
                border-radius: 25px;
				color: white;
				font-weight: bold;
                text-decoration: none;
                display: inline-block;
                cursor: pointer;
                width: 44%;
                background-color:  #ff0e0e;
                text-align: center;
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
            <?php $filterSupport =  $this->session->userdata('filterDataSupport'); ?>

            <div class="content-page">
                <div class="content" style="margin-top: 2%">
                    <!-- Start Content-->
                    <div class="container-fluid">
                        <form method="POST" action="<?php echo base_url();?>index.php/admin/Support/index">
                            <div class="row">
                                <div class="col-xl-4">
                                <label>From: </label>
                                    <input type="date" value="<?=(!empty($filterSupport['start_date']) ? $filterSupport['start_date'] : "")?>" class="form-control filters_style_input" placeholder="start date" name="start_date" />
                                </div> <!-- end col -->

                                <div class="col-xl-4">
                                <label>To: </label>
                                  <input type="date" value="<?=(!empty($filterSupport['end_date']) ? $filterSupport['end_date'] : "")?>" class="form-control filters_style_input" placeholder="end date"  name="end_date" />
                                </div> <!-- end col -->

                                <div class="col-xl-4">  
                                    <label style="display: block;">Search: </label>                                  
                                    <button type="submit" class="form-control filters_style_input filter button">Filter</button>
                                    <a class= "form-control filters_style_input filter buttonReset"href="<?php echo base_url();?>index.php/admin/Support/resetFilter">Reset</a>
                                    <i class="glyphicon glyphicon-calendar"></i> 
                                </div> <!-- end col -->
                            </div>
                        </form>

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card-box boxStyle filters_style" style= "margin-top: 3%">
                                    <div class="table-responsive"> 
                                        <table class="table table-centered table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="border-top-0">Image</th>
                                                    <th class="border-top-0">Name</th>
                                                    <th class="border-top-0">Phone No.</th>
                                                    <th class="border-top-0">Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>  
                                                <?php foreach ($data as $support) { ?>
                                                    <tr>
                                                        <td>  
                                                            <img src="<?php echo SURL;?>assets/images/male.png" alt="" class="rounded-circle images avatar-sm bx-shadow-lg image2">
                                                        </td>
                                                        <td><span style="padding-left: 2%; color:black">Asim</span></td>
                                                        <td> 92313-5936985 </td>
                                                        <td>asim@gmail.com</td>
                                                    </tr>
                                               <?php } ?>
                                            </tbody>
                                        </table>
                                        <div class="pagination" ><?php  echo $this->pagination->create_links(); ?></div>
                                    </div>
                                </div> 
                            </div> 
                        </div> <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <?php include('includes/footer.php');?>
                <!-- end Footer -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
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
    </body>
</html>