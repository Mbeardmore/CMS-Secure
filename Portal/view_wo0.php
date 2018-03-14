<?php
include_once "Includes/header.php";
?>
<body>
    <div id="wrapper">
        <?php
        include "Includes/sidenav.php";
        include "Includes/topnav.php";
        ?>
                    <div class="ibox-content" style="background-color:#f3f3f4;">
                        <?php
          if (is_tech($_SESSION['u_name'])) {
          $tech = $_SESSION['u_first'];

          $woID = escape($_GET['view_wo']);
          $query = "SELECT * FROM work_orders WHERE ID = {$woID} OR Work_Order = {$woID}";
          $select_wo = mysqli_query($conn, $query);

          $row = mysqli_fetch_assoc($select_wo);
          $id             = $row['ID'];
          $jobtype        = $row['Job_type'];
          $creator        = $row['creator'];
          $wonum          = $row['Work_Order'];
          $jobloc         = $row['job_location'];
          $company        = $row['company'];
          $street         = $row['street'];
          $city           = $row['city'];
          $creation       = $row['date_today'];
          $datestart      = $row['date_start'];
          $dateend        = $row['date_end'];
          $Assigned       = $row['Assigned_user'];
          $jobinfo        = $row['job_info'];
          $floorsize      = $row['floor_size'];
          $Start          = $row['Start'];
          $status         = $row['status'];
          $contact        = $row['site_contact'];
          $client         = $row['client'];
          $techsig        = $row['tech_sig'];
          $clientsig      = $row['Client_sig'];
          $satisfaction   = $row['sat_rating'];
          $com_summary    = $row['Summary'];
          $survey         = $row['survey'];

          $start = new DateTime($datestart);
          $end = new DateTime($dateend);
          $diff = date_diff($start,$end);
          $nights1 = $diff->format('%d Nights');
          $log = "Accessed Work Order";
          $user = $_SESSION['u_name'];

          $test = new log();
          $test->logaction($log, $wonum, $user );

          $date = date("d-m-Y");
          ?>
          <div id="wrapper">
        <div class="row">
            <div class="col-lg-9">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <h1></h1>
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="m-b-md">
                                      <?php if (is_manager($_SESSION['u_name'])) {?>
                                        <a href="edit_wo.php?edit_wo=<?php echo $id; ?>" class="btn btn-white btn-xs pull-right">Edit project</a>
                                        <?php }  ?>
                                        <h2>Contract with <?php echo " ". $company;?></h2>
                                    </div>
                                    <?php wostatus($status); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <dl class="dl-horizontal">
                                        <dt>Work Order number</dt> <dd> <?php echo $wonum ?> <dd>
                                        <dt>Created by:</dt> <dd><?php echo $creator ?></dd>
                                        <dt>Client:</dt> <dd><a href="#" class="text-navy"> <?php echo $client ?></a> </dd>
                                        <dt>Nights on Site:</dt> <dd> <?php echo $nights1; ?></dd>
                                        <dt>Contact Onsite</dt> <dd><?php echo $contact ?> </dd>
                                        <dt>Address</dt> <dd><?php echo $street . " " . $city; ?></dd>
                                    </dl>
                                </div>
                                <div class="col-lg-7" id="cluster_info">
                                    <dl class="dl-horizontal" >
                                        <dt>Google Maps</dt> <dd><a href="https://www.google.com/maps/dir//<?php echo $company; ?>,+<?php echo $street; ?>,+<?php echo $city ?>,+United+Kingdom/" class="btn btn-primary btn-xs">Get Directions</a></dd>
                                        <dt>Created:</dt> <dd>  <?php echo $creation; ?> </dd>
                                        <dt>Participants:</dt>
                                        <dd><?php echo $Assigned ?></dd>
                                        <dt>Floor Size</dt><dd><?php echo $floorsize; ?></dd>
                                        <dt>Start Time at Unit: </dt> <dd><?php echo $Start; ?></dd>
                                    </dl>
                                </div>
                            </div>

                            <div class="row m-t-sm">
                                <div class="col-lg-12">
                                <div class="panel blank-panel">
                                <div class="panel-heading">
                                    <div class="panel-options">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab-1" data-toggle="tab">Users messages</a></li>
                                            <li class=""><a href="#tab-2" data-toggle="tab">Notes</a></li>
                                            <?php if ($wonum === '') {
                                            } else {
                                              echo '
                                            <li class=""><a href="#tab-3" data-toggle="tab">Images</a></li>';
                                          }
                                          ?>
                                            <?php
                                              $accom = "SELECT * FROM acommodation WHERE work_order = '$wonum'";
                                              $result = mysqli_query($conn, $accom);
                                            if(mysqli_num_rows($result) <  1 ) {} else { ?>
                                            <li class=""><a href="#tab-4" data-toggle="tab">Accomodation</a></li>
                                            <?php  } ?>
                                            <?php if(is_admin($_SESSION['u_name'])) { ?>
                                            <li class="" style="display:;"><a href="#tab-5" data-toggle="tab">Costing</a></li>
                                            <li class="" style="display:;"><a href="#tab-6" data-toggle="tab">Products Used</a></li>
                                            <?php } if ($status === 'Completed') { ?>
                                            <li class=""><a href="#tab-7" data-toggle="tab">Completion information</a></li>
                                            <?php } else {} ?>
                                         </ul>
                                    </div>
                                </div>
                                <div class="panel-body">
                                <div class="tab-content">
                                <div class="tab-pane active" id="tab-1">
                                    <div class="feed-activity-list" style="height:400px;overflow-y: scroll;border: 1px solid #e7eaec;border-radius: 5px;;" id="message">
                                        <!-- messages go here -->
                                          <?php

                                          $retmessage = "SELECT * FROM job_messages WHERE Work_Order = '$wonum' ";
                                          $retrieve = mysqli_query($conn, $retmessage);
                                          while ($ret = mysqli_fetch_assoc($retrieve)) {

                                            $message = $ret['message'];
                                            $name    = $ret['u_name'];
                                            $sent    = $ret['time_added'];

                                          ?>
                                            <div class="feed-element"
                                            <a href="#" class="pull-left">
                                               <!--  <img alt="image" class="img-circle" src="img/a7.jpg"> -->
                                            </a>
                                            <div class="media-body" style="padding:5px">
                                                <!-- <small class="pull-right">46h ago</small> -->
                                                <strong><?php echo $name; ?></strong> <br>
                                                <small class="text-muted"><?php echo $name . "- " . "Sent: " . $sent;?></small>
                                                <div class="well">
                                                <?php echo $message; ?>
                                                </div>
                                            </div>
                                        </div>
                                          <?php } ?>
                                    </div>
                                            <form method="POST">
                                              <input type="text" name="u_message" class="form-control">
                                              <span class="input-group-btn">
                                                <input class="btn btn-primary" style="margin-top:5px;" type="submit" name="message" value="Send Message">
                                              </span>
                                            </form>

                                            <?php if(isset($_POST['message'])) {

                                                    if (!empty($_POST['u_message'])) {

                                                $message = escape($_POST['u_message']);
                                                $timedate = date("Y-m-d h:i:sa");

                                                if ($wonum === '') {
                                                  $log = "Failed to Fetch WO Number";
                                                  $user = $_SESSION['u_name'];
                                                  $newlog = new log();
                                                  $newlog->logaction($log, $wonum, $user);
                                                }

                                                $addmessage = "INSERT INTO job_messages (Work_Order, u_name, message, time_added) ";
                                                $addmessage .= "VALUES ('{$wonum}','{$tech}','{$message}','{$timedate}') ";

                                                $mesresult = mysqli_query($conn, $addmessage);

                                                confirmQuery($mesresult);

                                                header("Location: view_wo.php?view_wo={$id}");

                                              } else {
                                                echo "Empty Field";
                                              }
                                              }?>
                                </div>
                                <div class="tab-pane fade" id="tab-2">

                                  <?php echo $jobinfo ?>

                                </div>

                                <div class="tab-pane" id="tab-3">
                                  <form action="" method="POST" enctype="multipart/form-data" id="uploadForm">
                                    <input type="hidden" name="<?php echo ini_get("session.upload_progress.name"); ?>" value="123"/>
                                    <div class="form-inline">
                                      <div class="form-group">
                                        <input type="file" name="files[]" id="js-upload-files" multiple>

                                      </div>
                                      <button type="submit" class="btn btn-sm btn-primary" name="upload" id="btnSubmit">Upload files</button>
                                    </div>
                                  </form>
                                  <?php if(is_manager($_SESSION['u_name'])) { ?>
                                  <form method="post">
                                     <button type="submit" class="btn btn-sm btn-primary" name="Compress" id="btnSubmit">Compress Images</button>
                                  </form>
                                  <?php } else {} ?>
                                  <?php
                                    if(isset($_POST['upload'])) {
                                      echo'
                                      <div id="progress-div"><div id="progress-bar"></div></div>';
                                    handleimages($jobloc, $wonum, $tech, $id);
                                    echo $count ."Images Uploaded";
                                  } ?>
                                 <?php if(isset($_POST['Compress'])) {
                                    //Initial settings, Just specify Source and Destination Image folder.
                                    $ImagesDirectory    = 'Images/wo_images/'.$wonum.".".$jobloc."/"; //Source Image Directory End with Slash
                                    $NewImageWidth      = 1000; //New Width of Image
                                    $NewImageHeight     = 1000; // New Height of Image
                                    $Quality            = 75; //Image Quality

                                    //Open Source Image directory, loop through each Image and resize it.

                                    if($dir = opendir($ImagesDirectory)){
                                        while(($file = readdir($dir))!== false){

                                            $imagePath = $ImagesDirectory.$file;
                                            $destPath = $ImagesDirectory.$file;
                                            $checkValidImage = @getimagesize($imagePath);

                                            if(file_exists($imagePath) && $checkValidImage) //Continue only if 2 given parameters are true
                                            {
                                                //Image looks valid, resize.
                                                if(resizeImage($imagePath,$destPath,$NewImageWidth,$NewImageHeight,$Quality))
                                                {
                                                    echo $file.' resize Success!<br />';
                                                    /*
                                                    Now Image is resized, may be save information in database?
                                                   */
                                                }else{
                                                    echo $file.' resize Failed!<br />';
                                                }
                                            }
                                        }
                                        closedir($dir);
                                    }
                                    }
                                     ?>
                                  <br>
                                  <?php if (is_tech($_SESSION['u_name'])) { ?>
                                  <button type="button" id="myBtn" class="btn btn-info">Open Gallery</button>
                                  <?php } else { } ?>
                                </div>

                                <div class="tab-pane" id="tab-4">

                                  <?php
                                  $accom = "SELECT * FROM acommodation WHERE work_order = '$wonum'";

                                  $result = mysqli_query($conn, $accom);

                                  $res = mysqli_fetch_assoc($result);

                                  $accom_type = $res['accom_type'];
                                  $address    = $res['Address'];
                                  $town       = $res['Town'];
                                  $Postcode   = $res['Postcode'];
                                  $arrival    = $res['Arrival'];
                                  $owner      = $res['owner'];
                                  $special    = $res['special_ins'];
                                   ?>
                                  <div class="col-lg-5">
                                  <dl class="dl-horizontal">
                                        <dt>Accomodation Type<dt> <dd> <?php echo $accom_type; ?> <dd>
                                        <dt>Address</dt> <dd> <?php echo $address; ?>  <dd>
                                        <dt>Town</dt> <dd> <?php echo $town; ?></dd>
                                        <dt>PostCode</dt> <dd> <?php echo $Postcode ?> </dd>
                                        <dt>Arrival Time</dt> <dd> <?php echo $arrival ?> </dd>
                                        <dt>Phone Number</dt> <dd><?php echo $arrival ?> </dd>
                                    </dl>
                                  </div>

                                  <div class="col-lg-7" id="cluster_info">
                                    <dl class="dl-horizontal" >
                                        <dt>Google Maps</dt> <dd><a href="https://www.google.co.uk/maps/dir//<?php echo $address; ?>,+<?php echo $town; ?>,+<?php echo $Postcode; ?>/" class="btn btn-primary btn-xs">Get Directions</a></dd>
                                    </dl>
                                </div>
                               <div class="col-lg-12">
                                <label for for="card">Special Instructions</label>
                                <div class="divider"></div>
                                <div class="card" style="border:1px solid rgba(233, 231, 226, .3);border-radius: 5px;">
                                  <div class="card-block">
                                    <p><?php echo $special; ?></p>
                                  </div>
                                </div>
                                </div>
                                </div>

                                 <div class="tab-pane" id="tab-5">
                                  <dt>Consumable Cost<dt> <dd><dd>
                                  <br>
                                  <dt>Cleanse</dt> <dd><dd>
                                  <dt>SafeStrip</dt> <dd></dd>
                                  <dt>Defence</dt> <dd></dd>
                                  <dt>Dr Schutz PU sealer</dt> <dd></dd>
                                  <dt>Total Cost: </dt> <dd></dd>
                                 </div>
                                 <?php } ?>
                                 <div style="" class="tab-pane" id="tab-6">
                                    <dl>
                                 </div>
                                 <div class="tab-pane" id="tab-7">
                                    <dl class="dl-horizontal">
                                        <dt>Technician Signature</dt> <dd> <?php echo $techsig;?> <dd>
                                        <dt>Client Signature</dt> <dd><?php echo $clientsig; ?></dd>
                                    </dl>
                                    <div class="col-lg-12">
                                <label for for="card">Summary of Completed Works</label>
                                <div class="divider"></div>
                                <div class="card" style="border:1px solid rgba(233, 231, 226, .3);border-radius: 5px;">
                                  <div class="card-block">
                                    <p><?php echo $com_summary; ?></p>
                                  </div>
                                </div>
                                </div>
                                 </div>
                                </div>
                                <br>
                                <?php
                              if ($status === 'Pending' && $survey ===  '0') {
                                 echo '
                                 <div class="col-md-12 center-block" style="margin-bottom:5px;">
                                   <button id="myBtn" class="btn btn-primary center-block btn-lg" data-toggle="modal" data-target="#myModal">Complete</button>
                                   </div>';

                                } elseif ($status ==='Pending' && $survey === '1' && $client === "Apple") {
                                  echo
                                  '<div class="col-md-12 center-block" style="margin-bottom:5px;">
                                    <button id="myBtn1" class="btn btn-primary center-block btn-lg" data-toggle="modal" data-target="#myModal1">Pre Survey</button>
                                    </div>';
                                }
                                ?>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
