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
                /* height: 100%; */
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
				color: white;
				font-weight: bold;
                text-decoration: none;
                display: inline-block;
                cursor: pointer;
                width: 44%;
                background-color:  #41BB48;
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
            .deleteButton {
                background: #FFFFFF none repeat scroll 0 0;
                border: medium none;
                color: #fff;
                cursor: pointer;
                font-size: 17px;
                height: 33px;
                position: absolute;
                top: 0px;
                width: 33px;
                left : 270px;
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
            <?php $filterPayment =  $this->session->userdata('filterDataInput'); ?>
            <div class="content-page">
                <div class="content" style="margin-top: 2%">
                    <!-- Start Content-->
                    <div class="container-fluid">

                        <?php if ($this->session->flashdata('error')) { ?>

                            <div id="message" class="alert alert-danger alert-dismissable"><?php echo $this->session->flashdata('error'); ?></div>
                            
                            <?php }elseif($this->session->flashdata('message')){ ?>
                                <div id="message" class="alert alert-success alert-dismissable"><?php echo $this->session->flashdata('message'); ?></div>

                        <?php } ?>

                        <form method="POST" action="<?php echo base_url();?>index.php/admin/Splash/uploadData" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-xl-4">
                                    <label>Image: </label>
                                    <input type="file" class="form-control filters_style_input" name="file" required />
                                </div> <!-- end col -->

                                <div class="col-xl-4">
                                    <label>Date: </label>
                                  <input type="date" value="<?=(!empty($filterPayment['date']) ? $filterPayment['date'] : "")?>" class="form-control filters_style_input" placeholder="Date"  name="date" required />
                                </div> <!-- end col -->
                                
                                <div class="col-xl-4">  
                                    <label style="display: block;">Post: </label>
                                    <input style="width:10%" type="checkbox" value="yes" name="status">schedule post </input> 
                                </div> <!-- end col -->
                            </div>
                            <div class="row" style="margin-top:3%">
                                <div class="col-xl-6">  
                                    <button type="submit" class="form-control filters_style_input filter button"> Upload</button>
                                </div> <!-- end col -->
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card-box boxStyle filters_style" style= "margin-top: 3%">
                                    <div class="table-responsive"> 
                                        <div class="row" >
                                            <?php foreach ($splashData as $index) {?>
                                                
                                                <div class='col-md-4' style = "margin-top:3%">
                                                    <input type="hidden" name="id" value="<?php echo (string)$index['_id']; ?>" />
                                                    <img src="<?php echo str_replace("/var/www/html","http://3.120.159.133" , $index['image']); ?>" alt=""  class="img img-responsive"  />
                                                    <button class="deleteButton" type="button"> <i style="color : #41BB48;" class="fas fa-trash" aria-hidden="true"></i></button>
                                                    
                                                </div>
                                            <?php } ?>
                                        </div>
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

        <script>

            $('.deleteButton').click(function(){
                var id = $(this).closest("div.col-md-4").find("input[name='id']").val();
                $(this).closest("div.col-md-4").remove();
                $.ajax({
                    'url': '<?php echo base_url();?>index.php/admin/Splash/deleteSplash',
                    'type': 'POST',
                    'data': {id : id},
                    'success': function (response) {
                    }
                });
            })
        </script>
    </body>
</html>