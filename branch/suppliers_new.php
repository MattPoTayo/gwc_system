<?php
	ob_start();
	require_once("verify_access.php");
	require_once("../resource/database/hive.php");
	$page_name = "New Supplier";
	$page_type = 9;
?>
<html>
	<link href="../resource/graphics/css/sb-admin-2.css" rel="stylesheet">
	<?php require_once("../resource/sections/branch_header.php"); ?>
	<body>
		<?php require_once("../resource/sections/branch_banner.php"); ?>
		<?php require_once("../resource/sections/branch_menu.php"); ?>
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="form_class_full">
			<div class="form_title"><div class="panel-heading"><svg class="glyph stroked laptop computer and mobile"><use xlink:href="#stroked-laptop-computer-and-mobile"/></use></svg>NEW SUPPLIER</div></div>
				<div>
					<?php
						if($_POST)
						{
							require_once("../resource/database/hive.php");
							$creator = $_SESSION['id'];

							$name = $mysqli->real_escape_string($_POST['name']);
							$phone = $mysqli->real_escape_string($_POST['phone']);
							$address = $mysqli->real_escape_string($_POST['address']);
							$username = $mysqli->real_escape_string($_POST['username']);
							$tin = $mysqli->real_escape_string($_POST['tin']);
							$vatmode = $_POST['vatmode'];
							$password1 = "supplieronly";
							$password2 = "supplieronly";
							$contactperson =  $mysqli->real_escape_string($_POST['contactperson']);
							#$ccode =  $mysqli->real_escape_string($_POST['ccode']);
							$cmobile =  $mysqli->real_escape_string($_POST['cmobile']);
							$clandline =  $mysqli->real_escape_string($_POST['clandline']);
							$cemail =  $mysqli->real_escape_string($_POST['cemail']);
							$designation = $mysqli->real_escape_string($_POST['designation']);

							$stringSQL = "SELECT 
											    (`ID` + 1) AS 'ID'
											FROM
											    `category`
											ORDER BY `ID` DESC
											LIMIT 1";

							$cat = mysqli_query($mysqli, $stringSQL);
							$cat->data_seek(0);
				    				$row = $cat->fetch_row();
				    		$ccode = "1000".$row[0];
							
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
							else if($name == "" or $date_today == "" or $phone == "" or $address == "" or $username == "" or $password1 == "" or $password2 == "")
							{
								echo "<p class='ffail'>Missing required field!</p>";	
							}
							else if($password1 != $password2)
							{
								echo "<p class='ffail'>Passwords do not match!</p>";	
							}
							else
							{
								$sqlquery = "INSERT INTO `supplier`(`Name`, `Address`, `Phone`, `Birthdate`, `Username`, `Password`, `Level`, `Type`, `Mark`, `Tin`, `VatMode`) 
											      VALUES ('$name', '$address', '$phone', '$date_today', '$username', '$password1', '1', '1', '1', '$tin', '$vatmode')";
								echo $sqlquery;
								$new = mysqli_query($mysqli, $sqlquery);
								$cid = $mysqli->insert_id;

								$sqlquerytwo = "INSERT INTO `contacts`(`Wid`, `Name`, `Mobile`, `Landline`, `Email`, `SupplierID`, `ContactOwner`, `Designation`) 
											      VALUES ('$ccode', '$contactperson', '$cmobile', '$clandline', '$cemail', '$cid', '$creator', '$designation')";
								$newtwo = mysqli_query($mysqli, $sqlquerytwo);			      

								if($newtwo) $_SESSION['success'] = "Successfully added new supplier. Click <a href='suppliers_new.php'>here</a> to add another one.";
								else $_SESSION['fail'] = $sqlquery;
									#"Oops, something went wrong. If error persists, please contact support.";
								
								ob_end_clean();
								header("location:suppliers.php");
							}
						}
						else
						{
							date_default_timezone_set ('Asia/Taipei');
							$date_today = date("Y-m-d H:i:s");
							$name = "";
							$phone = "";
							$address = "";
							$username = "";
							$tin = "";
							$password1 = "";
							$password2 = "";
							$contactperson = "";
							$ccode = "";
							$cmobile = "";
							$clandline = "";
							$cemail = "";
							$designation = "";

							$stringSQL = "SELECT 
											    (`ID` + 1) AS 'ID'
											FROM
											    `contacts`
											ORDER BY `ID` DESC
											LIMIT 1";

							$cat = mysqli_query($mysqli, $stringSQL);
							$cat->data_seek(0);
				    				$row = $cat->fetch_row();
				    		$ccode = "1000".$row[0];
						}
					
					?>
				</div>
				<div class="form_content">
							<form class="form-horizontal" method=post action="<?php echo $_SERVER['PHP_SELF'];?>">
							<div class='panel-heading'>COMPANY INFORMATION</div>
								<div class="form-group">
									<div class="col-sm-8">
										<label for="name">Company Name*</label>
										<input name="name" type="text" class="form-control" placeholder="Company Name" value=<?php echo "'".$name."'"; ?> required>
									</div>
									<div class="col-sm-4">
										<label for="birthdate">Date*</label>
										<input name="birthdate" type="date" class="form-control" value=<?php echo "'".$date_today."'"; ?>>
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
									<div class="col-sm-6">
										<label for="tin">TIN #:</label>
										<input name="tin" type="text" class="form-control" placeholder="TIN" value=<?php echo "'".$tin."'"; ?>>
									</div>
									<div class="col-sm-6">
										<label>VAT Mode</label>
											<select class="form-control" name="vatmode">
												<option value="1">VAT</option>
												<option value="2">VAT Exempt</option>
												<option value="3">Zero-Rated</option>
											</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-4">
										<label for="username">E-mail*</label>
										<input name="username" type="text" class="form-control" placeholder="E-mail" value=<?php echo "'".$username."'"; ?> required>
									</div>
									<!--
									<div class="col-sm-4">
										<label for="password1">Password*</label>
										<input name="password1" type="password" class="form-control" placeholder="Password" value=<?php #echo "'".$password1."'";?> required>
									</div>
									<div class="col-sm-4">
										<label for="mn">Retype Password*</label>
										<input name="password2" type="password" class="form-control" placeholder="Retype Password" value=<?php #echo "'".$password2."'";?> required>
										
									</div>-->
								</div>
								
								<div class='panel-heading'>INITIAL CONTACT PERSON</div>
								<div class="form-group">
									<div class="col-sm-8">
										<label for="contactperson">Contact Person*</label>
										<input name="contactperson" type="text" class="form-control" placeholder="Full Name" value=<?php echo "'".$contactperson."'"; ?> required>
									</div>
									<div class="col-sm-4">
										<label for="ccode">Contact Code*</label>
										<input name="ccode" type="text" class="form-control" placeholder="Contact Code" value=<?php echo "'".$ccode."'"; ?> disabled>
									</div>
								</div>	
								<div class="form-group">
									<div class="col-sm-4">
										<label for="cmobile">Contact Mobile*</label>
										<input name="cmobile" type="text" class="form-control" placeholder="Mobile" value=<?php echo "'".$cmobile."'"; ?> required>
									</div>
									<div class="col-sm-4">
										<label for="clandline">Contact Landline*</label>
										<input name="clandline" type="text" class="form-control" placeholder="Landline" value=<?php echo "'".$clandline."'"; ?> required>
									</div>
									<div class="col-sm-4">
										<label for="cemail">Contact Email*</label>
										<input name="cemail" type="text" class="form-control" placeholder="Email" value=<?php echo "'".$cemail."'"; ?> required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-6">
										<label for="designation">Designation</label>
										<input name="designation" type="text" class="form-control" placeholder="Designation" value=<?php echo "'".$designation."'"; ?>>
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
	</div>
	</body>
</html>