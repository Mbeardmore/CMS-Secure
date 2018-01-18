<?php include "Includes/header.php";

include "Includes/sidenav.php";
include "Includes/topnav.php";


$event  =  escape($_GET['holiday_approve']);

$events = $conn->prepare("UPDATE events SET Approved = 'Approved' WHERE ID = ? ");
$events->bind_param("s", $event);
$events->execute();

$editevent =  escape($_GET['holiday_edit'])

?>
    <div id="wrapper">
<?php
if(is_manager($_SESSION['u_name'])) {
 echo "<table class='table table-hover' style='width:50%;'>
<th>User</th>
<th>Start Date</th>
<th>End Date</th>
<th></th>
<th>Status</th>
<tbody>";

$query = $conn->prepare("SELECT ID, title, start, `end`,  signature, Approved FROM  events WHERE Approved = 'Awaiting Approval' OR  Code = '2' ORDER BY id DESC LIMIT 30 ");
$query->execute();
$query->bind_result($id, $title, $start, $end, $sig, $approved);

while($query->fetch()) {

echo "
<tr class='clickable-row'>
<td class='project-title'>{$title}</td>
<td class='project-title'>{$start}</td>
<td class='project-title'>{$end}</td>
<td class='project-title'>{$signature}</td>
<td style='top:10px; position:relative' class='project-status'><span class='label label-warning'>{$approved}</span></td>
<td class='project-actions'><a href='booking.php?holiday_edit={$id}' class='btn btn-white btn-sm'>Edit</a>"; if ($approved === "Awaiting Approval") { echo "<a href='booking.php?holiday_approve={$id}' class='btn btn-white btn-sm'>Approve</a></td>";} else {}"
</tr>
";

}
$query->close();;
}

include "Includes/footer.php" ?>
