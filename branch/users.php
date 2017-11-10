		 		<?php
	ob_start();
	session_start();
	require_once("verify_access.php");
	$page_name = "Employees";
	$page_type = 2;
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
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/datepicker3.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
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
				<div class="row" style="margin-left:1px;">
					<div class="messages">
						<?php
							if(isset($_SESSION['success'])) { echo "<p class='fsuccess'>".$_SESSION['success']."</p>"; unset($_SESSION['success']); }
							else if(isset($_SESSION['fail'])) { echo "<p class='ffail'>".$_SESSION['fail']."</p>"; unset($_SESSION['fail']); }
						?>
					</div>
				</div>
				
				<div class="panel-heading"><svg class="glyph stroked dashboard-dial">svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>   USER MANAGEMENT</div>

				<div></div>
					<div class="table-wrapper">
				        	<table id="patients" class="display responsive nowrap selecttable" cellspacing="0" width="100%">
				        	<!-- <button type="submit" class="btn btn-primary">Submit Button</button> -->
							<?php
								require_once("../resource/database/hive.php");
								$result = mysqli_query($mysqli, "SELECT 
															    E.`ID`, E.`Name`, E.`Address`, E.`Phone`, E.`Birthdate`, E.`Username`, T.`Name`
															FROM
															    `entity` AS E
															LEFT join
																`teams` AS T ON T.`ID` = E.`TeamID`
															WHERE
															    E.`Type` = 1 AND E.`Mark` = 1");
							
								echo '<thead>';
								echo '<tr style="text-align:center;font-weight:bold;">';
								echo '<th style="width:8%;text-align:center;" data-priority="1">Employee ID</th>';
								echo '<th style="width:20%;text-align:center;" data-priority="2">Name</th>';
								echo '<th style="width:22%;text-align:center;" data-priority="5">Address</th>';
								echo '<th style="width:15%;text-align:center;" data-priority="4">Phone</th>';
								echo '<th style="width:15%;text-align:center;" data-priority="3">Birthdate</th>';
								echo '<th style="width:10%;text-align:center;" data-priority="6">Email</th>';
								echo '<th style="width:10%;text-align:center;" data-priority="7">Team</th>';
								echo '<th style="width:10%;text-align:center;" data-priority="8">Actions</th>';
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
									
									//Birthdate
									echo '<td>'.date("F d, Y", strtotime($row[4])).'</td>';
									
									//Email
									echo '<td>'.$row[5].'</td>';

									//Team
									echo '<td>'.$row[6].'</td>';	
									
									//Actions
									echo '<td><a href="user_edit.php?type='.$row[0].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>&nbsp&nbsp|&nbsp&nbsp<a href="user_delete.php?employee='.$row[0].'&action=reset"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</a>&nbsp&nbsp|&nbsp&nbsp
										  <a href="user_delete.php?employee='.$row[0].'&action=delete"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>';
									
									
									echo '</tr>';
								}
							?>
							</tbody>
						</table>
					</div>
				
		</div>
	</body>
</html>