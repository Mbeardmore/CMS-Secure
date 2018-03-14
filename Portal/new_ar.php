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
                <select class="selectpicker" name="AR_type">
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
                      <input type="text" style="max-width:60%" name="AR-Title" placeholder="New Feature: Client login" class="form-control">
                    </div>
                </fieldset>
                <div class="form-group">
                <label for="assigned">Requested By</label>
                <input type="text" class="form-control" name="Request">
                </div>
                <div class="form-group" >
                    <label for="Job-Details">AR Details</label>
                    <textarea class="form-control" name="AR-Details" id="" cols="75" rows="10" style="float:left;" placeholder="Either details on how the bug occured,  or what features and how you want them to work"></textarea>
                </div>
                <div class="form-group" style="position: relative;top:30px">
                    <input class="btn btn-primary" type="submit" name="create_AR" value="create">
                </div>
            </div>
                </div>
                <div class="col" style="float:right;width:45%">
                  <div class="form-group">
                      <label for="exampleSelect1">Priority</label>
                      <select class="form-control" id="exampleSelect1" name="Priority">
                          <option value="High">High</option>
                          <option value="Medium">Medium</option>
                          <option value="Low">Low</option>
                      </select>
                  </div>
                <div class="form-group">
                    <label for="title">AR Number</label>
                    <input type="text" id="wonumber" class="form-control" name="AR_number">
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
if (isset($_POST['create_AR'])) {
  $ARtitle   = $_POST['AR-Title'];
  $ARType    = $_POST['AR_type'];
  $ARNumber  = $_POST['AR_number'];
  $Requested = $_POST['Request'];
  $Priority  = $_POST['Priority'];
  $ARDetails = $_POST['AR-Details'];
  $stmt = $conn->prepare("INSERT INTO features (AR_NO, AR_TYPE, AR_TITLE, AR_DETAILS, AR_REQUEST, AR_PRIORITY) VALUES (?,?,?,?,?,?)");
  $stmt->bind_param("isssss", $ARNumber, $ARType, $ARtitle, $ARDetails, $Requested, $Priority);
  $stmt->execute();
  $stmt->close();

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
