<?php include "Includes/header.php"; ?>
<?php if(is_admin($_SESSION['u_name'])) { ?>
<body>
    <div id="wrapper">
        <?php include "Includes/sidenav.php"; ?>
        <?php include "Includes/topnav.php"; ?>
                  <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Items</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Item Additions
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
    <form action="" method="POST" enctype="multipart/form-data">

      <div class="form-group">
         <label for="title">Item Name</label>
          <input   type="text" class="form-control" name="item_name">
      </div>
      <div class="form-group">
         <label for="title">Supplier</label>
          <input   type="text" class="form-control" name="item_supplier">
      </div>
      <div class="form-group" style="width:40%;float:left;">
         <label for="title">Price ex vat</label>
          <input   type="text" class="form-control" name="price_exvat">
      </div>
      <div class="form-group" style="width:40%;float:right;">
         <label for="title">Price we sell at</label>
          <input  type="text" class="form-control" name="sell_price">
      </div>
      <div class="form-group" style="width:20%;">
         <label for="title">Size</label>
          <input  type="text" class="form-control" name="item_size">
      </div>
      <div class="form-group" style="width:40%;float:left;">
         <label for="title">Stock Level</label>
          <input  type="text" class="form-control" name="stock_level">
      </div>
     <div class="form-group" style="width:40%;float:right;">
         <label for="title">Stock Location</label>
          <input   type="text" class="form-control" name="stock_location">
      </div>
       <div class="form-group" style="width:15%;">
         <label for="title">Date Of Last Purchase</label>
          <input   type="text" class="form-control" name="purchase_date">
      </div>
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_item" value="Create Item">
      </div>
</form>
<?php
if (isset($_POST['create_item'])) {
  createitem();
}
 } else {
 header ("Location: ../index.html");
}
?>
 </div>
 <?php include "Includes/footer.php" ?>
