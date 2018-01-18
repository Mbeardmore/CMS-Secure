<?php include "Includes/header.php"; ?>

<body>
    <div id="wrapper">
        <?php 
        include "Includes/sidenav.php";
        include "Includes/topnav.php";
         ?>
                    <div class="ibox-content" style="background-color: #f3f3f4">
                         <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>UserName</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>User Role</th>
                        <th>Last Logged in</th>
                        <th>edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 

                    viewallusers();

                    if (isset($_GET['delete_user'])) {
                    deleteuser();
                    }
                     ?>
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

</body>

</html>
