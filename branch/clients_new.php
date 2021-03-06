<?php
	ob_start();
	require_once("verify_access.php");
	require_once("../resource/database/hive.php");
	$page_name = "New Client";
	$page_type = 3;
?>
<html>
	<link href="../resource/graphics/css/sb-admin-2.css" rel="stylesheet">
	<?php require_once("../resource/sections/branch_header.php"); ?>
	<body>
		<?php require_once("../resource/sections/branch_banner.php"); ?>
		<?php require_once("../resource/sections/branch_menu.php"); ?>
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="form_class_full">
			<div class="form_title"><div class="panel-heading"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg>NEW CLIENT</div></div>
				<div>
					<?php
						if($_POST)
						{
							require_once("../resource/database/hive.php");

							$name = $mysqli->real_escape_string($_POST['name']);
							$phone = $mysqli->real_escape_string($_POST['phone']);
							$address = $mysqli->real_escape_string($_POST['address']);
							$username = $mysqli->real_escape_string($_POST['username']);
							$tin = $mysqli->real_escape_string($_POST['tin']);
							$creator = $_SESSION['id'];
							$contactperson =  $mysqli->real_escape_string($_POST['contactperson']);
							#$ccode =  $mysqli->real_escape_string($_POST['ccode']);
							$cmobile =  $mysqli->real_escape_string($_POST['cmobile']);
							$clandline =  $mysqli->real_escape_string($_POST['clandline']);
							$cemail =  $mysqli->real_escape_string($_POST['cemail']);
							$designation = $mysqli->real_escape_string($_POST['designation']);
							$vatmode = $_POST['vatmode'];

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
							else if($name == "" or $phone == "")
							{
								echo "<p class='ffail'>Missing required field!</p>";	
							}
							else
							{
								$sqlquery = "INSERT INTO `entity`(`Name`, `Address`, `Phone`, `Birthdate`, `Username`, `Password`, `Level`, `Type`, `Mark`, `AccountOwner`, `IsClient`, `Tin`, `VatMode`) 
											      VALUES ('$name', '$address', '$phone', '$date_today', '$username', '', '1', '4', '1', '$creator', '1', '$tin', '$vatmode')";
								echo $sqlquery;
								$new = mysqli_query($mysqli, $sqlquery);
								$cid = $mysqli->insert_id;

								$sqlquerytwo = "INSERT INTO `contacts`(`Wid`, `Name`, `Mobile`, `Landline`, `Email`, `ClientID`, `IsClient`, `Designation`, `ContactOwner`) 
											      VALUES ('$ccode', '$contactperson', '$cmobile', '$clandline', '$cemail', '$cid','1', '$designation', '$creator')";
								$newtwo = mysqli_query($mysqli, $sqlquerytwo);			      

											      
								if($newtwo) $_SESSION['success'] = "Successfully added new client. Click <a href='clients_new.php'>here</a> to add another one.";
								else $_SESSION['fail'] = $sqlquery;
									#"Oops, something went wrong. If error persists, please contact support.";
								
								ob_end_clean();
								header("location:clients.php");
							}
						}
						else
						{
							$name = "";
							$phone = "";
							$address = "";
							$username = "";
							$tin = "";
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
						<div class='panel-heading'>CLIENT INFORMATION</div>
						<div class="form-group">
							<div class="col-sm-6">
								<label for="name">Name*</label>
								<input name="name" type="text" class="form-control" placeholder="Name" value=<?php echo "'".$name."'"; ?> required>
							</div>
							
							<div class="col-sm-6">
								<label for="phone">Phone*</label>
								<input name="phone" type="text" class="form-control" placeholder="Phone" value=<?php echo "'".$phone."'"; ?> required>
							</div>
							
							<div class="col-sm-6">
								<label for="address">Address</label>
								<input name="address" type="text" class="form-control" placeholder="Address" value=<?php echo "'".$address."'"; ?>>
							</div>
							
							<div class="col-sm-6">
								<label for="username">E-mail</label>
								<input name="username" type="text" class="form-control" placeholder="E-mail" value=<?php echo "'".$username."'"; ?>>
							</div>
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