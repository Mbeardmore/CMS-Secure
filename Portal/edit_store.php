<?php include "Includes/header.php";?>

<?php if(is_admin($_SESSION['u_name'])) { 

$store_query = escape($_GET['store_id']);

$stmt = $conn->prepare("SELECT ID, store_ID, Location, po_specialist, orig_seal, foh_size, boh_size, Access, last_job, closing_time, comments FROM stores WHERE ID = {$store_query}");
$stmt->execute();
$stmt->bind_result($ID, $store_id, $location, $po_specialist, $orig_seal, $foh, $boh, $access, $last_job, $closing, $comment);
$stmt->fetch(); 
$stmt->close();
?>


<body>

    <div id="wrapper">
        <?php include "Includes/sidenav.php"; ?>

        <?php include "Includes/topnav.php"; ?>
   
                    <div class="ibox-content">

                       
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Store</h1>
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
          <input   type="text" class="form-control" name="store_id" value="<?php echo $store_id; ?>" >
      </div>
      <div class="form-group">
         <label for="title">Location</label>
          <input   type="text" class="form-control" name="Location" value="<?php echo $location; ?>">
      </div>
      <div class="form-group" style="width:40%;">
         <label for="title">Preservation Officer</label>
          <input   type="text" class="form-control" name="pres_officer" value="<?php echo $po_specialist; ?>">
      </div>
      <div class="form-group" style="width:40%;">
         <label for="title">Original Floor Seal</label>
          <input  type="text" class="form-control" name="original_seal" value="<?php echo $orig_seal; ?>">
      </div>
      <div class="form-group" style="width:20%;">
         <label for="title">FOH Size</label>
          <input  type="text" class="form-control" name="FOH_size" value="<?php echo $foh; ?>">
      </div>
      <div class="form-group" style="width:40%;">
         <label for="title">BOH Size</label>
          <input  type="text" class="form-control" name="BOH_size" value="<?php echo $boh; ?>">
      </div>
     <div class="form-group" style="display:inline-grid;">
                <label for="jobtype">Access card required</label>
                <select class="selectpicker" name="Access" value="<?php echo $access; ?>">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
                </div>
       <div class="form-group" style="width:40%;">
         <label for="title">Date Of last Works</label>
          <input   type="text" class="form-control" name="last_job" value="<?php echo $last_job; ?>">
      </div>
      <div class="form-group" style="width:40%;">
         <label for="title">Closing Time</label>
          <input   type="text" class="form-control" name="closing_time" value="<?php echo $closing; ?>">
      </div>
      <div class="form-group">
  <label for="comment">Comment:</label>
  <textarea class="form-control" rows="5" name="comment" id="comment" value=""><?php echo $comment; ?></textarea>
</div>
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_store" value="Update Store">
      </div>


</form>

<?php

if (isset($_POST['update_store'])) {

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


$stmt = $conn->prepare("UPDATE stores SET store_ID = ?, Location = ?, po_specialist = ?, orig_seal = ?, foh_size = ?, boh_size = ?, Access = ?, last_job = ?, closing_time = ?, comments = ? WHERE ID = {$ID} ");
$stmt->bind_param("ssssssssss", $storeid, $location, $pres_officer, $seal, $FOH, $BOH, $Access, $last_job, $closing, $comment);
$stmt->execute();
$stmt->close();

header("Location: edit_store.php?store_id={$ID}");




}
 } else {

 header ("Location: ../index.html");

}

?>
 </div> 

 <?php include "Includes/footer.php"; ?>