<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<?php
include_once "Portal/Includes/db.php";
include_once "Portal/Includes/functions.php";
if (isset($_GET['id'])) {

  $Survey = escape($_GET['id']);
  $stmt = $conn->prepare("SELECT ID, SECURE, EMAIL, STARTD, ENDD, WONUM, NOS, STOREID FROM pre_survey WHERE SECURE = '$Survey' ");
  $stmt->execute();
  $stmt->bind_result($ID, $SECURE, $EMAIL, $STARTD, $ENDD, $WONUM, $NOS, $STOREID);
  $stmt->fetch();
  $stmt->close();

} ?>
<body style="background-color:f5f5f5">
<div class="container">
       <table class="table table-striped">
          <tbody>
             <tr>
                <td colspan="1" style="background-color:f5f5f5">
                   <form class="well form-horizontal">
										 <div clas="wrapper">
											 <div>
										 			<img class="img-responsive" style="margin:auto;width:30%" src="../logo.png">
										 	</div>
												 <div class="col-lg-12">
														 <dl class="dl-horizontal">
																 <dt>Store Number:</dt> <dd><?php echo $STOREID ?><dd>
																 <dt>Date of Works:</dt> <dd><?php echo $STARTD; ?></dd>
																 <dt>Nights on Site:</dt> <dd><?php echo $NOS;?></dd>
														 </dl>
													 </div>
													 <div style="padding-left:3%;padding-right:3%;">
												 <div class="form-group">
														<label for="exampleSelect1">Parking Available?</label>
														<select class="form-control">
															<option></option>
															<option value="Yes">Yes</option>
															<option value="No">No</option>
														</select>
														<label for="exampleTextarea">If no please provide address details on where we can park</label>
														<textarea class="form-control" rows="3" placeholder="Carpark 3"></textarea>
													</div>
													<div class="form-group">
 														<label for="exampleSelect1">Security</label>
														<br>
														<small>Has security been arranged for dates above</small>
 														<select class="form-control">
 															<option></option>
 															<option value="Yes">Yes</option>
 															<option value="No">No</option>
 														</select>
													</div>
													<div class="form-group">
												    <label for="formGroupExampleInput">How many Floors in the Store?</label>
												    <input type="text" class="form-control" placeholder="3">
														<label for="exampleTextarea">Please indicate if there are lifts to facilitate movement of cleaning machinery</label>
														<textarea class="form-control" rows="3" placeholder=""></textarea>
												  </div>
													<div class="form-group">
												    <label for="formGroupExampleInput">Other ontractual Works</label>
														<select class="form-control">
 															<option></option>
 															<option value="Yes">Yes</option>
 															<option value="No">No</option>
 														</select>
														<label for="exampleTextarea">If Yes Please indicate if any other works are due to take place on the scheduled dates maintenance/restoraton</label>
														<textarea class="form-control" rows="3" placeholder=""></textarea>
												  </div>
                          <div class="form-group">
                            <label for="formGroupExampleInput">Air Conditioning</label>
                           <select class="form-control">
                               <option></option>
                               <option value="Yes">Yes</option>
                               <option value="No">No</option>
                             </select>
                             <small>It is vital to the works if the Air Conditioning is left on overnight please confirm if are you able to do this?</small>
                          </div>
                          <div class="form-group">
                            <label for="formGroupExampleInput">Lutron Panel</label>
                           <select class="form-control">
                               <option></option>
                               <option value="Yes">Yes</option>
                               <option value="No">No</option>
                             </select>
                            <small>It is important that the lights remain on during our works. If the lights are not overridden it can cause us problems. Please ensure we have access to the panel for emergency purposes.</small>
                          </div>
                          <div class="form-group">
                            <label for="formGroupExampleInput">Fuse Board</label>
                           <select class="form-control" >
                               <option></option>
                               <option value="Yes">Yes</option>
                               <option value="No">No</option>
                             </select>
                            <small>Machinery intermidently does trip switches, can access be available to the fuse board if required please.</small>
                          </div>
                          <div class="form-group">
												    <label for="formGroupExampleInput">Product Launch/Promotions</label>
														<select class="form-control">
 															<option></option>
 															<option value="Yes">Yes</option>
 															<option value="No">No</option>
 														</select>
														<label for="exampleTextarea">if there are any product launches or promotions please fill put details below</label>
														<textarea class="form-control" rows="3" placeholder=""></textarea>
												  </div>
                          <div class="form-group">
												    <label for="formGroupExampleInput">Are the tables plug & Play</label>
														<select class="form-control">
 															<option></option>
 															<option value="Yes">Yes</option>
 															<option value="No">No</option>
 														</select>
                            <label for="formGroupExampleInput">If no has an electrician been booked</label>
														<select class="form-control">
 															<option></option>
 															<option value="Yes">Yes</option>
 															<option value="No">No</option>
 														</select>
														<small>The tables must be professional disconnected if hard wired, prior to our works</small>
												  </div>
                          <div class=" center-block" style="margin-bottom:5px;">
                            <button class="btn btn-primary center-block btn-lg" data-toggle="modal" data-target="#myModal">Complete</button>
                            </div>
												</div>
                      </div>
		                   </form>
		                </td>
									</div>
<?php if (isset($_POST['com_survey'])) {



} ?>
