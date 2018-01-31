<?php
include "Includes/header.php";
 ?>

<?php if(is_admin($_SESSION['u_name'])) { ?>
<body>
     <div id="wrapper">
        <?php include "Includes/sidenav.php"; ?>
        <?php include "Includes/topnav.php"; ?>
                    <div class="ibox-content" style="background-color:#f3f3f4;">
                    	<div class="col-lg-12">
                <h1 class="page-header">Work Order Accomodation</h1>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
                  Accommodation
                  <div class="panel_heading" style="float:right">
                  <b>Creator:</b> <?php echo $_SESSION['u_first'] . " " . $_SESSION['u_last']; ?>
                  </div>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group" style="max-width:25%; display:block;">
                    <label for="exampleSelect1">Acommodation Type</label>
                    <select class="form-control" id="exampleSelect1" name="accom_type">
                        <option value="Hotel">Hotel</option>
                        <option value="House">House</option>
                        <option value="Flat">Flat</option>
                    </select>
                </div>
                 <div class="form-group" style="float:left;width:45%;">
                 <fieldset>
                  <div class="form-group">
                    <label for="textinput" style="">Address</label>
                      <input type="text" style="max-width:60%" name="address" placeholder="32 fitzgerald close" class="form-control">
                    </div>

                  <!-- Text input-->
                  <div class="form-group" style="position: relative;right:13px;">

                    <div class="col-sm-4">
                        <label for="textinput">Town</label>
                      <input type="text" placeholder="London" name="town" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label  for="textinput">Postcode</label>
                      <input type="text" placeholder="L10 TQ2" name="post_code" class="form-control">
                    </div>
                  </div>
                </fieldset>
                </div>
                <div class="form-group" style="float:right;width:45%">
                    <label for="title">Work Order Number</label>
                    <input type="text" placeholder="WO1123423" class="form-control" name="wo_number">
                </div>
                <div class="form-group" style="float:right;width:25%;position:relative;right:20%">
                    <label for="title">Arrival Time</label>
                    <input type="text" placeholder="19:30" class="form-control" name="arrival">
                </div>
                <div class="form-group" style="width: 30%">
                <label for="assigned">Home Owners Phone Number/ Name</label>
                <input type="text" class="form-control" name="site_contact">
                </div>
                <br>
                <br>
                <br>
                <br>
                <div class ="form-group" style="display:flow-root;position: relative;top:-50px">
                <div class="form-group" style="width:45%;top:-50px;float:left;">
                    <label for="Job-Details">Special Instructions</label>
                    <textarea class="form-control" name="special" id="" cols="30" rows="10" style="float:left;"></textarea>
                </div>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="create_accom" value="create">
                </div>
            </form>
            <?php
                if (isset($_POST['create_accom']))
                {
                 $accomtype    =  escape($_POST['accom_type']);
                  $address      = escape($_POST['address']);
                  $town         = escape($_POST['town']);
                  $post_code    = escape($_POST['post_code']);
                  $wonum        = escape($_POST['wo_number']);
                  $arrival      = escape($_POST['arrival']);
                  $owner        = escape($_POST['site_contact']);
                  $special      = escape($_POST['special']);

                  $query = "INSERT INTO acommodation (accom_type, Address, Town, Postcode, work_order, Arrival, owner, special_ins) ";
                  $query .= "VALUES ('{$accomtype}','{$address}','{$town}','{$post_code}','{$wonum}','{$arrival}','{$owner}','{$special}') ";
                  $accomresult = mysqli_query($conn, $query);

                  confirmQuery($accomresult);
                 }?>
        </div>
    </div>
</div>
</div>
</div>
</body>
<?php } else {header("Location: ../index.php");} ?>
<?php include "Includes/footer.php"; ?>
