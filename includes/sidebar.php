<style>
    .nameStyle{
        color: black;
        font-weight : bold;
        font-size   : 15px
    }
    #sidebar-menu > ul > li > a.active{
        height: 47px;
        background: linear-gradient(89.96deg, #82ED30 -11.08%, #39B54A 99.95%);
        border-radius: 16px;
        color: white;
        margin-right: 6%;
        margin-left: 2%;
    }
    #sidebar-menu > ul > li > a{
        bottom: 83.22%;
        font-size: 14px;
        line-height: 20px;
        color: #FFFFFF; 
    }
    #sidebar-menu > ul > li > a:hover{
        color: #cbcdd3; 
    }
</style>
<div class="left-side-menu" style="background-color: #000000">
    <div class="slimscroll-menu">
        <!--- Sidemenu -->
        <?php         
            $userArray = $this->session->userdata('user_data');
            $tabName   = $this->session->userdata('tabName');

            $Paymentclass = '';
            $Dashboard    = '';
            $splash1       = '';
            $support      = '';
            $user         = '';

            if($tabName == 'Dashboard'){

                $Dashboard = 'active';
            }
            elseif($tabName == 'payments'){    

                $Paymentclass = 'active';
            }elseif($tabName == 'splash'){

                $splash1 = 'active';
            }elseif($tabName == 'support'){

                $support = 'active';
            }elseif($tabName == 'users'){

                $user = 'active';
            }
        ?>
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">

                <li class="mt-3">
                    <a href="<?php echo base_url();?>index.php/admin/Dashboard/index" class= "<?php echo $Dashboard;?>">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url();?>index.php/admin/users/index" class= "<?php echo $user;?>">
                        <i class="mdi mdi-account-outline" medium></i>
                        <span> Users </span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url();?>index.php/admin/Payment/index" class= "<?php echo $Paymentclass;?>">
                        <i class="far fa-credit-card"></i>
                        <span> Payments </span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url();?>index.php/admin/Support/index" class= "<?php echo $support;?>">
                        <i class="far fa-comments"></i>
                        <span> Support </span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url();?>index.php/admin/Splash/index" class= "<?php echo $splash1;?>">
                        <i class="fas fa-image"></i>
                        <span> Splash Screen</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
<script>

</script>