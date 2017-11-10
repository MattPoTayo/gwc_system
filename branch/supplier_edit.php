<?php
	ob_start();
	require_once("verify_access.php");
	require_once("../resource/database/hive.php");
	$page_name = "Edit Supplier";
	$page_type = 9;
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
					<div class="form_title"><div class="panel-heading"><svg class="glyph stroked dashboard-dial">svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>EDIT SUPPLIER</div></div>
					<div>
						<div>
							<?php
								require_once("../resource/database/hive.php");
								$profile = mysqli_query($mysqli, "SELECT * FROM `supplier` WHERE `ID` = '$id'");
								$myprofile = $profile->fetch_assoc();
									
								#echo $id;
								$name = $myprofile['Name'];
								$datemodified = date("Y-m-d", strtotime($myprofile['Birthdate']));
								$phone = $myprofile['Phone'];
								$address = $myprofile['Address'];
								$email = $myprofile['Username'];
								$tin = $myprofile['Tin'];
								$vatmode = $myprofile['VatMode'];
								
								if($_POST)
								{	
									if(isset($_POST['id']))
									{
										$id = $mysqli->real_escape_string($_POST['id']);
										$name = $mysqli->real_escape_string($_POST['name']);
										$datemodified = $mysqli->real_escape_string($_POST['datemodified']);
										$phone = $mysqli->real_escape_string($_POST['phone']);
										$address = $mysqli->real_escape_string($_POST['address']);
										$email = $mysqli->real_escape_string($_POST['email']);
										$tin = $mysqli->real_escape_string($_POST['tin']);
										$vatmode = $_POST['vatmode'];
										
										
										date_default_timezone_set ('Asia/Taipei');
										$date_today = date("Y-m-d H:i:s");
										
										if(strlen($name) > 120)
										{
											echo "<p class='ffail'>Name can only be 45 characters long!</p>";	
											
										}
										else if($name == "" or $phone == "" or $address == "" or $email == "")
										{
											echo "<p class='ffail'>Missing required field!</p>";	
										}
										else if(strlen($address) > 225)
										{
											echo "<p class='ffail'>Address can only be 225 characters long!</p>";		
										}
										else
										{
											$sqlstring = "UPDATE `supplier` SET `Name` = '$name', `Birthdate` = '$datemodified', `Phone` = '$phone', `Address` = '$address', `Username` = '$email', `Tin` = '$tin', `VatMode` = '$vatmode' WHERE `ID` = '$id'";
											$new = mysqli_query($mysqli, $sqlstring);
											#echo $sqlstring;
											if($new)
												$_SESSION['success'] = '<div class="alert bg-success" role="alert"><svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> Succesfully updated supplier details<a href="suppliers.php" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';
											else 
												$_SESSION['fail'] = '<div class="alert bg-danger" role="alert"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Error in saving supplier details. Call Administrator for support<a href="suppliers.php" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>';

											ob_end_clean();
											header("location:suppliers.php");
										}
									}
									else
											echo "Error In Saving Supplier";
								}
							?>
						</div>
						<div class="form_content">
							<form class="form-horizontal" method=post action="<?php echo $_SERVER['PHP_SELF'];?>">
								<div class="form-group">
									<div class="col-sm-2">
										<label for="id">Supplier ID</label>
										<input name="id" type="text" class="form-control" placeholder="ID" value=<?php echo "'".$id."'"; ?> readonly>
									</div>
									<div class="col-sm-6">
										<label for="name">Supplier Name*</label>
										<input name="name" type="text" class="form-control" placeholder="Name" value=<?php echo "'".$name."'"; ?> required>
									</div>
									<div class="col-sm-4">
										<label for="datemodified">Modification Date</label>
										<input name="datemodified" type="date" class="form-control" value=<?php echo "'".$datemodified."'"; ?> readonly>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-12">
										<label for="address">Address*</label>
										<input name="address" type="text" class="form-control" placeholder="Address" value=<?php echo "'".$address."'"; ?> required>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-4">
										<label for="phone">Phone*</label>
										<input name="phone" type="text" class="form-control" placeholder="Phone" value=<?php echo "'".$phone."'"; ?> required>
									</div>
									<div class="col-sm-4">
											<label for="tin">TIN #:</label>
											<input name="tin" type="text" class="form-control" placeholder="TIN" value=<?php echo "'".$tin."'"; ?>>
										</div>
										<div class="col-sm-4">
										<label>VAT Mode</label>
											<select class="form-control" name="vatmode">
												<option value="1" <?php if($vatmode == 1) echo "selected" ?>>VAT</option>
												<option value="2" <?php if($vatmode == 2) echo "selected" ?>>VAT Exempt</option>
												<option value="3" <?php if($vatmode == 3) echo "selected" ?>>Zero-Rated</option>
											</select>
									</div>
									
								</div>
								<div class="form-group">
									<div class="col-sm-4">
										<label for="email">E-mail*</label>
										<input name="email" type="text" class="form-control" placeholder="E-mail" value=<?php echo "'".$email."'"; ?> required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-0 col-sm-6">
										<button type="submit" class="form_button">Update</button>
									</div>
									<div class="col-sm-offset-0 col-sm-6">
									<a class="btn form_button" href="suppliers.php" role="button">Back</a>
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