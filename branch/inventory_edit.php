<?php
	ob_start();
	require_once("verify_access.php");
	require_once("../resource/database/hive.php");
	$page_name = "Edit Inventory";
	$page_type = 4;
?>
<html>
	<link href="../resource/graphics/css/sb-admin-2.css" rel="stylesheet">

	<?php require_once("../resource/sections/branch_header.php"); ?>
	<body>
		<?php require_once("../resource/sections/branch_banner.php"); ?>
		<?php require_once("../resource/sections/branch_menu.php"); ?>
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
			<div class="form_class">
				<div class="form_title"><div class="panel-heading"> UPDATE INVENTORY</div></div>
					<div>
						<?php
							require_once("../resource/database/hive.php");
							
							if(isset($_GET['type']))
							{
								$type = $_GET['type'];
								$transID = $_GET['transID'];
							}
							else
							{
								$type = 1;
								$transID = 0;
							}
							$inventoryID = $_GET['inventory'];
							$stringquery = "SELECT * FROM `inventory` WHERE `ID` = '$inventoryID'";
							$inventory = mysqli_query($mysqli, $stringquery);
							#echo $stringquery;
							$inventory = $inventory ->fetch_assoc();
								
							$name = $inventory['Name'];
							$category = $inventory['Category'];
							$description = $inventory['Description'];
							$weight = $inventory['Weight'];
							$purchasecode = $inventory['Code'];
							$brand = $inventory['Brand'];
							$price = $inventory['Buy'];

							
							if(isset($_GET['sid']))
							{
								$sid = $_GET['sid'];
								
								//Price
								$price = mysqli_query($mysqli, "SELECT `Amount` FROM particular WHERE `Mark` = 2 AND `Transaction` = '$sid' AND `Inventory` = '$inventoryID'");
								$price = mysqli_fetch_row($price); $price = $price[0];
							}
							
							if($_POST)
							{
								$name = $mysqli->real_escape_string($_POST['name']);
								$category = $mysqli->real_escape_string($_POST['category']);
								$brand = $mysqli->real_escape_string($_POST['brand']);
								$description = $mysqli->real_escape_string($_POST['description']);
								$weight = $mysqli->real_escape_string($_POST['weight']);
								$purchasecode = $mysqli->real_escape_string($_POST['purchasecode']);

								$price = $mysqli->real_escape_string($_POST['price']);
								$stringCost = "UPDATE `inventory` SET `Buy` = '$price' WHERE `ID` = '$inventoryID'";

								#$imagetmp = addslashes (file_get_contents($_FILES['img']['tmp_name']));
								#$tmp_name = $_FILES['img']['tmp_name'];
								if(isset($_GET['sid']))
								{	
									//Update price
									$update_price = mysqli_query($mysqli, "UPDATE particular SET Amount = '$price' WHERE Mark = 2 AND `Transaction` = '$sid' AND `Inventory` = '$inventoryID'");
										echo $stringCost;


									if(isset($_SESSION['receive']) || $type == 2)
									{
										$update_buy = mysqli_query($mysqli, $stringCost);
									}
									else if(isset($_SESSION['sales']))
										$update_buy = mysqli_query($mysqli, "UPDATE `inventory` SET `Sell` = '$price' WHERE `ID` = '$inventoryID'");
								}
								else
								if(!is_null($price))
								{
									$update_buy = mysqli_query($mysqli, $stringCost);
								}
								
								#if($imagetmp != "")
								#{
								#	move_uploaded_file($tmp_name, "../resource/images/inv_image/$inventoryID.png");
								#}
								
								$stringUpdate = "UPDATE `inventory` SET `Name` = '$name', `Category` = '$category', `Description` = '$description', `Weight` = '$weight', `Code` = '$purchasecode', `Brand` = '$brand' WHERE `ID` = '$inventoryID'";
								echo $stringUpdate;
								$edit = mysqli_query($mysqli, $stringUpdate);								
								
								
							}
						?>
					</div>
					<div class="form_content">
						<form class="form-horizontal" enctype="multipart/form-data" method=post action="<?php if(isset($_GET['sid'])) echo $_SERVER['PHP_SELF']."?inventory=".$inventoryID."&sid=".$sid; else echo $_SERVER['PHP_SELF']."?inventory=".$inventoryID; ?>">
							<div class="form-group">
								<div class="col-sm-12">
									<label for="name" class="control-label">Code</label>
									<input type="text" name="name" class="form-control" <?php if(isset($name)) echo  "value='".$name."'"; ?> >
								</div>
								
								<?php #echo $type; ?>
								<div class="col-sm-12">
									<label for="category" class="control-label">Category</label>
											<select name="category" class="selectpicker form-control" data-live-search="true">
												<?php
														$cat = mysqli_query($mysqli, "SELECT `ID`, `Name` FROM `category`");
														for($i=0; $i<mysqli_num_rows($cat) and mysqli_num_rows($cat)>0; $i++)
														{
															$cat->data_seek($i);
															$row = $cat->fetch_row();
														
															if($row[0] == $category) echo "<option value='".$row[0]."' SELECTED>".sprintf('%05d', $row[0])." ".ucwords(strtolower($row[1]))."</option>";
															else echo "<option value='".$row[0]."'>".sprintf('%05d', $row[0])." ".ucwords(strtolower($row[1]))."</option>";
														}
													?>
										</select>
								</div>

								<div class="col-sm-12">
									<label for="brand" class="control-label">Brand</label>
											<select name="brand" class="selectpicker form-control" data-live-search="true">
												<?php
														$cat = mysqli_query($mysqli, "SELECT `ID`, `Name` FROM `brand`");
														for($i=0; $i<mysqli_num_rows($cat) and mysqli_num_rows($cat)>0; $i++)
														{
															$cat->data_seek($i);
															$row = $cat->fetch_row();
														
															if($row[0] == $brand) echo "<option value='".$row[0]."' SELECTED>".sprintf('%05d', $row[0])." ".ucwords(strtolower($row[1]))."</option>";
															else echo "<option value='".$row[0]."'>".sprintf('%05d', $row[0])." ".ucwords(strtolower($row[1]))."</option>";
														}
													?>
										</select>
								</div>
								
								<div class="col-sm-12">
									<label for="weight" class="control-label">Weight</label>
											<input type="text" name="weight" class="form-control" <?php if(isset($weight)) echo  "value='".$weight."'"; ?> >
								</div>
								
								<div class="col-sm-12">
									<label for="img" class="control-label">Image</label>
									<input type="file" name="img" class="form-control" >
								</div>
								
								<div class="col-sm-12">
									<label for="description" class="control-label">Description</label>
									<input type="text" name="description" class="form-control" <?php if(isset($description)) echo "value='".$description."'"; ?> >
								</div>

								<div class="col-sm-12">
									<label for="purchasecode" class="control-label">Purchase Code</label>
									<input type="text" name="purchasecode" class="form-control" <?php if(isset($purchasecode)) echo "value='".$purchasecode."'"; ?> >
								</div>
								
								<?php if(isset($_GET['sid']) || $type = 2)  { ?>
								<div class="col-sm-12">
									<label for="price" class="control-label"><?php if(isset($_SESSION['receive']) || $type == 2) echo 'COST PRICE'; else echo 'SELLING PRICE'; ?></label>
									<input type="text" name="price" class="form-control" <?php if(isset($price)) echo "value='".$price."'"; ?> >
								</div>
								<?php } ?>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-0 col-sm-6">
									<button type="submit" class="form_button">Update</button>
								</div>
								<div class="col-sm-offset-0 col-sm-6">
								<?php 
								if($type == 1)
									echo '<a class="btn form_button" href="inventory.php" role="button">Back</a>';
								else
									echo'<a class="btn form_button" href="edit_so_cost.php?id='.$transID.'" role="button">Back</a>';
								?>
							</div>			
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	</body>
</html>