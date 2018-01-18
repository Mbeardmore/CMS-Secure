<?php 
include "Includes/header.php"; 
?>

<?php if(is_admin($_SESSION['u_name'])) { ?>

<body>

    <div id="wrapper">
        <?php include "Includes/sidenav.php"; ?>

        <?php include "Includes/topnav.php"; ?>
   
                    <div class="ibox-content" style="background-color:#f3f3f4;">

                    	<div class="col-lg-12">
                <h1 class="page-header">Create Appointment</h1>
            </div>
        </div>
        <!-- /.row -->
               <link rel="stylesheet" href="../css/jquery.steps.css">
        <div class="row">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
                  Appointment Form
                  <div class="panel_heading" style="float:right">
                  <b>Creator:</b> <?php echo $_SESSION['u_first'] . " " . $_SESSION['u_last']; ?>
                  </div>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <form method="POST" id="wizard" enctype="multipart/form-data">
              <div id="example-basic">
                <h3>Location Details</h3>
                <section>
                    <div class="form-group" style="">
                     <label for="title">Client Name</label>
                        <input  type="text" class="form-control" name="client_name" style="width:25%" required="">

                    <label for="title">Floor Type</label>
                        <input  type="text" class="form-control" name="floor_type" style="width:25%" required="">
                        <br>
                        <div>
                            <div>
                            <label for="length">Length</label>
                        <input  type="text" class="form-control" name="length" style="width:10%;">
                    </div>
                    <div>
                         <label style=";" for="tech"> Width</label>
                        <input  type="text" class="form-control" name="Tech" style=";width:10%;" required=>
                    </div>
                    </div>
                    <div>
                        

                    </div>
                </div>
                </section>
                <h3>Customer Details</h3>
                    <section>
                        <div class="form-group" style="">
                         <label for="title">Client First Name</label>
                        <input  type="text" class="form-control" name="client_name" style="width:25%" required="">
                        <br>
                        <label for="title">Client Last Name</label>
                        <input  type="text" class="form-control" name="client_name" style="width:25%" required="">
                        <br>
                        <label for="title">Client Email</label>
                        <input  type="text" class="form-control" name="client_name" style="width:25%" required="">
                    </div>
                    </section>
                <h3>Address</h3>
                <section>
                  
                </section>
                <h3>Completion</h3>
                <section style="">
                <input class="btn btn-primary btn-lg center-block" id="submit" type="submit" name="complete_wo" value="Complete">
                </section>
            </div>
          </form>
        </div>
    </div>
</div>
</div>
</div>
</body>
<script type="text/javascript">
 $("#example-basic").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true
});
    </script>

<?php } else {header("Location: ../index.php");} ?>

<?php include "Includes/footer.php"; ?>