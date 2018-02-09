<?php
include "Includes/header.php";
include "Includes/sidenav.php";
include "Includes/topnav.php";?>


            <div class="ibox-content">
                <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Product Name</th>
                <th>Supplier</th>
                <th>Purchase Price</th>
                <th>Sell Price</th>
                <th>Size</th>
                <th>Stock</th>
                <th>Last Purchase</th>
                <th>Stock Location</th>
                <th>edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            itemSearch();
            if(isset($_GET['delete_item'])) {
                deleteitem();
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
