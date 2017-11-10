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
		$check = mysqli_query($mysqli, "SELECT * FROM `purchase_head` WHERE `ID` = '$creation'");
		
		if($check AND mysqli_num_rows($check) == 1)
		{
			$transaction = $check->fetch_assoc();
			$creation = $transaction['ID'];
			$creatorID = $transaction['Creator'];
			$termID = $transaction['TermID'];
			
			//Creator
			$creator = mysqli_query($mysqli, "SELECT Name FROM entity WHERE ID = '$creatorID'");
			$creator = mysqli_fetch_row($creator);
			
			//Destination Details
			$destination_ID = $transaction['Destination'];
			$destination_query = mysqli_query($mysqli, "SELECT * FROM `supplier` WHERE `ID` = '$destination_ID'");
			$destination = $destination_query->fetch_assoc();

			$contact_ID = $transaction['ContactID'];
			$contact_query = mysqli_query($mysqli, "SELECT * FROM `contacts` WHERE `SupplierID` = '$destination_ID' LIMIT 1");
			$contact = $contact_query->fetch_assoc();
			
			//Source openssl_pkey_get_details(key)
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
	<title>Receipt | Gadget Works Corporation</title>
	<link rel="shortcut icon" type="image/x-icon" href="../resource/images/favicon.png" />
</head>
<body>
	<main>
		<div style="width:100%;">
			<div style="width:90%;margin-left:auto;margin-right:auto;">
				<table style="width:100%;margin-left:auto;margin-right:auto;">
					<tr>
						<td>
							<p style="display:inline;font-size:70%;font-weight:bold;"><img height ="40%" width ="10%" src="../resource/images/Logo-small.png" alt="Banner Image"/>
							<img height ="30%" width ="40%" src="../resource/images/CompanyTitle.png" alt="Banner Image"/></p><br>
							<p style="display:inline;font-size:70%;">Phone: <?php echo $branch['contact']; ?></p><br>
							<p style="display:inline;font-size:70%;">Address: <?php echo $branch['address']; ?></p><br>
						</td>
						<td style='text-align:right;'>
							<p style='display:inline;font-size:20px;font-weight:bold;'>
								<?php
									$type = mysqli_query($mysqli, "SELECT Type FROM particular_sales AS PS WHERE PS.`Mark` = 1 AND PS.`Sales` = '$creation' LIMIT 1");
									$type = mysqli_fetch_row($type);
									
									if($type[0] == 1) echo "Purchase Order";
									else if($type[0] == 2) echo "Borrowing Slip";
									else if($type[0] == 3) echo "Trust Agreement Receipt";
									else if($type[0] == 4) echo "Borrowed Items Return";
									else if($type[0] == 5) echo "Repair Request";
									else if($type[0] == 6) echo "Release Form";
									else "Transaction Record";
								?>
							</p><br>
							<p style='font-size:22px;display:inline;font-family:courier;'>Transaction No. <font style='color:red'><?php echo sprintf('%05d', $transaction['ID']); ?></font></p>
						</td>
					</tr>
				</table><br>
			
				<?php if($type[0] == 1) { ?>
				
				<table style="font-size:12px;margin-bottom:10px;width:100%" border=0 cellspacing=0>
					<tr><td style="width:15%">VENDOR:</td><td style="border-bottom:solid 1px;"><?php echo $destination['Name']; ?></td><td style="width:0%">&nbsp</td><td style="width:15%">PO DATE:</td><td style="border-bottom:solid 1px;"><?php echo date("F d, Y h:i A", strtotime($transaction['Date'])); ?></td></tr>
					<tr><td>ATTENTION:</td><td style="border-bottom:solid 1px;"><?php echo $contact['Name']; ?><td>&nbsp</td><td>SHIP TO:</td><td style="border-bottom:solid 1px;"><?php echo $branch['address']; ?></td></tr>
					<tr><td>CONTACT MOBILE:</td><td style="border-bottom:solid 1px;"><?php echo $contact['Mobile']; ?></td><td>&nbsp</td><td>DELIVERY DATE:</td><td style="border-bottom:solid 1px;"><?php echo $transaction['DeliveryDate']; ?></td></tr>
					<tr><td>CONTACT LANDLINE:</td><td style="border-bottom:solid 1px;"><?php echo $contact['Landline']; ?></td><td>&nbsp</td><td>TERMS OF PAYMENT:</td><td style="border-bottom:solid 1px;"><?php echo ' '; ?></td></tr>
				</table>
				
				<?php } else if($type[0] == 2 or $type[0] == 3) { ?>
				
				<table style="font-size:12px;margin-bottom:10px;width:100%" border=0 cellspacing=0>
					<tr><td style="width:25%">Date:</td><td style="border-bottom:solid 1px;"><?php echo date("F d, Y h:i A", strtotime($transaction['Date'])); ?></td><td style="width:40%">&nbsp</td></tr>
					<tr><td>Trust Receipt Agreement No.:</td><td style="border-bottom:solid 1px;"><?php echo $transaction['Reference']; ?><td>&nbsp</td></tr>
					<tr><td>Client ID:</td><td style="border-bottom:solid 1px;"><?php echo sprintf('%05d', $destination['ID']); ?></td><td>&nbsp</td></tr>
					<tr><td>Client:</td><td style="border-bottom:solid 1px;"><?php echo $destination['Name']; ?></td><td>&nbsp</td></tr>
					<tr><td>Phone:</td><td style="border-bottom:solid 1px;"><?php echo $destination['Phone']; ?></td><td>&nbsp</td></tr>
					<tr><td>Address:</td><td style="border-bottom:solid 1px;"><?php echo $destination['Address']; ?></td><td>&nbsp</td></tr>
				</table>
				
				<?php } else if($type[0] == 4) { ?>
				
				<table style="font-size:12px;margin-bottom:10px;width:100%" border=0 cellspacing=0>
					<tr><td style="width:25%">Date:</td><td style="border-bottom:solid 1px;"><?php echo date("F d, Y h:i A", strtotime($transaction['Date'])); ?></td><td style="width:40%">&nbsp</td></tr>
					<tr><td>Trust Receipt Agreement No.:</td><td style="border-bottom:solid 1px;"><?php echo $transaction['Reference']; ?><td>&nbsp</td></tr>
					<tr><td>Client ID:</td><td style="border-bottom:solid 1px;"><?php echo sprintf('%05d', $source['ID']); ?></td><td>&nbsp</td></tr>
					<tr><td>Client:</td><td style="border-bottom:solid 1px;"><?php echo $source['Name']; ?></td><td>&nbsp</td></tr>
					<tr><td>Phone:</td><td style="border-bottom:solid 1px;"><?php echo $source['Phone']; ?></td><td>&nbsp</td></tr>
					<tr><td>Address:</td><td style="border-bottom:solid 1px;"><?php echo $source['Address']; ?></td><td>&nbsp</td></tr>
				</table>
				
				<?php } else { ?>
			
				<table style="font-size:12px;margin-bottom:10px;width:100%" border=0 cellspacing=0>
					<tr>
						<td style="width:25%">Date:</td><td style="width:25%;border-bottom:solid 1px;"><?php echo date("F d, Y h:i A", strtotime($transaction['Date'])); ?></td>
						<td style="width:2%;">&nbsp</td>
						<td style="width:23%;">Reference/SI Number:</td><td style="width:25%;border-bottom:solid 1px;"><?php echo $transaction['Reference']; ?></td>
					</tr>
					<tr>
						<td style="width:25%">Source:</td><td style="width:25%;border-bottom:solid 1px;"><?php if($source['ID'] != 200) { echo "[".sprintf('%05d', $source['ID'])."] ".ucwords(strtolower($source['Name'])); } else echo "Supplier: ".$transaction['Comment']; ?></td>
						<td style="width:2%;">&nbsp</td>
						<td style="width:23%">Destination:</td><td style="width:25%;border-bottom:solid 1px;"><?php echo "[".sprintf('%05d', $destination['ID'])."] ".ucwords(strtolower($destination['Name'])); ?></td>
					</tr>
					<tr>
						<td style="width:25%">Source Contact No.</td><td style="width:25%;border-bottom:solid 1px;"><?php echo $source['Phone']; ?></td>
						<td style="width:2%;">&nbsp</td>
						<td style="width:23%">Destination Contact No.</td><td style="width:25%;border-bottom:solid 1px;"><?php echo $destination['Phone']; ?></td>
					</tr>
					<tr>
						<td style="width:25%">Source Address</td><td style="width:25%;border-bottom:solid 1px;"><?php echo $source['Address']; ?></td>
						<td style="width:2%;">&nbsp</td>
						<td style="width:23%">Destination Address</td><td style="width:25%;border-bottom:solid 1px;"><?php echo $destination['Address']; ?></td>
					</tr>				
				</table>
				
				<?php } ?>
				
				<table style="margin-top:10px;font-size:12px;margin-bottom:10px;width:100%" class="bordered">
					<tr style="text-align:center;font-weight:bold;background:#212121;color:white">
						<td style="width:8%">PICTURE</td>
						<td style="width:8%">QUANTITY</td>
						<td style="width:35%">DESCRIPTION</td>
						<td style="width:9%">UNIT PRICE</td>
						<td style="width:9%">TOTAL</td> 
					</tr>
					<?php		 
						$sqlQuery = @"SELECT 
										    PD.`ID`,
										    I.`Description`,
										    PD.`InventoryID`,
										    PD.`PurchaseCost`,
										    PD.`Qty`
										FROM
										    `purchase_detail` AS PD
										        LEFT JOIN
											`inventory` AS I ON I.`ID` = PD.`InventoryID`
										WHERE
										    PD.`HeadID` = '$creation'";
						$result = mysqli_query($mysqli, $sqlQuery);
						//echo("SELECT inventory.ID, Name, Category, Description, Weight, Picture, Amount FROM particular, inventory WHERE particular.Transaction = '$creation' AND inventory.ID = particular.Inventory AND particular.Mark > 0");
						$path = "value";
						for($i=0, $total=0, $cost=0;  $i < mysqli_num_rows($result); $i++)
						{	
							echo '<tr style="text-align:center;">';
							$result->data_seek($i);
			    				$row = $result->fetch_row();
			    				
			    				echo "<tr style='text-align:center'>";
			    				
							//Picture
			    			$path = "../resource/images/inv_image/".sprintf('%d', $row[2]).".png";
							echo '<td><img style="width:70px;" src="'.$path.'"/></td>';
						
							//Quantity
							echo '<td>'.$row[4].'</td>';
			    				
			    			//Item Description
							echo '<td>'.$row[1].'</td>';
							
							//Supplier
							#echo '<td>'.$row[6].'</td>';

							//Unit Price
							echo '<td>'.number_format($row[3],2).'</td>';
							
							//Cost Price
							#echo '<td>'.number_format($row[3] * $row[5],2).'</td>';

							//Selling
							#echo '<td>'.number_format($row[4],2).'</td>';
							
							//Amount
							$total += $row[3] * $row[4];
							 echo '<td>'.number_format($row[3] * $row[4],2).'</td>';
							#$cost += $row[3] * $row[5];
							
							echo '</tr>';
						}
						if(mysqli_num_rows($result) == 0)
						{
							echo "<tr><td colspan=7 style='text-align:center;'>Cart Empty!</td></tr>";
						}
						else
						{

							echo "<tr><tr><td colspan=2  style='text-align:left'><b>TOTAL:</b>&nbsp</td><td style='text-align:center;font-weight:bold'>&#8369 ".number_format($cost,2)."</td><td>&nbsp</td><td style='text-align:center;font-weight:bold'>&#8369 ".number_format($total,2)."</td></tr>";
						}
					?>
				</table>
				
				<?php if($type[0] > 1) { ?>
				<table style="margin-top:10px;font-size:12px;margin-bottom:10px;width:100%" class="bordered">
					<tr style="text-align:center;font-weight:bold;background:#212121;color:white">
						<td style="width:10%">PID</td>
						<td style="width:10%">Type</td>
						<td style="width:25%">Date</td>
						<td style="width:20%">Check Bank</td>
						<td style="width:25%">Check Date</td>
						<td style="width:10%">Amount</td>
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
				<br><br><br>
					<tr>
						<td style="width:15%;vertical-align:bottom;text-align:center;margin-top:10px">
							<hr>
							<strong>Prepared By:</strong><br>
							<?php echo $creator[0]; ?>
						</td>
						<td style="width:2%;">&nbsp</td>
						<td style="width:15%;vertical-align:bottom;text-align:center;margin-top:10px">
							<hr>
							<?php 
								if($type[0] == 1) echo "<strong>Checked By:</strong><br>".$source['Name']; 
								else if($type[0] == 2 or $type[0] == 3 or $type[0] == 4) echo "<strong>Received By:</strong><br>".$destination['Name'];
								else if($type[0] == 5) echo "<strong>Confirmed By:</strong><br>".$source['Name']; 
								else if($type[0] == 6) echo "<strong>Received By:</strong><br>".$destination['Name']; 
							?>
						</td>
						<td style="width:15%;vertical-align:bottom;text-align:center;margin-top:10px">
							<hr>
							<?php 
								if($type[0] == 1) echo "<strong>Approved By:</strong><br>LEO  CARLO DE JESUS<br>General Manager"; 
							?>
						</td>
					</tr>
				</table>
				
				<p style="font-size:10px"><a href="salesorderlist.php">Gadget Works Corporation &reg GWC CRM System</a></p>
			</div>
		</div>
	</main>
</body>
			
</html>