<?php include "Includes/header.php";
$today = date("Y-m-d");
$query = $conn->prepare("UPDATE work_orders SET status = 'Pending' WHERE date_start >= '$today' AND date_start <= '$today' + INTERVAL 21 DAY AND status = 'Inactive'");
$query->execute();
$query->close();
if(isset($_SESSION['u_name'])) {}  else { header("Location: ../index.php"); die(); }
include "Includes/sidenav.php";
include "Includes/topnav.php";
$completed = selectallwos('Completed') / selectallwo() * 100;
$pending = selectallwos('Pending') / selectallwo() * 100;
 ?>
    <div class="wrapper" style="height:auto;">
          <div class="row  border-bottom white-bg dashboard-header">
          <br>
        <?php if(is_admin($_SESSION['u_name'])) { ?>
        <div class="row">
            <a href="wo_search.php">
            <div class="col-lg-3" style="">
                <div class="ibox float-e-margins">
                    <div class="ibox-title ">
                        <span class="label label-success pull-right">Total</span>
                        <h5>Work Orders</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php  echo selectallwo(); ?>
                        </h1>
                        <div class="stat-percent font-bold text-success">
                            <i class="fa fa-bolt"></i>
                        </div>
                        <small>All Work Orders</small>
                    </div>
                </div>
            </div></a>
            <a href="wo_search_completed.php">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">Completed</span>

                        <h5>Work Orders</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo selectallwos('Completed'); ?>
                        </h1>
                        <div class="stat-percent font-bold text-info">
                            <?php echo round($completed)."%"; ?> <i class="fa fa-level-up"></i>
                        </div>
                        <small>Completed</small>
                    </div>
                </div>
            </div>
          </a>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">Pending</span>
                        <h5>Work Orders</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo selectallwos('Pending'); ?>
                        </h1>
                        <div class="stat-percent font-bold text-navy">
                           <?php echo round($pending)."%"; ?> <i class="fa fa-level-up"></i>
                        </div>
                        <small>Pending</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-danger pull-right">Total Items</span>

                        <h5>Database Items</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo selectall(); ?>
                        </h1>
                        <small>Total Products</small>
                    </div>
                </div>
            </div>
        </div>
        <hr class="style13">
        <?php }  ?>
  <?php if (is_manager($_SESSION['u_name'])) { ?>
    <div class="col-lg-4">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>Daily Access logs</h5>
              <div class="ibox-tools">
                  <span class="label label-warning-light pull-right"></span>
                 </div>
          </div>
          <div class="ibox-content" style="">
              <div>
                  <div class="feed-activity-list" style="height: 355px; overflow-y: scroll;">
                    <?php
                    $stmt = $conn->prepare("SELECT user, notification, work_order, accessed FROM logs ORDER BY ID DESC LIMIT 30");
                    $stmt->execute();
                    $stmt->bind_result($user,$notification,$work_order,$accessed);
                    while ($stmt->fetch())
                    {
                      echo '
                      <div class="feed-element">
                          <div class="pull-left">
                              <strong>'.$work_order.'</strong>
                          </div>
                          <div class="media-body ">
                              <small class="pull-right">'.$accessed.'</small>
                              <strong>'.$user.'</strong> '.$notification.' <br>
                          </div>
                      </div>';
                    } ?>
                  </div>
              </div>
          </div>
      </div>
  </div>
<?php } ?>
    <div class="col-lg-4">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
                <h5>Work Order Messages</h5>
            </div>
            <div class="panel-body" style="padding:0px">
                <div class="feed-activity-list" style="height:400px;overflow-y: scroll;" id="message">
                    <!-- messages go here -->
                    <?php
                    $retmessage = "SELECT * FROM job_messages ORDER BY ID DESC LIMIT 20";
                    $retrieve = mysqli_query($conn, $retmessage);
                    while ($ret = mysqli_fetch_assoc($retrieve)) {

                      $wonum   = $ret['Work_Order'];
                      $message = $ret['message'];
                      $name    = $ret['u_name'];
                      $sent    = $ret['time_added'];
                    ?>
                    <div class="feed-element" style="margin:2%; margin-top:0;">
                        <a class="pull-left" href="https://beaverfloorcare.com/Portal/view_wo.php?view_wo=<?php echo $wonum; ?>"><strong>Wo: <?php echo $wonum; ?></strong></a>
                        <br>
                        <div class="media-body">
                            <strong><?php echo $name; ?></strong><br>
                            <small class="text-muted"><?php echo $name . "- " . "Sent: " . $sent;?></small>

                            <div class="well">
                                <?php echo $message; ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php if (is_manager($_SESSION['u_name'])) { ?>
    <div class="col-lg-4">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
                <h5>Holiday </h5>
            </div>
            <div class="panel-body" style="padding:0px;height:400px;overflow-y: scroll ">
              <?php
                    if(is_manager($_SESSION['u_name'])) {
                     echo "<table class='table table-hover''>
                    <th>Name</th>
                    <th>Start</th>
                    <th>End</th>
                    <th></th>
                    <th>Status</th>
                    <tbody>";
                    $query = $conn->prepare("SELECT ID, title, start, `end`,  signature, Approved FROM  events WHERE Approved = 'Awaiting Approval' OR  Code = '2' ORDER BY id DESC LIMIT 10 ");
                    $query->execute();
                    $query->bind_result($id, $title, $start, $end, $sig, $approved);
                    while($query->fetch()) {
                    echo "
                    <tr class='clickable-row'>
                    <td class='project-title'>{$title}</td>
                    <td class='project-title'>{$start}</td>
                    <td class='project-title'>{$end}</td>
                    <td class='project-title'>{$sig}</td>
                    <td style='top:10px; position:relative' class='project-status'><span class='label label-warning'>{$approved}</span></td>
                    <td class='project-actions'><a href='booking.php?holiday_edit={$id}' class='btn btn-white btn-sm'>Edit</a><a href='booking.php?holiday_approve={$id}' class='btn btn-white btn-sm'>Approve</a></td>
                    </tr>";
                    }
                    $query->close();;
                    } ?>
            </div>
          </div>
    </div>
    <?php } else {} ?>
  </div>
</div>
        <?php include "Includes/footer.php"; ?>
</body>
</html>