<div class="col-lg-3">
                <div class="wrapper wrapper-content project-manager">
                    <h4>Project description & Procedures</h4>
                    <img src="" class="img-responsive">
                    <p class="small">
                        <?php jobtype($jobtype); ?>
                    </p>
                    <p class="small font-bold">
                        <span><i class="fa fa-circle text-warning"></i> High priority</span>
                    </p>
                    <h5>Project tag</h5>
                    <ul class="tag-list" style="padding: 0">
                       <!--  <li><a href=""><i class="fa fa-tag"></i> Zender</a></li>
                        <li><a href=""><i class="fa fa-tag"></i> Lorem ipsum</a></li>
                        <li><a href=""><i class="fa fa-tag"></i> Passages</a></li>
                        <li><a href=""><i class="fa fa-tag"></i> Variations</a></li> -->
                    </ul>
                    <br>
                    <hr>
                    <h5>Project files</h5>
                    <ul class="list-unstyled project-files">
                       <?php

                       $dir = "work_order_files/$wonum.$company/";

                       if(is_dir($dir)) {
                    $files = scandir($dir);
                    $files = array_diff($files, array('.', '..'));

                    foreach($files as $file){ ?>
                     <li><a href="<?php echo $dir; echo $file; ?>"><i class="fa fa-file"></i> <?php echo $file; ?></a></li>
                    <?php
                    }
                  }
                    ?>

                    </ul>
                </div>
            </div>
