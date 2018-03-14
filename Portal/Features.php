<?php
include "Includes/header.php";
include "Includes/sidenav.php";
include "Includes/topnav.php";
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Feature Tracker</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.php">Homepage</a>
            </li>
            <li class="active">
                <strong>Feature Tracker</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Issue list</h5>
                            <div class="ibox-tools">
                                <a href="action-request.php" class="btn btn-primary btn-xs">Add new issue</a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="m-b-lg">

                                <div class="input-group">
                                    <input type="text" placeholder="Search issue by name..." class=" form-control" hidden>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-white" hidden> Search</button>
                                    </span>
                                </div>
                                <div class="m-t-md">

                                    <strong>Action Requests</strong>
                                </div>
                            </div>
                            <div class="table-responsive">
                            <table class="table table-hover issue-tracker">
                                <tbody>
                                <?php
                                $date="";
                                $stmt = $conn->prepare("SELECT ID, AR_NO, AR_TYPE, AR_DETAILS, AR_TITLE, AR_REQUEST, AR_PRIORITY, AR_DATE FROM features ");
                                $stmt->execute();
                                $stmt->bind_result($ID, $arno, $artype, $ardet, $artit, $arreq, $arprior, $date);
                                $stmt->store_result();
                                $today = date_create(date("Y-m-d"));

                                while ($stmt->fetch()) {

                                  $ardate= date_create($date);

                                  $tage= $today->diff($ardate)->format('%a Days');
                                  if($ardate->diff($today)->days < 3) {
                                    $age = "New ".$artype;
                                    $label = "primary";

                                  } else {
                                    $age = $artype;
                                    $label = "warning";
                                  }

                                  echo "
                                  <tr>
                                    <td>
                                        <span class='label label-$label'>{$age}</span>
                                    </td>
                                    <td class='issue-info'>
                                        <a href='view_ar.php?view_arID={$ID}'>
                                             $artit
                                        </a>
                                        <small>
                                            Requested By: $arreq
                                        </small>
                                    </td>
                                    <td>
                                    Date Created: <br> $date
                                    </td>
                                    <td>
                                    Age: <br>
                                    $tage
                                    </td>
                                    <td>

                                    </td>
                                    <td class='text-right'>
                                        <button class='btn btn-white btn-xs'>View</button>
                                        <button class='btn btn-white btn-xs'>Client</button>
                                    </td>
                                </tr>";

                                }
                                 ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
<?php include "Includes/footer.php"; ?>
