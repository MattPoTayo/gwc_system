<?php
	ob_start();
	session_start();
	require_once("verify_access.php");
	$page_name = "Accounting Module";
	$page_type = 5;
?>
<html>
	<?php require_once("../resource/sections/branch_header.php"); ?>
	<body>
		<?php 
			require_once("../resource/sections/branch_banner.php"); 
			require_once("../resource/sections/branch_menu.php"); 
			
			if(isset($_GET['continue']))
			{
				$sid = $_GET['continue'];
				$ttype = $_GET['type'];
				
				if($ttype == 1)
				{
					$_SESSION['order'] = $sid;
					ob_end_clean();
					header("location:create_salesorder.php");
				}
				else if($ttype == 2)
				{
					$_SESSION['report'] = $sid;
					ob_end_clean();
					header("location:add_report.php");
				}
				else if($ttype == 3)
				{
					$_SESSION['sales'] = $sid;
					ob_end_clean();
					header("location:t_sales.php");
				}
				else if($ttype == 4)
				{
					$_SESSION['return'] = $sid;
					ob_end_clean();
					header("location:t_return.php");
				}
				else if($ttype == 5)
				{
					$_SESSION['repair'] = $sid;
					ob_end_clean();
					header("location:t_repair.php");
				}
				else if($ttype == 6)
				{
					$_SESSION['release'] = $sid;
					ob_end_clean();
					header("location:t_release.php");
				}
			}
			
			if(isset($_GET['reverse']))
			{
				$sid = $_GET['reverse'];
				$items = mysqli_query($mysqli, "SELECT `Sales` FROM `particular_sales` WHERE Mark = 1 AND `Sales` = '$sid'");
				
			    for($ok=true, $i=0; $i < mysqli_num_rows($items); $i++)
				{
					$items->data_seek($i);
			    		$row = $items->fetch_row();
			    		$check = mysqli_query($mysqli, "SELECT `Sales` FROM `particular_sales` AS PS, `sales_head` AS SH WHERE PS.`Sales` = SH.`ID` AND PS.`Details` = '$row[0]' AND SH.`Mark` = 1 ORDER BY PS.`Sales` DESC LIMIT 1");
			    		$check = mysqli_fetch_row($check);
			    		
			    if($check[0] != $sid) $ok = false;
				}
				
				if($ok)
				{
					$reverse_connection = mysqli_query($mysqli, "UPDATE `particular_sales` AS PS, `sales_detail` AS SD SET PS.`Mark` = 2, SD.`Mark` = 2 WHERE PS.`Sales` = '$sid' AND PS.`Sales` = SD.`ID`");
					$reverse_transaction = mysqli_query($mysqli, "UPDATE `sales_head` SET Mark = 2 WHERE ID = '$sid'");
					
					if($reverse_connection and $reverse_transaction)
					$_SESSION['success'] = "Successfully reversed transaction.";
				}
				else
				{
					$_SESSION['fail'] = "One of the items in the receipt is already included in a newer receipt. Please reverse that receipt first before reversing this one.";
				}
				
			}

			if(isset($_GET['approved']))
			{
				$sid = $_GET['approved'];
				$items = mysqli_query($mysqli, "SELECT `ID` FROM `particular_sales` WHERE Mark = 1 AND `Sales` = '$sid'");
				$creatorid = $_SESSION['id'];
				$approvedquery = "UPDATE `sales_head` SET `Approved` = 1, `SecondaryApproval` = $creatorid  WHERE Mark = 1 AND `ID` = '$sid'";
				$items = mysqli_query($mysqli, $approvedquery);
				if($items)
					$_SESSION['success'] = "iID No. ".$sid." sales is successfully approved.";
				else
					$_SESSION['fail'] = "iID No. ".$sid." sales unable to approved. Please contact support if error persists.";
				ob_end_clean();
				header("location:purchasing_view.php");
			}

			if(isset($_GET['cancel']))
			{
				$sid = $_GET['cancel'];
				$items = mysqli_query($mysqli, "SELECT `ID` FROM `particular_sales` WHERE Mark = 1 AND `Sales` = '$sid'");
				$creatorid = $_SESSION['id'];
				$approvedquery = "UPDATE `sales_head` SET `Approved` = 0, `SecondaryApproval` = 0, `ManagerApproval` = 0  WHERE Mark = 1 AND `ID` = '$sid'";
				$items = mysqli_query($mysqli, $approvedquery);
				if($items)
					$_SESSION['success'] = "iID No. ".$sid." sales is successfully cancelled.";
				else
					$_SESSION['fail'] = "iID No. ".$sid." sales unable to cancel. Please contact support if error persists.";
				ob_end_clean();
				header("location:purchasing_view.php");
			}

			if(isset($_GET['proceed']))
			{
				$sid = $_GET['proceed'];
				$items = mysqli_query($mysqli, "SELECT `ID` FROM `particular_sales` WHERE Mark = 1 AND `Sales` = '$sid'");
				$creatorid = $_SESSION['id'];
				$approvedquery = "UPDATE `sales_head` SET `Approved` = 0, `SecondaryApproval` = 0, `ManagerApproval` = 0  WHERE Mark = 1 AND `ID` = '$sid'";
				$items = mysqli_query($mysqli, $approvedquery);
				if($items)
					$_SESSION['success'] = "iID No. ".$sid." sales is successfully cancelled.";
				else
					$_SESSION['fail'] = "iID No. ".$sid." sales unable to cancel. Please contact support if error persists.";
				ob_end_clean();
				header("location:purchasing_view.php");
			}

			if(isset($_GET['proceedorder']))
			{
				$sid = $_GET['proceedorder'];
				$creator = $_SESSION['id'];

				for($i=0; $i < mysqli_num_rows($supplierlist); $i++)
				{
					$supplierlist->data_seek($i);
				    $row = $supplierlist->fetch_row();
				    $supplier = $row["Supplier"];

				    $supplierdetail = mysqli_query($mysqli, "SELECT * FROM `supplier` WHERE `ID` = '$row[0]' LIMIT 1");
					$supplierdetail = mysqli_fetch_row($supplierdetail);

					$insertPO = "INSERT INTO `purchase_head`(`Source`, `Destination`, `Date`, `Mark`, `Creator`, `Type`) VALUES ('$creator', '$supplier', Now(), '1', '$creator', '1')";
					$insertPOprocess = mysqli_query($mysqli, $insertPO);

					$supplier_items = mysqli_query($mysqli, "SELECT 
																    SD.`HeadID`, I.`ID`, SD.`Qty`, I.`Buy`
																FROM
																    `sales_detail` AS SD
																        LEFT JOIN
																    `inventory` AS I ON I.`ID` = SD.`InventoryID`
																WHERE
																    SD.`HeadID` = '$sid'
																        AND I.`SupplierID` = '$supplierID'");


				}
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
					<a href="#">
					<div class="row" style="margin-top:5px"><div class="alert bg-warning" role="alert"><svg class="glyph stroked flag"><use xlink:href="#stroked-flag"></use></svg>Purchasing and Accounting Module</span></a></div></div>
					<div class="panel-heading"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg>   Sales Order Request List</div>
					<div class="messages">
						<?php
							if(isset($_SESSION['success'])) { echo "<p class='fsuccess'>".$_SESSION['success']."</p>"; unset($_SESSION['success']); }
							else if(isset($_SESSION['fail'])) { echo "<p class='ffail'>".$_SESSION['fail']."</p>"; unset($_SESSION['fail']); }
						?>
					</div>

				</div>
				<table class="table" style="width:100%;font-size:12px">
			        	<table id="patients" class="display responsive nowrap selecttable" cellspacing="0" width="100%">
						<?php
							require_once("../resource/database/hive.php");
							$creatorid = $_SESSION['id'];
							$sqlquery = "SELECT 
									    S.`ID`,
									    S.`Reference`,
									    E.`Name`,
									    ET.`Name`,
									    S.`Date`,
									    SUM(P.`Amount`) AS 'Amount',
									    S.`Type`,
									    S.`Comment`,
									    S.`Mark`,
									    S.`Approved`,
									    S.`ManagerApproval`,
									    S.`SecondaryApproval`
									FROM
									    `sales_head` AS S
									        LEFT JOIN
									    `entity` AS E ON E.`ID` =S.`Source`
									        LEFT JOIN
									    `entity` AS ET ON ET.`ID` = S.`Destination`
									        LEFT JOIN
									    `particular_sales` AS P ON P.`Sales` = S.`ID`
									WHERE
									    S.`Mark` = 1
									    AND S.`AccountingApproval` = 0
									GROUP BY S.`ID`
									ORDER BY `ID` DESC";
							#echo $sqlquery;
							$result = mysqli_query($mysqli, $sqlquery);
														
							echo '<thead>';
							echo '<tr style="text-align:center;font-weight:bold;">';
							echo '<th style="width:10%;text-align:center;" data-priority="1">SID</th>';
							echo '<th style="width:10%;text-align:center;" data-priority="2">Reference</th>';
							echo '<th style="width:15%;text-align:center;" data-priority="3">Date</th>';
							echo '<th style="width:20%;text-align:center;" data-priority="4">Request Owner</th>';
							echo '<th style="width:20%;text-align:center;" data-priority="4">Client Name</th>';
							echo '<th style="width:20%;text-align:center;" data-priority="6">Status</th>';
							echo '<th style="width:10%;text-align:center;" data-priority="8">Action</th>';
							echo '</tr></thead><tbody>';
						
							for($i=0; $i < mysqli_num_rows($result); $i++)
							{	
								echo '<tr style="text-align:center;">';
								$result->data_seek($i);
				    				$row = $result->fetch_row();
				    				
			    				//ID
								echo '<td>'.sprintf('%05d', $row[0]).'</td>';
								
								//Reference
								echo '<td>'.$row[1].'</td>';
								
								//Date
								echo '<td>'.date("M d, Y h:i A", strtotime($row[4])).'</td>';
								
								//Owner
								echo '<td>'.ucwords(strtolower($row[2])).'</td>';

								//Cleint
								echo '<td>'.ucwords(strtolower($row[3])).'</td>';
								
								//Type
								if($row[9] == 1 && $row[11] != 0 && $row[10] == 0) echo "<td>Preliminary Approval</td>";
								else if ($row[9] == 1 && $row[10] != 0) echo "<td>For Order</td>";
								else echo "<td>Pending</td>" ;
								
								//Actions
								if($row[8] == 1) echo '<td><a href="pdf-sales.php?id='.$row[0].'&action=view" target="_blank"><i class="fa fa-file-o" aria-hidden="true"></i> View</a>&nbsp|&nbsp<a href="transactions.php?continue='.$row[0].'&type='.$row[6].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>&nbsp|&nbsp<a href="purchasing_view.php?approved='.$row[0].'&type='.$row[6].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Approved</a></td>';
								else if($row[8] == 2) echo '<td><a href="salesorderlist.php?continue='.$row[0].'&type='.$row[6].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Continue</a></td>';
								
								echo '</tr>';
							}
						?>
						</tbody>
					</table>
				</div>



				<hr style="border-top: 2px solid black;">


				<div class="panel-heading"> Approved List</div>
				<table class="table" style="width:100%;font-size:12px">	
			        	<table id="patients2" class="display responsive nowrap selecttable" cellspacing="0" width="100%">
						<?php
							require_once("../resource/database/hive.php");
							$creatorid = $_SESSION['id'];
							$sqlquery = "SELECT 
									    S.`ID`,
									    S.`Reference`,
									    E.`Name`,
									    ET.`Name`,
									    S.`Date`,
									    SUM(P.`Amount`) AS 'Amount',
									    S.`Type`,
									    S.`Comment`,
									    S.`Mark`,
									    S.`Approved`,
									    S.`ManagerApproval`,
									    S.`SecondaryApproval`
									FROM
									    `sales_head` AS S
									        LEFT JOIN
									    `entity` AS E ON E.`ID` =S.`Source`
									        LEFT JOIN
									    `entity` AS ET ON ET.`ID` = S.`Destination`
									        LEFT JOIN
									    `particular_sales` AS P ON P.`Sales` = S.`ID`
									WHERE
									    S.`Mark` = 1
									    AND S.`Approved` = 1
									    AND S.`SecondaryApproval` != 0
									GROUP BY S.`ID`
									ORDER BY `ID` DESC";
							#echo $sqlquery;
							$result = mysqli_query($mysqli, $sqlquery);
														
							echo '<thead>';
							echo '<tr style="text-align:center;font-weight:bold;">';
							echo '<th style="width:10%;text-align:center;" data-priority="1">SID</th>';
							echo '<th style="width:10%;text-align:center;" data-priority="2">Reference</th>';
							echo '<th style="width:15%;text-align:center;" data-priority="3">Date</th>';
							echo '<th style="width:20%;text-align:center;" data-priority="4">Request Owner</th>';
							echo '<th style="width:20%;text-align:center;" data-priority="4">Client Name</th>';
							echo '<th style="width:20%;text-align:center;" data-priority="6">Status</th>';
							echo '<th style="width:10%;text-align:center;" data-priority="8">Action</th>';
							echo '</tr></thead><tbody>';
						
							for($i=0; $i < mysqli_num_rows($result); $i++)
							{	
								echo '<tr style="text-align:center;">';
								$result->data_seek($i);
				    				$row = $result->fetch_row();
				    				
			    				//ID
								echo '<td>'.sprintf('%05d', $row[0]).'</td>';
								
								//Reference
								echo '<td>'.$row[1].'</td>';
								
								//Date
								echo '<td>'.date("M d, Y h:i A", strtotime($row[4])).'</td>';
								
								//Owner
								echo '<td>'.ucwords(strtolower($row[2])).'</td>';

								//Cleint
								echo '<td>'.ucwords(strtolower($row[3])).'</td>';
								
								//Status
								if($row[9] == 1 && $row[11] != 0 && $row[10] == 0) echo "<td>Preliminary Approval</td>";
								else if ($row[9] == 1 && $row[10] != 0) echo "<td>For Order</td>";
								else echo "<td>Pending</td>" ;
								
								//Actions
								if($row[8] == 1) echo '<td><a href="pdf-report.php?id='.$row[0].'&action=view" target="_blank"><i class="fa fa-file-o" aria-hidden="true"></i> View</a>&nbsp|&nbsp<a href="purchasing_view.php?cancel='.$row[0].'&type='.$row[6].'"><i class="fa fa-times" aria-hidden="true"></i> Cancel Approval</a>&nbsp|&nbsp<a href="purchasing_view.php?cancel='.$row[0].'&type='.$row[6].'"><i class="fa fa-check" aria-hidden="true"></i> Proceed</a></td>';
								else if($row[8] == 2) echo '<td><a href="salesorderlist.php?continue='.$row[0].'&type='.$row[6].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Continue</a></td>';
								
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