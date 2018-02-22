<?php include "Includes/header.php";?>

<?php if(is_admin($_SESSION['u_name'])) {

$store_query = escape($_GET['store_id']);

$stmt = $conn->prepare("SELECT ID, store_ID, Location, po_specialist, orig_seal, foh_size, boh_size, Access, last_job, closing_time, comments FROM stores WHERE ID = {$store_query}");
$stmt->execute();
$stmt->bind_result($ID, $store_id, $location, $po_specialist, $orig_seal, $foh, $boh, $access, $last_job, $closing, $comment);
$stmt->fetch();
$stmt->close();
?>
<body>
<div id="wrapper">
    <?php include "Includes/sidenav.php";
          include "Includes/topnav.php"; ?>
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Store Information</a></li>
            <li><a data-toggle="tab" href="#menu1">Pre Store Visit Information</a></li>
          </ul>
          <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
          <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Apple Store Information
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <form action="" method="POST" enctype="multipart/form-data">

                            <div class="form-group">
                               <label for="title">Store ID</label>
                                <input   type="text" class="form-control" name="store_id" value="<?php echo $store_id; ?>" >
                            </div>
                            <div class="form-group">
                               <label for="title">Location</label>
                                <input   type="text" class="form-control" name="Location" value="<?php echo $location; ?>">
                            </div>
                            <div class="form-group" style="width:40%;">
                               <label for="title">Preservation Officer</label>
                                <input   type="text" class="form-control" name="pres_officer" value="<?php echo $po_specialist; ?>">
                            </div>
                            <div class="form-group" style="width:40%;">
                               <label for="title">Original Floor Seal</label>
                                <input  type="text" class="form-control" name="original_seal" value="<?php echo $orig_seal; ?>">
                            </div>
                            <div class="form-group" style="width:20%;">
                               <label for="title">FOH Size</label>
                                <input  type="text" class="form-control" name="FOH_size" value="<?php echo $foh; ?>">
                            </div>
                            <div class="form-group" style="width:40%;">
                               <label for="title">BOH Size</label>
                                <input  type="text" class="form-control" name="BOH_size" value="<?php echo $boh; ?>">
                            </div>
                           <div class="form-group" style="display:inline-grid;">
                                      <label for="jobtype">Access card required</label>
                                      <select class="selectpicker" name="Access" value="<?php echo $access; ?>">
                                          <option value="No">No</option>
                                          <option value="Yes">Yes</option>
                                      </select>
                                      </div>
                             <div class="form-group" style="width:40%;">
                               <label for="title">Date Of last Works</label>
                                <input   type="text" class="form-control" name="last_job" value="<?php echo $last_job; ?>">
                            </div>
                            <div class="form-group" style="width:40%;">
                               <label for="title">Closing Time</label>
                                <input   type="text" class="form-control" name="closing_time" value="<?php echo $closing; ?>">
                            </div>
                            <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea class="form-control" rows="5" name="comment" id="comment" value=""><?php echo $comment; ?></textarea>
                      </div>
                             <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update_store" value="Update Store">
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
                <div id="menu1" class="tab-pane fade">
                  <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                              <form action="" method="POST" enctype="multipart/form-data">

                                <div class="form-group" style="width:40%">
                                   <label for="title">Store Name</label>
                                    <input   type="text" class="form-control" value="<?php echo $store_id; ?>" name="store_name">
                                </div>
                                <div class="form-group" style="max-width:40%">
                                    <label for="date">Start date of Works</label>
                                    <input type="date" class="form-control" id="date" name="start_date">
                                </div>
                                <div class="form-group" style="max-width:40%">
                                    <label for="date">End date of Works</label>
                                    <input type="date" class="form-control" id="date" name="end_date">
                                </div>
                                <div class="form-group" style="width:40%">
                                   <label for="title">WO Number</label>
                                    <input   type="text" class="form-control" name="wo_num">
                                </div>
                                <div class="form-group" style="width:40%">
                                   <label for="title">Number of nights on site</label>
                                    <input   type="text" class="form-control" name="n-onsite">
                                </div>
                                <div class="form-group" style="width:40%">
                                   <label for="title">email</label>
                                    <input  type="text" class="form-control" name="email">
                                </div>
                                 <div class="form-group">
                                    <input class="btn btn-primary" type="submit" value="Request Pre-Survey" name="send_email">
                                </div>
                          </form>
                          </div>
                        </div>
                      </div>
                </div>
              </div>
</div>

<?php

if (isset($_POST['send_email'])) {
$rand=generateRandomString();
$email = $_POST['email'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$wo_num = $_POST['wo_num'];
$nos = $_POST['n-onsite'];
$to = $email;
$subject = "Apple Pre site Survey Store: ".$store_id;
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// More headers
$headers .= 'From: <info@beaverfloorcare.com>' . "\r\n";
$link ="https://beaverfloorcare.com/siteaudit.php?id={$rand}";



$stmt = $conn->prepare("INSERT INTO pre_survey (SECURE, EMAIL, STARTD, ENDD, WONUM, NOS, STOREID) VALUES (?,?,?,?,?,?,?) ");
$stmt->bind_param("sssssis", $rand, $email, $start_date, $end_date, $wo_num, $nos, $store_id);
$stmt->execute();
$stmt->close();

$email = "
<html>
<head>
<meta http-equiv='Content-Type' content=text/html; charset=utf-8></head>
<style type=text/css>
    /* CLIENT-SPECIFIC STYLES */
    body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
    table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;} /* Remove spacing between tables in Outlook 2007 and up */
    img{-ms-interpolation-mode: bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

    /* RESET STYLES */
    img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
    table{border-collapse: collapse !important;}
    body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}

    /* iOS BLUE LINKS */
    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }

    /* MOBILE STYLES */
    @media screen and (max-width: 525px) {

        /* ALLOWS FOR FLUID TABLES */
        .wrapper {
          width: 100% !important;
            max-width: 100% !important;
        }

        /* ADJUSTS LAYOUT OF LOGO IMAGE */
        .logo img {
          margin: 0 auto !important;
        }

        /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
        .mobile-hide {
          display: none !important;
        }

        .img-max {
          max-width: 100% !important;
          height: auto !important;
        }

        /* FULL-WIDTH TABLES */
        .responsive-table {
          width: 100% !important;
        }

        /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
        .padding {
          padding: 10px 5% 15px 5% !important;
        }

        .padding-meta {
          padding: 30px 5% 0px 5% !important;
          text-align: center;
        }

        .padding-copy {
             padding: 10px 5% 10px 5% !important;
          text-align: center;
        }

        .no-padding {
          padding: 0 !important;
        }

        .section-padding {
          padding: 50px 15px 50px 15px !important;
        }

        /* ADJUST BUTTONS ON MOBILE */
        .mobile-button-container {
            margin: 0 auto;
            width: 100% !important;
        }

        .mobile-button {
            padding: 15px !important;
            border: 0 !important;
            font-size: 16px !important;
            display: block !important;
        }

    }

    /* ANDROID CENTER FIX */
    div[style*='margin: 16px 0;'] { margin: 0 !important; }
</style>
</head>
<body style='margin: 0 !important; padding: 0 !important;'>

<!-- HIDDEN PREHEADER TEXT -->
<div style='display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;'>Site Pre Survey Store: $store_id</div>

<!-- HEADER -->
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tr>
        <td bgcolor='#ffffff' align='center'>

            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 500px;' class='wrapper'>
                <tr>
                    <td align='center' valign='top' style='padding: 15px 0;' class='logo'>
                        <a href='' target='_blank'>
                            <img alt='Logo' src='https://www.beaverfloorcare.com/logo.png' width='300' height='35' style='display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;' border='0'>
                        </a>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td bgcolor='#D8F1FF' align='center' style='padding: 70px 15px 70px 15px;' class='section-padding'>
            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 500px;' class='responsive-table'>
                <tr>
                    <td>
                        <br>
                        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                            <tr>
                                <td>
                                    <!-- COPY -->
                                    <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                        <tr>
                                            <td align='center' style='font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;' class='padding'>Pre Site Survey Information Form</td>
                                        </tr>
                                        <tr>
                                            <td align='center' style='padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding'><br><a href='$link'>Apple Pre Survey Form</a></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor='#ffffff' align='center' style='padding: 20px 0px;'>
            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='max-width: 500px;' class='responsive-table'>
                <tr>
                    <td align='center' style='font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;'>
                         The Barn,
                         Oldberrow Manor,
                         Ullenhall Ln,
                         Ullenhall B95
                         5PF
                        <br>
                        <a href='' target='_blank' style='color: #666666; text-decoration: none;'>Unsubscribe</a>
                        <span style='font-family: Arial, sans-serif; font-size: 12px; color: #444444;'>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                        <a href='' target='_blank' style='color: #666666; text-decoration: none;'>View this email in your browser</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>
";

mail($to,$subject,$email,$headers);
}

if (isset($_POST['update_store'])) {

$storeid = escape($_POST['store_id']);
$location = escape($_POST['Location']);
$pres_officer = escape($_POST['pres_officer']);
$seal = escape($_POST['original_seal']);
$FOH = escape($_POST['FOH_size']);
$BOH = escape($_POST['BOH_size']);
$Access = escape($_POST['Access']);
$last_job =  escape($_POST['last_job']);
$closing = escape($_POST['closing_time']);
$comment = escape($_POST['comment']);


$stmt = $conn->prepare("UPDATE stores SET store_ID = ?, Location = ?, po_specialist = ?, orig_seal = ?, foh_size = ?, boh_size = ?, Access = ?, last_job = ?, closing_time = ?, comments = ? WHERE ID = {$ID} ");
$stmt->bind_param("ssssssssss", $storeid, $location, $pres_officer, $seal, $FOH, $BOH, $Access, $last_job, $closing, $comment);
$stmt->execute();
$stmt->close();

header("Location: edit_store.php?store_id={$ID}");
}
 } else {

 header ("Location: ../index.html");

}

?>
 </div>

 <?php include "Includes/footer.php"; ?>
