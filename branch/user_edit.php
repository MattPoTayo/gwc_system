<?php
	ob_start();
	require_once("verify_access.php");
	require_once("../resource/database/hive.php");
	$page_name = "Edit User";
	$page_type = 2;
	$id = $_GET['type'];
?>
<html>
	<link href="../resource/graphics/css/sb-admin-2.css" rel="stylesheet">
	<?php require_once("../resource/sections/branch_header.php"); ?>
	<body>
		<?php require_once("../resource/sections/branch_banner.php"); ?>
		<?php require_once("../resource/sections/branch_menu.php"); ?>
			<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
			<?php require_once("../resource/sections/branch_shortcuts.php"); ?>
				<div class="form_class_full">
					<div class="form_title"><div class="panel-heading"><svg class="glyph stroked dashboard-dial">svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>USER SETTING</div></div>
					<div>
						<div>
							<?php
								require_once("../resource/database/hive.php");
								$profile = mysqli_query($mysqli, "SELECT * FROM `entity` WHERE `ID` = '$id'");
								$myprofile = $profile->fetch_assoc();

								$checkUser = mysqli_query($mysqli,"SELECT `Code` FROM `user_permission` WHERE `Wid` = '$id' AND `Code`= '101'");
								$checkClients = mysqli_query($mysqli,"SELECT `Code` FROM `user_permission` WHERE `Wid` = '$id' AND `Code`= '103'");
								$checkSupplier = mysqli_query($mysqli,"SELECT `Code` FROM `user_permission` WHERE `Wid` = '$id' AND `Code`= '102'");
								$checkInventory = mysqli_query($mysqli,"SELECT `Code` FROM `user_permission` WHERE `Wid` = '$id' AND `Code`= '105'");
								$checkTransaction = mysqli_query($mysqli,"SELECT `Code` FROM `user_permission` WHERE `Wid` = '$id' AND `Code`= '106'");
								$checkPayment = mysqli_query($mysqli,"SELECT `Code` FROM `user_permission` WHERE `Wid` = '$id' AND `Code`= '104'");
								$checkReports = mysqli_query($mysqli,"SELECT `Code` FROM `user_permission` WHERE `Wid` = '$id' AND `Code`= '108'");
								$checkCategory = mysqli_query($mysqli, "SELECT `Code` FROM `user_permission` WHERE `Wid` = '$id' AND `Code`= '109'");
								$checkManager = mysqli_query($mysqli, "SELECT `Code` FROM `user_permission` WHERE `Wid` = '$id' AND `Code` = '110'");
								$checkContact = mysqli_query($mysqli, "SELECT `Code` FROM `user_permission` WHERE `Wid` = '$id' AND `Code` = '114'");
								$checkGM = mysqli_query($mysqli, "SELECT `Code` FROM `user_permission` WHERE `Wid` = '$id' AND `Code` = '115'");
								$checkPurchAcc = mysqli_query($mysqli, "SELECT `Code` FROM `user_permission` WHERE `Wid` = '$id' AND `Code` = '116'");
								$checlBrand = mysqli_query($mysqli, "SELECT `Code` FROM `user_permission` WHERE `Wid` = '$id' AND `Code` = '117'");
									
								#echo $id;
								$name = $myprofile['Name'];
								$birthdate = date("Y-m-d", strtotime($myprofile['Birthdate']));
								$phone = $myprofile['Phone'];
								$address = $myprofile['Address'];
								$username = $myprofile['Username'];
								$password1 = $myprofile['Password'];
								$password2 = $myprofile['Password'];
								$team = $myprofile['TeamID'];
								
								if($_POST)
								{	
									if(isset($_POST['id']))
									{
										$id = $mysqli->real_escape_string($_POST['id']);
										$name = $mysqli->real_escape_string($_POST['name']);
										$birthdate = $mysqli->real_escape_string($_POST['birthdate']);
										$phone = $mysqli->real_escape_string($_POST['phone']);
										$address = $mysqli->real_escape_string($_POST['address']);
										$username = $mysqli->real_escape_string($_POST['username']);
										$passwordreal = $mysqli->real_escape_string($_POST['password1']);
										$password1 = $mysqli->real_escape_string(md5 ($_POST['password1']));
										$password2 = $mysqli->real_escape_string(md5 ($_POST['password2']));
										$team = $mysqli->real_escape_string($_POST['team']);


										$checkpassword = "SELECT * FROM `entity` WHERE `Password` = '$passwordreal' AND `ID` = '$id' LIMIT 1";
										$checkpw = mysqli_query($mysqli,$checkpassword);
										if($checkpw->num_rows > 0)
										{
											$password1 = $passwordreal;
											$password2 = $passwordreal; 
										}
										
										date_default_timezone_set ('Asia/Taipei');
										$date_today = date("Y-m-d H:i:s");
										
										if(strlen($name) > 120)
										{
											echo "<p class='ffail'>Name can only be 45 characters long!</p>";	
										}	
										else if(strlen($address) > 225)
										{
											echo "<p class='ffail'>Address can only be 225 characters long!</p>";	
										}
										else if($name == "" or $birthdate == "" or $phone == "" or $address == "" or $username == "" or $password1 == "" or $password2 == "")
										{
											echo "<p class='ffail'>Missing required field!</p>";	
										}
										else if(strlen($passwordreal) < 8)
										{
											echo "<p class='ffail'>Password must be at least 8 characters long.</p>";	
										}			
										else if($password1 != $password2)
										{
											echo "<p class='ffail'>Passwords do not match!</p>";	
										}
										else
										{
											$sqlstring = "UPDATE `entity` SET `Name` = '$name', `Birthdate` = '$birthdate', `Phone` = '$phone', `Address` = '$address', `Username` = '$username', `Password` = '$password1', `TeamID` = '$team' WHERE `ID` = '$id'";
											$new = mysqli_query($mysqli, $sqlstring);
											#echo $sqlstring;
											if($new)
											{ 
												if(empty($_POST['check_list']))
												{
													$sqlquery = "DELETE FROM `user_permission` WHERE `Wid` = '$id' AND `ID` > 0";
													$new1 = mysqli_query($mysqli, $sqlquery);
												} 
												else
												{
													$sqlquery = "DELETE FROM `user_permission` WHERE `Wid` = '$id' AND `ID` > 0";
													$new1 = mysqli_query($mysqli, $sqlquery);
													foreach($_POST['check_list'] as $check) 
													{
														#echo "Hello";
														$sqlquery = "INSERT INTO `user_permission`( `Wid`, `Code`) VALUES ('$id', '$check')";
														#echo $sqlquery;
														$new3 = mysqli_query($mysqli, $sqlquery);

														$sqlCheckManager = "SELECT * FROM `user_permission` WHERE `Wid` = '$id' AND `Code` = '110' LIMIT 1";
														$sqlTeam = "SELECT * FROM `teams` WHERE `ManagerID` = '$id' AND `Active` = 1 LIMIT 1";
														$new3 = mysqli_query($mysqli, $sqlCheckManager);
														$oldActiveTeam = mysqli_query($mysqli, $sqlTeam);
    													if($new3 && $new3->num_rows > 0 && $oldActiveTeam->num_rows == 0)
    													{
    														$createTeam = "INSERT INTO `teams` (`Name`, `ManagerID`,`Active`) VALUES ('$name', '$id', '1')";
				    										$new5 = mysqli_query($mysqli, $createTeam);
				    										$teamID = $mysqli->insert_id;
				    										$updateAsManager = "UPDATE `entity` SET `IsManager` = 1, `TeamID` = '$teamID' WHERE `ID` = '$id'";
				    										$new4 = mysqli_query($mysqli, $updateAsManager);
    													}
    													else if ($oldActiveTeam->num_rows > 0 && new3 && $new3->num_rows == 0)
    													{
    														
				    										$checkTeam = "SELECT * FROM `team` AS T
				    														LEFT JOIN `entity` AS E ON E.`TeamID` = T.`ID`
				    														WHERE T.`Active` = 1 AND E.`ID` = $id";
				    										$deactivateTeam = "UPDATE `teams` SET `Active` = 0 WHERE `ManagerID` = '$id' AND `ID` > 0";
				    										$new5 = mysqli_query($mysqli, $deactivateTeam);
				    										$new6 = mysqli_query($mysqli, $checkTeam);
				    										if($new6->num_rows > 0 and $new6)
				    										{
				    										$updateAsManager = "UPDATE `entity` SET `IsManager` = 0, `TeamID` = '1' WHERE `ID` = '$id'";
				    										$new4 = mysqli_query($mysqli, $updateAsManager);
				    										}
    													}
    													else
    													{
    														$checkTeam = "SELECT * FROM `team` AS T
				    														LEFT JOIN `entity` AS E ON E.`TeamID` = T.`ID`
				    														WHERE T.`Active` = 1 AND E.`ID` = $id";
				    										$new6 = mysqli_query($mysqli, $checkTeam);
				    										if($new6->num_rows > 0 and $new6)
				    										{
				    										$updateAsManager = "UPDATE `entity` SET `IsManager` = 0, `TeamID` = '1' WHERE `ID` = '$id'";
				    										$new4 = mysqli_query($mysqli, $updateAsManager);
				    										}
    													}
													}
												}
												$_SESSION['success'] = '<div class="alert bg-success" role="alert"><svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> Success saving user details<a href="users.php" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
											}
											else $_SESSION['fail'] = '<div class="alert bg-danger" role="alert"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Error in saving user details. Call Administrator for support.<a href="clients.php" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';

											ob_end_clean();
											header("location:users.php");
										}
									}
									else
											echo "Error Class#001: Kindly, capture screenshot and contact dev";
								}
							?>
						</div>
						<div class="form_content">
							<form class="form-horizontal" method=post action="<?php echo $_SERVER['PHP_SELF'];?>">
								<div class="form-group">
									<div class="col-sm-2">
										<label for="id">User ID</label>
										<input name="id" type="text" class="form-control" placeholder="ID" value=<?php echo "'".$id."'"; ?> readonly>
									</div>
									<div class="col-sm-6">
										<label for="name">Name*</label>
										<input name="name" type="text" class="form-control" placeholder="Name" value=<?php echo "'".$name."'"; ?> required>
									</div>
									<div class="col-sm-4">
										<label for="birthdate">Birth Date*</label>
										<input name="birthdate" type="date" class="form-control" value=<?php echo "'".$birthdate."'"; ?> required>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-4">
										<label for="phone">Phone*</label>
										<input name="phone" type="text" class="form-control" placeholder="Phone" value=<?php echo "'".$phone."'"; ?> required>
									</div>
									<div class="col-sm-8">
										<label for="address">Address*</label>
										<input name="address" type="text" class="form-control" placeholder="Address" value=<?php echo "'".$address."'"; ?> required>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-4">
										<label for="username">E-mail*</label>
										<input name="username" type="text" class="form-control" placeholder="E-mail" value=<?php echo "'".$username."'"; ?> required>
									</div>
									<div class="col-sm-4">
										<label for="password1">Password*</label>
										<input name="password1" type="password" class="form-control" placeholder="Password" value=<?php echo "'".$password1."'";?> required>
									</div>
									<div class="col-sm-4">
										<label for="mn">Retype Password*</label>
										<input name="password2" type="password" class="form-control" placeholder="Retype Password" value=<?php echo "'".$password2."'";?> required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-6">
											<label for="team" class="control-label">Team</label>
											<select name="team" class="selectpicker form-control" data-live-search="true">
												<?php
														$teamlist = mysqli_query($mysqli, "SELECT `ID`, `Name` FROM `teams` WHERE `Active` = 1");
														for($i=0; $i<mysqli_num_rows($teamlist) and mysqli_num_rows($teamlist)>0; $i++)
														{
															$teamlist->data_seek($i);
															$row = $teamlist->fetch_row();
														
															if($row[0] == $team) echo "<option value='".$row[0]."' SELECTED>".ucwords(strtolower($row[1]))."</option>";
															else echo "<option value='".$row[0]."'>".ucwords(strtolower($row[1]))."</option>";
														}
													?>
											</select>
										</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
									<label> Permissions </label>
									</div>
									<div class="col-sm-4">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="101" <?php if($checkUser->num_rows > 0) echo 'checked';?>>Users
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="102" <?php if($checkSupplier->num_rows > 0) echo 'checked';?>>Supplier
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="103" <?php if($checkClients->num_rows > 0) echo 'checked';?>>Clients
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="104" <?php if($checkPayment->num_rows > 0) echo 'checked';?>>Payment
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="114" <?php if($checkContact->num_rows > 0) echo 'checked';?>>Contact
											</label>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="105" <?php if($checkInventory->num_rows > 0) echo 'checked';?>>Inventory
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="106" <?php if($checkTransaction->num_rows > 0) echo 'checked';?>>Transaction
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="108" <?php if($checkReports->num_rows > 0) echo 'checked';?>>Reports
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="109" <?php if($checkCategory->num_rows > 0) echo 'checked';?>>Category
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="117" <?php if($checlBrand->num_rows > 0) echo 'checked';?>>Brand
											</label>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="110" <?php if($checkManager->num_rows > 0) echo 'checked';?>>Manager
											</label>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="115" <?php if($checkGM->num_rows > 0) echo 'checked';?>> <b>General Manager</b>
											</label>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="116" <?php if($checkPurchAcc->num_rows > 0) echo 'checked';?>> <b>Purchasing/Accounting</b>
											</label>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-offset-0 col-sm-6">
										<button type="submit" class="form_button">Update</button>
									</div>
									<div class="col-sm-offset-0 col-sm-6">
									<a class="btn form_button" href="users.php" role="button">Back</a>
								</div>
								</div>				
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>