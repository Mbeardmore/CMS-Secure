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
          $query = "SELECT * FROM work_orders WHERE ID = {$woID}";
          $select_wo = mysqli_query($connection, $query);

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

       <link rel="stylesheet" href="../css/jquery.steps.css">
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
                                              $result = mysqli_query($connection, $accom);
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
                                          $retrieve = mysqli_query($connection, $retmessage);
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

                                                $addmessage = "INSERT INTO job_messages (Work_Order, u_name, message, time_added) ";
                                                $addmessage .= "VALUES ('{$wonum}','{$tech}','{$message}','{$timedate}') ";

                                                $mesresult = mysqli_query($connection, $addmessage);

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
                                    handleimages($jobloc, $wonum, $tech);
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

                                  $result = mysqli_query($connection, $accom);

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

                                  <?php
                                   switch ($jobtype) {

                                      case 'Apple_Strip_FOH_Ardex':

                                      if(isset($_POST['Consumables'])) {

                                              $cleanse = escape($_POST['cleanse']);
                                              $PUSealer = escape($_POST['DrSchutz-PU']);
                                              $MPC = escape($_POST['Orange-MPC']);
                                              $StoneSoap = escape($_POST['Stone-Soap']);
                                              $Sustain = escape($_POST['Sustain']);


                                              $stmt = $conn->prepare("INSERT INTO `used_items` (`date`, wo_id, cleanse, PUsealer, `Orange-MPC`, `Stone-Soap`, Sustain) VALUES (?,?,?,?,?,?,?) ");
                                              $stmt->bind_param("ssiiiii", $date, $wonum, $cleanse, $PUSealer, $MPC, $StoneSoap, $Sustain);
                                              $stmt->execute();
                                              $stmt->close();
                                              header("Location: view_wo.php?view_wo={$id}");
                                            }

                                             echo '
                                            <form method="post">
                                              <dl class="dl-horizontal">
                                              <dt>Cleanse<dt><dd><input type="text" name="cleanse" class="form-control" style="width:auto;" required><dd>
                                              <br>
                                              <dt>Dr Schutz PU Sealer<dt><dd><input type="text" name="DrSchutz-PU" class="form-control" style="width:auto;"><dd>
                                              <br>
                                              <dt>Orange MPC<dt><dd><input type="text" name="Orange-MPC" class="form-control" style="width:auto;"><dd>
                                              <br>
                                              <dt>Stone Soap<dt><dd><input type="text" name="Stone-Soap" class="form-control" style="width:auto;"><dd>
                                              <br>
                                              <dt>Sustain<dt><dd><input type="text" name="Sustain" class="form-control" style="width:auto;"><dd>
                                              <br>
                                              <input class="btn btn-primary" type="submit" name="Consumables" value="submit">
                                            </form>';

                                      break;

                                      case 'Apple_Strip_FOH_NoArdex':
                                             if(isset($_POST['Consumables'])) {

                                              $cleanse = escape($_POST['cleanse']);
                                              $Defence = escape($_POST['Defence']);
                                              $PUSealer = escape($_POST['DrSchutz']);
                                              $MPC = escape($_POST['Orange-MPC']);
                                              $StoneSoap = escape($_POST['Stone-Soap']);
                                              $sustain  = escape($_POST['Sustain']);


                                              $stmt = $conn->prepare("INSERT INTO `used_items` (`date`, wo_id, cleanse, defence, PUsealer, `Orange-MPC`, `Stone-Soap`, Sustain) VALUES (?,?,?,?,?,?,?,?) ");
                                              $stmt->bind_param("siiiiiii", $date, $wonum, $cleanse, $Defence, $PUSealer, $MPC, $StoneSoap, $sustain);
                                              $stmt->execute();
                                              $stmt->close();
                                              header("Location: view_wo.php?view_wo={$id}");
                                            }


                                      echo '
                                        <form method="post">
                                          <dl class="dl-horizontal">
                                          <dt>Cleanse<dt><dd><input type="text" name="cleanse" class="form-control" style="width:auto;" required><dd>
                                          <br>
                                          <dt>Defence<dt><dd><input type="text" name="Defence" class="form-control" style="width:auto;"><dd>
                                          <br>
                                          <dt>Turbo Strip 10L<dt><dd><input type="text" name="Turbo-Strip" class="form-control" style="width:auto;"><dd>
                                          <br>
                                          <dt>Dr Schutz PU Sealer<dt><dd><input type="text" name="DrSchutz" class="form-control" style="width:auto;"><dd>
                                          <br>
                                          <dt>Orange MPC<dt><dd><input type="text" name="Orange-MPC" class="form-control" style="width:auto;"><dd>
                                          <br>
                                          <dt>Stone Soap<dt><dd><input type="text" name="Stone-Soap" class="form-control" style="width:auto;"><dd>
                                          <br>
                                          <dt>Sustain<dt><dd><input type="text" name="Sustain" class="form-control" style="width:auto;"><dd>
                                          <br>
                                          <input class="btn btn-primary" type="submit" name="Consumables" value="submit">
                                        </form>';



                                      break;

                                      case 'Apple_Strip_FOH_Terrazzo':

                                       if(isset($_POST['Consumables'])) {

                                              $cleanse = escape($_POST['cleanse']);
                                              $Secura = escape($_POST['Secura']);
                                              $MPC = escape($_POST['Orange-MPC']);
                                              $StoneSoap = escape($_POST['Stone-Soap']);
                                              $Sustain = escape($_POST['Sustain']);


                                              $stmt = $conn->prepare("INSERT INTO `used_items` (`date`, wo_id, cleanse, `Orange-MPC`, `Stone-Soap`, Sustain, Secura) VALUES (?,?,?,?,?,?,?) ");
                                              $stmt->bind_param("ssiiiii", $date, $wonum, $cleanse, $MPC, $StoneSoap, $Sustain, $Secura);
                                              $stmt->execute();
                                              $stmt->close();
                                              header("Location: view_wo.php?view_wo={$id}");
                                            }

                                       echo '
                                             <form method="post">
                                          <dl class="dl-horizontal">
                                          <dt>Cleanse<dt><dd><input type="text" name="cleanse" class="form-control" style="width:auto;" required><dd>
                                          <br>
                                          <dt>Dr Schutz Secura<dt><dd><input type="text" name="Secura" class="form-control" style="width:auto;"><dd>
                                          <br>
                                          <dt>Orange MPC<dt><dd><input type="text" name="Orange-MPC" class="form-control" style="width:auto;"><dd>
                                          <br>
                                          <dt>Stone Soap<dt><dd><input type="text" name="Stone-Soap" class="form-control" style="width:auto;"><dd>
                                          <br>
                                          <dt>Sustain<dt><dd><input type="text" name="Sustain" class="form-control" style="width:auto;"><dd>
                                          <br>
                                          <input class="btn btn-primary" type="submit" name="Consumables" value="submit">
                                          </form>';


                                      break;

                                      case 'Apple_ardex_removal':



                                      break;

                                      case 'Apple_hone':

                                      break;

                                      case 'Apple_strip_BOH':

                                       if(isset($_POST['Consumables'])) {

                                              $TurboStrip = escape($_POST['TurboStrip']);
                                              $Secura = escape($_POST['Secura']);
                                              $Fort2 = escape($_POST['Forte2']);
                                              $Isi2 = escape($_POST['Isi2']);


                                              $stmt = $conn->prepare("INSERT INTO `used_items` (`date`, wo_id, turbostrip, Secura, `EcoLab-Forte2`, `EcoLab-Isi2`) VALUES (?,?,?,?,?,?) ");
                                              $stmt->bind_param("ssiiii", $date, $wonum, $TurboStrip, $Secura, $Fort2, $Isi2);
                                              $stmt->execute();
                                              $stmt->close();
                                              header("Location: view_wo.php?view_wo={$id}");
                                            }


                                        echo '
                                             <form method="post">
                                          <dl class="dl-horizontal">
                                          <dt>Dr Schutz Turbo Strip<dt><dd><input type="text" name="TurboStrip" class="form-control" style="width:auto;" required><dd>
                                          <br>
                                          <dt>Dr Schutz Secura<dt><dd><input type="text" name="Secura" class="form-control" style="width:auto;"><dd>
                                          <br>
                                          <dt>EcoLab Maxx Forte2<dt><dd><input type="text" name="Forte2" class="form-control" style="width:auto;"><dd>
                                          <br>
                                          <dt>EcoLab Maxx Isi2<dt><dd><input type="text" name="Isi2" class="form-control" style="width:auto;"><dd>
                                          <br>
                                          <input class="btn btn-primary" type="submit" name="Consumables" value="submit">
                                          </form>';


                                      break;

                                      case 'wood_floor_rest':

                                      if(isset($_POST['Consumables'])) {

                                        $primer   = $_POST['Primer'];
                                        $lacquer  = $_POST['Lacquer'];
                                        $Fill101  = $_POST['Fill-101'];
                                        $Fill     = $_POST['Fill-H99A'];
                                        $coloroil = $_POST['Colour-Oil'];
                                        $oil1fs   = $_POST['Oil-1FS'];
                                        $waxoil   = $_POST['Wax-Oil'];
                                        $stain    = $_POST['Stain'];

                                        $stmt = $conn->prepare("INSERT INTO `used_items` (`date`, wo_id, Primer, Lacquer, `Fill-101`, `Fill-H99A`, `Colour-Oil`, `Oil-1FS`, `Wax-Oil`, Stain) VALUES (?,?,?,?,?,?,?,?,?,?) ");
                                        $stmt->bind_param("ssiiiiiiii", $date,  $wonum, $primer, $lacquer, $Fill101, $Fill, $coloroil, $oil1fs, $waxoil, $stain);
                                        $stmt->execute();
                                        $stmt->close();
                                      }


                                         echo '
                                             <form method="post">
                                          <dl class="dl-horizontal">
                                          <dt>Primer 5L<dt><dd><input type="text" name="Primer" class="form-control" style="width:auto;" required><dd>
                                          <br>
                                          <dt>Lacquer<dt><dd><input type="text" name="Lacquer" class="form-control" style="width:auto;"><dd>
                                          <br>
                                          <dt>Fill 101<dt><dd><input type="text" name="Fill-101" class="form-control" style="width:auto;"><dd>
                                          <br>
                                          <dt>Fill H99A<dt><dd><input type="text" name="Fill-H99A" class="form-control" style="width:auto;"><dd>
                                          <br>
                                          <dt>Colour Oil<dt><dd><input type="text" name="Colour-Oil" class="form-control" style="width:auto;"><dd>
                                          <br>
                                          <dt>Oil 1FS<dt><dd><input type="text" name="Oil-1FS" class="form-control" style="width:auto;"><dd>
                                          <br>
                                          <dt>Wax Oil<dt><dd><input type="text" name="Wax-Oil" class="form-control" style="width:auto;"><dd>
                                          <br>
                                          <dt>Stain <dt><dd><input type="text" name="Stain" class="form-control" style="width:auto;"><dd>
                                          <br>
                                          <input class="btn btn-primary" type="submit" name="Consumables" value="submit">
                                          </form>';


                                      break;

                                      case 'carpet_clean':

                                      break;

                                    }
                                  ?>

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

                               if ($status === 'Completed') {


                                } else {

                                  echo '

                                  <div class="col-md-12 center-block" style="margin-bottom:5px;">
                                    <button id="myBtn" class="btn btn-primary center-block btn-lg" data-toggle="modal" data-target="#myModal">Complete</button>
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

                    $result = mysqli_query($connection, $images);

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

<!-- Modal Image uplaod -->
              <div id="mymodal2" class="modal">
  <!-- Modal content -->
              <div class="modal-content" style=" display:inline-grid; background: grey;position: relative;float: left;left: 50%;top: 50%;transform: translate(-50%, -50%);">
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
                            $result = mysqli_query($connection, $accom);
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
          </script>


          <script type="text/javascript">


          $(document).ready(function () {

          $("#modal").click(function(){
          $('#myModal').modal('show');
          });
          $("#btnSubmit").click(function(){
          $('#mymodal2').modal('show');
          });
          });
          </script>


<script type="text/javascript">
 $("#example-basic").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true
});
    </script>
