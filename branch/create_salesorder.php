<?php
	ob_start();
	session_start();
	require_once("verify_access.php");
	$page_name = "Create/Submit Sales Order";
	$page_type = 5;
?>	
<html>
	<?php require_once("../resource/sections/branch_header.php"); ?>
	<body>
		<?php 
			require_once("../resource/sections/branch_banner.php"); 
			
			function ClearTxt() {
				
			}
			//New Receiving
			if(!isset($_SESSION['order']))
			{
				$creator = $_SESSION['id'];
				$sqlquery = "INSERT INTO `sales_head`(`Source`, `Destination`, `Comment`, `Date`, `Mark`, `Creator`, `Type`, `DeliveryDate`) VALUES ('0', '0', '', '$time_now', '2', '$creator', '1', Now())";
				#echo $sqlquery;
				$new = mysqli_query($mysqli, $sqlquery);
				$_SESSION['order'] = $mysqli->insert_id;
				#echo $mysqli->insert_id;
				$sid = $_SESSION['order'];
				$sqlquery = "UPDATE `sales_head` SET `Reference` = `ID`,`Source` = '$creator' WHERE `ID` = '$sid'";
				$updateID =  mysqli_query($mysqli, $sqlquery);
				
				$reference = $sid;
				$delivery_date = date("Y-m-d");
				$comment = "";
				$activity_mode = 1;
				$activity_detail = "";	
				$delivery_charge= 0;
				$bdf = 0;
			}
			else
			{
				$sid = $_SESSION['order'];
				
				$TransDetails = mysqli_query($mysqli, "SELECT * FROM `sales_head` WHERE `ID` = '$sid'");
				$TransExistDetails = $TransDetails->fetch_assoc();

				$reference = $TransExistDetails["Reference"];
				$comment = $TransExistDetails["Comment"];
				$delivery_date = date("Y-m-d", strtotime($TransExistDetails["DeliveryDate"]));
				$client = $TransExistDetails["Destination"];
				$contact = $TransExistDetails["ContactID"];
				$payment = $TransExistDetails["TermID"];
				$delivery_charge = $TransExistDetails["DeliveryCharge"];
				$bdf = $TransExistDetails["BDF"];
			}
			
			//Actions
			if(isset($_GET['delete']))
			{	
				$detail = $_GET['delete'];
				$delete_connection = mysqli_query($mysqli, "UPDATE `particular_sales` SET `Mark` = -1 WHERE `Sales` = '$sid' AND Details = '$detail'");
				$sql = "UPDATE `sales_detail` SET `Mark` = -1 WHERE `ID` = '$detail'";
				$delete_inventory = mysqli_query($mysqli, $sql);
				if($delete_connection AND $delete_inventory)
					$_SESSION['success'] = "iID No. ".$detail." successfully deleted.";
				else
					$_SESSION['fail'] = "iID No. ".$detail." delete failed. Please contact support if error persists.";
				ob_end_clean();
				header("location:create_salesorder.php");
			}
			
			if(isset($_GET['cancel']))
			{	
				$sales = $_GET['cancel'];
				$delete_connection = mysqli_query($mysqli, "UPDATE `particular_sale`s SET `Mark` = -1 WHERE `Sales` = '$sid'");
				$reset_inventory = mysqli_query($mysqli, "UPDATE `sales_detail` SET `Mark` = -1 WHERE `HeadID` = '$sales'");	
				$delete_Activity = mysqli_query($mysqli, "UPDATE `sales_head` SET `Mark` = -1 WHERE `ID` = '$sid'");	
				unset($_SESSION['order']);
				ob_end_clean();
				header("location:salesorderlist.php");
			}
			
			if(isset($_GET['finalize']))
			{			

				$checker = mysqli_query($mysqli, "SELECT `Destination` FROM `sales_head` WHERE `ID` = '$sid' AND `Destination` = 0 LIMIT 1");
				if(mysqli_num_rows($checker) == 0)
				{
					$finalize = mysqli_query($mysqli, "UPDATE `particular_sales` AS PS, 
												    `sales_detail` AS SD,
												    `sales_head`  AS SH
												SET 
												    SH.`Mark` = 1,
												    PS.`Mark` = 1,
												    SD.`Mark` = 1
												WHERE
												    SH.`ID` = $sid
												        AND PS.`Sales` = $sid
												        AND PS.`Details` = SD.`ID`
												        AND SD.`Mark` > 0
												        AND PS.`Mark` > 0");
					if($finalize)
					{
						unset($_SESSION['order']);
						ob_end_clean();
						header("location:pdf-sales.php?id=".$sid);
					}
					else
					{
						$_SESSION['fail'] = "Failed to finalize. Please contact support if error persists.";
					}
				}
				else
				{
					$_SESSION['fail'] = "Click and Update client details before finalize!";
				}
			}
			
			if(isset($_GET['save']))
			{			
				unset($_SESSION['order']);
				ob_end_clean();
				header("location:index.php");
			}
			
			//Update Receipt Data
			if(isset($_POST['reference']))
			{
				$client = $mysqli->real_escape_string($_POST['client']);

				$reference = $mysqli->real_escape_string($_POST['reference']);
				$delivery_date = $mysqli->real_escape_string($_POST['delivery_date']);
				$contact = $mysqli->real_escape_string($_POST['contact']);
				$comment = $mysqli->real_escape_string($_POST['comment']);
				$payment = $mysqli->real_escape_string($_POST['payment']);
				$delivery_charge = $mysqli->real_escape_string($_POST['delivery_charge']);
				$bdf = $mysqli->real_escape_string($_POST['bdf']);

				$updatestring = "UPDATE `sales_head` SET `Reference` = '$reference', `Comment` = '$comment', `Type` = '1', `DeliveryDate` = '$delivery_date', `Destination` = '$client', `ContactID` = '$contact', `TermID` = '$payment', `DeliveryCharge` = '$delivery_charge', `BDF` = '$bdf' WHERE `ID` = '$sid'";

				#echo $updatestring;
				$update = mysqli_query($mysqli, $updatestring);
				$_SESSION['success'] = "Successfully updated client details";
			}
			
			//Add Item
			if(isset($_POST['inventory']))
			{
				$inventory = $mysqli->real_escape_string($_POST['inventory']);
				$quantity = $mysqli->real_escape_string($_POST['quantity']);
				$price = $mysqli->real_escape_string($_POST['price']);
				
				$add_detail = mysqli_query($mysqli, "INSERT `sales_detail`(`HeadID`,`InventoryID`,`Qty`,`ItemRemarks`,`Mark`) VALUES ('$sid', '$inventory', '$quantity', 'None', '1')");
				$new_detail = $mysqli->insert_id;

				//Transaction Type: 1-buy, 2-borrow, 3-sell
				$add_cart = mysqli_query($mysqli, "INSERT INTO `particular_sales`(`Sales`, `Details`, `Type`, `Amount`, `Mark`) VALUES ('$sid', '$new_detail', '1', '$price', 2)");
				
				$_SESSION['success'] = "Successfully added new item.";
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
							<div class="form_title"><div class="panel-heading">Sales Order Details</div></div>
							<div class="form_content_view">
								<form class="form-horizontal" method=post action="<?php echo $_SERVER['PHP_SELF'];?>">
									<div class="form-group">
										<div class="col-sm-2">
											<label for="reference" class="control-label">Reference No.</label>
											<input type="text" name="reference" class="form-control" required <?php if(isset($reference)) echo  "value='".$reference."'"; ?> readonly>
										</div>
										<div class="col-sm-5">
											<label for="client" class="control-label">Client*</label>
											<select name="client" class="selectpicker form-control" data-live-search="true">
												<?php
														$creator = $_SESSION['id'];
														$sql = "SELECT ID, `Name` FROM `entity` WHERE `Mark` = 1 AND Type = 4 AND `AccountOwner` = '$creator' AND `IsClient` = '1'";
														echo $sql;
														$clientlist = mysqli_query($mysqli, $sql);
														for($i=0; $i<mysqli_num_rows($clientlist) and mysqli_num_rows($clientlist)>0; $i++)
														{
															$clientlist->data_seek($i);
															$row = $clientlist->fetch_row();
														
															if($row[0] == $client) echo "<option value='".$row[0]."' SELECTED>".ucwords(strtolower($row[1]))."</option>";
															else echo "<option value='".$row[0]."'>".ucwords(strtolower($row[1]))."</option>";
														}
													?>
											</select>
										</div readonly>
										<div class="col-sm-5">
											<label for="contact" class="control-label">Contact*</label>
											<select name="contact" class="selectpicker form-control"  required data-live-search="true">
												<?php
														$creator = $_SESSION['id'];
														$contactlist = mysqli_query($mysqli, "SELECT `ID`, `Name` FROM `contacts` WHERE `ContactOwner` = '$creator'");
														for($i=0; $i<mysqli_num_rows($contactlist) and mysqli_num_rows($contactlist)>0; $i++)
														{
															$contactlist->data_seek($i);
															$row = $contactlist->fetch_row();
														
															if($row[0] == $contact) echo "<option value='".$row[0]."' SELECTED>".ucwords(strtolower($row[1]))."</option>";
															else echo "<option value='".$row[0]."'>".ucwords(strtolower($row[1]))."</option>";
														}
													?>
											</select>
										</div readonly>
										<div class="col-sm-2">
											<label for="delivery_date" class="control-label">Delivery Date</label>
											<input type="date" name="delivery_date" class="form-control" <?php if(isset($delivery_date)) echo "value='".$delivery_date."'"; ?> >
										</div>
										<div class="col-sm-3">
											<label for="payment" class="control-label">Payment Term</label>
											<select name="payment" class="selectpicker form-control" data-live-search="true">
												<?php
														$terms = mysqli_query($mysqli, "SELECT `ID`, `Name` FROM `payment_terms`");
														for($i=0; $i<mysqli_num_rows($terms) and mysqli_num_rows($terms)>0; $i++)
														{
															$terms->data_seek($i);
															$row = $terms->fetch_row();
														
															if($row[0] == $payment) echo "<option value='".$row[0]."' SELECTED>".ucwords(strtolower($row[1]))."</option>";
															else echo "<option value='".$row[0]."'>".ucwords(strtolower($row[1]))."</option>";
														}
													?>
											</select>
										</div readonly>
										
										<div class="col-sm-3">
											<label for="delivery_charge" class="control-label">Delivery Charge</label>
											<input type="text" name="delivery_charge" class="form-control" <?php if(isset($delivery_charge)) echo "value='".$delivery_charge."'"; ?> >
										</div>
										<div class="col-sm-3">
											<label for="bdf" class="control-label">Client BDF</label>
											<input type="text" name="bdf" class="form-control" <?php if(isset($bdf)) echo "value='".number_format($bdf,2)."'"; ?> >
										</div>
										<div class="col-sm-10">
											<label for="comment" class="control-label">Comment</label>
											<input type="text" name="comment" class="form-control" <?php if(isset($comment)) echo "value='".$comment."'"; ?> >
										</div>
										<div class="col-sm-2">
											<label for="update" class="control-label">&nbsp</label>
											<button name="update" type="submit" class="view_button">Update</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				<div style="clear:both"></div>
					
				<?php if($reference != "") { ?>
				
				<hr style="border-top: 2px solid black;">
				
				<h3 style="margin-left:1%">Client Cart</h3>
				<div class="selecttable" style="width:98%;margin-left:1%">
					<form method=post action="<?php echo $_SERVER['PHP_SELF'];?>" >
			        	<table class="table table-bordered table-stripped" style="font-size:12px;width:100%">
					<?php
						$result = mysqli_query($mysqli, "SELECT 
														    I.`ID` AS 'ID',
														    I.`Name` AS 'Item Name',
														    C.`Name` AS 'Category',
														    I.`Description` AS 'Description',
														    SD.`Qty` AS 'Quantity',
														    PS.`Amount` AS 'Amount',
														    SD.`ID` AS 'Detail'
														FROM
														    `particular_sales` AS PS,
														    `sales_detail` AS SD
														        LEFT JOIN
														    `inventory` AS I ON I.`ID` = SD.`InventoryID`
														        LEFT JOIN
														    `brand` AS B ON B.`ID` = I.`Brand`
														        LEFT JOIN
														    `category` AS C ON C.`ID` = I.`Category`
														WHERE
														    PS.Sales = '$sid'
														        AND SD.`ID` = PS.`Details`
														        AND PS.`Mark` > 0");
						
						echo '<thead>';
						echo '<tr style="text-align:center;font-weight:bold;background:black;color:white">';
						echo '<th style="width:8%;text-align:center">Picture</th>';
						echo '<th style="width:8%;text-align:center">iID</th>';
						echo '<th style="width:10%;text-align:center">Code</th>';
						echo '<th style="width:10%;text-align:center">Category</th>';
						echo '<th style="width:35%;text-align:center">Description</th>';
						echo '<th style="width:9%;text-align:center">Quantity</th>';
						echo '<th style="width:10%;text-align:center">Unit Price</th>';
						echo '<th style="width:10%;text-align:center">Actions</th>';
						echo '</tr></thead><tbody>';
					?>
					
					<tr>
						<td style="vertical-align:middle;text-align:center;font-weight:bold">Add Item</td>
						<td colspan=4>
							<select name="inventory" class="selectpicker form-control" data-live-search="true">
							<?php
								$available = mysqli_query($mysqli, "SELECT `ID`, `Name`, `Category`, `Weight` FROM inventory WHERE `Mark` = 1");
								for($i=0; $i<mysqli_num_rows($available) and mysqli_num_rows($available)>0; $i++)
								{
									$available->data_seek($i);
									$row = $available->fetch_row();
								
									echo "<option value='".$row[0]."'>".sprintf('%05d', $row[0])." ".$row[1]." [".$row[2].", ".$row[3]."]</option>";
								}
							?>
							</select>
						</td>
						<td><input type="text" name="quantity" class="form-control" required ></td>
						<td><input type="text" name="price" class="form-control" required ></td>
						<td><button name="add" type="submit" class="view_button">Add</button></td>
					</tr>
					
					<?php
						
						for($i=0, $total=0; $i < mysqli_num_rows($result); $i++)
						{	
							$result->data_seek($i);
			    				$row = $result->fetch_row();
			    				
			    				echo "<tr style='text-align:center'>";
			    				
			    				//Picture
			    			$path = "../resource/images/inv_image/".sprintf('%d', $row[0]).".png";	
							echo '<td><img style="width:20px;" src="'.$path.'"/></td>';
			    				
			    				//ID
							echo '<td>'.sprintf('%05d', $row[0]).'</td>';
							
							//Name
							echo '<td>'.$row[1].'</td>';
							//Category
							echo '<td>'.$row[2].'</td>';
						
							//Description
							echo '<td>'.$row[3].'</td>';
							
							//Quantity
							echo '<td>'.$row[4].'</td>';
							
							//Amount
							echo '<td>&#8369 '.number_format($row[5],2).'</td>';
							$total += $row[5] * $row[4];
							
							//Delete
							echo '<td><a href="inventory_edit.php?inventory='.$row[0].'&sid='.$sid.'"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>&nbsp|&nbsp<a href="create_salesorder.php?delete='.$row[6].'"><i class="fa fa-times" aria-hidden="true"></i> Delete</a></td>';
			    				
			    				echo "</tr>";
						}
						
						if(mysqli_num_rows($result) == 0)
						{
							echo "<tr><td colspan=8 style='text-align:center'>Cart Empty.</td></tr>";
						}
						else
						{
							echo "<tr><td colspan=6 style='text-align:right;margin-right:5px;'>Total Amount Payable</td><td style='text-align:center;font-weight:bold'>&#8369 ".number_format($total,2)."</td><td>&nbsp</td></tr>";
						}
					?>
					</tbody>
					</table>
					</form>
				</div>
				
				<?php } ?>
			
				<div class="selecttable" style="width:98%;margin-left:1%">
			        	<table class="table" style="font-size:12px;width:100%">
			        		<tr style="text-align:center;">
			        			<td style="width:76%;text-align:right;margin-right:5px;">&nbsp</td>
			        			<td style="width:8%"><a class='btn view_button' href='create_salesorder.php?save=true' role='button'>Save</a></td>
			        			<td style="width:8%"><a class='btn view_button' href='create_salesorder.php?cancel=true' role='button'>Cancel</a></td>
			        			<?php if($reference != "") { ?> <td style="width:8%"><a class='btn view_button' href='create_salesorder.php?finalize=true' role='button'>Finalize</a></td><?php } ?>
			        		</tr>
			        	</table>
			       </div>
			</div>
		</div>			
	</body>
</html>