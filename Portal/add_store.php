<?php include "Includes/header.php"; ?>

<?php if(is_admin($_SESSION['u_name'])) { ?>
<body>
    <div id="wrapper">
        <?php include "Includes/sidenav.php"; ?>
        <?php include "Includes/topnav.php"; ?>
                    <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Items</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Apple Store Information
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
    <form action="" method="POST" enctype="multipart/form-data">

      <div class="form-group">
         <label for="title">Store ID</label>
          <input   type="text" class="form-control" name="store_id">
      </div>
      <div class="form-group">
         <label for="title">Location</label>
          <input   type="text" class="form-control" name="Location">
      </div>
      <div class="form-group" style="width:40%;">
         <label for="title">Preservation Officer</label>
          <input   type="text" class="form-control" name="pres_officer">
      </div>
      <div class="form-group" style="width:40%;">
         <label for="title">Original Floor Seal</label>
          <input  type="text" class="form-control" name="original_seal">
      </div>
      <div class="form-group" style="width:20%;">
         <label for="title">FOH Size</label>
          <input  type="text" class="form-control" name="FOH_size">
      </div>
      <div class="form-group" style="width:40%;">
         <label for="title">BOH Size</label>
          <input  type="text" class="form-control" name="BOH_size">
      </div>
     <div class="form-group" style="display:inline-grid;">
                <label for="jobtype">Access card required</label>
                <select class="selectpicker" name="Access">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
                </div>
       <div class="form-group" style="width:40%;">
         <label for="title">Date Of last Works</label>
          <input   type="text" class="form-control" name="last_job">
      </div>
      <div class="form-group" style="width:40%;">
         <label for="title">Closing Time</label>
          <input   type="text" class="form-control" name="closing_time">
      </div>
      <div class="form-group">
  <label for="comment">Comment:</label>
  <textarea class="form-control" rows="5" id="comment"></textarea>
</div>
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_store" value="Create Store">
      </div>
</form>
<?php
if (isset($_POST['create_store'])) {

$storeid = escape($_POST['store_id']);
$location = escape($_POST['Location']);
$pres_officer = escape($_POST['pres_officer']);
$seal = escape($_POST['original_seal']);
$FOH = escape($_POST['FOH_size']);
$BOH = escape($_POST['BOH_size']);
$Access = escape($_POST['Access']);
$last_job =  escape($_POST['last_job']);
$closing = escape($_POST['closing_time']);
$comment = escape($_POST['comment']);

$stmt = $conn->prepare("INSERT INTO stores (store_ID, Location, po_specialist, `orig_seal`, foh_size, boh_size, Access, last_job, closing_time, comments) VALUES (?,?,?,?,?,?,?,?,?,?) ");
$stmt->bind_param("ssssssssss", $storeid, $location, $pres_officer, $seal, $FOH, $BOH, $Access, $last_job, $closing, $comment);
$stmt->execute();
$stmt->close();
header("Location: add_store.php");
}
 } else {
 header ("Location: ../index.html");
}
?>
 </div> 
 <?php include "Includes/footer.php"; ?>
