<?php
include "Includes/header.php";
include "Includes/sidenav.php";
include "Includes/topnav.php";
if (isset($_GET['new_video']) && is_manager($_SESSION['u_name'])) {

if (isset($_POST['Add_Video'])) {

  $title = $_POST['title'];
  $link  = $_POST['youtube'];
  $desc  = $_POst['vid_desc'];
  $date  = date("d/m/y");
  $upload= $_SESSION['u_first'];

$vid = $conn->prepare("INSERT INTO media (title, link, description, `date`, uploader) VALUES (?,?,?,?,?) ");
$vid->bind_param("sssss", $title, $link, $desc, $date, $upload);
$vid->execute();
$vid->close();
if(!$vid->execute()) echo $vid->error;
header("Location: help.php");
}  ?>
  <div class="panel-body" id="formbody">
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Title</label>
    <input value=""  type="text" class="form-control" name="title" style="Width:40%">
    </div>
    <div class="form-group">
    <label for="title">Youtube Link</label>
    <input value=""  type="text" class="form-control" name="youtube" placeholder="www.youtube.com/watch?v=G1ueDkb_S6Q"style="width:40%" required>
    </div>
    <br>
    <div class="form-group">
    <input class="btn btn-primary" type="submit" name="Add_Video" value="Add Video">
    </div>
  </form>
</div>
<?php } else {
  if (is_manager($_SESSION['u_name'])) { echo "<a href='help.php?new_video' class='btn btn-primary' style='float:right;margin-top:1%;''> Add new Video</a>";}?>
  <div class="wrapper">
    <div class="container-fluid" style="margin:3% auto;border: 3px dotted #e5e5e5;">
        <div class="row" style="padding-top:3%">
          <?php
            $stmt = $conn->prepare("SELECT ID, title, link, description, `date`,  uploader FROM media ");
            $stmt->execute();
            $stmt->bind_result($id, $title, $link, $description, $date, $uploader);
            while ($stmt->fetch())
            {
              echo "
              <div class='col-sm-4'>
                <div class='card' style='width:auto'>
                  <div class='embed-responsive embed-responsive-16by9'>
                      <iframe class='embed-responsive-item' src='{$link}'></iframe>
                  </div>
                  <div class='card-block'>
                    <h4 class='card-title'>{$title}</h4>
                  </div>
                </div>
              </div>";
            }
          }?>
        </div>
    </div>
  </div>
  <?php include "Includes/footer.php" ?>
