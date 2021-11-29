

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
    .newStyle{
        left: 16%;
        top: 201%;
        font-style: normal;
        font-weight: normal;
        line-height: 21px;
        margin-top:-3%;
    }
    .searchBar {
        color: black;
        border-radius: 25px;
        border: 2px solid #fff;
    }
    .badge{
        position: absolute;
        top: 13px;
        margin-left: -1%;
        right: 6px;
        padding: 5px 7px;
        border-radius: 50%;
        background: red;
        color: black;
    }
</style>
<div class="navbar-custom" style="-webkit-box-shadow: none;box-shadow: none; background-color: #eee ">
    <ul class="list-unstyled topnav-menu float-right mb-0">
        <li class="app-search d-none d-md-block">
            <form>
                <input style="color:black; background-color: #fff" type="text" placeholder="Search..." class="form-control searchBar">
                <button type="submit" class="sr-only"></button>
            </form>
        </li>

        <?php
            $userData = $this->session->userdata('user_data');

            $notificationData = getAdminNotification();
            $notificationCount = countAdminNotification();
        ?>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-bell noti-icon text-dark"></i>
                <span class="badge"><?php echo ($notificationCount['data'] == 0 ? '' : $notificationCount['data']); ?></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                <div class="dropdown-item noti-title">
                    <h5 class="m-0">
                        <span class="float-right">
                            <ahref="" class="text-dark" id="markAllRead" style="cursor: pointer;">
                                <small>Read All</small>
                            </a>
                        </span>Notification
                    </h5>
                </div>

                <div class="slimscroll noti-scroll" style="position: relative; overflow: hidden; width: auto; max-height:445px">

                    <?php foreach ($notificationData['data'] as $notification) { 

                        $time_zone = date_default_timezone_get();
                        $last_time_ago = time_elapsed_string($notification['created_date'] , $time_zone);

                        if(empty($notification['profile_details'][0]['imageUrl'])){
                            
                            $profile_img = SURL.'assets/images/male.png';
                        }else{
                            
                            $profile_img = $notification['profile_details'][0]['imageUrl'];
                        }
                        ?>
                        <a href="javascript:void(0);" class="dropdown-item notify-item active">
                            <div class="notify-icon">
                                <img src="<?php echo $profile_img; ?>" class="img-fluid rounded-circle" alt="" />
                            </div>
                            <p class="notify-details"><?php echo $notification['message']; ?>
                                <small title="<?php echo $notification['created_date'];?>" class="text-muted"><?php echo $last_time_ago;?>
                                </small>
                            </p>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img style= "padding-left:25%" src="<?php echo SURL;?>assets/images/imageP.png" alt="user-image" class="rounded-circle">

            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <div class="dropdown-item noti-title">
                    <h6 class="m-0">
                        Welcome Asim!
                    </h6>
                </div>
                <div class="dropdown-divider"></div>

                <a href= "<?php echo base_url();?>index.php/admin/Login/logoutUser" class="dropdown-item notify-item">
                    <i class="dripicons-power"></i>
                    <span>Logout</span>
                </a>
            </div>
        </li>
    </ul>
    <ul class="list-unstyled menu-left mb-0">
        <li class="float-left">
            <a href="<?php echo base_url();?>index.php/admin/login/index" class="logo">
                <span class="logo-lg" style="background-color: #000000">
                    <img src="<?php echo SURL;?>assets/images/Group.png" alt="" height="1%" width="50%" style = "margin-top: 7%">
                </span>
                <span class="logo-sm" style="background-color: #000000">
                    <img src="<?php echo SURL;?>assets/images/Group.png" alt="" height="1%" width="50%" style = "margin-top: 7%">
                </span>
            </a>
        </li>
        <li class="float-left">
            <a class="button-menu-mobile navbar-toggle" style = "background-color: #eeeeee">
                <div class="lines">
                    <span style="background-color: black;"></span>
                    <span style="background-color: black;"></span>
                    <span style="background-color: black;"></span>
                </div>
            </a>
        </li>
        <?php  $userArray = $this->session->userdata('user_data'); 
               $tabName   = $this->session->userdata('tabName');
               if(empty($tabName)){
                $tabName = 'Dashboard';
               }
        ?>

        <li class="float-left" style="position:fixed; margin-left:1%;display:inline-block" >
            <h3 class="pt-2" style = "font-weight: bold; color: black; "><?php echo $tabName; ?></h3>
            <h5 class="newStyle">Morning Asim, Welcome to Fitness-Hub Dashboard</h5>
        </li>
    </ul>
</div> 
<script>
    $(document).ready(function(){
        $('#markAllRead').click(function(){
            $.ajax({
                'url': '<?php echo base_url();?>index.php/admin/Dashboard/markAllReadss',
                'type': 'POST',
                'data': "",
                'success': function (response) {
                    $('.badge').remove();
                }
            });
        });
    });
</script>