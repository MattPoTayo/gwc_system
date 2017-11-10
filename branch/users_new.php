<?php
	ob_start();
	require_once("verify_access.php");
	require_once("../resource/database/hive.php");
	$page_name = "New User";
	$page_type = 2;
?>
<html>
	<link href="../resource/graphics/css/sb-admin-2.css" rel="stylesheet">
	<?php require_once("../resource/sections/branch_header.php"); ?>
	<body>
		<?php require_once("../resource/sections/branch_banner.php"); ?>
		<?php require_once("../resource/sections/branch_menu.php"); ?>
		<div class="form_class">
			<div class="form_title"><div class="panel-heading"><svg class="glyph stroked dashboard-dial">svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>NEW USER</div></div>
				<div>
					<?php
						if($_POST)
						{
							require_once("../resource/database/hive.php");

							$name = $mysqli->real_escape_string($_POST['name']);
							$birthdate = $mysqli->real_escape_string($_POST['birthdate']);
							$phone = $mysqli->real_escape_string($_POST['phone']);
							$address = $mysqli->real_escape_string($_POST['address']);
							$username = $mysqli->real_escape_string($_POST['username']);
							$password1 = $mysqli->real_escape_string(md5 ($_POST['password1']));
							$password2 = $mysqli->real_escape_string(md5 ($_POST['password2']));
							$team = $mysqli->real_escape_string($_POST['team']);

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
							else if($password1 != $password2)
							{
								echo "<p class='ffail'>Passwords do not match!</p>";	
							}
							else
							{
								$sqlquery = "INSERT INTO `entity`(`Name`, `Address`, `Phone`, `Birthdate`, `Username`, `Password`, `Level`, `Type`, `Mark`, `TeamID`) 
											      VALUES ('$name', '$address', '$phone', '$birthdate', '$username', '$password1', '1', '1', '1', '$team')";
								#echo $sqlquery;
								$new = mysqli_query($mysqli, $sqlquery);

								if($new)
								{ 
									$newUID = $mysqli->insert_id;
									#echo $newUID;
									if(!empty($_POST['check_list'])) 
									{
										$sqlquery = "DELETE FROM `user_permission` WHERE `Wid` = '$newUID' AND `ID` > 0";
										$new2 = mysqli_query($mysqli, $sqlquery);
    									foreach($_POST['check_list'] as $check) 
    									{
    										#echo "Hello";
    										$sqlquery = "INSERT INTO `user_permission`( `Wid`, `Code`) VALUES ('$newUID', '$check')";
    										#echo $sqlquery;
    										$new3 = mysqli_query($mysqli, $sqlquery);
    									}

    									$sqlCheckManager = "SELECT * FROM `user_permission` WHERE `Wid` = '$newUID' AND `Code` = '110' LIMIT 1";
    									$new3 = mysqli_query($mysqli, $sqlCheckManager);
    									if($new3 && $new3->num_rows > 0)
    									{
    										$createTeam = "INSERT INTO `teams` (`Name`, `ManagerID`, `Active`) VALUES ('$name', '$newUID', '1')";
    										echo $createTeam;
    										$new5 = mysqli_query($mysqli, $createTeam);
    										$teamID = $mysqli->insert_id;
    										$updateAsManager = "UPDATE `entity` SET `IsManager` = 1, `TeamID` = '$teamID' WHERE `ID` = '$newUID'";
    										echo $updateAsManager;
    										$new4 = mysqli_query($mysqli, $updateAsManager);
    									}

    								}
									$_SESSION['success'] = '<div class="alert bg-success" role="alert"><svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> Success adding new user. Click <a href="users_new.php">here</a> to add another one.<a href="users.php" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
								}
								else $_SESSION['fail'] = '<div class="alert bg-danger" role="alert"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Oops, something went wrong. If error persists, please contact support.<a href="users.php" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
								
								#ob_end_clean();
								header("location:users.php");
							}
						}
						else
						{
							date_default_timezone_set ('Asia/Taipei');
							$date_today = date("Y-m-d H:i:s");
							$name = "";
							$birthdate = date("Y-m-d");
							$phone = "";
							$address = "";
							$username = "";
							$password1 = "";
							$password2 = "";
						}
					
					?>
				</div>
				<div class="form_content">
							<form class="form-horizontal" method=post action="<?php echo $_SERVER['PHP_SELF'];?>">
								<div class="form-group">
									<div class="col-sm-8">
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
														
															if($row[0] == 0) echo "<option value='".$row[0]."' SELECTED>".ucwords(strtolower($row[1]))."</option>";
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
												<input type="checkbox" checked="checked" name="check_list[]" value="101" >Users
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="102">Supplier
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="103">Clients
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="104">Payment
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="114">Contacts
											</label>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="105">Inventory
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="106">Transaction
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="108">Reports
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="109">Category
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="check_list[]" value="117">Brand
											</label>
										</div>
									</div>
										<div class="col-sm-4">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="check_list[]" value="110">Manager
												</label>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="check_list[]" value="115"><b>General Manager</b>
												</label>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="check_list[]" value="116"><b>Purchasing/Acct</b>
												</label>
											</div>
										</div>
									</div>
								<div class="form-group">
									<div class="col-sm-offset-0 col-sm-6">
										<button type="submit" class="form_button">Save</button>
									</div>
									<div class="col-sm-offset-0 col-sm-6">
									<a class="btn form_button" href="index.php" role="button">Back</a>
								</div>
								</div>				
							</form>
						</div>
			</div>
		</div>
	</div>
	</body>
</html>