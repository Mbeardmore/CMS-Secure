<?php
$session = $_SESSION['ID'];
$query = "SELECT user_image FROM user WHERE ID = {$session}";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result))
{
    $image = $row['user_image'];
}
?>
<div id="wrapper">
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                    <img href="../index.php" alt="image" class="img-circle" src="Images/user_images/<?php echo $image;?>" style="width:100px;height:100px;">
                     </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION['u_first'] . " " . $_SESSION['u_last'] ?></strong>
                     </span> <span class="text-muted text-xs block"><?php echo $_SESSION['user_role'] ?><b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.php">Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="Includes/logout.php">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    B+
                </div>
            </li>
            <li>
                <a href="index.php"><i class="fa fa-diamond"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <?php if (is_manager($_SESSION['u_name'])) { ?>
            <li>
                <a href="Features.php"><i class="fa fa-bug"></i> <span class="nav-label" >Features Tracker</span></a>
            </li>
          <?php } ?>
          <li>
              <a href="siteaudit.php"><i class="fa fa-sitemap"></i> <span class="nav-label">Site Audit</span></a>
          </li>
            <li>
                <a href=""><i class="fa fa-info"></i> <span class="nav-label">Help Section</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="help.php">Videos</a>
                        <a href="help-section.php">Help Documents</a>
                    </li>
                </ul>
            </li>
            <?php if(is_manager($_SESSION['u_name']) && $settings[Company]['View Logs'] === '1')  { ?>
            <li>
                <a href="#"><i class="fa fa-log"></i> <span class="nav-label">Phone Logs</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="#">View Phone Logs</a></li>
                    <li><a href="#">New Phone Log</a></li>
                </ul>
            </li>
             <?php } if(is_manager($_SESSION['u_name'])) { ?>
            <li>
                <a href=""><i class="fa fa-th-large"></i> <span class="nav-label">Databases</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="store_info.php">Store Information Database</a>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <?php if(is_manager($_SESSION['u_name'])) { ?>
            <li>
            <a href=""><i class="fa fa-folder-open-o"></i> <span class="nav-label">Site Surveys</span> <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li><a href="create_appointment.php">Create Appointment</a></li>
                <li><a href="">Apple Site Survey</a></li> 
            </ul>
        </li>
        <?php } else {} ?>
            <li>
                <a href=""><i class="fa fa-briefcase"></i> <span class="nav-label">Work Orders</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="wo_search.php">View Work Order Projects</a></li>
                    <?php if(is_manager($_SESSION['u_name'])) { ?>
                    <li><a href="wo_search_completed.php">Completed Work Orders</a></li>
                    <li><a href="create_wo.php">Create Work Order</a></li>
                    <li><a  href="accomodation.php">Accomodation</a><li>
                    <?php } else {} ?>
                </ul>
            </li>
             <li>
                <a href=""><i class="fa fa-calendar"></i> <span class="nav-label">Calenders</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <?php if(is_manager($_SESSION['u_name'])) { ?>
                         <li><a href="calenderadmin.php">View Calender</a></li>
                         <li><a href="view-Holiday.php">View Booked Holidays</a></li>
                    <?php } else { ?>
                         <li><a href="calender.php">Calender</a></li>
                   <?php } ?>
                        <li><a href="booking.php">Book Holiday</a></li>
                </ul>
            </li>
            <?php if(is_manager($_SESSION['u_name'])) { ?>

             <li>
                <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Users</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="user.php">Create User</a></li>
                    <?php } else {}
                    if(is_manager($_SESSION['u_name'])) {?>
                    <li><a href="manage_user.php">Manage Users</a></li>
                    <?php } else {} ?>
                </ul>
            </li>
            <?php
            if (is_manager($_SESSION['u_name']) && $settings[Company]['View Settings'] == '1') { ?>
            <li>
                <a href="settings.php"><i class="fa fa-wrench"></i> <span class="nav-label">Settings</span></a>
            </li>
              <?php } ?>
        </ul>
    </div>
</nav>
</div>
