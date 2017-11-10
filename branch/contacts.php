<?php
	ob_start();
	session_start();
	require_once("verify_access.php");
	$page_name = "Contact List";
	$page_type = 12;
	$flag = 0;
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
				<?php
				if(isset($_GET['type']) AND $_GET['type'] == 0)
				{
					echo '<div class="panel-heading"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg>   SUPPLIER CONTACT LIST</div>';
					$flag = 0;
				}
				else if(isset($_GET['type']) AND $_GET['type'] == 1)
				{
					echo '<div class="panel-heading"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg>   CLIENT CONTACT LIST</div>';
					$flag = 1;
				}
					?>
				<div class="table-wrapper">
			        	<table id="patients" class="display responsive nowrap selecttable" cellspacing="0" width="100%">
						<?php
							require_once("../resource/database/hive.php");
							$creator = $_SESSION['id'];
							$result = mysqli_query($mysqli, "SELECT 
																    `Wid`, `Name`, `Mobile`, `Landline`, `Email`
																FROM
																    `contacts`
																WHERE
																    `IsClient` = '$flag' AND  `ContactOwner` = '$creator'");
						
							echo '<thead>';
							echo '<tr style="text-align:center;font-weight:bold;">';
							echo '<th style="width:8%;text-align:center;" data-priority="1">Contact ID</th>';
							echo '<th style="width:20%;text-align:center;" data-priority="2">Name</th>';
							echo '<th style="width:22%;text-align:center;" data-priority="5">Mobile</th>';
							echo '<th style="width:15%;text-align:center;" data-priority="4">Landline</th>';
							echo '<th style="width:10%;text-align:center;" data-priority="6">Email</th>';
							echo '<th style="width:10%;text-align:center;" data-priority="7">Actions</th>';
							echo '</tr></thead><tbody>';
						
							for($i=0; $i < mysqli_num_rows($result); $i++)
							{	
								echo '<tr style="text-align:center;">';
								$result->data_seek($i);
				    				$row = $result->fetch_row();
				    				
				    				//ID and Name
								echo '<td>'.sprintf('%05d', $row[0]).'</td>';
								echo '<td>'.ucwords(strtolower($row[1])).'</td>';
								
								//Address
								echo '<td>'.$row[2].'</td>';
								
								//Phone
								echo '<td>'.$row[3].'</td>';
								
								//Email
								echo '<td>'.$row[4].'</td>';
								
								//Actions
								echo '<td><a href="supplier_history.php?id='.$row[0].'&action=view"><i class="fa fa-file" aria-hidden="true"></i> View</a></td>';
								
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