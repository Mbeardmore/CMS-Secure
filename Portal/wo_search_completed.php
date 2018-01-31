<?php include "Includes/header.php"; 


?>

<?php 

if(isset($_GET['page'])) {

$page = $_GET['page'];

} else {

 $page = "";

}

if ($page == "" || $page == 1) {

    $page_1 = 0;
} else {

    $page_1 = ($page * 10) - 10;
}

 ?>
<body>

    <div id="wrapper">
        <?php 
        include "Includes/sidenav.php";
        include "Includes/topnav.php";
         ?>
        <div class="ibox">
                        <div class="ibox-title">
                            <h5>All Completed Work Orders</h5>
                            <div class="ibox-tools">
                                <a href="create_wo.php" class="btn btn-primary btn-xs">Create new project</a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row m-b-sm m-t-sm">
                                <div class="col-md-1">
                                    <button type="button" id="loading-example-btn" onClick="window.location.reload()" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> Refresh</button>
                                </div>
                                <div class="col-md-11">
                                    <form method="POST">
                                        <?php if (is_admin($_SESSION['u_name'])) {?>
                                    <div class="input-group"><input type="text" name="text" placeholder="Search..." class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="submit" name="search" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                                        <?php } else {} ?>
                                    </form>



                                </div>
                            </div>
                            
                            <div class="project-list">

                                <table class="table table-hover">
                                    <th>
                                        <td>status</td>
                                        <td>Contract</td>
                                        <td>Start Date</td>
                                        <td>End Date</td>
                                        <td></td>
                                        <td style="float:right;">Assigned Techs</td>
                                     
                                    </th>
                                    <tbody>
                                  <?php 

                                  if(isset($_POST['search'])) {
                                    $search = escape($_POST['text']);


                                
                                  $post_count = "SELECT * FROM work_orders WHERE Work_Order LIKE  '%$search%' OR company LIKE '%$search%' AND status = 'Completed' " ;
                                  $find_count = mysqli_query($conn, $post_count);
                                  $count = mysqli_num_rows($find_count);


                                  $count = ceil($count / 10);
                                    
                                    $query = "SELECT * FROM work_orders WHERE Work_Order LIKE '%$search%' OR company LIKE '%$search%' AND status = 'Completed' ";

                                      $display_all = mysqli_query($conn, $query);

                                      confirmQuery($display_all);

                                      while ($row = mysqli_fetch_assoc($display_all)) {
                                          $id             = $row['ID'];
                                          $creator        = $row['creator'];
                                          $wonum          = $row['Work_Order'];
                                          $jobloc         = $row['job_location'];
                                          $store          = $row['street'];
                                          $todaydate      = $row['date_today'];
                                          $datestart      = $row['date_start'];
                                          $dateend        = $row['date_end'];
                                          $Assigned       = $row['Assigned_user'];
                                          $jobinfo        = $row['job_info'];
                                          $floorsize      = $row['floor_size'];
                                          $status         = $row['status'];
                                          $contact        = $row['site_contact'];

                                            echo "

                                           <tr class='clickable-row' data-href='view_wo.php?view_wo={$id}'>
                                              <td class='project-status'>";
                                                 wosearchstatus($status);
                                                 echo "
                                              </td>
                                              <td class='project-title'>
                                                  <a href='view_wo.php?view_wo={$id}'>Contract with: {$jobloc} {$store}<br>
                                                  WO: {$wonum}</a>
                                                  <br>
                                                  <small>created: {$todaydate}</small>
                                              </td>
                                              <td class='project-title'>
                                              <a href=''> Start date </a><br>
                                              <small>{$datestart}</small>
                                              </td>
                                              <td class='project-title'>
                                              <a href=''> End date </a><br>
                                              <small>{$dateend}</small>
                                              </td>
                                              <td>
                                              </td>
                                              <td class='project-people'>
                                              <small> Assigned Techs</small><br>
                                              {$Assigned}
                                              </td>
                                              <td class='project-actions'>
                                                  <a href='view_wo.php?view_wo={$id}' class='btn btn-white btn-sm'><i class='fa fa-folder'></i> View </a>
                                                  <a href='edit_wo.php?edit_wo={$id}' class='btn btn-white btn-sm'><i class='fa fa-pencil'></i> Edit </a>
                                              </td>
                                          </tr>";
     
                                    }


                                  } else {

                                    if (is_manager($_SESSION['u_name'])) {

                                        WOSearchmanagercompleted($page_1, $dateend);
                                      }
                                    }
                                     ?>
                                    
                                    </tbody>

                                </table>

                                <nav aria-label="Page navigation example">
                                  <ul class="pagination">
                
                                    <?php for($i = 1; $i <= $count; $i++) {

                                        echo "<li class='page-item'><a class='page-link' href='wo_search_completed.php?page={$i}'>{$i}</a></li>";
                                    }

                                     ?>
                                    

                                  </ul>
                                </nav>

                            </div>

                        </div>


                    </div>


    </div>



    <?php include "Includes/footer.php"; ?>
    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

        });

    </script>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
    </script>

</body>

</html>
