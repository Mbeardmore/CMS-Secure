<?php
include "db.php";

function is_admin($username) {

    global $conn;

    $stmt =$conn->prepare("SELECT user_role FROM user WHERE u_name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();

    if ($result ==='Super-Admin' || $result === 'Admin' || $result === 'Manager') {

      return true;

    } else {

      return false;
    }
}

function is_manager($username) {

    global $conn;

    $stmt =$conn->prepare("SELECT user_role FROM user WHERE u_name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();

    if ($result ==='Super-Admin' || $result === 'Manager') {

      return true;

    } else {

      return false;
    }
}

function is_tech($username) {

       global $conn;

    $stmt =$conn->prepare("SELECT user_role FROM user WHERE u_name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();

    if ($result ==='Super-Admin' || $result === 'Admin' || $result === 'Manager' || $result === 'Tech') {

      return true;

    } else {

      return false;
    }
}


function escape($string)
{

    global $connection;

    return mysqli_real_escape_string($connection, trim($string));


}

function confirmQuery($result)
{
    global $connection;

    if (!$result) {

        die("QUERY FAILED ." . " " . mysqli_error($connection));
    }
}


function ItemSearch()
{
    global $conn;

    $stmt = $conn->prepare("SELECT ID, item_image, prod_name, supplier_name, P_PRICE_EXVAT, P_SELL, SIZE, stock_level, L_PURCHASE, Stock_Location FROM stock_management");
    $stmt->execute();
    $stmt->bind_result($ID, $item_image, $prod_name, $supplier_name, $P_PRICE_EXVAT, $P_SELL, $SIZE, $stock_level, $L_PURCHASE, $Stock_Location);

    while($stmt->fetch()) {

        echo "<tr>";
        echo "<td>" . $ID . "</td>";
        echo "<td>" . $item_image . "</td>";
        echo "<td>" . $prod_name . "</td>";
        echo "<td>" . $supplier_name . "</td>";
        echo "<td>" . $P_PRICE_EXVAT . "</td>";
        echo "<td>" . $P_SELL . "</td>";
        echo "<td>" . $SIZE . "</td>";
        echo "<td>" . $stock_level . "</td>";
        echo "<td>" . $L_PURCHASE . "</td>";
        echo "<td>" . $Stock_Location . "</td>";
        echo "<td><a href='edit_item.php?edit_item={$ID}'>Edit</a></td>";
        echo "<td><a href='item_search.php?delete_item={$ID}'>Delete</a></td>";
        echo "</tr>";

    }
$stmt->close();


}


function selectall()
{
    global $connection;
    $query      = "SELECT * FROM stock_management";
    $select_all = mysqli_query($connection, $query);
    $final_num  = mysqli_num_rows($select_all);
    return $final_num;
}

function selectallwos($status)
{
    global $connection;
    $query      = "SELECT * FROM work_orders WHERE status = '$status'";
    $select_all = mysqli_query($connection, $query);
    $wo  = mysqli_num_rows($select_all);
    return $wo;
}

function selectallwo()
{
    global $connection;
    $query      = "SELECT * FROM work_orders";
    $select_all = mysqli_query($connection, $query);
    $wo  = mysqli_num_rows($select_all);
    return $wo;
}


function createitem() {

global $conn;

  $item_name         = escape($_POST['item_name']);
  $item_supplier     = escape($_POST['item_supplier']);
  $pexvat            = escape($_POST['price_exvat']);
  $pwesell           = escape($_POST['sell_price']);
  $item_size         = escape($_POST['item_size']);
  $stock_level       = escape($_POST['stock_level']);
  $stock_location    = escape($_POST['stock_location']);
  $purchase_date     = escape($_POST['purchase_date']);

  $buy = "£".$pexvat;
  $sell = "£".$pwesell;

  $stmt = $conn->prepare("INSERT INTO stock_management (prod_name, supplier_name, P_PRICE_EXVAT, P_SELL, SIZE, stock_level, L_PURCHASE, Stock_Location) VALUES (?,?,?,?,?,?,?,?)");
  $stmt->bind_param("ssssssss", $item_name, $item_supplier, $buy, $sell, $item_size, $stock_level, $stock_location, $purchase_date);
  $stmt->execute();
  $stmt->close();

  echo "<p class='bg-success'>Item created.";

}



function deleteitem() {

global $conn;

if (isset($_GET['delete_item'])) {

$item_Id = escape($_GET['delete_item']);


}
$stmt =$conn("DELETE  FROM stock_management WHERE ID = ? ");
$stmt->bind_param("s", $item_Id);
$stmt->execute();
$stmt->close();

Header("Location: item_search.php");

}

function createuser() {

  global $connection;


    $username = escape($_POST['user']);
    $postimage = $_FILES['image_upload']['name'];
    $postimage_tmp = $_FILES['image_upload']['tmp_name'];
    $fname = escape($_POST['f_name']);
    $lname = escape($_POST['l_name']);
    $email = escape($_POST['email']);
    $pwd = escape($_POST['pwd']);
    $userrole = escape ($_POST['user_role']);

    move_uploaded_file($postimage_tmp, "Images/user-images/$postimage ");

    $password = password_hash( $pwd, PASSWORD_BCRYPT, array('cost' => 12));


    $query = "INSERT INTO user (u_name, user_image, u_first, u_last, u_email, u_pwd, user_role) ";
    $query .= "VALUES ('{$username}','{$postimage}','{$fname}','{$lname}','{$email}','{$password}','{$userrole}') ";

    $result = mysqli_query($connection, $query);

    confirmQuery($result);
}

function viewallusers() {

    global $connection;

    $query = "SELECT * FROM user";

    $display_all = mysqli_query($connection, $query);


    while ($row = mysqli_fetch_assoc($display_all)) {
        $id             = $row['ID'];
        $username       = $row['u_name'];
        $first          = $row['u_first'];
        $last           = $row['u_last'];
        $email          = $row['u_email'];
        $userrole       = $row['user_role'];
        $lastonline     = $row['Last_Signed_in'];

        echo "<tr>";
        echo "<td>" . $username . "</td>";
        echo "<td>" . $first . "</td>";
        echo "<td>" . $last . "</td>";
        echo "<td>" . $email . "</td>";
        echo "<td>" . $userrole . "</td>";
        echo "<td>" . $lastonline . "</td>";

        echo "<td><a href='edit_user.php?edit_user={$id}'>Edit</a></td>";
        echo "<td><a href='manage_user.php?delete_user={$id}'>Delete</a></td>";
        echo "</tr>";
    }
}

function updateuser($userid) {



    global $conn;

    $username        = escape($_POST['user']);
    $first           = escape($_POST['f_name']);
    $last            = escape($_POST['l_name']);
    $email           = escape($_POST['email']);
    $pwd             = escape($_POST['pwd']);
    $userrole        = escape($_POST['user_role']);
    $log = "Altered user" . " " . $username;
    $user = $_SESSION['u_name'];
    $wonum = "Users";

    if ($first  = 'Martin' && $_SESSION['u_name'] != "mbeardmore") { echo "you dont have access to this account";  return false; }
    if (!empty($pwd) ) {

      $password = password_hash( $pwd, PASSWORD_BCRYPT, array('cost' => 12));

      $stmt = $conn->prepare("UPDATE user SET u_name = ?, u_first = ?, u_last = ?, u_email = ?, u_pwd = ?, user_role = ?  WHERE ID = {$userid} ");
      $stmt->bind_param("ssssss", $username, $first, $last, $email, $password, $userrole);
      $stmt->execute();
      $stmt->close();
      $newlog = new log();
      $newlog->logaction($log, $wonum, $user);
      header("Location: manage_user.php");
    }  else  {

      $stmt = $conn->prepare("UPDATE user SET u_name = ?, u_first = ?, u_last = ?, u_email = ?, user_role = ?  WHERE ID = {$userid} ");
      $stmt->bind_param("sssss", $username, $first, $last, $email, $userrole);
      $stmt->execute();
      $stmt->close();
      $newlog = new log();
      $newlog->logaction($log, $wonum, $user);
      header("Location: manage_user.php");

    }
}

function logout() {

session_start();
session_destroy();
header("Location: ../../index.php");


}

function usersearch()
{

    global $connection;
    $query = "SELECT u_first FROM user;";
    $display_all = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($display_all)) {
        $firstname       = $row['u_first'];
        echo "<option value='$firstname'>" . $firstname . "</option>";
    }

  }


function deleteuser() {

global $connection;

if (isset($_GET['delete_user'])) {

$user_id = escape($_GET['delete_user']);

if ($user_id === '1') { echo "You do not have permission to remove this account"; return false; } else {


}
$query = "DELETE FROM user WHERE ID = $user_id ";
$select_item = mysqli_query($connection, $query);
echo "<p class='bg-sucess'> user Deleted.";

}

}

  function createworkorder() {

    global $connection;

      $upload  = $_POST['file'];
      $jobtype = escape ($_POST['Jobtype']);
      $creator = $_SESSION['u_first'];
      $company = escape($_POST['company']);
      $joblocation = $company;
      $street   = escape($_POST['street']);
      $city     = escape($_POST['city']);
      $wonumber = escape($_POST['wo_number']);
      $floorsize = escape($_POST['floor_size']);
      $start_time = escape($_POST['start_time']);
      $active = escape($_POST['Active']);
      $startdate = escape($_POST['start_date']);
      $enddate = escape ($_POST['end_date']);
      $assigned = $_POST['assigned'];
      $Jobdetails = escape ($_POST['Job-Details']);
      $sitecontact = escape($_POST['site_contact']);
      $client = escape($_POST['client']);
      $WOlink = escape($_POST['link']);
      $datetoday = date('d/m/Y');
      $assignedtech = implode(",", $assigned);
      $combined = $wonumber . " " . $joblocation . " " . $assignedtech;
      $color = "#008000";
      $exploded = explode(",", $assignedtech);


      //Create directory if Work order is set
if(!empty($_POST['wo_number'] && $_SERVER['REQUEST_METHOD'] == "POST")) {

 $path = "work_order_files/$wonumber.$joblocation/";
  mkdir($path);

  if (is_dir($path)) {
    $valid_formats = array(
      "jpg",
      "jpeg",
      "JPEG",
      "JPG",
      "png",
      "PDF",
      "pdf",
      "doc",
      "xls"
    );
    foreach($_FILES['file']['name'] as $f => $name) {

      $fileext = explode('.', $name);
      $actualExt = strtolower(end($fileext));

      if (in_array($actualExt, $valid_formats)) {

        move_uploaded_file($_FILES['file']['tmp_name'][$f], $path . $name);

        $query = "INSERT INTO wo_files (wo_number, Location, Uploader) ";
        $query .= "VALUES ('{$wonumber}','{$name}','{$creator}') ";

        $result = mysqli_query($connection, $query);

        confirmQuery($result);

        } else
        {
        echo "Wrong File Extension";
        }
      }
    }


  }
      if(!empty($assigned)) {
      foreach ($exploded as $user) {

        $query1 = "INSERT INTO assigned (wo_num, u_first) ";
        $query1 .= "VALUES ('{$wonumber}','{$user}') ";

        $result1 = mysqli_query($connection, $query1);

        confirmQuery($result1);

      }
    }

      $query = "INSERT INTO work_orders (Job_type, creator, Work_Order, job_location, company, street, city, date_today, date_start, date_end, Assigned_user, job_info, floor_size, Start, status, site_contact, client, `work_order_link`) ";
      $query .= "VALUES ('{$jobtype}','{$creator}','{$wonumber}','{$joblocation}','{$company}','{$street}','{$city}','{$datetoday}','{$startdate}','{$enddate}','{$assignedtech}','{$Jobdetails}','{$floorsize}','{$start_time}','{$active}','{$sitecontact}','{$client}','{$WOlink}') ";
      $result = mysqli_query($connection, $query);
      confirmQuery($result);

      $calevent = "INSERT INTO events (title, color, start, end, assigned_users, work_order) ";
      $calevent .= "VALUES ('{$combined}','{$color}','{$startdate}','{$enddate}','{$assignedtech}','{$wonumber}') ";
      $calresult = mysqli_query($connection, $calevent);
      confirmQuery($calresult);

      header("Location: wo_search.php");

  }


function createaccomodation() {

    global $conn;

  $accomtype    = $_POST['accom_type'];
  $address      = escape($_POST['address']);
  $town         = escape($_POST['town']);
  $post_code    = escape($_POST['post_code']);
  $wonum        = escape($_POST['wo_number']);
  $arrival      = escape($_POST['arrival']);
  $owner        = escape($_POST['site_contact']);
  $special      = escape($_POST['special']);

  $stmt = $conn->prepare("INSERT INTO acommodation (accom_type, Address, Town, Postcode, work_order, Arrival, owner, special_ins) VALUES (?,?,?,?,?,?,?,?) ");
  $stmt->bind_param("ssssssss", $accomtype, $address, $town, $post_code, $wonum, $arrive, $owner, $special);
  $stmt->execute();
  $stmt->close();

  }


  function WOSearch($session, $page_1){

        global $connection;
        global $count;

    $query = "SELECT wo_num FROM assigned WHERE u_first = '$session' ";

    $result = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($result)) {

        $ID[] = $row['wo_num'];
    }

    if(mysqli_num_rows($result) > 0) {

$implode = implode("','", $ID);


      $post_count = "SELECT * FROM `work_orders` WHERE `Work_Order` IN ('$implode') AND status = 'Pending' ORDER BY date_start ASC" ;
      $find_count = mysqli_query($connection, $post_count);
      $count = mysqli_num_rows($find_count);

      $count = ceil($count / 10);


$query1 = "SELECT * FROM `work_orders` WHERE `Work_Order` IN ('$implode') AND status = 'Pending' ORDER BY date_start ASC LIMIT $page_1, 10";

    $user_wo_res = mysqli_query($connection, $query1);

while ($row = mysqli_fetch_assoc($user_wo_res)) {

          $id             = $row['ID'];
          $creator        = $row['creator'];
          $wonum          = $row['Work_Order'];
          $jobloc         = $row['job_location'];
          $street         = $row['street'];
          $city           = $row['city'];
          $todaydate      = $row['date_today'];
          $datestart      = $row['date_start'];
          $dateend        = $row['date_end'];
          $Assigned       = $row['Assigned_user'];
          $jobinfo        = $row['job_info'];
          $floorsize      = $row['floor_size'];
          $status         = $row['status'];
          $contact        = $row['site_contact'];
          $startime       = $row['Start'];

                        echo "

           <tr class='clickable-row' data-href='all_wo.php?view_wo={$id}'>
              <td class='project-status'>";
                 wosearchstatus($status, $dateend);
                 echo "
              </td>
              <td class='project-title'>
                  <a href='view_wo.php?view_wo={$id}'>{$jobloc} {$city}</a>
                  <br>
                  <small>created: {$todaydate}</small>
                  <br>
                  <Small> <b>Start Time @ unit:</b> {$startime}<small>
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
              </td>
          </tr>";
}
} else {}

}

  function WOSearchmanager($page_1)
  {

      global $connection;
      global $count;
      $post_count = "SELECT * FROM work_orders WHERE status = 'Pending' || status = 'Inactive' ORDER BY date_start ASC" ;
      $find_count = mysqli_query($connection, $post_count);
      $count = mysqli_num_rows($find_count);

      $count = ceil($count / 10);
      $query = "SELECT * FROM work_orders WHERE status = 'Pending' || status = 'Inactive' ORDER BY date_start ASC LIMIT $page_1, 10 " ;



      $display_all = mysqli_query($connection, $query);


      while ($row = mysqli_fetch_assoc($display_all)) {
          $id             = $row['ID'];
          $creator        = $row['creator'];
          $wonum          = $row['Work_Order'];
          $jobloc         = $row['job_location'];
          $street         = $row['street'];
          $city           = $row['city'];
          $todaydate      = $row['date_today'];
          $datestart      = $row['date_start'];
          $dateend        = $row['date_end'];
          $Assigned       = $row['Assigned_user'];
          $jobinfo        = $row['job_info'];
          $floorsize      = $row['floor_size'];
          $status         = $row['status'];
          $contact        = $row['site_contact'];
          $startime       = $row['Start'];

          $dateS = new DateTime($datestart);
          $dateE = new DateTime($dateend);
            echo "

           <tr class='clickable-row' data-href='view_wo.php?view_wo={$id}'>
              <td class='project-status'>";
                 wosearchstatus($status, $dateend);
                 echo "
              </td>
              <td class='project-title'>
                  <a href='view_wo.php?view_wo={$id}'> {$jobloc} {$city}<br>
                  WO: {$wonum}</a>
                  <br>
                  <small>created: {$todaydate}</small>
                  <br>
                  <small><b>Start Time @ unit: {$startime}</b><small>
              </td>
              <td class='project-title'>
              <a href=''> Start date </a><br>
              <small>{$dateS->format('d-m-Y')}</small>
              </td>
              <td class='project-title'>
              <a href=''> End date </a><br>
              <small>{$dateE->format('d-m-Y')}</small>
              </td>
              <td>
              </td>
              <td class='project-people'>
              <small> Assigned Techs</small><br>
              {$Assigned}
              </td>
              <td class='project-actions'>
                  <a href='edit_wo.php?edit_wo={$id}' class='btn btn-white btn-sm'><i class='fa fa-pencil'></i> Edit </a>
              </td>
          </tr>";
  }

  return $count;
}

  function WOSearchmanagercompleted($page_1)
  {

      global $connection;
      global $count;
      $post_count = "SELECT * FROM work_orders WHERE status = 'Completed' " ;
      $find_count = mysqli_query($connection, $post_count);
      $count = mysqli_num_rows($find_count);

      $count = ceil($count / 10);
      $query = "SELECT * FROM work_orders WHERE status = 'Completed' ORDER BY date_start DESC LIMIT $page_1, 10 " ;



      $display_all = mysqli_query($connection, $query);


      while ($row = mysqli_fetch_assoc($display_all)) {
          $id             = $row['ID'];
          $creator        = $row['creator'];
          $wonum          = $row['Work_Order'];
          $jobloc         = $row['job_location'];
          $street         = $row['street'];
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
                 wosearchstatus($status, $dateend);
                 echo "
              </td>
              <td class='project-title'>
                  <a href='view_wo.php?view_wo={$id}'>Contract with: {$jobloc} {$street}<br>
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
                  <a href='edit_wo.php?edit_wo={$id}' class='btn btn-white btn-sm'><i class='fa fa-pencil'></i> Edit </a>
              </td>
          </tr>";
  }

  return $count;
}

function WOSearchadmin($page_1)
  {

      global $connection;
      global $count;
      $post_count = "SELECT * FROM work_orders WHERE status ='Pending' " ;
      $find_count = mysqli_query($connection, $post_count);
      $count = mysqli_num_rows($find_count);

      $count = ceil($count / 10);
      $query = "SELECT * FROM work_orders WHERE status = 'Pending' ORDER BY date_start ASC LIMIT $page_1, 10" ;

      $display_all = mysqli_query($connection, $query);


      while ($row = mysqli_fetch_assoc($display_all)) {
          $id             = $row['ID'];
          $creator        = $row['creator'];
          $wonum          = $row['Work_Order'];
          $jobloc         = $row['job_location'];
          $street         = $row['street'];
          $city           = $row['city'];
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
                 wosearchstatus($status, $dateend);
                 echo "
              </td>
              <td class='project-title'>
                  <a href='view_wo.php?view_wo={$id}'>Contract with: {$jobloc} {$city}</a>
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
              </td>
          </tr>";
  }

  return $count;
}



function deletewo() {

global $connection;

if (isset($_GET['delete_wo'])) {

$wo_id = escape($_GET['delete_wo']);
$wo_num = escape($_GET['wo_order']);


}
$event = "DELETE FROM events WHERE work_order = '$wo_num' ";
$query = "DELETE  FROM work_orders WHERE ID = '$wo_id' ";
$messages = "DELETE  FROM job_messages WHERE Work_Order = '$wo_num' ";
$wo_messages = "DELETE  FROM work_order_images WHERE wo_number = '$wo_num' ";
$files = "DELETE  FROM wo_files WHERE wo_number = '$wo_num' ";

$wo_message = mysqli_query($connection, $wo_messages);
$wo_files = mysqli_query($connection, $files);
$event_query = mysqli_query($connection, $event);
$select_item = mysqli_query($connection, $query);
echo "<p class='bg-sucess'> Work order Deleted.";

header("Location: wo_search.php");

}


  function addnote($wonum, $tech) {
   global $connection;

   $note = escape($_POST['add-note']);

   $query = "INSERT INTO wo_notes (wo_num, message, tech) ";
   $query .= "VALUES('{$wonum}','{$note}','{$tech}') ";

   $addnote = mysqli_query($connection, $query);

   confirmQuery($addnote);

  }

function resizeImage($SrcImage,$DestImage, $MaxWidth,$MaxHeight,$Quality)
{
    list($iWidth,$iHeight,$type)    = getimagesize($SrcImage);
    $ImageScale             = min($MaxWidth/$iWidth, $MaxHeight/$iHeight);
    $NewWidth               = ceil($ImageScale*$iWidth);
    $NewHeight              = ceil($ImageScale*$iHeight);
    $NewCanves              = imagecreatetruecolor($NewWidth, $NewHeight);

    switch(strtolower(image_type_to_mime_type($type)))
    {
        case 'image/jpeg':
            $NewImage = imagecreatefromjpeg($SrcImage);
            break;
        case 'image/png':
            $NewImage = imagecreatefrompng($SrcImage);
            break;
        case 'image/gif':
            $NewImage = imagecreatefromgif($SrcImage);
            break;
        default:
            return false;
    }

    // Resize Image
    if(imagecopyresampled($NewCanves, $NewImage,0, 0, 0, 0, $NewWidth, $NewHeight, $iWidth, $iHeight))
    {
        // copy file
        if(imagejpeg($NewCanves,$DestImage,$Quality))
        {
            imagedestroy($NewCanves);
            return true;
        }
    }
}

function handleimages($jobloc, $wonum, $tech) {
  global $connection;

$path = "Images/wo_images/$wonum.$jobloc/";

if (is_dir($path))
  {
  $valid_formats = array(
    "jpg",
    "jpeg",
    "JPEG",
    "JPG",
    "png"
  );
  foreach($_FILES['files']['name'] as $f => $name)
    {
    $fileext = explode('.', $name);
    $actualExt = strtolower(end($fileext));
    if (in_array($actualExt, $valid_formats))
      {
      move_uploaded_file($_FILES['files']['tmp_name'][$f], $path . $name);
      $query = "INSERT INTO work_order_images (wo_number, Location, Uploader) ";
      $query .= "VALUES ('{$wonum}','{$name}','{$tech}') ";

      $result = mysqli_query($connection, $query);

      confirmQuery($result);
      }
      else
      {
      echo "Wrong File Extension";
      }
    }
  }
  else
  {
  mkdir($path);
  if (is_dir($path))
    {
    $valid_formats = array(
      "jpg",
      "jpeg",
      "JPEG",
      "JPG",
      "png"
    );
    foreach($_FILES['files']['name'] as $f => $name)
      {
      $fileext = explode('.', $name);
      $actualExt = strtolower(end($fileext));
      if (in_array($actualExt, $valid_formats))
        {

        move_uploaded_file($_FILES['files']['tmp_name'][$f], $path . $name);

        $query = "INSERT INTO work_order_images (wo_number, Location, Uploader) ";
        $query .= "VALUES ('{$wonum}','{$name}','{$tech}') ";

        $result = mysqli_query($connection, $query);

        confirmQuery($result);

        } else
        {
        echo "Wrong File Extension";
        }
      }
    }
  }
}


function completewo($wonum, $id) {
global $connection;
global $conn;

               $techsig        = escape($_POST['Tech']);
               $clientsig      = escape($_POST['Client']);
               $satisfaction   = escape($_POST['optradio']);
               $summary        = escape($_POST['summary']);
               $asummary       = escape($_POST['accom_summary']);
               $rating         = escape($_POST['accom_rating']);
               $complete = "Completed";


                $query = "UPDATE work_orders SET ";
                $query .="tech_sig  = '{$techsig}', ";
                $query .="Client_sig = '{$clientsig}', ";
                $query .="sat_rating = '{$satisfaction}', ";
                $query .="Summary = '{$summary}', ";
                $query .="status = '{$complete}' ";
                $query .= "WHERE ID = {$id} ";


                $accom = "SELECT * FROM acommodation WHERE work_order = '$wonum' ";
                $result = mysqli_query($connection, $accom);
               if(mysqli_num_rows($result) == 1 ) {

                $stmt = "UPDATE acommodation SET rating = '$rating', summary = '$asummary' WHERE work_order = '$wonum' ";
                $update_accom = mysqli_query($connection,$stmt);
               } else {}

              $update_workorder = mysqli_query($connection,$query);

                header("Location: wo_search.php");
             }



function wostatus($status) {

    switch ($status) {
      case 'Inactive':
      ?>
        <dl class="dl-horizontal">
      <dt>Status:</dt> <dd style="top:10px; position:relative;"><span class="label label-default"><?php echo $status; ?></span></dd>
     </dl>


      <?php

        break;
      case 'Pending':

          ?>
          <dl class="dl-horizontal">
      <dt>Status:</dt> <dd style="top:10px; position:relative;"><span class="label label-warning"><?php echo $status; ?></span></dd>
     </dl> <?php

          break;


      case 'Completed':?>

          <dl class="dl-horizontal">
      <dt>Status:</dt> <dd style="top:10px; position:relative;"><span class="label label-success"><?php echo $status; ?></span></dd>
     </dl><?php
          break;

      case 'Cancelled':?>

      <dl class="dl-horizontal">
      <dt>Status:</dt> <dd style="top:10px; position:relative;"><span class="label label-danger"><?php echo $status; ?></span></dd>
     </dl><?php
          break;

    }

}

function wosearchstatus($status, $dateend) {

  $today = date("Y-m-d");
if($today > $dateend && $status === 'Pending') {

echo "<td class='project-status'>
       <span class='label label-danger'>Out Standing</span>
      </td>";

} else {
    switch ($status) {
      case 'Inactive':
      ?>

      <td class="project-status">
            <span class="label label-Default">Inactive</span>
          </td>

      <?php

      break;

      case 'Pending':

          ?>

          <td class="project-status">
            <span class="label label-warning">Pending</span>
          </td>

           <?php

          break;


      case 'Completed':

      ?>

        <td class="project-status">
         <span class="label label-success">Completed</span>
        </td>

          <?php
          break;

      case 'Cancelled':?>

      <td class="project-status">
       <span class="label label-danger">Cancelled</span>
      </td>

      <?php
          break;

    }
  }

}

function jobtype($jobtype) {
  global $conn;
  $stmt = $conn->prepare(" SELECT `instructions` FROM  `Specification` WHERE `job_type` = ? ");
  $stmt->bind_param("s", $jobtype);
  $stmt->execute();
  $stmt->bind_result($job);
  $stmt->fetch();


  echo $job;


 }


?>
