<?php
	ob_start();
	require_once("verify_access.php");
	require_once("../resource/database/hive.php");
	$page_name = "New Brand";
	$page_type = 11;
?>
<html>
	<link href="../resource/graphics/css/sb-admin-2.css" rel="stylesheet">
	<?php require_once("../resource/sections/branch_header.php"); ?>
	<body>
		<?php require_once("../resource/sections/branch_banner.php"); ?>
		<?php require_once("../resource/sections/branch_menu.php"); ?>
		<div class="form_class">
			<div class="form_title"><div class="panel-heading"><svg class="glyph stroked laptop computer and mobile"><use xlink:href="#stroked-laptop-computer-and-mobile"/></use></svg>NEW BRAND</div></div>
				<div>
					<?php
						if($_POST)
						{
							require_once("../resource/database/hive.php");

							$name = $mysqli->real_escape_string($_POST['name']);
							$stringSQL = "SELECT 
											    (`ID` + 1) AS 'ID'
											FROM
											    `brand`
											ORDER BY `ID` DESC
											LIMIT 1";

							$cat = mysqli_query($mysqli, $stringSQL);
							$cat->data_seek(0);
				    				$row = $cat->fetch_row();
				    		$code = "1000".$row[0];
							
							
							if(strlen($name) > 120)
							{
								echo "<p class='ffail'>Name can only be 45 characters long!</p>";	
							}	
							else
							{
								$sqlquery = "INSERT INTO `brand`(`Name`, `Code`) 
											      VALUES ('$name', '$code')";
								echo $sqlquery;
								$new = mysqli_query($mysqli, $sqlquery);
											      
								if($new) $_SESSION['success'] = "Successfully added new category. Click <a href='category_new.php'>here</a> to add another one.";
								else $_SESSION['fail'] = $sqlquery;
									#"Oops, something went wrong. If error persists, please contact support.";
								
								ob_end_clean();
								header("location:brand.php");
							}
						}
						else
						{
							$name = "";

							$stringSQL = "SELECT 
											    (`ID` + 1) AS 'ID'
											FROM
											    `category`
											ORDER BY `ID` DESC
											LIMIT 1";

							$cat = mysqli_query($mysqli, $stringSQL);
							$cat->data_seek(0);
				    				$row = $cat->fetch_row();
				    		$code = "1000".$row[0];

						}
					
					?>
				</div>
				<div class="form_content">
							<form class="form-horizontal" method=post action="<?php echo $_SERVER['PHP_SELF'];?>">
								<div class="form-group">
									<div class="col-sm-8">
										<label for="name">Brand Name*</label>
										<input name="name" type="text" class="form-control" placeholder="Brand Name" value=<?php echo "'".$name."'"; ?> required>
									</div>
									<div class="col-sm-4">
										<label for="code">Brand Code*</label>
										<input name="code" type="text" class="form-control" placeholder="Brand Code" value=<?php echo "'".$code."'"; ?> disabled>
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