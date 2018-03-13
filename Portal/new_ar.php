<?php include "Includes/header.php"; ?>

<?php if(is_admin($_SESSION['u_name'])) { ?>

<body onload="GetRandom()">

    <div id="wrapper">
        <?php include "Includes/sidenav.php"; ?>

        <?php include "Includes/topnav.php"; ?>

                    <div class="ibox-content" style="background-color:#f3f3f4;">

                    	<div class="col-lg-12">
                <h1 class="page-header">Create Action Request</h1>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
                  AR Form
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
                <label for="jobtype">AR Type</label>
                <select class="selectpicker" name="Jobtype">
                 <option selected style="display:none;">Please Select One</option>
                    <option value="New_Feature">New Feature</option>
                    <option value="Bug">Report Bug</option>
                   
                </select>
                </div>
                <br>
                <div class="form-group" style="float:left;">
                 <fieldset>
                  <div class="form-group">
                    <label for="textinput" style="">AR Title</label>
                      <input type="text" style="max-width:60%" name="company" placeholder="New Feature: Client login" class="form-control">
                    </div>
                </fieldset>
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
                 
                <div class="form-group">
                <label for="assigned">Site Contact</label>
                <input type="text" class="form-control" name="site_contact">
                </div>
                <div class="form-group" >
                    <label for="Job-Details">AR Details</label>
                    <textarea class="form-control" name="Job-Details" id="" cols="75" rows="10" style="float:left;" placeholder="Either details on how the bug occured,  or what features and how you want them to work"></textarea>
                </div>

                <div class="form-group" style="position: relative;top:30px">
                    <input class="btn btn-primary" type="submit" name="create_wo" value="create">
                </div>
            </div>
                </div>
                <div class="col" style="float:right;width:45%">
                 <div class="form-group">
                <label for="jobtype">Priority</label>
                <br>
                <select class="selectpicker" name="client">
                    <option selected style="display:none;">Please Select One</option>
                    <option value="Apple">High</option>
                    <option value="Apple">Medium</option>
                    <option value="Apple">low</option>
                </select>
                </div>
                <div class="form-group">
                    <label for="title">AR Number</label>
                    <input type="text" id="wonumber" class="form-control" name="wo_number">
                </div>
                <br>
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
