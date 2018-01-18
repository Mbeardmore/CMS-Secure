<?php
include "Includes/header.php";
include "Includes/sidenav.php";
include "Includes/topnav.php";
$id = $_GET["edit_spec"];
$stmt1 = $conn->prepare("SELECT ID, job_type, instructions FROM Specification WHERE ID = ? ");
$stmt1->bind_param("s", $id);
$stmt1->execute();
$stmt1->bind_result($ids, $job_type, $instructions);
$stmt1->fetch();
$stmt1->close();
?>
<div id="wrapper">
 	<div class="ibox-content">
 		<div class="col-lg-12">
         	<h1 class="page-header">Edit WorkOrder Specification</h1>
        </div>
        	<form method="POST">
        		<?php if (isset($_GET['edit_spec'])) {
        			echo "
        			<div class='form-group'>
        			<label for='Job-Type'>Job Type</label>
        			<input class='form-control' type='text' name='Job-Type' value='{$job_type}' style='width:30%' disabled>
        			</div>";
        		} else { ?>
        		<div class="form-group">
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
		        <?php } ?>
		            <br>
						<div class="form-group" style="width:50%;">
 					<label for="Job-Details">Job Specification</label>
 					<textarea class="input-block-level" id="summernote" name="Job-Details" rows="18"><?php echo $instructions; ?></textarea>
 				</div>
 				<?php if (isset($_GET['edit_spec'])) {

 					echo "<input class='btn btn-primary' type='submit' name='update'>";
 				} else  {
 					echo "<input class='btn btn-primary' type='submit' value='Add new' name='newspec'>";
 				}
 				?>

 			</form>
 	   </div>
 </div>
<?php
if (isset($_POST['update'])) {
	$specdetails = escape($_POST['Job-Details']);
	$stmt = $conn->prepare("UPDATE Specification SET instructions = ? WHERE id = ?");
	$stmt->bind_param("si", $specdetails,$id);
	$stmt->execute();
	$stmt->close();
} elseif (isset($_POST['newspec'])) {
	$jobtype    = $_POST['Jobtype'];
	$jobdetails = escape($_POST['Job-Details']);

	$stmt2 = $conn->prepare("INSERT INTO Specification (job_type,instructions) VALUES (?,?)");
	$stmt2->bind_param("ss", $jobtype, $jobdetails);
	$stmt2->execute();
	$stmt2->close();
}
 ?>
<script>
$(document).ready(function() {
  $('#summernote').summernote({
    height: "300px"
  });
});
</script>
<?php include "Includes/footer.php" ?>
