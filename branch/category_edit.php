<?php
	ob_start();
	require_once("verify_access.php");
	require_once("../resource/database/hive.php");
	$page_name = "Edit Category";
	$page_type = 10;
	$id = $_GET['type'];
?>
<html>
	<link href="../resource/graphics/css/sb-admin-2.css" rel="stylesheet">
	<?php require_once("../resource/sections/branch_header.php"); ?>
	<body>
		<?php require_once("../resource/sections/branch_banner.php"); ?>
		<?php require_once("../resource/sections/branch_menu.php"); ?>
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
			<div class="form_class">
				<div class="form_title"><div class="panel-heading"><svg class="glyph stroked laptop computer and mobile"><use xlink:href="#stroked-laptop-computer-and-mobile"/></use></svg>EDIT CATEGORY</div></div>
					<div>
						<?php
							require_once("../resource/database/hive.php");
							$brand = mysqli_query($mysqli, "SELECT * FROM `category` WHERE `ID` = '$id'");
							$brandinfo = $brand->fetch_assoc();
							$name = $brandinfo['Name'];
							$code = $brandinfo['Code'];
							#echo $name;

							if($_POST)
							{
								$name = $mysqli->real_escape_string($_POST['name']);
								$id = $mysqli->real_escape_string($_POST['id']);
					    		$code = $mysqli->real_escape_string($_POST['code']);
								
								
								if(strlen($name) > 120)
								{
									echo "<p class='ffail'>Name can only be 45 characters long!</p>";	
								}	
								else
								{
									$sqlquery = "UPDATE `category` SET `Name` = '$name' WHERE `ID` = '$id'";
									echo $sqlquery;
									$new = mysqli_query($mysqli, $sqlquery);
												      
									if($new) $_SESSION['success'] = "Edited category succesfully saved";
									else $_SESSION['fail'] = $sqlquery;
										#"Oops, something went wrong. If error persists, please contact support.";
									
									ob_end_clean();
									header("location:category.php");
								}
							}
						?>
					</div>
					<div class="form_content">
						<form class="form-horizontal" method=post action="<?php echo $_SERVER['PHP_SELF'];?>">
								<div class="form-group">
									<div class="col-sm-2">
										<label for="id">Category ID</label>
										<input name="id" type="text" class="form-control" placeholder="ID" value=<?php echo "'".$id."'"; ?> readonly>
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-8">
										<label for="name">Category Name*</label>
										<input name="name" type="text" class="form-control" placeholder="Brand Name" value=<?php echo "'".$name."'"; ?> required>
									</div>
									<div class="col-sm-4">
										<label for="code">Category Code</label>
										<input name="code" type="text" class="form-control" placeholder="Brand Code" value=<?php echo "'".$code."'"; ?> readonly>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-offset-0 col-sm-6">
										<button type="submit" class="form_button">Save</button>
									</div>
									<div class="col-sm-offset-0 col-sm-6">
									<a class="btn form_button" href="category.php" role="button">Back</a>
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