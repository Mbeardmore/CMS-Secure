<?php
include_once "Includes/header.php";


 if(is_admin($_SESSION['u_name'])) {


if (isset($_GET['edit_item'])) {

$item_Id = escape($_GET['edit_item']);


$query = "SELECT * FROM stock_management WHERE ID = $item_Id ";
$select_item = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($select_item);
    $id =             $row['ID'];
    $image =          $row['item_image'];
    $name =           $row['prod_name'];
    $supplier =       $row['supplier_name'];
    $pexvat =         $row['P_PRICE_EXVAT'];
    $sellprice =      $row['P_SELL'];
    $size =           $row['SIZE'];
    $stock =          $row['stock_level'];
    $lastpurchase =   $row['L_PURCHASE'];
    $Stock_Location = $row['Stock_Location'];

}
 ?>
<body>
    <div id="wrapper">
        <?php
         include "Includes/sidenav.php";
         include "Includes/topnav.php"; ?>
                    <div class="ibox-content">
                                        <div class="col-lg-12">
                    <h1 class="page-header">Alter Item</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Item Alteration
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" id="formbody">
    <form action="" method="post" enctype="multipart/form-data">


      <div class="form-group">
         <label for="title">Item Name</label>
          <input value="<?php echo htmlspecialchars(stripslashes($name));?>"  type="text" class="form-control" name="item_name">
      </div>
      <div class="form-group">
         <label for="title">Supplier</label>
          <input value="<?php  echo htmlspecialchars(stripslashes($supplier));
   ?>"  type="text" class="form-control" name="item_supplier">
      </div>
      <div class="form-group" style="width:40%;float:left;">
         <label for="title">Price ex vat</label>
          <input value="<?php  echo htmlspecialchars(stripslashes($pexvat));
   ?>"  type="text" class="form-control" name="price_exvat">
      </div>
      <div class="form-group" style="width:40%;float:right;">
         <label for="title">Price we sell at</label>
          <input value="<?php  echo htmlspecialchars(stripslashes($sellprice));
   ?>"  type="text" class="form-control" name="sell_price">
      </div>
      <div class="form-group" style="width:20%;">
         <label for="title">Size</label>
          <input value="<?php  echo htmlspecialchars(stripslashes($size));
   ?>"  type="text" class="form-control" name="item_size">
      </div>
      <div class="form-group" style="width:40%;float:left;">
         <label for="title">Stock Level</label>
          <input value="<?php  echo htmlspecialchars(stripslashes($stock));
   ?>"  type="text" class="form-control" name="stock_level">
      </div>
     <div class="form-group" style="width:40%;float:right;">
         <label for="title">Stock Location</label>
          <input value="<?php  echo htmlspecialchars(stripslashes($Stock_Location));
   ?>"  type="text" class="form-control" name="stock_location">
      </div>
       <div class="form-group" style="width:15%;">
         <label for="title">Date Of Last Purchase</label>
          <input value="<?php  echo htmlspecialchars(stripslashes($lastpurchase));
   ?>"  type="text" class="form-control" name="purchase_date">
      </div>
      <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea  class="form-control "name="post_content" id="" cols="30" rows="10"></textarea>
      </div>
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_item" value="Update Post" id="update">
      </div>
</form>
 <?php
  if(isset($_POST['update_item'])) {

    $name = escape($_POST['item_name']);
    $supplier = escape($_POST['item_supplier']);
    $pexvat = escape($_POST['price_exvat']);
    $sellprice = escape($_POST['sell_price']);
    $size = escape($_POST['item_size']);
    $stock = escape($_POST['stock_level']);
    $lastpurchase = escape($_POST['purchase_date']);
    $Stock_Location = escape($_POST['stock_location']);

          $query = "UPDATE stock_management SET ";
          $query .="prod_name  = '{$name}', ";
          $query .="supplier_name = '{$supplier}', ";
          $query .="P_PRICE_EXVAT = '{$pexvat}', ";
          $query .="P_SELL = '{$sellprice}', ";
          $query .="SIZE   = '{$size}', ";
          $query .="stock_level= '{$stock}', ";
          $query .="L_PURCHASE  = '{$lastpurchase}' ";
          $query .= "WHERE ID = {$item_Id} ";

        $update_post = mysqli_query($conn,$query);

        confirmQuery($update_post);

        echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$name}'>View Post </a> or <a href='item_search.php'>Edit More Posts</a></p>";

        header("Location:item_search.php");
    }

  } else {

    header ("Location: ../index.html");

       }
?>
</div>
    </div>
