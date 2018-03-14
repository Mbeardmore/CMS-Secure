<?php
include "Includes/header.php";
include "Includes/sidenav.php";
include "Includes/topnav.php";


$stmt = $conn->Prepare("");
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
                                <a href="new_ar.php" class="btn btn-primary btn-xs">Add new issue</a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="m-b-lg">

                                <div class="input-group">
                                    <input type="text" placeholder="Search issue by name..." class=" form-control">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-white"> Search</button>
                                    </span>
                                </div>
                                <div class="m-t-md">
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-sm btn-white"> <i class="fa fa-comments"></i> </button>
                                        <button type="button" class="btn btn-sm btn-white"> <i class="fa fa-user"></i> </button>
                                        <button type="button" class="btn btn-sm btn-white"> <i class="fa fa-list"></i> </button>
                                        <button type="button" class="btn btn-sm btn-white"> <i class="fa fa-pencil"></i> </button>
                                        <button type="button" class="btn btn-sm btn-white"> <i class="fa fa-print"></i> </button>
                                        <button type="button" class="btn btn-sm btn-white"> <i class="fa fa-cogs"></i> </button>
                                    </div>
                                    <strong>Found  issues.</strong>
                                </div>
                            </div>
                            <div class="table-responsive">
                            <table class="table table-hover issue-tracker">
                                <tbody>
                                <?php
                                $stmt = $conn->prepare("SELECT ID, AR_NO, AR_TYPE, AR_DETAILS, AR_TITLE, AR_REQUEST, AR_PRIORITY FROM features ");
                                $stmt->execute();
                                $stmt->bind_result($ID, $arno, $artype, $ardet, $artit, $arreq, $arprior);
                                $stmt->store_result();

                                while ($stmt->fetch()) {
                                  echo "
                                  <tr>
                                    <td>
                                        <span class='label label-primary'>New</span>
                                    </td>
                                    <td class='issue-info'>
                                        <a href=''#''>
                                            "; echo $artit; echo"
                                        </a>

                                        <small>
                                            Requested By: "; echo $arreq; echo"
                                        </small>
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        12.02.2015 10:00 am
                                    </td>
                                    <td>
                                     2 Days
                                    </td>
                                    <td class='text-right'>
                                        <button class='btn btn-white btn-xs'> Tag</button>
                                        <button class='btn btn-white btn-xs'> Mag</button>
                                        <button class='btn btn-white btn-xs'> Rag</button>
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
