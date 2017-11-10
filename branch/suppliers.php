<?php
	ob_start();
	session_start();
	require_once("verify_access.php");
	$page_name = "Suppliers";
	$page_type = 9;
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
					<div class="messages">
						<?php
							if(isset($_SESSION['success'])) { echo "<p class='fsuccess'>".$_SESSION['success']."</p>"; unset($_SESSION['success']); }
							else if(isset($_SESSION['fail'])) { echo "<p class='ffail'>".$_SESSION['fail']."</p>"; unset($_SESSION['fail']); }
						?>
					</div>
				</div>
				<div class="panel-heading"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg>   SUPPLIER MANAGEMENT</div>
				<div class="table-wrapper">
			        	<table id="patients" class="display responsive nowrap selecttable" cellspacing="0" width="100%">
						<?php
							require_once("../resource/database/hive.php");
							$result = mysqli_query($mysqli, "SELECT ID, `Name`, `Address`, `Phone`, `Birthdate`, `Username`, `Tin`, `VatMode` FROM `supplier` WHERE `Mark` = 1 AND Type = 1");
						
							echo '<thead>';
							echo '<tr style="text-align:center;font-weight:bold;">';
							echo '<th style="width:8%;text-align:center;" data-priority="1">Supplier ID</th>';
							echo '<th style="width:20%;text-align:center;" data-priority="2">Company Name</th>';
							echo '<th style="width:10%;text-align:center;" data-priority ="3">Brand List</th>';
							echo '<th style="width:12%;text-align:center;" data-priority="5">Address</th>';
							echo '<th style="width:15%;text-align:center;" data-priority="4">Phone</th>';
							echo '<th style="width:10%;text-align:center;" data-priority="6">Email</th>';
							echo '<th style="width:10%;text-align:center;" data-priority="7">TIN</th>';
							echo '<th style="width:10%;text-align:center;" data-priority="7">Vat Mode</th>';
							echo '<th style="width:10%;text-align:center;" data-priority="8">Actions</th>';
							echo '</tr></thead><tbody>';
							$brandlist = "";
						
							for($i=0; $i < mysqli_num_rows($result); $i++)
							{	
								echo '<tr style="text-align:center;">';
								$result->data_seek($i);
				    				$row = $result->fetch_row();
				    				
			    				//ID and Name
								echo '<td>'.sprintf('%05d', $row[0]).'</td>';
								echo '<td>'.ucwords(strtolower($row[1])).'</td>';
								
								$brands = mysqli_query($mysqli, "SELECT 
																    B.`Name`
																FROM
																    `brand` AS B
																        LEFT JOIN
																    `inventory` AS I ON I.`Brand` = B.`ID`
																WHERE
																    I.`SupplierID` = '$row[0]'  AND B.`ID` != 1
																GROUP BY B.`ID`;");

								if($brands->num_rows == 0)
									$brandlist = "None";
								else
								{
									$brandlist = "";
									$num_rows = $brands->num_rows;
									for($j=0; $j < $num_rows; $j++)
									{
										$brands->data_seek($j);
					    				$row2 = $brands->fetch_row();
										$brandlist = $brandlist .' | '.$row2[0];
									}
									$brandlist = '<b>'. $brandlist .' |</b>';
								}
								//Brand List
								echo '<td>'.$brandlist.'</td>';

								//Address
								echo '<td>'.$row[2].'</td>';
								
								//Phone
								echo '<td>'.$row[3].'</td>';
								
								//Email
								echo '<td>'.$row[5].'</td>';

								//TIN
								echo '<td>'.$row[6].'</td>';

								//Vat Mode
								if($row[7] == 2)
									$vat = "VAT EXEMPT";
								else if($row[7] == 3)
									$vat = "ZERO RATED";
								else
									$vat = "VAT";
								echo '<td>'.$vat.'</td>';
								
								//Actions
								echo '<td><a href="supplier_edit.php?type='.$row[0].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>&nbsp&nbsp|&nbsp&nbsp<a href="supplier_history.php?id='.$row[0].'&action=view"><i class="fa fa-file" aria-hidden="true"></i> View</a></td>';
								
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