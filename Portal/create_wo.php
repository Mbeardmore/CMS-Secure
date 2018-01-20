<?php include "Includes/header.php"; ?>

<?php if(is_admin($_SESSION['u_name'])) { ?>

<body>

    <div id="wrapper">
        <?php include "Includes/sidenav.php"; ?>

        <?php include "Includes/topnav.php"; ?>

                    <div class="ibox-content" style="background-color:#f3f3f4;">

                    	<div class="col-lg-12">
                <h1 class="page-header">Create Work order</h1>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
                  Work Order Form
                  <div class="panel_heading" style="float:right">
                  <b>Creator:</b> <?php echo $_SESSION['u_first'] . " " . $_SESSION['u_last']; ?>
                  </div>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <div class="container" style="margin:0">
            <div class="row">
                <div class="col" style="float:left;">
                 <form method="POST" enctype="multipart/form-data">
                <div class="form-group" style="display:inline-grid;">
                <label for="jobtype"> Job Type </label>
                <select class="selectpicker" name="Jobtype">

                    <option value="Apple_Strip_FOH_Ardex">Apple Deep & Seal FOH / Ardex </option>
                    <option value="Apple_Strip_FOH_NoArdex">Apple Deep & Seal FOH/Non Ardex</option>
                    <option value="Apple_Strip_FOH_Terrazzo">Apple Deep & Seal FOH / Terrazzo</option>
                    <option value="Apple_ardex_removal">Apple Ardex Removal</option>
                    <option value="Apple_hone">Apple Stone Honing</option>
                    <option value="Apple_strip_BOH">Apple Strip & Seal BOH</option>
                    <option value="Stone_rest">Stone Floor Restoration</option>
                    <option value="wood_floor_rest">Wood Floor Restoration</option>
                    <option value="Hardfloor_rest">Hard Floor Restoration</option>
                    <option value="carpet_clean">Carpet Cleaning</option>
                    <option value="Slip_Treatment">Anti-Slip Treatment</option>
                    <option value="Annual Service">Annual Service </option>

                </select>
                </div>
                <br>
                <div class="form-group" style="float:left;">
                 <fieldset>
                  <div class="form-group">
                    <label for="textinput" style="">Company</label>
                      <input type="text" style="max-width:60%" name="company" placeholder="Apple" class="form-control">
                    </div>

                  <!-- Text input-->
                  <div class="form-group" style="position: relative;right:13px;">

                    <div class="col-sm-4">
                        <label for="textinput">Street</label>
                      <input type="text" placeholder="Street" name="street" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label  for="textinput">City</label>
                      <input type="text" placeholder="City" name="city" class="form-control">
                    </div>
                  </div>
                </fieldset>
                <br>
                <div class="form-group">
                    <label for="exampleSelect1">Active</label>
                    <select class="form-control" id="exampleSelect1" name="Active">
                        <option value="Inactive">Inactive</option>
                        <option value="Pending">Active</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                        <option value="Appointment">Appointment</option>
                    </select>
                </div>
                <div class="form-group" name="dates" style="display:inline-table;">
                <div class="form-group" style="max-width:45%;float:left;">
                    <label for="date"> Start Date </label>
                    <input type="date" class="form-control" id="date" name="start_date">
                </div>
                <div class="form-group" style="max-width:45%;float:right">
                    <label for="date"> End Date </label>
                    <input type="date" class="form-control" id="date" name="end_date">
                </div>
                </div>
                 <div class="form-group" style="">
 		  <label for="assign">Assigned Technicians</label>
 		  <br>
                 <select class="selectpicker" multiple="multiple" name="assigned[]" multiple data-actions-box="true" data-live-search="true">
                 <?php usersearch(); ?>
                 </select>
                 </div>
                <div class="form-group">
                <label for="assigned">Site Contact</label>
                <input type="text" class="form-control" name="site_contact">
                </div>
                <div class="form-group" >
                    <label for="Job-Details">Job Details</label>
                    <textarea class="form-control" name="Job-Details" id="" cols="30" rows="10" style="float:left;"></textarea>
                </div>
                <br>
                <br>
                <div style="position: relative;top:15px">
                <label for="file">Work Order Files</label>
                <div class="form-inline">
                  <div class="form-group">
                    <input type="file" name="file[]"  id="js-upload-files" multiple="multiple">
                  </div>
              </div>
            </div>
                <div class="form-group" style="position: relative;top:30px">
                    <input class="btn btn-primary" type="submit" name="create_wo" value="create">
                </div>
            </div>
                </div>
                <div class="col" style="float:right;width:45%">
                 <div class="form-group">
                <label for="jobtype">Client</label>
                <br>
                <select class="selectpicker" name="client">
                    <option value="Apple">Apple</option>
                    <option value="KPMG">KPMG</option>
                    <option value="DFS">DFS</option>
                    <option value="Bensons">Bensons</option>
                    <option value="Harveys">Harveys</option>
                    <option value="Interface">Interface</option>
                    <option value="Domestic">Domestic</option>
                    <option value="Private business">Business</option>

                </select>
                </div>
                 <div class="form-group">
                    <label for="title">Work Order Number</label>
                    <input type="text" id="wonumber" placeholder="WO1123423" class="form-control" name="wo_number">
                    <br>
                    <button class="btn btn-primary btn-sm"  OnClick="GetRandom()" type="button">generate</button>
                </div>
                <br>
                <div class="form-group">
                    <label for="title">Floor Size</label>
                    <input type="text" placeholder="324sqm" class="form-control" name="floor_size">
                </div>
                <div class="form-group">
                <label for="jobtype">Start Time</label>
                <input type="text" class="form-control" name="start_time">
                <br>
                <label for="jobtype">Work Order link</label>
                <input type="text" class="form-control" name="link">
                </div>
            </form>
                </div>
            </div>
         </div>
    </div>
</div>
</div>
</div>
</div>
 <?php
if (isset($_POST['create_wo'])) {
createworkorder();
}?>

</body>
<script>
    function GetRandom()
    {
        var myElement = document.getElementById("wonumber")
        myElement.value = Math.floor(Math.random() * 1002003434+999999999)
    }
</script>

<?php } else {header("Location: ../index.php");} ?>

<?php include "Includes/footer.php"; ?>
