<?php
include "Includes/header.php";
include "Includes/sidenav.php";
include "Includes/topnav.php";
if (isset($_GET['new_video']) || isset($_GET['edit_video'])  && is_manager($_SESSION['u_name'])) {
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
}
if(isset($_GET['edit_video'])) {
$ID = $_GET['edit_video'];
$stmt = $conn->prepare("SELECT title, link FROM media WHERE ID = {$ID} ");
$stmt->execute();
$stmt->bind_result($T,$L);
$stmt->fetch();
$stmt->close();
}
if (isset($_POST['Edit_Video'])) {
 $newtitle = $_POST['title'];
 $newlink = $_POST['youtube'];
$stmt = $conn->prepare("UPDATE media SET title = ?, link = ? WHERE ID = ?");
$stmt->bind_param("ssi",$newtitle, $newlink, $ID);
$stmt->execute();
$stmt->close();
header("Location: help.php?edit_video=$ID");
}
?>
<div class="panel-body" id="formbody">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="title">Title</label>
      <br>
      <?php echo $link;
      echo $Title; ?>
      <input  type="text" class="form-control" value="<?php echo $T; ?>" name="title" style="Width:40%">
    </div>
    <div class="form-group">
      <label for="title">Youtube Link</label>
      <input type="text" class="form-control" name="youtube"  value="<?php echo $L; ?>"placeholder="www.youtube.com/watch?v=G1ueDkb_S6Q"style="width:40%" required>
    </div>
      <br>
    <div class="form-group">
      <?php if(isset($_GET['edit_video'])) {?>
      <input class="btn btn-primary" type="submit" name="Edit_Video" value="Submit">
    <?php } else { ?>
      <input class="btn btn-primary" type="submit" name="Add_Video" value="Add Video">
    <?php } ?>
    </div>
  </form>
</div>
<?php }  else { ?>
  <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-sm-4">
          <h2>Video Section</h2>
          <ol class="breadcrumb">
              <li>
                  <a href="index.php">Homepage</a>
              </li>
              <li class="active">
                  <strong>Video Section</strong>
              </li>
          </ol>
      </div>
      <div class="col-sm-8">
          <div class="title-action">
            <?php if (is_manager($_SESSION['u_name'])) { echo "<a href='help.php?new_video' class='btn btn-primary'>New Video</a>";} ?>
          </div>
      </div>
  </div>
  <div class="wrapper" style="margin-top:3%;">
    <div class="container-fluid" style="margin:3% auto;border: 3px dotted #e5e5e5;">
        <div class="row" style="padding-top:1.5%; padding-bottom:1.5%;">
          <?php
            $stmt = $conn->prepare("SELECT ID, title, link, description, `date`,  uploader FROM media ");
            $stmt->execute();
            $stmt->bind_result($id, $title, $link, $description, $date, $uploader);
            while ($stmt->fetch())
            {
              echo "
              <a href='help.php?edit_video={$id}'>
              <div class='col-sm-4'>
                <div class='card' style='width:auto'>
                <h3 class='card-title'><center>{$title}</center></h3>
                  <div class='embed-responsive embed-responsive-16by9'>
                      <iframe class='embed-responsive-item' src='{$link}'></iframe>
                  </div>
                  <div class='card-block'>
                </div>
              </div>
            </div>
            </a>";
            }
          }
      ?>
        </div>
    </div>
  </div>
  <?php include "Includes/footer.php" ?>
