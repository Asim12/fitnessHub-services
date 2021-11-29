<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Dashboard | Fitness-Hub</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Impressions" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <!-- <link rel="shortcut icon" href="<?php echo SURL;?>assets/images/favicon.png"> -->

        <!-- jvectormap -->
        <link href="<?php echo SURL;?>assets/libs/jqvmap/jqvmap.min.css" rel="stylesheet" />

        <!-- DataTables -->
        <link href="<?php echo SURL;?>assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo SURL;?>assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        
        <!-- App css -->
        <link href="<?php echo SURL;?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo SURL;?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo SURL;?>assets/css/app.min.css" rel="stylesheet" type="text/css" />      
        
        <!-- DROP DOWN STYLE -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

        <style>

            .userNameColorChange{
                color: black;
            }

            .filters_style {
                border-radius: 25px;
                border: 2px solid #e9ecef;
                width: 100%;
                height: 41px;
            }
            .filters_style_new {
                border-radius: 25px;
                border: 2px solid #e9ecef;
                width: 100%;
            }

            .filters_style_input {
                border-radius: 25px;
                border: 2px solid #e9ecef;
                width: 100%;
                background-color : #F9F9F9;
                height: 90%;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                /* border: 1px solid #dddddd; */
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
                width: 40%;
                text-align: center;
            }

            .buttonReset{
                border-radius: 25px;
				color: white;
				font-weight: bold;
                text-decoration: none;
                display: inline-block;
                cursor: pointer;
                width: 40%;
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
            <div class="content-page">
                <div class="content" style="margin-top: 2%">
                <?php $filterData =  $this->session->userdata('filterData');?>
                    <!-- Start Content-->
                    <div class="container-fluid">
                        <form method="POST" action="<?php echo base_url();?>index.php/admin/Users/index">
                            <div class="row">
                                <div class="col-xl-6">  
                                    <select id="select-state" name="location" class="form-control filters_style" placeholder="Select country...">
                                        <option value="" selected>Select Country</option>
                                            <?php foreach ($getAllCountries as $country) {?>
                                                <option value="<?php echo $country['code']; ?>" <?php echo ( !empty($filterData['location']) &&  $filterData['location'] ==  $country['code']) ? "selected" : ""; ?> > <?php echo $country['name'];?></option>
                                            <?php } ?>
                                    </select>
                                </div> <!-- end col -->

                                <div class="col-xl-6">                                    
                                    <button type="submit" class="form-control filters_style_input filter button">Filter</button>
                                    <a class= "form-control filters_style_input filter buttonReset"href="<?php echo base_url();?>index.php/admin/Users/resetFilter">Reset</a>
                                </div> <!-- end col -->
                            </div>
                        </form>

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card-box boxStyle filters_style_new" style= "margin-top: 3%">
                                    <div class="table-responsive"> 
                                        <table class="table table-centered table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="border-top-0">Image</th>
                                                    <th class="border-top-0">Name/Email</th>
                                                    <th class="border-top-0">Gym/Price</th>
                                                    <th class="border-top-0">Location</th>
                                                    <th class="border-top-0">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php foreach ($users as $user){?>
                                                    <tr>
                                                        <td>  
                                                            <img src="<?php echo SURL;?>assets/images/male.png" alt="" class="rounded-circle images avatar-sm bx-shadow-lg image2">
                                                        </td>
                                                        <td><?php echo $user['name']; ?><br /><?php echo $user['email'];?></td>
                                                        <td>
                                                            Outer <br />
                                                            <?php echo ($user['packageData']) ? '$'.$user['packageData'][0]['price'].' Monthly' : '--';?>
                                                        </td>
                                                        <td>Pakistan</td>
                                                        <td>Active</td>
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


        <!-- APPLY SEARCH OPTIN IN DROP dOWN -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>

        <script>
            $("#checkAll").click(function(){
                $('input:checkbox').not(this).prop('checked', this.checked);
            });

            $(document).ready(function () {
                $('select').selectize({
                    sortField: 'text'
                });
            });
            $(document).ready(function () {
                $(".selectize-input").addClass("filters_style");
                $(".selectize-dropdown").addClass("filters_style");
             
            });
        </script>
    </body>
</html>