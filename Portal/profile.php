<?php
ob_start();
include "Includes/header.php";
include "Includes/sidenav.php";
include "Includes/topnav.php";
if(is_tech($_SESSION['u_name'])) { } else { die(); }
$session = $_SESSION['ID'];
$query = "SELECT * FROM user WHERE ID = {$session}";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result))
{
    $image     = $row['user_image'];
}
$user = $_SESSION['u_first'];
$query1 = "SELECT * FROM assigned WHERE u_first = '$user' ";
$numrows = mysqli_query($conn, $query1);
$count = mysqli_num_rows($numrows);
?>
<div class="page-wrapper">
 <div class="row m-b-lg m-t-lg">
                <div class="col-md-6">

                    <div class="profile-image">
                        <img src="Images/user_images/<?php echo $image; ?>" class="img-circle circle-border m-b-md" alt="profile">
                    </div>
                    <div class="profile-info">
                        <div class="">
                            <div>
                                <h2 class="no-margins">
                                    <?php echo $_SESSION['u_first'] . " " . $_SESSION['u_last']; ?>
                                </h2>
                                <h4> </h4>
                                <small>
                                    Small Bio here
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <table class="table small m-b-xs">
                        <tbody>
                        <tr>
                            <td>
                                <strong><?php echo $count; ?></strong> Projects you have been assigned to this year!
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>


            </div>
</div>
<?php include "Includes/footer.php"; ?>
