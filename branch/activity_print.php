<?php 
	#require_once("verify_access.php");
	require_once("../resource/database/hive.php");
	$conversion = 49;
	
	if(isset($_GET['id']))
	{
		#$userID	= $_SESSION['id'];
		$config = mysqli_query($mysqli, "SELECT `value` FROM `config` WHERE `particular`='branchid'");
		$config = mysqli_fetch_row($config); $config = $config[0];
		$userBranch = $config;
		$creation = $_GET['id'];
		
		//Check Receipt Integrity
		$check = mysqli_query($mysqli, "SELECT * FROM `activity_head` WHERE `ID` = '$creation' AND `Mark` >= 0");
		
		if($check AND mysqli_num_rows($check) == 1)
		{
			$activity = $check->fetch_assoc();
			$creation = $activity['ID'];
			$creatorID = $activity['Creator'];
			$dateactivity = date("F d, Y", strtotime($activity['ActivityDate']));
			
			//Creator
			$creator = mysqli_query($mysqli, "SELECT Name FROM entity WHERE ID = '$creatorID'");
			$creator = mysqli_fetch_row($creator);
			
			//Destination Details
			$destination_ID = $activity['Destination'];
			$destination_query = mysqli_query($mysqli, "SELECT * FROM `entity` WHERE `ID` = '$destination_ID'");
			$destination = $destination_query->fetch_assoc();
			
			//Source Details
			$source_ID = $activity['Source'];
			$source_query = mysqli_query($mysqli, "SELECT * FROM `entity` WHERE `ID` = '$source_ID'");
			$source = $source_query->fetch_assoc();
			
			//Branch Details
			$branch_query = mysqli_query($mysqli, "SELECT * FROM `branch` WHERE `wid` = '$userBranch'");
			$branch = $branch_query->fetch_assoc();
		}
		else
		{
			header("location:index.php");
		}
	}
	else
	{
		header("location:index.php");
	}
	ob_start();
