<?php
	ob_start();
	session_start();
	require_once("verify_access.php");
	$page_name = "Brand";
	$page_type = 11;
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
				<div class="panel-heading"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg>  BRAND </div>
				<div class="table-wrapper">
			        	<table id="patients" class="display responsive nowrap selecttable" cellspacing="0" width="100%">
						<?php
							require_once("../resource/database/hive.php");
							$stringSQL = "SELECT 
											    `ID`, `Code`, `Name`
											FROM
											    `brand`";
							$result = mysqli_query($mysqli, $stringSQL);
						
							echo '<thead>';
							echo '<tr style="text-align:center;font-weight:bold;">';
							echo '<th style="width:15%;text-align:center;" data-priority="1">Brand ID</th>';
							echo '<th style="width:20%;text-align:center;" data-priority="2">Brand Code</th>';
							echo '<th style="width:60%;text-align:center;" data-priority="5">Brand Name</th>';
							echo '<th style="width:10%;text-align:center;" data-priority="7">Actions</th>';
							echo '</tr></thead><tbody>';
						
							for($i=0; $i < mysqli_num_rows($result); $i++)
							{	
								echo '<tr style="text-align:center;">';
								$result->data_seek($i);
				    				$row = $result->fetch_row();
				    				
				    			//ID
								echo '<td>'.sprintf('%05d', $row[0]).'</td>';
								//Code
								echo '<td>'.$row[1].'</td>';
								//Name
								echo '<td>'.ucwords(strtolower($row[2])).'</td>';
								//Actions
								echo '<td><a href="brand_edit.php?type='.$row[0].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>&nbsp&nbsp|&nbsp&nbsp<a href="brand_supplier_list.php?id='.$row[0].'&action=view"><i class="fa fa-file" aria-hidden="true"></i>Supplier List</a></td>';
								
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