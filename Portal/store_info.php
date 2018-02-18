<?php include "Includes/header.php";
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
         include "Includes/topnav.php"; ?>
        <div class="ibox">
                        <div class="ibox-title">
                            <h5>Apple Store Information</h5>
                            <div class="ibox-tools">
                                <a href="add_store.php" class="btn btn-primary btn-xs">Create new Store</a>
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
                                        <td>Store ID</td>
                                        <td>Location</td>
                                        <td>Preservation Officer</td>
                                        <td></td>
                                        <td></td>
                                        <td style="float:right;">Closing Time</td>

                                    </th>

                                    <?php
                                  $post_count = "SELECT * FROM stores" ;
                                  $find_count = mysqli_query($conn, $post_count);
                                  $count = mysqli_num_rows($find_count);
                                  $count = ceil($count / 10);
                                  confirmQuery($count);
                                    $query = "SELECT * FROM stores LIMIT $page_1, 10";
                                      $display_all = mysqli_query($conn, $query);
                                     confirmQuery($display_all);
                                      while ($row = mysqli_fetch_assoc($display_all)) {
                                                $id          =   $row['ID'];
                                                $store_id    =   $row['store_ID'];
                                                $location    =   $row['Location'];
                                                $presofficer =   $row['po_specialist'];
                                                $closing_time =   $row['closing_time'];
                                            echo "

                                           <tr class=''>
                                              <td class='project-status'>
                                              </td>
                                              <td class='project-title'>
                                                  {$store_id}
                                              </td>
                                              <td class='project-title'>
                                              {$location}

                                              </td>
                                              <td class='project-title'>
                                              {$presofficer}
                                              </td>
                                              <td>
                                              </td>
                                              <td>
                                              </td>
                                              <td class='project-people'>
                                                {$closing_time}

                                              </td>
                                              <td class='project-actions'>
                                                  <a href='edit_store.php?store_id={$id}' class='btn btn-white btn-sm'><i class='fa fa-folder'></i> View </a>
                                              </td>
                                          </tr>";
                                      }
                                     ?>
                                    <tbody>
                                    </tbody>
                                </table>
                                <nav aria-label="Page navigation example">
                                  <ul class="pagination">
                                    <?php for($i = 1; $i <= $count; $i++) {
                                        echo "<li class='page-item'><a class='page-link' href='store_info.php?page={$i}'>{$i}</a></li>";
                                    }?>
                                  </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
    </div>
    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'copy'},
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
    <?php include "Includes/footer.php"; ?>