<!-- Modal Image -->
              <div id="mymodal" class="modal">
  <!-- Modal content -->
              <div class="modal-content" style="height:75%;overflow-y:scroll;" >
                <span class="close cursor" id="close">&times;</span>
                <div class="ibox-content" id="ibox">

                  <?php
                    $images = "SELECT * FROM work_order_images WHERE wo_number = '$wonum' ";
                    $result = mysqli_query($conn, $images);
                    while($row = mysqli_fetch_assoc($result)) {

                      $imageloc = $row['Location'];

                      echo " <a href='Images/wo_images/{$wonum}.{$jobloc}/{$imageloc}' title='{$imageloc}' data-gallery=''><img style='height:180px;width:250px;padding-bottom:5px;text-align:center-block;' src='Images/wo_images/{$wonum}.{$jobloc}/{$imageloc}'></a> ";

                    }?>
                  <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
                  <div class="slides"></div>
                  <h3 class="title"></h3>
                  <a class="prev">‹</a>
                  <a class="next">›</a>
                  <a class="close">×</a>
                  <a class="play-pause"></a>
                  <ol class="indicator"></ol>
                  </div>
              </div>
            </div>
          </div>
<!-- PRe sruvey -->
          <div id="mymodal1" class="modal fade bd-example-modal-lg">
