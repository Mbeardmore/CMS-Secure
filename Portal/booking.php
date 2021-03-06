<?php include "Includes/header.php";

include "Includes/sidenav.php";
include "Includes/topnav.php";
$event  =  escape($_GET['holiday_approve']);
$events = $conn->prepare("UPDATE events SET Approved = 'Approved' WHERE id = ? ");
$events->bind_param("s", $event);
$events->execute();

$stmtevent =  escape($_GET['holiday_edit']);

$stmt = $conn->prepare("SELECT id,title,start,`end`,signature,Approved FROM events WHERE id = ?");
$stmt->bind_param("i",$stmtevent);
$stmt->execute();
$stmt->bind_result($id,$title,$start,$end,$signature,$Approved);
$stmt->fetch();
$stmt->close()
?>
<body>
    <div id="wrapper">
<h1>Holiday Form</h1>
<form method="POST">
	<label for="jobtype">Name</label>
<input type="text" class="form-control" name="Name" value="<?php echo $title; ?>" style="width:50%">
<br>
<?php if (is_manager($_SESSION['u_name'])) { ?>
<label for="Status" >Status</label>
<br>
    <select class="selectpicker" name="Status"  value="<?php echo $Approved ?>" style="z-index:99; ">
        <option value="Approved">Accepted</option>
        <option value="Awaiting Approval" selected>Awaiting Approval</option>
        <option value="Canceled">Cancelled</option>
    </select>
 <br>
 <?php } ?>
 <br>
    <label for="date"> Start Date </label>
    <input type="date" class="form-control" id="date" name="start_date" value="<?php echo $start ?>" style="width:17%;">
<br>

    <label for="date"> End Date </label>
    <input type="date" class="form-control" id="date" name="end_date" value="<?php echo $end ?>" style="width:17%">
<br>

<?php if (isset($_GET['holiday_edit']))
{
	echo "
	<br>
	<input class='btn-primary' type='submit' name='Update' value='Update'>
	<br>";
} else
{

	echo "
	<label for='assign'> Signature</label>
<input type='text' class='form-control' name='Signature' style='width:50%'>
<br>
	<input class='btn-primary' type='submit' name='Submit' value='Submit'>";
}
?>
</form>
<?php

if(isset($_POST['Submit'])) {

	$name       = $_POST['Name'] . " " . "Annual Leave";
	$color      = "#02d1e0";
	$start_date = $_POST['start_date'];
	$signature  = $_POST['Signature'];
	$status     = 'Awaiting Approval';
	$flag       = '2';
	$enddate    = $_POST['end_date'];

	if (strtotime($enddate) < strtotime($start_date)) {

	return false;

	}

	$stmt = $conn->prepare("INSERT INTO events (title, color, start, `end`, signature, Approved, Code) VALUES (?,?,?,?,?,?,?) ");
	$stmt->bind_param("ssssssi", $name, $color, $start_date, $enddate, $signature, $status, $flag);
	$stmt->execute();
	$stmt->close();

} else {

if(isset($_POST['Update'])) {

	$title       = $_POST['Name'];
	$status      = $_POST['Status'];
	$startd      = $_POST['start_date'];
	$endd        = $_POST['end_date'];
	$id          = escape($_GET['holiday_edit']);
  	$code        = "0";

	$stmt = $conn->prepare("UPDATE events SET title = ?, start = ?, `end` = ?, Approved = ?, Code = ? WHERE id = {$id} ");
	$stmt->bind_param("sssss", $title, $startd, $endd, $status, $code);
	$stmt->execute();
  	$stmt->close();
  	header("Location: view-Holiday.php");
	}
}
 ?>
</div>
</body>
</div>
<?php  include "Includes/footer.php" ?>
