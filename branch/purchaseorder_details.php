<?php
	ob_start();
	session_start();
	require_once("verify_access.php");
	$page_name = "Purchase Status List";
	$page_type = 5;
?>
<html>
	<?php require_once("../resource/sections/branch_header.php"); ?>
	<body>
		<?php 
			require_once("../resource/sections/branch_banner.php"); 
			require_once("../resource/sections/branch_menu.php"); 
			if(!isset($_SESSION['editcost']))
			{
				$transID = $_GET['id'];
				$_SESSION['editcost'] = $transID;

			}
		?>	
		
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css"/>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.0.2/css/responsive.dataTables.min.css"/>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.0.2/js/dataTables.responsive.min.js"></script>
				
		<script type="text/javascript" charset="utf-8">
	            $(document).ready(function(){
	                $('#patients').dataTable({
			        "iDisplayLength": [100]
			    });
			    
			$('#patients2').dataTable({
			        "iDisplayLength": [100]
			    });
			    
			$('#patients3').dataTable({
			        "iDisplayLength": [100]
			    });
	            })
	        </script>		
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<?php require_once("../resource/sections/branch_shortcuts.php"); ?>
			<div>
				<div class="row" style="margin-left:1px;">
					<div class="panel-heading">Sales Order Purchase Status</div>
					<div class="messages">
						<?php
							if(isset($_SESSION['success'])) { echo "<p class='fsuccess'>".$_SESSION['success']."</p>"; unset($_SESSION['success']); }
							else if(isset($_SESSION['fail'])) { echo "<p class='ffail'>".$_SESSION['fail']."</p>"; unset($_SESSION['fail']); }
						?>
					</div>
				</div>
				
				<table class="table" style="width:100%;font-size:12px">
					<?php
						require_once("../resource/database/hive.php");
						$id = $_GET['id'];
						$config = mysqli_query($mysqli, "SELECT `value` FROM `config` WHERE `particular`='branchid'");
						$config = mysqli_fetch_row($config); $config = $config[0];
						$userBranch = $config;
						
						//Check Receipt Integrity
						$check = mysqli_query($mysqli, "SELECT * FROM `sales_head` WHERE `ID` = '$id' AND `Mark` >= 0");
						
						if($check AND mysqli_num_rows($check) == 1)
						{
							$transaction = $check->fetch_assoc();
							$id = $transaction['ID'];
							$creatorID = $transaction['Creator'];
							$termID = $transaction['TermID'];
							$bdf = $transaction['BDF'];
							
							//Creator
							$creator = mysqli_query($mysqli, "SELECT Name FROM entity WHERE ID = '$creatorID'");
							$creator = mysqli_fetch_row($creator);
							
							//Destination Details
							$destination_ID = $transaction['Destination'];
							$destination_query = mysqli_query($mysqli, "SELECT * FROM `entity` WHERE `ID` = '$destination_ID'");
							$destination = $destination_query->fetch_assoc();

							$contact_ID = $transaction['ContactID'];
							$contact_query = mysqli_query($mysqli, "SELECT * FROM `contacts` WHERE `ID` = '$contact_ID'");
							$contact = $contact_query->fetch_assoc();
							
							//Source Details
							$source_ID = $transaction['Source'];
							$source_query = mysqli_query($mysqli, "SELECT * FROM `entity` WHERE `ID` = '$source_ID'");
							$source = $source_query->fetch_assoc();
							
							//Branch Details
							$branch_query = mysqli_query($mysqli, "SELECT * FROM `branch` WHERE `wid` = '$userBranch'");
							$branch = $branch_query->fetch_assoc();

							$terms_query = mysqli_query($mysqli, "SELECT * FROM `payment_terms` WHERE `ID` = '$termID'");
							$payment_term = $terms_query->fetch_assoc();
						}
						else
						{
							header("location:index.php");
							ob_start();
						}
						
						$result3 = mysqli_query($mysqli, "SELECT * FROM `sales_head` WHERE `ID` = '$id'");
						$result3->data_seek(0);
					    	$row3 = $result3->fetch_row();
					?>
					<tr><td style="width:20%">SO No.</td><td style="width:30%"><?php echo $id; ?></td>
					<td style="width:20%">Client</td><td style="width:30%"><?php echo $destination["Name"]; ?></td></tr>
					<tr><td style="width:20%">Address</td><td style="width:30%"><?php echo $destination["Address"]; ?></td><td style="width:20%">Request By</td><td style="width:30%"><?php echo $creator[0]; ?></tr>

				</table>
				
				<hr style="border-top: 2px solid black;">
				
				
				
				<div class="panel-heading">Purchase Order List</div>
				<div class="table-wrapper">
			        	<table id="patients3" class="display responsive nowrap selecttable" cellspacing="0" width="100%">
						<?php
							$stringSQL = "SELECT 
											    PH.`ID`, S.`Name`
											FROM
											    `purchase_head` AS PH
											        LEFT JOIN
											    `supplier` AS S ON S.`ID` = PH.`Destination`
											WHERE
											    PH.`SalesOrderID` = '$id';";
							$result = mysqli_query($mysqli, $stringSQL);
							
							echo '<thead>';
							echo '<tr style="text-align:center;font-weight:bold;">';
							echo '<th style="width:8%;text-align:center;" data-priority="1">PO Number</th>';
							echo '<th style="width:10%;text-align:center;" data-priority="3">Designated Supplier</th>';
							echo '<th style="width:10%;text-align:center;" data-priority="9">View</th>';
							echo '</tr></thead><tbody>';
						
							for($i=0; $i < mysqli_num_rows($result); $i++)
							{	
								$result->data_seek($i);
				    				$row = $result->fetch_row();
				    				
			    					echo '<tr style="text-align:center;">';
			    					
				    				//ID
									echo '<td>'.sprintf('%05d', $row[0]).'</td>';
									
									//Picture
									#$path =  "../resource/images/inv_image/".sprintf('%d', $row[2]).".png";
									//echo $path;
									#echo '<td><img style="width:30px;" src="'.$path.'"/></td>';
									
									//Description
									echo '<td>'.ucwords(strtolower($row[1])).'</td>';

									//Qty
									#echo '<td>'.$row[5].'</td>';

									//Unit Cost
									#echo '<td>'.ucwords(strtolower($row[3])).'</td>';
									
									//Cost Price
									#echo '<td>'.number_format($row[3] * $row[5], 2).'</td>';
									
									//Selling Price
									#echo '<td>'.$row[4].'</td>';
									
									//Amount
									#echo '<td>'.number_format($row[4] * $row[5], 2).'</td>';
									
									//Actions
									echo '<td><a href="pdf-order.php?id='.$row[0].'&action=view" target="_blank" target="_self"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>View</a>';
									
									echo '</tr>';
							}
						?>
						</tbody>
					</table>
				</div>
			</div>			
		</div>
	</body>
</html>