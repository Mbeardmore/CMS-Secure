<?php include "Includes/header.php"; ?>
<body>

    <div id="wrapper">
        <?php include "Includes/sidenav.php"; ?>

        <?php include "Includes/topnav.php"; ?>
   
                    <div class="ibox-content" style="background-color: #f3f3f4">

                    	<?php
                    	if (isset($_GET['edit_user'])) {

$userid = escape($_GET['edit_user']);

$query = "SELECT * FROM user WHERE ID = {$userid} ";
$select_user = mysqli_query($connection, $query);

$row = mysqli_fetch_assoc($select_user);
    $id              = $row['ID'];
    $username        = $row['u_name'];
    $first           = $row['u_first'];
    $last            = $row['u_last'];
    $email           = $row['u_email'];
    $userrole        = $row['user_role'];          

?>
<body>
  <div id="wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Edit User Details</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
                            Item Additions
                        </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="title">username</label>
                  <input value="<?php echo htmlspecialchars(stripslashes($username)); ?>"  type="text" class="form-control" name="user">
                  </div>
                  <div class="form-group" >
                    <label for="title">First Name</label>
                    <input  value="<?php echo htmlspecialchars(stripslashes($first)); ?>" type="text" class="form-control" name="f_name">
                    </div>
                    <div class="form-group" ">
                      <label for="title">Last Name</label>
                      <input value="<?php echo htmlspecialchars(stripslashes($last));?>"  type="text" class="form-control" name="l_name">
                      </div>
                      <div class="form-group" >
                        <label for="title">email</label>
                        <input value="<?php echo htmlspecialchars(stripslashes($email)); ?>" type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                           <label for="title">password</label>
                            <input  type="password" class="form-control" name="pwd">
                        </div>
                        <?php if(is_manager($_SESSION['u_name'])) { ?>
                        <div class="form-group">
                          <label for="Role">User Role</label>
                          <select class="form-control" placeholder="
                            <?php echo $userrole; ?>" name="user_role" id="Role">
                            <option value="
                              <?php echo $userrole; ?>">
                              <?php echo $userrole; ?>
                            </option>
                            <option valie="Super-Admin">Super-Admin</option>
                            <option value="Manager">Manager</option>
                            <option value="Admin">Admin</option>
                            <option value="Tech">Technician</option>

                          </select>
                        </div>
                        <?php
                        } else { } ?>
                        <div class="form-group">
                          <input class="btn btn-primary" type="submit" name="update_user" value="update user" id="update">
                          </div>
                        </form>
                        <?php 

if(isset($_POST['update_user'])) {

updateuser($userid);
   }

}

  ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
  
</div>
</div>