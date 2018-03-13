<?php
include "Includes/header.php";
include "Includes/sidenav.php";
include "Includes/topnav.php";

if (isset($_GET['new_pdf'])) { ?>
  <div class="panel-body" id="formbody">
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
      <label for="exampleSelect1">category</label>
      <select class="form-control" id="exampleSelect1" name="category" style="width:30%">
          <option value="Carpet">Carpet</option>
          <option value="Vinyl">Vinyl</option>
          <option value="Wood">Wood</option>
          <option value="Stone">Stone</option>
          <option value="Apple">Apple</option>
          <option value="Health&Safety">Health & Safety</option>
          <option value="Miscellaneous">Miscellaneous</option>
      </select>
  </div>
  <div class="form-group" style="width:75%">
      <label for="Job-Details">Description</label>
      <textarea class="input-block-level" id="summernote" name="Description" required></textarea>
      <script>
        $(document).ready(function() {
            $('#summernote').summernote({
              height: "300px"
            });
        });
      </script>
  </div>
  <p>Please make sure all PDF's have single names with no spaces so Apple-Honing-Process.pdf no spaces</p>
    <div class="form-group">
        <label class="custom-file">
        <input type="file" id="file" name="image_upload" class="custom-file-input">
        <span class="custom-file-control"></span>
        </label>
    </div>
    <div class="form-group">
    <input class="btn btn-primary" type="submit" name="Add_Pdf" value="Add PDF">
    </div>
  </form>
  <?php
  if(isset($_POST['Add_Pdf'])) {

  $cat = $_POST['category'];
  $desc = $_POST['Description'];
  $pdf = $_FILES['image_upload']['name'];
  $pdf_tmp = $_FILES['image_upload']['tmp_name'];
  $valid_formats = array("pdf","xls","docx");
  $imageFileType = strtolower(pathinfo($pdf,PATHINFO_EXTENSION));

  if($desc==="") {
    echo "description needed";
  }

  if(in_array($imageFileType, $valid_formats)) {
    move_uploaded_file($pdf_tmp, "Files/PDF/$pdf");
} else {
 echo "File Extension needs to be PDF,XLS or docx";
}
$stmt = $conn->prepare("INSERT INTO faq (category,link,description) VALUES (?,?,?) ");
$stmt->bind_param("sss",$cat,$pdf,$desc);
$stmt->execute();
$stmt->close();
header("Location: help-section.php");
}
  ?>
</div>
<?php  } else { ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>PDF Section</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.php">Homepage</a>
            </li>
            <li class="active">
                <strong>PDF Help</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
          <?php if (is_manager($_SESSION['u_name'])) { echo "<a href='help-section.php?new_pdf' onclick='window.location.href='' class='btn btn-primary'>New PDF</a>";} ?>
        </div>
    </div>
</div>
  <div class="row">
      <div class="col-lg-12">
          <div class="wrapper wrapper-content animated fadeInRight" style="padding:5px 5px 5px">
              <div class="faq-item">
                  <div class="row">
                      <div class="col-md-7">
                          <a data-toggle="collapse" href="#faq1" class="faq-question">Carpet</a>
                      </div>
                      <div class="col-md-3">
                          <span class="small font-bold">Tags</span>
                          <div class="tag-list">
                              <span class="tag-item">Floor Restoration</span>
                              <span class="tag-item">Carpet</span>

                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-12">
                          <div id="faq1" class="panel-collapse collapse ">
                              <?php
                               QandA("Carpet");
                              ?>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="row">
      <div class="col-lg-12">
          <div class="wrapper wrapper-content animated fadeInRight" style="padding:5px 5px 5px">
              <div class="faq-item">
                  <div class="row">
                      <div class="col-md-7">
                          <a data-toggle="collapse" href="#faq2" class="faq-question">Vinyl</a>

                      </div>
                      <div class="col-md-3">
                          <span class="small font-bold">Tags</span>
                          <div class="tag-list">
                              <span class="tag-item">Floor Restoration</span>
                              <span class="tag-item">vinyl</span>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-12">
                          <div id="faq2" class="panel-collapse collapse ">
                              <?php QandA("Vinyl"); ?>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="row">
      <div class="col-lg-12">
          <div class="wrapper wrapper-content animated fadeInRight" style="padding:5px 5px 5px">
              <div class="faq-item">
                  <div class="row">
                      <div class="col-md-7">
                          <a data-toggle="collapse" href="#faq3" class="faq-question">Wood</a>

                      </div>
                      <div class="col-md-3">
                          <span class="small font-bold">Tags</span>
                          <div class="tag-list">
                              <span class="tag-item">Floor Restoration</span>
                              <span class="tag-item">Wood</span>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-12">
                          <div id="faq3" class="panel-collapse collapse ">
                              <?php QandA("Wood"); ?>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="row">
      <div class="col-lg-12">
          <div class="wrapper wrapper-content animated fadeInRight" style="padding:5px 5px 5px">
              <div class="faq-item">
                  <div class="row">
                      <div class="col-md-7">
                          <a data-toggle="collapse" href="#faq4" class="faq-question">Stone</a>

                      </div>
                      <div class="col-md-3">
                          <span class="small font-bold">Tags</span>
                          <div class="tag-list">
                              <span class="tag-item">Floor Restoration</span>
                              <span class="tag-item">Stone</span>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-12">
                          <div id="faq4" class="panel-collapse collapse ">
                              <?php QandA("Stone"); ?>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="row">
      <div class="col-lg-12">
          <div class="wrapper wrapper-content animated fadeInRight" style="padding:5px 5px 5px">
              <div class="faq-item">
                  <div class="row">
                      <div class="col-md-7">
                          <a data-toggle="collapse" href="#faq5" class="faq-question">Apple</a>

                      </div>
                      <div class="col-md-3">
                          <span class="small font-bold">Tags</span>
                          <div class="tag-list">
                              <span class="tag-item">Floor Restoration</span>
                              <span class="tag-item">Apple</span>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-12">
                          <div id="faq5" class="panel-collapse collapse ">
                              <?php QandA("Apple"); ?>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="row">
      <div class="col-lg-12">
          <div class="wrapper wrapper-content animated fadeInRight" style="padding:5px 5px 5px">
              <div class="faq-item">
                  <div class="row">
                      <div class="col-md-7">
                          <a data-toggle="collapse" href="#faq6" class="faq-question">Health & Safety</a>

                      </div>
                      <div class="col-md-3">
                          <span class="small font-bold">Tags</span>
                          <div class="tag-list">
                              <span class="tag-item">Floor Restoration</span>
                              <span class="tag-item">Health & Safety</span>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-12">
                          <div id="faq6" class="panel-collapse collapse ">
                              <?php QandA("Health&Safety"); ?>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="row">
      <div class="col-lg-12">
          <div class="wrapper wrapper-content animated fadeInRight" style="padding:5px 5px 5px">
              <div class="faq-item">
                  <div class="row">
                      <div class="col-md-7">
                          <a data-toggle="collapse" href="#faq7" class="faq-question">Miscellaneous</a>

                      </div>
                      <div class="col-md-3">
                          <span class="small font-bold">Tags</span>
                          <div class="tag-list">
                              <span class="tag-item">Floor Restoration</span>
                              <span class="tag-item">Miscellaneous</span>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-12">
                          <div id="faq7" class="panel-collapse collapse ">
                              <?php QandA("Miscellaneous"); ?>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
<?php } include "Includes/footer.php";  ?>
