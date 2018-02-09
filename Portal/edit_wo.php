<?php
include "Includes/header.php";
if (is_admin($_SESSION['u_name'])) {

include "Includes/sidenav.php";
include "Includes/topnav.php";

if (isset($_GET['edit_wo'])) {


$woID = escape($_GET['edit_wo']);
          $query = "SELECT * FROM work_orders WHERE ID = {$woID}";


          $select_wo = mysqli_query($connection, $query);

          $row = mysqli_fetch_assoc($select_wo);
          $id             = $row['ID'];
          $jobtype        = $row['Job_type'];
          $creator        = $row['creator'];
          $wonum          = $row['Work_Order'];
          $jobloc         = $row['job_location'];
          $company        = $row['company'];
          $street         = $row['street'];
          $city           = $row['city'];
          $creation       = $row['date_today'];
          $datestart      = $row['date_start'];
          $dateend        = $row['date_end'];
          $Assigned       = $row['Assigned_user'];
          $jobinfo        = $row['job_info'];
          $floorsize      = $row['floor_size'];
          $status         = $row['status'];
          $contact        = $row['site_contact'];
          $client         = $row['client'];
          $start          = $row['Start'];


}
}
 ?>

    <div id="wrapper">
                    <div class="ibox-content" style="background-color:#f3f3f4;">

                    	<div class="col-lg-12">
                <h1 class="page-header"> Edit Work order</h1>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
                  Work Order Form
                  <div class="panel_heading" style="float:right">
                  <b>Editor:</b> <?php echo $_SESSION['u_first'] . " " . $_SESSION['u_last']; ?>
                  </div>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
                <form method="POST" enctype="multipart/form-data">


                <br>
                 <div class="form-group" style="float:left;width:45%;">
                 <fieldset>

                  <div class="form-group">
                    <label for="textinput" style="">Company</label>
                      <input type="text" style="max-width:60%" name="company" value="<?php echo $company; ?>" placeholder="Apple" class="form-control">
                    </div>

                  <!-- Text input-->
                  <div class="form-group" style="position: relative;right:13px;">

                    <div class="col-sm-4">
                        <label for="textinput">Street</label>
                      <input type="text" placeholder="Street" name="street" value="<?php echo $street; ?>" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label  for="textinput">City</label>
                      <input type="text" placeholder="City" name="city" value="<?php echo $city; ?>" class="form-control">
                    </div>
                  </div>
                </fieldset>
                </div>
                <div class="form-group" style="float:right;width:45%">
                    <label for="title">Work Order Number</label>
                    <input type="text" placeholder="WO1123423" class="form-control" name="wo_number" value="<?php echo $wonum; ?>">
                </div>
                <div class="form-group" style="float:right;width:25%;position:relative;right:20%">
                    <label for="title">Floor Size</label>
                    <input type="text" placeholder="324sqm" class="form-control" value="<?php echo $floorsize; ?>" name="floor_size">
                </div>
                <div class="form-group" style="max-width:25%; display:block;">
                    <label for="exampleSelect1">Active</label>
                    <select class="form-control" id="exampleSelect1" name="Active">
                        <option value="Inactive">Inactive</option>
                        <option value="Pending" selected>Active</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="form-group" name="dates" style="display:inline-table;">
                <div class="form-group" style="max-width:45%;float:left;">
                    <label for="date"> Start Date </label>
                    <input type="date" class="form-control" id="date" name="start_date" value="<?php echo $datestart; ?>">
                </div>
                <div class="form-group" style="max-width:45%;float:right">
                    <label for="date"> End Date </label>
                    <input type="date" class="form-control" id="date" name="end_date" value="<?php echo $dateend; ?>">
                </div>
                </div>
                <div class="form-group" style="width:35%;"">
                <label for="assign"> Assigned Technicians </label>
                 <input type="text" placeholder="" name="assigned" value="<?php echo $Assigned; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group" style="display:inline-grid;position:relative;left:1%;width: 30%"">
                <label for="assigned">Site Contact</label>
                <input type="text" class="form-control" value="<?php echo $contact; ?>" name="site_contact">
                </div>
                <br>
                <div class="form-group" style="display:inline-grid;position:relative;left:1%;width:15%">
                <label for="assigned">Start Time</label>
                <input type="text" class="form-control" value="<?php echo $start; ?>" name="start_time">
                </div>
                <br>
                <br>
                <br>
                <br>
                <div class ="form-group" style="display:flow-root;position:relative;bottom:5rem;margin:1%;">
                <div class="form-group" style="width:50%;">
                    <label for="Job-Details">Job Details</label>
                    <textarea class="input-block-level" id="summernote" name="Job-Details" rows="18"><?php echo $jobinfo; ?>
          </textarea>
                    <script>
                      $(document).ready(function() {
                          $('#summernote').summernote({

                            height: "300px"
                          });


                      });
                    </script>
                        </div>
                </div>
                <label for="files">Work Order Files</label>
                  <div class="form-group" name="files" style="margin-left:1%">
                    <input type="file" name="file[]"  id="js-upload-files" multiple="multiple">
                  </div>
                  <br>
                  <br>
                 <div class="form-group" style="margin:1%;">
                    <input class="btn btn-primary" type="submit" name="update_wo" value="Update">
                </div>



                <br>

                </form>

            <?php if(isset($_POST['update_wo'])) {

                $creator = $_SESSION['u_first'];
                $company = escape($_POST['company']);
                $street   = escape($_POST['street']);
                $city     = escape($_POST['city']);
                $wonumber = escape($_POST['wo_number']);
                $floorsize = escape($_POST['floor_size']);
                $active =      $_POST['Active'];
                $startdate = $_POST['start_date'];
                $enddate =   $_POST['end_date'];
                $assigned = $_POST['assigned'];
                $starttime = $_POST['start_time'];
                $Jobdetails = escape ($_POST['Job-Details']);
                $sitecontact = escape($_POST['site_contact']);
                $upload  = $_FILES['file'];
                $path = "work_order_files/$wonumber.$company/";
                $combined = $wonumber . " " . $company . " " . $assigned;

                  if(!empty($_POST['wo_number'])) {

                    if(!is_dir($path)) {

                          mkdir($path);
                } else {

                  if (is_dir($path)) {
                    $valid_formats = array(
                      "jpg",
                      "jpeg",
                      "JPEG",
                      "JPG",
                      "png",
                      "PDF",
                      "pdf",
                      "doc"
                    );
                    foreach($_FILES['file']['name'] as $f => $name) {

                      $fileext = explode('.', $name);
                      $actualExt = strtolower(end($fileext));

                      if (in_array($actualExt, $valid_formats)) {

                        move_uploaded_file($_FILES['file']['tmp_name'][$f], $path . $name);
                        }
                        else
                        {
                        echo "Wrong File Extension";
                        }
                      }
                    }
                  }
                }



                  $query = "UPDATE work_orders SET ";
                  $query .="Work_Order  = '{$wonumber}', ";
                  $query .="company  = '{$company}', ";
                  $query .="street  = '{$street}', ";
                  $query .="city  = '{$city}', ";
                  $query .="city  = '{$city}', ";
                  $query .="status  = '{$active}', ";
                  $query .="date_start  = '{$startdate}', ";
                  $query .="date_end  = '{$enddate}', ";
                  $query .="Assigned_user  = '{$assigned}', ";
                  $query .="job_info  = '{$Jobdetails}', ";
                  $query .="Start = '{$starttime}',";
                  $query .="site_contact  = '{$sitecontact}' ";
                  $query .= "WHERE ID = {$id} ";

                  if($Assigned === $assigned) { } else {

                  $stmt = $conn->prepare("DELETE FROM assigned WHERE wo_num = ? ");
                  $stmt->bind_param("s", $wonum);
                  $stmt->execute();
                  $stmt->close();


                  $explode= explode(",", $assigned);
                  foreach ($explode as $user) {

                    $stmt =$conn->prepare("INSERT INTO assigned (wo_num, u_first) VALUES (?, ?) ");
                    $stmt->bind_param("ss", $wonumber, $user);
                    $stmt->execute();
                    $stmt->close();



                  }

                }

                  $query2 = "UPDATE events SET work_order = '{$wonumber}' WHERE work_order = '{$wonum}' ";
                  $query3 = "UPDATE assigned SET wo_num = '{$wonumber}' WHERE wo_num = '{$wonum}' ";
                  $query4 = "UPDATE wo_notes SET wo_num = '{$wonumber}' WHERE wo_num = '{$wonum}' ";
                  $query5 = "UPDATE job_messages SET Work_Order = '{$wonumber}' WHERE Work_Order = '{$wonum}' ";
                  $query6 = "UPDATE assigned SET wo_number = '{$wonumber}' WHERE wo_number '{$wonum}' ";

                  $stmt = $conn->prepare("UPDATE events SET title = ? WHERE work_order = ? ");
                  $stmt->bind_param("ss", $combined, $wonum);
                  $stmt->execute();
                  $stmt->close();
                  $assigned = mysqli_query($conn, $query6);
                  $womessages = mysqli_query($conn, $query5);
                  $wonotes = mysqli_query($conn, $query4);
                  $eventupdatewo = mysqli_query($conn, $query2);
                  $assignedupdate = mysqli_query($conn, $query3);

                  $query1 = "UPDATE events SET start = '{$startdate}', end = '{$enddate}' WHERE work_order = {$wonumber} ";

                  $event = mysqli_query($connection, $query1);
                  $result = mysqli_query($connection, $query);

                  header("Location: view_wo.php?view_wo={$id}");
            }


              ?>
        </div>
    </div>
</div>
</div>
</div>


<?php include "Includes/footer.php" ?>
