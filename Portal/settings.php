<?php
include "Includes/header.php";
include "Includes/sidenav.php";
include "Includes/topnav.php";
$log = "Accessed Settings Page";
$user = $_SESSION['u_name'];
$wonum = "Settings";
$test = new log();
$test->logaction($log, $wonum, $user);
//after the form submit

if($_POST['update']){
  $filepath = "Includes/company_config.ini";
  $data = $_POST;
  //update ini file, call function
  update_ini_file($data, $filepath);
}
//this is the function going to update your ini file
  function update_ini_file($data, $filepath) {
    $content = "";
    //parse the ini file to get the sections
    //parse the ini file using default parse_ini_file() PHP function

    foreach($data as $section=>$values){
      //append the section
      $content .= "[".$section."]\n";
      //append the values
      foreach($values as $key=>$value){
        $content .= $key."=".$value."\n";
      }
    }
    //write it into file
    if (!$handle = fopen($filepath, 'w')) {
      return false;
    }
    $success = fwrite($handle, $content);
    fclose($handle);

    header("Location: settings.php");
  }
  if (isset($_POST['New_Spec'])) {
    header("Location: specifications.php");
  }
 ?>
    <div class="wrapper" style="">
<div class="col-lg-12">
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Company Settings</a></li>
  <li><a data-toggle="tab" href="#menu4">Job Details</a></li>
</ul>
<dv class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <div class="col-lg-12">
            <h1></h1>
            <div class="ibox">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="m-b-md">
                                <h2>Company Information</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                          <dl class="dl-horizontal">
                                <form action="" method="post">
                                <?php
                                foreach($settings as $section=>$values){
                                  //keep the section as hidden text so we can update once the form submitted
                                  echo "<input type='hidden' value='$section' name='$section'/>";
                                  //print all other values as input fields, so can edit.
                                  //note the name='' attribute it has both section and key
                                  foreach($values as $key=>$value){
                                    echo "<dt>".$key.":</dt>"."<dd><input type='text' style='border:0;' name='{$section}[$key]' value='$value'/>"."</dd>";
                                  }
                                  echo "<br>";
                                }
                                ?>
                                <input type="submit" name="update" value="Update" />
                              </form>
                            </dl>
                        </div>
                     </div>
                  </div>
                </div>
             </div>
           </div>
  <div id="menu4" class="tab-pane fade">
    <input class="btn btn-primary" type="submit"  onclick="window.location.href='specifications.php'" name="New-Spec" value="New Spec" style="float:right;">
    <br>
    <br>
    <table class="table table-hover">
      <th>Job Type</th>
      <th>Job Specification</th>

      <tbody>
    <?php
     $stmt = $conn->prepare("SELECT ID,job_type, instructions FROM Specification");
     $stmt->execute();
     $stmt->bind_result($id, $job_type, $instructions);
     $inst = mb_substr($instructions, 0,250);


     while ($stmt->fetch()) {
       $inst = mb_substr($instructions, 0,500);
      echo "
      <tr>
            <td class='project-status'>
              {$job_type}
            </td>
            <td><h3>{$inst}</h3></td>
            <td></td>
            <td></td>
            <td class='project-actions'><a href='specifications.php?edit_spec={$id}' class='btn btn-white btn-sm'><i class='fa fa-pencil'></i>Edit</a></td>
        </tr>
      ";
     }
     $stmt->close();
     ?>
  </tbody>
</table>
  </div>
 </div>
<?php include "Includes/footer.php" ?>
