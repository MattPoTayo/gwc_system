<?php
	ob_start();
	session_start();
	require_once("verify_access.php");
	$page_name = "Team Activity";
	$page_type = 14;
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
					$_SESSION['report'] = $sid;
					ob_end_clean();
					header("location:add_report.php");
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
				$items = mysqli_query($mysqli, "SELECT `Activity` FROM `particular_activity` WHERE Mark = 1 AND `Activity` = '$sid'");
				
			    for($ok=true, $i=0; $i < mysqli_num_rows($items); $i++)
				{
					$items->data_seek($i);
			    		$row = $items->fetch_row();
			    		
			    		$check = mysqli_query($mysqli, "SELECT `Activity` FROM `particular_activity` AS PA, `activity_head` AS AH WHERE PA.`Activity` = AH.`ID` AND PA.`Details` = '$row[0]' AND AH.`Mark` = 1 ORDER BY PA.`Activity` DESC LIMIT 1");
			    		$check = mysqli_fetch_row($check);
			    		
			    if($check[0] != $sid) $ok = false;
				}
				
				if($ok)
				{
					$reverse_connection = mysqli_query($mysqli, "UPDATE `particular_activity` AS PA, `activity_detail` AS AD SET PA.`Mark` = 2, AD.`Mark` = 2 WHERE PA.`Activity` = '$sid' AND PA.`Activity` = AD.`ID`");
					$reverse_transaction = mysqli_query($mysqli, "UPDATE activity_head` SET Mark = 2 WHERE ID = '$sid'");
					
					if($reverse_connection and $reverse_transaction)
					$_SESSION['success'] = "Successfully reversed transaction.";
				}
				else
				{
					$_SESSION['fail'] = "One of the items in the receipt is already included in a newer receipt. Please reverse that receipt first before reversing this one.";
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
			        "order": [[ 0, "desc" ]]
			    });
	            })
	        </script>		
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<?php require_once("../resource/sections/branch_shortcuts.php"); ?>
			<div>
				<div class="row" style="margin-left:1px;">
					<a href="#">
					<div class="panel-heading"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg>   TEAM ACTIVITIES LIST</div>
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
							$creatorid = $_SESSION['id'];
							$selectTeam = "SELECT `ID` FROM `teams` WHERE `ManagerID` = '$creatorid' AND `Active` = 1";
							$team = mysqli_query($mysqli, $selectTeam); 
							$team = mysqli_fetch_row($team); $team = $team[0]; 

							$sqlquery = "SELECT 
									    A.`ID`,
									    A.`Reference`,
									    E.`Name`,
									    ET.`Name`,
									    A.`Date`,
									    SUM(P.`Amount`) AS 'Amount',
									    A.`Type`,
									    A.`Comment`,
									    A.`Mark`
									FROM
									    `activity_head` AS A
									        LEFT JOIN
									    `entity` AS E ON E.`ID` = A.`Source`
									        LEFT JOIN
									    `entity` AS ET ON ET.`ID` = A.`Destination`
									        LEFT JOIN
									    `particular_activity` AS P ON P.`Activity` = A.`ID`
									    	LEFT JOIN
									    `teams` AS T ON T.`ID` = E.`TeamID`
									WHERE
									    A.`Mark` >= 1 AND A.`Creator` = E.`ID`
									    AND E.`TeamID` = '$team'
									GROUP BY A.`ID`
									ORDER BY `ID` DESC";
							#echo $sqlquery;
							$result = mysqli_query($mysqli, $sqlquery);
														
							echo '<thead>';
							echo '<tr style="text-align:center;font-weight:bold;">';
							echo '<th style="width:10%;text-align:center;" data-priority="1">SID</th>';
							echo '<th style="width:10%;text-align:center;" data-priority="2">Reference</th>';
							echo '<th style="width:15%;text-align:center;" data-priority="3">Date</th>';
							echo '<th style="width:20%;text-align:center;" data-priority="4">Activity Owner</th>';
							echo '<th style="width:20%;text-align:center;" data-priority="6">Type</th>';
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
								
								//Activity_Owner
								echo '<td>'.ucwords(strtolower($row[2])).'</td>';
								
								//Type
								if($row[6] == 1) echo "<td>Daily Client [+]</td>";
								else if($row[6] == 2) echo "<td>Supplier Activity [-]</td>";
								else if($row[6] == 3) echo "<td>Sell [-]</td>";
								else if($row[6] == 4) echo "<td>Borrowed Return [+]</td>";
								else if($row[6] == 5) echo "<td>Repair Request [+]</td>";
								else if($row[6] == 6) echo "<td>Repair Release [-]</td>";
								
								//Actions
								if($row[8] == 1) echo '<td><a href="pdf-report.php?id='.$row[0].'&action=view" target="_blank"><i class="fa fa-file-o" aria-hidden="true"></i> View</a></td>';
								else if($row[8] == 2) echo '<td><a href="activity.php?continue='.$row[0].'&type='.$row[6].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Continue</a></td>';
								
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