?>
<style>
	@media print{ #cmdPrint{ display: none;} }
	@media screen {}	
	@media print,screen 
	{
		body 
		{ 
			margin:0; 
			padding: 0.25in;
			font-family: Helvetica,Arial,Tahoma, Courier and Andale Mono,Serif; /*Monospace fonts = Arial,Tahoma, Courier and Andale Mono.*/
			font-size: 5pt;	
		}
		@page 
		{
			margin: 0;
		}
		.a4 
		{
			text-align: left;
			padding: 0.15in;/**/
			margin-left:1in;
			height: 11in;
			width : 8.5in; /* 8.5in; */
		}	
	}
	
	table.bordered
	{
		border-collapse:collapse;
		border: 1px solid black;
	}
	
	table.bordered td, th
	{
	       border: 1px solid gray;
	}
	
	.footer
	{
		font-size:14px;
		text-align:left;
		color:gray;
	}
</style>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>Receipt | WH Jewels</title>
	<link rel="shortcut icon" type="image/x-icon" href="../resource/images/favicon.png" />
</head>
<body>
	<main>
		<div style="width:100%;">
			<div style="width:90%;margin-left:auto;margin-right:auto;">
				<table style="width:100%;margin-left:auto;margin-right:auto;">
					<tr>
						<td>
							<p style="display:inline;font-size:90%;font-weight:bold;"><img height ="50%" src="../resource/images/Logo-small.png" alt="Banner Image"/>
							<img height ="30%" src="../resource/images/CompanyTitle.png" alt="Banner Image"/></p><br>
							<p style="display:inline;font-size:70%;">Phone: <?php echo $branch['contact']; ?></p><br>
							<p style="display:inline;font-size:70%;">Address: <?php echo $branch['address']; ?></p><br>
						</td>
						<td style='text-align:right;'>
							<p style='display:inline;font-size:20px;font-weight:bold;'>
								<?php
									$type = mysqli_query($mysqli, "SELECT Type FROM `activity_head` AS AH WHERE AH.`Mark` = 1 AND AH.`ID` = '$creation' LIMIT 1");	
									$type = mysqli_fetch_row($type);
									p
									if($type[0] == 1) echo "Client Activity Report";
									else if($type[0] == 2) echo "Supplier Activity Report";
									else if($type[0] == 3) echo "Trust Agreement Receipt";
									else "Activity Record";
								?>
							</p><br>
							<p style='font-size:22px;display:inline;font-family:courier;'>Activity No. <font style='color:red'><?php echo sprintf('%05d', $activity['ID']); ?></font></p>
						</td>
					</tr>
				</table><br>
			
				<?php if($type[0] == 1) { ?>
				
				<table style="font-size:12px;margin-bottom:10px;width:100%" border=0 cellspacing=0>
					<tr><td style="width:25%">Date:</td><td style="border-bottom:solid 1px;"><?php echo date("F d, Y h:i A", strtotime($activity['Date'])); ?></td><td style="width:40%">&nbsp</td></tr>
					<tr><td>Activity Date.:</td><td style="border-bottom:solid 1px;"><?php echo $dateactivity; ?><td>&nbsp</td></tr>
				</table>
				
				<?php } else if($type[0] == 2 or $type[0] == 3) { ?>
				
				<table style="font-size:12px;margin-bottom:10px;width:100%" border=0 cellspacing=0>
					<tr><td style="width:25%">Date:</td><td style="border-bottom:solid 1px;"><?php echo date("F d, Y h:i A", strtotime($activity['Date'])); ?></td><td style="width:40%">&nbsp</td></tr>
					<tr><td>Activity Date.:</td><td style="border-bottom:solid 1px;"><?php echo $dateactivity; ?><td>&nbsp</td></tr>
				</table>
				
				<?php } ?>
				
				<table style="margin-top:10px;font-size:12px;margin-bottom:10px;width:100%" class="bordered">
					<tr style="text-align:center;font-weight:bold;background:#212121;color:white">
						<td style="width:8%">Detail ID</td>
						<td style="width:20%">Entity Name</td>
						<td style="width:10%">Activity Type</td>
						<td style="width:20%">Contact Person</td>
						<td style="width:15%">Brand</td>
						<td style="width:27%">Description</td>
					</tr>
					<?php		 
							$sqlQuery = @"SELECT 
										    SD.`ID`,
										    I.`Description`,
										    SD.`InventoryID`,
										    I.`Buy`,
										    PS.`Amount`,
										    SD.`Qty`
										FROM
										    `sales_detail` AS SD
										        LEFT JOIN
										    `particular_sales` AS PS ON PS.`Details` = SD.`ID`
												LEFT JOIN
											`inventory` AS I ON I.`ID` = SD.`InventoryID`
										WHERE
										    PS.`Sales` = 3 AND PS.`Mark` > 0";

						$result = mysqli_query($mysqli, $sqlQuery);
						//echo("SELECT inventory.ID, Name, Category, Description, Weight, Picture, Amount FROM particular, inventory WHERE particular.Transaction = '$creation' AND inventory.ID = particular.Inventory AND particular.Mark > 0");
						$path = "value";
						for($i=0, $total=0; $i < mysqli_num_rows($result); $i++)
						{	
							echo '<tr style="text-align:center;">';
							$result->data_seek($i);
			    				$row = $result->fetch_row();
			    				
			    			echo "<tr style='text-align:center'>";
			    				
							//ID
							echo '<td>'.$row[0].'</td>';
							
							//Name
							if($type[0] == 1)
								echo '<td>'.$row[1].'</td>';
							else
								echo '<td>'.$row[6].'</td>';
							
							//Activity Type
							echo '<td>'.$row[2].'</td>';
							
							//Contact Person
							echo '<td>'.$row[3].'</td>';
							
							//Brand
							echo '<td>'.$row[4].'</td>';
							
							//Description
							echo '<td>'.$row[5].'</td>';
							
							echo '</tr>';
						}
						if(mysqli_num_rows($result) == 0)
						{
							echo "<tr><td colspan=7 style='text-align:center;'>Cart Empty!</td></tr>";
						}
						else
						{

							echo "<tr><td colspan=6 style='text-align:right'>No. of Items &nbsp</td><td style='text-align:center;font-weight:bold'>".$i."</td></tr>";
							#if($type[0] == 1) echo "<tr><td colspan=6 style='text-align:right'>Total Bill&nbsp</td><td style='text-align:center;font-weight:bold'>$ ".number_format($total,2)."<br>(&#8369 ".number_format(($total*$conversion),2).")</td></tr>";
							#else echo "<tr><td colspan=6 style='text-align:right'>Total Bill&nbsp</td><td style='text-align:center;font-weight:bold'>".number_format($total,2)."</td></tr>";
						}
					?>
				</table>
				
				<?php if($type[0] > 3) { ?>
				<table style="margin-top:10px;font-size:12px;margin-bottom:10px;width:100%" class="bordered">
					<tr style="text-align:center;font-weight:bold;background:#212121;color:white">
						<td style="width:10%">PID</td>
						<td style="width:10%">Type</td>
						<td style="width:25%">Date</td>
						<td style="width:20%">Check Bank</td>
						<td style="width:25%">Check Date</td>
						<td style="width:10%">Amount in PHP</td>
					</tr>
					<?php
						$result = mysqli_query($mysqli, "SELECT `ID`, `Type`, `Date`, `Amount`, `CBank`, `CDate`, (SELECT Name FROM entity WHERE entity.ID = `Client`), `Mark` FROM payment WHERE Mark = 1 AND SID = '$creation'");
					
						for($i=0, $totalp=0; $i < mysqli_num_rows($result); $i++)
						{	
							$result->data_seek($i);
		    					$row = $result->fetch_row();
		    					
		    					echo '<tr style="text-align:center;">';
		    					echo '<td>'.sprintf('%05d', $row[0]).'</td>';
		    					
							//Type
							if($row[1] == 1) echo "<td>Cash</td>";
							else if($row[1] == 2) echo "<td>Check</td>";
							
							//Date
							echo '<td>'.date("M d, Y h:i A", strtotime($row[2])).'</td>';
							
							//CBank
							echo '<td>'.$row[4].'</td>'; 
							
							//Date
							if($row[5] != "0000-00-00 00:00:00") echo '<td>'.date("F d, Y", strtotime($row[5])).'</td>';
							else echo "<td>&nbsp</td>";
							
							//Amount
							echo '<td>'.number_format($row[3],2).'</td>'; $totalp += $row[3];
							
							echo '</tr>';
						}
						if(mysqli_num_rows($result) == 0)
						{
							echo "<tr><td colspan=6 style='text-align:center;'>No Payments.</td></tr>";
						}
						
						echo "<tr><td colspan=5 style='text-align:right;'>Total Payments</td><td style='text-align:center;'> ".number_format($totalp,2)."</td></tr>";
						echo "<tr><td colspan=5 style='text-align:right;'>Total Bill</td><td style='text-align:center;'> ".number_format($total,2)."</td></tr>";
						echo "<tr><td colspan=5 style='text-align:right;'>Total Balance</td><td style='text-align:center;'>-".number_format(($total-$totalp),2)."</td></tr>";
					?>
				</table>
				<?php } ?>
				
				<table style="margin-top:10px;font-size:12px;margin-bottom:10px;width:100%">
					<tr>
						<td style="width:15%;vertical-align:bottom;text-align:center;margin-top:10px">
							<hr>
							<strong>Prepared By:</strong><br>
							<?php echo $creator[0]; ?>
						</td>
						<td style="width:2%;">&nbsp</td>
						
						<?php echo '<td style="width"15%"><img style="margin-top:10px" alt="testing" src="../resource/tools/barcodes.php?text='.sprintf('%05d', $creation).'&print=true&size=45" /></td>'; ?>
						<td style="width:58%;vertical-align:top;margin-top:10px;border: 1px solid gray;padding:5px;">
							<strong>Remarks:</strong><br>
							<?php if($type[0] == 1 || $type[0] == 2) echo $activity['Comment']; else echo "None."; ?>
						</td>
					</tr>
				</table>
				
				<p style="font-size:10px"><a href="activity.php">Gadget Works Corporation &reg GWC CRM System</a></p>
			</div>
		</div>
	</main>
</body>
			
</html>