<!-- Modal content -->
          <div class="modal-content" style="" >
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="ibox-content" id="ibox">
                <form method="POST" id="wizard" enctype="multipart/form-data">
                <div id="example-basic">
                  <h3>Floor</h3>
                  <section>
                    <div class="form-group">
                        <label for="exampleSelect1">Floor Type</label>
                        <select class="form-control" id="exampleSelect1" name="Floor_type">
                            <option value="Terrazo">Terrazzo</option>
                            <option value="SandStone">Sandstone</option>
                            <option value="Completed">Wood</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelect1">Stains/Marks</label>
                        <select class="form-control" id="exampleSelect1" name="Floor_Stains">
                            <option value="Inactive">Good</option>
                            <option value="Pending">Average</option>
                            <option value="Completed">Poor</option>
                            <option value="Completed">Filthy</option>
                        </select>
                      </div>
                      <div class="form-group">
                      <label for="title">How many Cracked Tiles</label>
                      <input type="text" id="wonumber" placeholder="10" class="form-control" name="Tiles">
                    </div>
                    <div class="form-group">
                      <label>Grouting Damage?</label><br>
                 <textarea required="required" class="form-control" id="exampleTextarea" rows="3" style="height:167px" name="Grout_desc" placeholder="If yes please Explain"></textarea>
               </div>
                  </section>
                  <h3>Fixtures & fittings</h3>
                      <section>
                        <div class="form-group">
                            <label for="exampleSelect1">Is there any table damage?</label>
                            <select class="form-control" id="exampleSelect1" name="Table_damage">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">Tables Plug & Play</label>
                            <select class="form-control" id="Tables" name="Tables">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">Stainless Steel up to 5ft</label>
                            <br>
                            <small>Is there any marks/Damage</small>
                            <select class="form-control" id="Tables" name="steel">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="summary">Summary</label>
                          <textarea required="required" class="form-control" id="exampleTextarea" rows="3" style="height:167px" name="Fixtures_Desc" placeholder="Further Detail"></textarea>
                        </div>

                      </section>
                  <h3>Boh & Washroom Floors</h3>
                  <section>
                    <div class="form-group">
                        <label for="exampleSelect1">Floor Type</label>
                        <select class="form-control" id="Tables" name="Boh_Floortype">
                            <option value="Vinyl">Vinyl</option>
                            <option value="Rubber">Rubber</option>
                            <option value="Concrete">Concrete</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelect1">Appearence</label>
                        <select class="form-control" id="exampleSelect1" name="Floor_Appearence">
                            <option value="Inactive">Good</option>
                            <option value="Pending">Average</option>
                            <option value="Poor">Poor</option>
                            <option value="Filthy">Filthy</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Washroom Grouting Damage?</label><br>
                   <textarea required="required" class="form-control" id="exampleTextarea" rows="3" style="height:167px" name="Washroom_grouting" placeholder="If yes please Explain"></textarea>
                 </div>
                 <div class="form-group">
                   <input type="file" name="images[]" id="js-upload-files" multiple>
                 </div>
                 <button type="submit" class="btn btn-primary btn-lg center-block" name="complete_upload" id="btnSubmit">Complete</button>
                  </section>
              </div>
            </form>
        </div>
      </div>

      <?php
      If (isset($_POST['complete_upload'])) {
        $fohfloortype = $_POST['Floor_type'];
        $fohstains    = $_POST['Floor_Stains'];
        $tiles        = $_POST['Tiles'];
        $groutdesc    = $_POST['Grout_desc'];
        $tabledam     = $_POST['Table_damage'];
        $pptable      = $_POST['Tables'];
        $steel        = $_POST['steel'];
        $fixtures     = $_POST['Fixtures_Desc'];
        $bohFloortype = $_POST['Boh_Floortype'];
        $bohFloorApp  = $_POST['Floor_Appearence'];
        $WashroomGrout= $_POST['Washroom_grouting'];
        $stmt = $conn->prepare("UPDATE work_orders SET FOH_floortype = ?, FOH_stains = ?, DAM_Tiles = ?, FOH_Groutdesc = ?, FOH_tabledamage = ?, FOH_TablePP = ?, FOH_Steel = ?, Fixtures_desc = ?, BOH_Floortype = ?, BOH_Floorapp = ?, Wash_grout = ? WHERE ID = {$id} ");
        $stmt->bind_param("sssssssssss", $fohfloortype, $fohstains, $tiles, $groutdesc, $tabledam, $pptable, $steel, $fixtures, $bohFloortype, $bohFloorApp, $WashroomGrout);
        echo $id;
        $stmt->execute();
        $stmt->close();
        $stmt = $conn->prepare("UPDATE work_orders SET survey = '1' WHERE ID = {$id} ");
        $stmt->execute();
        $stmt->close();


        $path = "Images/wo_images/{$wonum}.{$jobloc}/Pre_Survey/";

        if (!is_dir($path))
          {   mkdir($path);
           }

        $valid_formats = array(
          "jpg",
          "jpeg",
          "JPEG",
          "JPG",
          "png"
        );
        foreach($_FILES['images']['name'] as $f => $name)
          {

          $fileext = explode('.', $name);
          $actualExt = strtolower(end($fileext));
          if (in_array($actualExt, $valid_formats))
            {
            $newfilename = round(microtime(true)) . '.' . $actualExt;
            move_uploaded_file($_FILES['images']['tmp_name'][$f], $path . $newfilename);
            $query = "INSERT INTO work_order_images (wo_number, Location, Uploader, GRP) ";
            $query .= "VALUES ('{$wonum}','{$newfilename}','{$tech}','1') ";

            $result = mysqli_query($conn, $query);

            confirmQuery($result);
            header("Location: view_wo.php?view_wo={$id}");
            }
            else
            {
            echo "Wrong File Extension";
            }
          }
}
       ?>
              <div id="mymodal2" class="modal">
  <!-- Modal content -->
              <div class="modal-content" style="display:inline-grid; background: grey;position: relative;float: left;left: 50%;top: 50%;transform: translate(-50%, -50%);">
                <div class="ibox-content">
                <span class="close cursor" id="close">&times;</span>
                 <h1 style="text-align: center;">Your images are being uploaded do not leave this page</h1>
                 <h3 style="text-align: center;">This page will refresh once they have uploaded!</h3>
              </div>
            </div>
          </div>
            <!-- Image -->
        <!-- Modal -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Complete Details</h4>

            </div>
            <div class="modal-body" style="">
              <form method="POST" id="wizard" enctype="multipart/form-data">
              <div id="example-basic">
                <h3>Signatures</h3>
                <section>
                    <div class="form-group" style="width:">
                     <label for="title">Technician Signature</label>
                        <input  type="text" class="form-control" name="Tech" required="">
                </div>
                <div class="form-group" style="width:">
                     <label for="title">Client Signature</label>
                        <input  type="text" class="form-control" name="Client" required="">
                </div>
                <label for="rating">Satisfaction Rating</label>
                <div name="rating" required="">
                <label class="radio-inline"><input type="radio" value="1" name="optradio">1</label>
                <label class="radio-inline"><input type="radio" value="2" name="optradio">2</label>
                <label class="radio-inline"><input type="radio" value="3" name="optradio">3</label>
                <label class="radio-inline"><input type="radio" value="4" name="optradio">4</label>
                <label class="radio-inline"><input type="radio" value="5" name="optradio">5</label>
              </div>
                </section>
                <h3>Job Summary</h3>
                    <section>
                         <label>Job Summary</label><br>
                    <textarea required="required" class="form-control" id="exampleTextarea" rows="3" style="height:167px" name="summary"></textarea>
                    <br>
                    <p>Provide detailed information on the works carried out.<br>
                      • Full process used<br>
                      • Number of applications, product usage<br>
                      • Problems that occurred i.e. Stains that couldn’t be removed<br>
                      • Brief summary of results<br>
                      • Any info to be passed to client<br>
                    </p>
                    </section>
                    <?php $accom = "SELECT * FROM acommodation WHERE work_order = '$wonum'";
                            $result = mysqli_query($conn, $accom);
                              if(mysqli_num_rows($result) <  1 ) { } else { ?>
                <h3>Accomodation</h3>
                <section>
                  <label for="rating">Accomodation Rating</label>
                <div name="accom_rating" required="">
                <label class="radio-inline"><input type="radio" value="1" name="accom_rating">1</label>
                <label class="radio-inline"><input type="radio" value="2" name="accom_rating">2</label>
                <label class="radio-inline"><input type="radio" value="3" name="accom_rating">3</label>
                <label class="radio-inline"><input type="radio" value="4" name="accom_rating">4</label>
                <label class="radio-inline"><input type="radio" value="5" name="accom_rating">5</label>
                <p>1 Worst - 5 Best</p>
                  </div>
                  <br>
                  <label>Brief Summary of Accomodation</label><br>
                    <textarea class="form-control" required="required" id="exampleTextarea" placeholder="For example: Excellent Accomodation Would use again." rows="3" style="height:167px;" name="accom_summary"></textarea>
                </section>
                <?php } ?>
                <h3>Completion</h3>
                <section style="">
                <input class="btn btn-primary btn-lg center-block" id="submit" onClick="" type="submit" name="complete_wo" value="Complete">
                </section>
            </div>
          </form>
              </div>
            <?php

            if (isset($_POST['complete_wo'])) {
              completewo($wonum, $id);
             }
              ?>
          </div>
          </div>
          </div>
<?php  include "Includes/footer.php"; ?>
<script>
// Get the modal
var modal = document.getElementById('mymodal');
// Get the button that opens the modal
var btn = document.getElementById("myBtn");

var btn1 = document.getElementById("myBtn1");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<script type="text/javascript">

      var objDiv = document.getElementById("message");
      objDiv.scrollTop = objDiv.scrollHeight;

  $(document).ready(function () {
  $("#btnSubmit").click(function(){
  $('#mymodal2').modal('show');
  });
  $("#myBtn1").click(function(){
  $('#mymodal1').modal('show');
  });
  $("#myBtn").click(function(){
  $('#mymodal').modal('show');
  });
  });

 $("#example-basic").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true
});
    </script>
