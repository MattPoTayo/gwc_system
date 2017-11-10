<?php
	ob_start();
	session_start();
	require_once("verify_access.php");
	$page_name = "Add Report";
	$page_type = 13;
?>	
<html>
	<?php require_once("../resource/sections/branch_header.php"); ?>
	<body>
		<?php 
			require_once("../resource/sections/branch_banner.php"); 
			
			function ClearTxt() {
				
			}
			//New Receiving
			if(!isset($_SESSION['report']))
			{
				$creator = $_SESSION['id'];
				$sqlquery = "INSERT INTO `activity_head`(`Source`, `Destination`, `Comment`, `Date`, `Mark`, `Creator`, `Type`, `ActivityDate`) VALUES ('0', '0', '', '$time_now', '2', '$creator', '1', Now())";
				#echo $sqlquery;
				$new = mysqli_query($mysqli, $sqlquery);
				$_SESSION['report'] = $mysqli->insert_id;
				#echo $mysqli->insert_id;
				$sid = $_SESSION['report'];
				$sqlquery = "UPDATE `activity_head` SET `Reference` = `ID`,`Source` = '$creator' WHERE `ID` = '$sid'";
				$updateID =  mysqli_query($mysqli, $sqlquery);
				
				$reference = $sid;
				$activity_date = date("Y-m-d");
				$comment = "";
				$activity_mode = 1;
				$activity_detail = "";	
			}
			else
			{
				$sid = $_SESSION['report'];
				
				$TransDetails = mysqli_query($mysqli, "SELECT * FROM `activity_head` WHERE `ID` = '$sid'");
				$TransExistDetails = $TransDetails->fetch_assoc();

				$reference = $TransExistDetails["Reference"];
				$comment = $TransExistDetails["Comment"];
				$activity_date = date("Y-m-d", strtotime($TransExistDetails["ActivityDate"]));
				$activity_mode = $TransExistDetails["Type"];
			}
			
			//Actions
			if(isset($_GET['delete']))
			{	
				$detail = $_GET['delete'];
				$delete_connection = mysqli_query($mysqli, "UPDATE particular_activity SET Mark = -1 WHERE Activity = '$sid' AND Details = '$detail'");
				$sql = "UPDATE activity_detail SET Mark = -1 WHERE ID = '$detail'";
				$delete_inventory = mysqli_query($mysqli, $sql);
				if($delete_connection AND $delete_inventory)
					$_SESSION['success'] = "iID No. ".$detail." successfully deleted.";
				else
					$_SESSION['fail'] = "iID No. ".$detail." delete failed. Please contact support if error persists.";
				ob_end_clean();
				header("location:add_report.php");
			}
			
			if(isset($_GET['cancel']))
			{	
				$activity = $_GET['cancel'];
				$delete_connection = mysqli_query($mysqli, "UPDATE particular_activity SET Mark = -1 WHERE Activity = '$sid'");
				$reset_inventory = mysqli_query($mysqli, "UPDATE `activity_detail` SET Mark = -1 WHERE `HeadID` = '$activity'");	
				$delete_Activity = mysqli_query($mysqli, "UPDATE activity_head SET Mark = -1 WHERE ID = '$sid'");	
				unset($_SESSION['report']);
				ob_end_clean();
				header("location:index.php");
			}
			
			if(isset($_GET['finalize']))
			{			
				$finalize = mysqli_query($mysqli, "UPDATE `particular_activity` AS PA, 
											    `activity_detail` AS AD,
											    `activity_head`  AS AH
											SET 
											    AH.`Mark` = 1,
											    PA.`Mark` = 1,
											    AH.`Mark` = 1
											WHERE
											    AH.`ID` = $sid
											        AND PA.`Activity` = $sid
											        AND PA.`Details` = AD.`ID`
											        AND AD.`Mark` > 0
											        AND PA.`Mark` > 0");
				if($finalize)
				{
					unset($_SESSION['report']);
					ob_end_clean();
					header("location:pdf-report.php?id=".$sid);
				}
				else
				{
					$_SESSION['fail'] = "Failed to finalize. Please contact support if error persists.";
				}
			}
			
			if(isset($_GET['save']))
			{			
				unset($_SESSION['report']);
				ob_end_clean();
				header("location:index.php");
			}
			
			//Update Receipt Data
			if(isset($_POST['reference']))
			{
				$activity_mode = $mysqli->real_escape_string($_POST['activity_mode']);
				$reference = $mysqli->real_escape_string($_POST['reference']);
				$activity_date = $mysqli->real_escape_string($_POST['activity_date']);
				$comment = $mysqli->real_escape_string($_POST['comment']);

				$update = mysqli_query($mysqli, "UPDATE `activity_head` SET `Reference` = '$reference', `Comment` = '$comment', `Type` = '$activity_mode', `ActivityDate` = '$activity_date' WHERE `ID` = '$sid'");
				$_SESSION['success'] = "Successfully updated record details.";
			}
			
			//Add Item
			if(isset($_POST['entity']))
			{
				$entity = $mysqli->real_escape_string($_POST['entity']);
				$activity_type = $mysqli->real_escape_string($_POST['activity_type']);
				$contactperson = $mysqli->real_escape_string($_POST['contactperson']);
				$description = $mysqli->real_escape_string($_POST['description']);
				$brand = $mysqli->real_escape_string($_POST['brand']);
				
				if($activity_mode == 1)
				{
					$sqlquery = "INSERT INTO `activity_detail`(`HeadID`, `TypeOfEntity`, `ClientID`, `ContactID`, `ActivityType`, `BrandID`, `ActivityDetail`, `Mark`) VALUES ('$sid', '$activity_mode', '$entity', '$contactperson', '$activity_type', '$brand', '$description', '1')";
				}
				else
				{
					$sqlquery = "INSERT INTO `activity_detail`(`HeadID`, `TypeOfEntity`, `SupplierID`, `ContactID`, `ActivityType`, `BrandID`, `ActivityDetail`, `Mark`) VALUES ('$sid', '$activity_mode', '$entity', '$contactperson', '$activity_type', '$brand', '$description', '1')";
				}

				#echo $sqlquery;
				$newInventory = mysqli_query($mysqli, $sqlquery);
				#echo $sqlquery;
				//$result = mysqli_query($mysqli, "SELECT ID FROM `inventory` ORDER BY `ID` DESC LIMIT 1");
				$new_detail = $mysqli->insert_id;
				#echo $new_inventory;
				//if(mysqli_num_rows($result) != 0)
				//{
				//	$result->data_seek(0);
				//	$row = $result->fetch_row();
				//	$name = sprintf('%d', $row[0]);
				#move_uploaded_file($tmp_name, "../resource/images/inv_image/$new_inventory.png");
				//}
				$sqlquery2 = "INSERT INTO `particular_activity`(`Activity`, `Details`, `Type`, `Amount`, `Mark`) VALUES ('$sid', '$new_detail', '1', '0', 2)";
				#echo $sqlquery2;
				$newConnection = mysqli_query($mysqli, $sqlquery2);
				$name = "";
				$category ="";
				$description ="";
				$weight = "";
				$price= "";
				$purchasecode= "";
				$_SESSION['success'] = "Successfully added new detail.";
			}
		?>	
		
			<div class="row">
				<div style="margin-right:-10px;margin-top:10px">
					<div class="col-sm-4">
						<div class="messages">
							<?php
								if(isset($_SESSION['success'])) { echo "<p class='fsuccess'>".$_SESSION['success']."</p>"; unset($_SESSION['success']); }
								else if(isset($_SESSION['fail'])) { echo "<p class='ffail'>".$_SESSION['fail']."</p>"; unset($_SESSION['fail']); }
							?>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div style="margin-right:-10px;margin-top:10px">
						<div class="form_class_view">
							<div class="form_title"><div class="panel-heading">Report Details</div></div>
							<div class="form_content_view">
								<form class="form-horizontal" method=post action="<?php echo $_SERVER['PHP_SELF'];?>">
									<div class="form-group">
										<div class="col-sm-2">
											<label for="reference" class="control-label">Reference No.</label>
											<input type="text" name="reference" class="form-control" required <?php if(isset($reference)) echo  "value='".$reference."'"; ?> readonly>
										</div>
										<div class="col-sm-2">
											<label for="activity_mode" class="control-label">Activity Mode</label>
											<select name="activity_mode" class="selectpicker form-control" data-live-search="true">
												<?php
														$activity = mysqli_query($mysqli, "SELECT `ID`, `Name` FROM `activity_mode`");
														for($i=0; $i<mysqli_num_rows($activity) and mysqli_num_rows($activity)>0; $i++)
														{
															$activity->data_seek($i);
															$row = $activity->fetch_row();
														
															if($row[0] == $activity_mode) echo "<option value='".$row[0]."' SELECTED>".ucwords(strtolower($row[1]))."</option>";
															else echo "<option value='".$row[0]."'>".ucwords(strtolower($row[1]))."</option>";
														}
													?>
											</select>
										</div readonly>
										<div class="col-sm-2">
											<label for="activity_date" class="control-label">Activity Date</label>
											<input type="date" name="activity_date" class="form-control" <?php if(isset($activity_date)) echo "value='".$activity_date."'"; ?> >
										</div>
										<div class="col-sm-4">
											<label for="comment" class="control-label">Comment</label>
											<input type="text" name="comment" class="form-control" <?php if(isset($comment)) echo "value='".$comment."'"; ?> >
										</div>
										<div class="col-sm-2">
											<label for="update" class="control-label">&nbsp</label>
											<button name="update" type="submit" class="view_button" 
											<?php $checkDetails = mysqli_query($mysqli,"SELECT * FROM `activity_detail` WHERE `HeadID` = '$sid' AND `Mark` > 0");
												if($checkDetails->num_rows > 0) echo "disabled" ?> >Update</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				<div style="clear:both"></div>
				
				<?php if($comment != "") { ?>
				<div style="margin-top:10px;width:100%">
					<div class="form_class_view">
						<div class="form_title_view">Add Activity</div>
						<div class="form_content_view">
							<form class="form-horizontal" enctype="multipart/form-data" method=post action="<?php echo $_SERVER['PHP_SELF'];?>" >
								<div class="form-group">
									<div class="col-sm-3">
									<label for="entity" class="control-label">Entity</label>
											<select name="entity" class="selectpicker form-control" data-live-search="true">
												<?php
														$creator = $_SESSION['id'];
														if($activity_mode == 1)
														{
															$stringSQL = "SELECT `ID`, `Name` FROM `entity` WHERE `IsClient` = '1' AND `AccountOwner` = '$creator'";
															#echo $stringSQL;
														}
														else
														{
															$stringSQL = "SELECT `ID`, `Name` FROM `supplier`";
														}
														$cat = mysqli_query($mysqli, $stringSQL);
														for($i=0; $i<mysqli_num_rows($cat) and mysqli_num_rows($cat)>0; $i++)
														{
															$cat->data_seek($i);
															$row = $cat->fetch_row();
														
															if($row[0] == $entity) echo "<option value='".$row[0]."' SELECTED>".sprintf('%05d', $row[0])." ".ucwords(strtolower($row[1]))."</option>";
															else echo "<option value='".$row[0]."'>".sprintf('%05d', $row[0])." ".ucwords(strtolower($row[1]))."</option>";
														}
													?>
										</select>
									</div>
									<div class="col-sm-3">
									<label for="activity_type" class="control-label">Activity Type</label>
											<select name="activity_type" class="selectpicker form-control" data-live-search="true">
												<?php
														$cat = mysqli_query($mysqli, "SELECT `ID`, `Name` FROM `activity_type` WHERE `Mode` = '$activity_mode'");
														for($i=0; $i<mysqli_num_rows($cat) and mysqli_num_rows($cat)>0; $i++)
														{
															$cat->data_seek($i);
															$row = $cat->fetch_row();
														
															if($row[0] == $category) echo "<option value='".$row[0]."' SELECTED>".ucwords(strtolower($row[1]))."</option>";
															else echo "<option value='".$row[0]."'>".ucwords(strtolower($row[1]))."</option>";
														}
													?>
										</select>
									</div>
									<div class="col-sm-3">
									<label for="contactperson" class="control-label">Contact Person</label>
											<select name="contactperson" class="selectpicker form-control" data-live-search="true">
												<?php
														$cat = mysqli_query($mysqli, "SELECT `ID`, `Name` FROM `contacts` WHERE `ContactOwner` IN ('$creator', '0')");
														for($i=0; $i<mysqli_num_rows($cat) and mysqli_num_rows($cat)>0; $i++)
														{
															$cat->data_seek($i);
															$row = $cat->fetch_row();
														
															if($row[0] == $contactperson) echo "<option value='".$row[0]."' SELECTED>".ucwords(strtolower($row[1]))."</option>";
															else echo "<option value='".$row[0]."'>".ucwords(strtolower($row[1]))."</option>";
														}
													?>
										</select>
									</div>
									<div class="col-sm-3">
									<label for="brand" class="control-label">Brand</label>
											<select name="brand" class="selectpicker form-control" data-live-search="true">
												<?php
														$cat = mysqli_query($mysqli, "SELECT `ID`, `Name` FROM `brand`");
														for($i=0; $i<mysqli_num_rows($cat) and mysqli_num_rows($cat)>0; $i++)
														{
															$cat->data_seek($i);
															$row = $cat->fetch_row();
														
															if($row[0] == $brand) echo "<option value='".$row[0]."' SELECTED>".ucwords(strtolower($row[1]))."</option>";
															else echo "<option value='".$row[0]."'>".ucwords(strtolower($row[1]))."</option>";
														}
													?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<label for="description" class="control-label">Description</label>
										<input type="text" name="description" class="form-control" <?php if(isset($description)) echo "value='".$description."'"; ?> required>
									</div>
									<div class="col-sm-2">
										<label for="add" class="control-label">Add</label>
										<button name="add" type="submit" class="view_button">Add</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				
				<div class="selecttable" style="width:98%;margin-left:1%">
			        	<table class="table table-bordered table-stripped" style="font-size:12px;width:100%">
					<?php
					if($activity_mode == 1)
					{
						$sqlquery = "SELECT 
									    AD.`ID`,
										E.`Name`,
									    AT.`Name`,
									    C.`Name`,
									    B.`Name`,
									    AD.`ActivityDetail`
									FROM
									    `particular_activity` AS PA,
									    `activity_detail` AS AD
									LEFT JOIN `brand` AS B ON B.`ID` = AD.`BrandID`
									LEFT JOIN `entity` AS E ON E.`ID` = AD.`ClientID`
                                    LEFT JOIN `supplier` AS S ON S.`ID` = AD.`SupplierID`
                                    LEFT JOIN `contacts` AS C ON C.`ID` = AD.`ContactID`
                                    LEFT JOIN `activity_type` AS AT ON AT.`ID` = AD.`ActivityType`                                    
									WHERE
									    PA.`Activity` = '$sid'
									        AND AD.`ID` = PA.`Details`
									        AND PA.`Mark` > 0";
					}
					else
					{
						$sqlquery = "SELECT 
									    AD.`ID`,
										S.`Name`,
									    AT.`Name`,
									    C.`Name`,
									    B.`Name`,
									    AD.`ActivityDetail`
									FROM
									    `particular_activity` AS PA,
									    `activity_detail` AS AD
									LEFT JOIN `brand` AS B ON B.`ID` = AD.`BrandID`
									LEFT JOIN `entity` AS E ON E.`ID` = AD.`ClientID`
                                    LEFT JOIN `supplier` AS S ON S.`ID` = AD.`SupplierID`
                                    LEFT JOIN `contacts` AS C ON C.`ID` = AD.`ContactID`
                                    LEFT JOIN `activity_type` AS AT ON AT.`ID` = AD.`ActivityType`                                    
									WHERE
									    PA.`Activity` = '$sid'
									        AND AD.`ID` = PA.`Details`
									        AND PA.`Mark` > 0";
					}
						#echo $sqlquery;
						$result = mysqli_query($mysqli, $sqlquery);
						#echo $sqlquery;
						echo '<thead>';
						echo '<tr style="text-align:center;font-weight:bold;background:black;color:white">';
						echo '<th style="width:8%;text-align:center">Activity ID</th>';
						echo '<th style="width:8%;text-align:center">Entity</th>';
						echo '<th style="width:8%;text-align:center">Activity Type</th>';
						echo '<th style="width:8%;text-align:center">Contact Person</th>';
						echo '<th style="width:8%;text-align:center">Brand</th>';
						echo '<th style="width:23%;text-align:center">Details</th>';
						echo '<th style="width:10%;text-align:center">Action</th>';
						echo '</tr></thead><tbody>';
						
						for($i=0, $total=0; $i < mysqli_num_rows($result); $i++)
						{	
							$result->data_seek($i);
			    				$row = $result->fetch_row();
			    				
			    			echo "<tr style='text-align:center'>";
			    				
			    			//ID
							echo '<td>'.sprintf('%05d', $row[0]).'</td>';
							
							//Entity
							echo '<td>'.$row[1].'</td>';
							
							//Activity Type 
							echo '<td>'.$row[2].'</td>';

							//Contact Person
							echo '<td>'.$row[3].'</td>';

							//Brand
							echo '<td>'.$row[4].'</td>';
							
							//Description
							echo '<td>'.$row[5].'</td>';
							
							//Delete
							echo '<td><a href="add_report.php?delete='.$row[0].'"><i class="fa fa-times" aria-hidden="true"></i> Delete</a></td>';
			    				
			    				echo "</tr>";
						}
						
						#if(mysqli_num_rows($result) == 0)
						#{
						#	echo "<tr><td colspan=7 style='text-align:center'>Cart Empty.</td></tr>";
						#}
						#else
						#{
						#	echo "<tr><td colspan=6 style='text-align:right;margin-right:5px;'>Total Amount Payable</td><td #style='text-align:center;font-weight:bold'>$ ".number_format($total,2)."</td><td>&nbsp</td></tr>";
						#}
					?>
					</tbody>
					</table>
				</div>
				
				<?php } ?>
			
				<div class="selecttable" style="width:98%;margin-left:1%">
			        	<table class="table" style="font-size:12px;width:100%">
			        		<tr style="text-align:center;">
			        			<td style="width:76%;text-align:right;margin-right:5px;">&nbsp</td>
			        			<td style="width:8%"><a class='btn view_button' href='add_report.php?save=true' role='button'>Save</a></td>
			        			<td style="width:8%"><a class='btn view_button' href='add_report.php?cancel=true' role='button'>Cancel</a></td>
			        			<?php if($comment != "") { ?><td style="width:8%"><a class='btn view_button' href='add_report.php?finalize=true' role='button'>Finalize</a></td><?php } ?>
			        		</tr>
			        	</table>
			        </div>
			</div>
		</div>			
	</body>
</html>