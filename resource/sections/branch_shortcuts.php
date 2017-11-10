<div class="row">
	<ol class="breadcrumb">
		<li><a href="logout.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li class="active">Add Shortcuts:</li>
		<?php  if($userId ==253 || $checkReports->num_rows > 0){?>
			<li class="active"><a href="add_report.php">Daily Report</a></li>
		<?php } ?>
		<?php  if($userId ==253 || $checkClients->num_rows > 0){?>
			<li class="active"><a href="clients.php">Client</a></li>
		<?php } ?>
		<?php  if($userId ==253 || $checkSupplier->num_rows > 0){?>
			<li class="active"><a href="suppliers.php"> Supplier</a></li>
		<?php } ?>
		<?php  if($userId ==253 || $checkInventory->num_rows > 0){?>
			<li class="active"><a href="inventory.php"> Item</a></li>
		<?php } ?>	
		<?php  if($userId ==253 || $checkPayment->num_rows > 0){?>
			<li class="active"><a href="payments.php">Payment</a></li>
		<?php } ?>
		<?php if($userId ==253 || $checkTransaction->num_rows >0 && ($CheckPurchAcctng->num_rows <= 0)){?>
			<li class="active"><a href="create_salesorder.php">Sales Order</a></li>
		<?php } ?>
		<?php if($userId == 253 || $CheckPurchAcctng->num_rows>0){?>
			<li class="active"><a href="purchasing_view.php">Sales Request</a></li>
		<?php } ?>
		<?php if($userId == 253 || $CheckGenManager->num_rows>0){?>
			<li class="active"><a href="gm_view.php">General Manager Module</a></li>
		<?php } ?>
	</ol>
</div><!--/.row-->