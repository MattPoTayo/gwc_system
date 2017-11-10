<?php
	ob_start();
	session_start();
	require_once("verify_access.php");
	$page_name = "Inventory";
	$page_type = 4;
	
	ob_end_clean();
	if(isset($_SESSION['sales']))
		header("location:t_sales.php");
	else if(isset($_SESSION['receive']))
		header("location:t_receiving.php");
	else if(isset($_SESSION['borrow']))
		header("location:t_borrow.php");
	else if(isset($_SESSION['return']))
		header("location:t_return.php");
	else if(isset($_SESSION['repair']))
		header("location:t_repair.php");
	else if(isset($_SESSION['release']))
		header("location:t_release.php");	
?>
<html>
	<?php require_once("../resource/sections/branch_header.php"); ?>
	<body>
		<?php 
			require_once("../resource/sections/branch_banner.php"); 
			require_once("../resource/sections/branch_menu.php"); 
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
	            })
	        </script>		
		
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<?php require_once("../resource/sections/branch_shortcuts.php"); ?>
			<div>
				<div class="row" style="margin-left:1px;">
					<div class="panel-heading"><svg class="glyph stroked desktop"><use xlink:href="#stroked-desktop"/></svg> ALL INVENTORY</div>
					<div class="messages">
						<?php
							if(isset($_SESSION['success'])) { echo "<p class='fsuccess'>".$_SESSION['success']."</p>"; unset($_SESSION['success']); }
							else if(isset($_SESSION['fail'])) { echo "<p class='ffail'>".$_SESSION['fail']."</p>"; unset($_SESSION['fail']); }
						?>
					</div>
				</div>
				<div class="table-wrapper">
			        	<table id="patients" class="display responsive nowrap selecttable" cellspacing="0" width="100%">
						<?php
							require_once("../resource/database/hive.php");
							$stringSQL = "SELECT 
											    I.`ID`,
											    I.`Name`,
											    C.`Name`,
											    I.`Subcategory`,
											    I.`Description`,
											    I.`Code`,
											    I.`Weight`,
											    I.`Buy`,
											    I.`Sell`,
											    I.`Mark`,
											    B.`Name`
											FROM
											    `inventory` AS I
											        LEFT JOIN
											    `category` AS C ON C.`ID` = I.`Category`
											    	LEFT JOIN
											    `brand` AS B ON B.`ID` = I.`Brand`";
							$result = mysqli_query($mysqli, $stringSQL);
						
							echo '<thead>';
							echo '<thead>';
							echo '<tr style="text-align:center;font-weight:bold;">';
							echo '<th style="width:9%;text-align:center;" data-priority="1">i-ID</th>';
							echo '<th style="width:9%;text-align:center;" data-priority="2">Picture</th>';
							echo '<th style="width:30%;text-align:center;" data-priority="3">Name</th>';
							echo '<th style="width:15%;text-align:center;" data-priority="4">Brand</th>';
							echo '<th style="width:15%;text-align:center;" data-priority="5">Category</th>';
							echo '<th style="width:30%;text-align:center;" data-priority="6">Description: </th>';
							echo '<th style="width:16%;text-align:center;" data-priority="7">Purchase Code: </th>';
							echo '<th style="width:9%;text-align:center;" data-priority="8">Weight: </th>';	
							echo '<th style="width:9%;text-align:center;" data-priority="9">Type</th>';
							echo '<th style="width:9%;text-align:center;" data-priority="10">Actions</th>';
							echo '</tr></thead><tbody>';
						
							for($i=0; $i < mysqli_num_rows($result); $i++)
							{	
								echo '<tr style="text-align:center;">';
								$result->data_seek($i);
				    				$row = $result->fetch_row();
				    				$Purchasecode = $row[5];
				    				
				    				//ID
								echo '<td>'.sprintf('%05d', $row[0]).'</td>';
								
								//Picture
								echo '<td><a href="inventory_view.php?id='.$row[0].'" target="_blank">View</a></td>';
								
								//Name
								echo '<td>'.ucwords(strtolower($row[1])).'</td>';
								
								//Brand
								echo '<td>'.ucwords(strtolower($row[10])).'</td>';
								
								//Category
								echo '<td>'.ucwords(strtolower($row[2])).'</td>';

								//Description
								echo '<td>'.$row[4].'</td>';

								//Purchase Code
								echo '<td>'.$Purchasecode.'</td>';
								
								//Weight
								echo '<td>'.$row[6].' g</td>';
								
								//Type
								if($row[9] == 1) echo '<td>Available</td>';
								else if($row[9] == 2) echo '<td>In Cart</td>';
								else if($row[9] == 3) echo '<td>Sold</td>';
								else if($row[9] == 4) echo '<td>Borrowed</td>';
								else if($row[9] == 5) echo '<td>Repair Request</td>';
								else if($row[9] == 6) echo '<td>Repair Released</td>';
								else if($row[9] < 1) echo '<td>Deleted</td>';
								
								//Actions
								echo '<td><a href="inventory_history.php?id='.$row[0].'" target="_blank"><i class="fa fa-history-o" aria-hidden="true"></i> History</a></td>';
								
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