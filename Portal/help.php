<?php
include "Includes/header.php";
include "Includes/sidenav.php";
include "Includes/topnav.php";
if (isset($_GET['new_video']) && is_manager($_SESSION['u_name'])) {?>
  <div class="panel-body" id="formbody">
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Title</label>
    <input value=""  type="text" class="form-control" name="title" style="Width:40%">
    </div>
    <div class="form-group">
    <label for="title">Youtube Link</label>
    <input value=""  type="text" class="form-control" name="youtube" style="width:40%">
    </div>
    <div class="form-group">
       <label for="post_content">Video description</label>
       <textarea  class="form-control "name="vid_desc" cols="30" rows="10" style="width:40%">
       </textarea>
    </div>
    <br>
    <div class="form-group">
    <input class="btn btn-primary" type="submit" name="Add Video" value="Add Video">
    </div>
  </form>
</div>
<?php } else { ?>
  <a href="help.php?new_video" class="btn btn-primary" style="float:right;margin-top:1%;"> Add new Video</a>
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
                    <p class='card-text'>{$description}</p>
                  </div>
                </div>
              </div>";
            }
          }?>
        </div>
    </div>
  </div>
