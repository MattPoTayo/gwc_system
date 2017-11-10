<?php
	ob_start();
	session_start();
	require_once("verify_access.php");
	$page_name = "Items By Category";
	$page_type = 10;
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
					<div class="panel-heading">Category</div>
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
						
						$result3 = mysqli_query($mysqli, "SELECT * FROM `category` WHERE `ID` = '$id'");
						$result3->data_seek(0);
					    	$row3 = $result3->fetch_row();
					?>
					<tr><td style="width:20%">Category ID</td><td style="width:30%"><?php echo $row3[0]; ?></td>
					<td style="width:20%">Name</td><td style="width:30%"><?php echo $row3[2]; ?></td></tr>
					<tr><td style="width:20%">Code</td><td style="width:30%"><?php echo $row3[1]; ?></td><td style="width:20%"></td><td style="width:30%"></tr>

				</table>
				
				<hr style="border-top: 2px solid black;">
				
				
				
				<div class="panel-heading"> Inventory List</div>
				<div class="table-wrapper">
			        	<table id="patients3" class="display responsive nowrap selecttable" cellspacing="0" width="100%">
						<?php
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
											    I.`Mark`
											FROM
											    `inventory` AS I
											        LEFT JOIN
											    `category` AS C ON C.`ID` = I.`Category`
											WHERE
											    I.`Category` = '$id'";
							$result = mysqli_query($mysqli, $stringSQL);
							
							echo '<thead>';
							echo '<tr style="text-align:center;font-weight:bold;">';
							echo '<th style="width:8%;text-align:center;" data-priority="1">i-ID</th>';
							echo '<th style="width:10%;text-align:center;" data-priority="2">Picture</th>';
							echo '<th style="width:10%;text-align:center;" data-priority="3">Name</th>';
							echo '<th style="width:10%;text-align:center;" data-priority="4">Category</th>';
							echo '<th style="width:15%;text-align:center;" data-priority="5">Description</th>';
							echo '<th style="width:7%;text-align:center;" data-priority="6">Purchase Code</th>';
							echo '<th style="width:10%;text-align:center;" data-priority="7">Weight</th>';
							echo '<th style="width:10%;text-align:center;" data-priority="8">View</th>';
							echo '</tr></thead><tbody>';
						
							for($i=0; $i < mysqli_num_rows($result); $i++)
							{	
								$result->data_seek($i);
				    				$row = $result->fetch_row();
				    				
			    					echo '<tr style="text-align:center;">';
			    					
				    				//ID
									echo '<td>'.sprintf('%05d', $row[0]).'</td>';
									
									//Picture
									$path =  "../resource/images/inv_image/".sprintf('%d', $row[0]).".png";
									//echo $path;
									echo '<td><img style="width:30px;" src="'.$path.'"/></td>';
									
									//Name
									echo '<td>'.ucwords(strtolower($row[1])).'</td>';
									
									//Category
									echo '<td>'.ucwords(strtolower($row[2])).'</td>';
									
									//Description
									echo '<td>'.$row[4].'</td>';
									
									echo '<td>'.$row[5].'</td>';
									//Weight
									echo '<td>'.$row[6].'</td>';
									
									//Actions
									echo '<td><a href="inventory_history.php?id='.$row[0].'&action=view" target="_blank"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> History</a>';
									
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