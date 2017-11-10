<?php
	$label1 = "Available Inventory";
	$label2 = "Borrowed Inventory";
	$label3 = "Total Value of Available Inventory";
	$label4 = "Total Income This Month";
	
	$value1 = mysqli_query($mysqli, "SELECT COUNT(*) FROM `inventory` WHERE `Mark` = 1");
	$value1 = mysqli_fetch_row($value1); 
	
	$value2 = mysqli_query($mysqli, "SELECT COUNT(*) FROM `inventory` WHERE `Mark` = 4");
	$value2 = mysqli_fetch_row($value2);
	
	$value3 = mysqli_query($mysqli, "SELECT SUM(`Buy`) FROM `inventory` WHERE `Mark` = 1");
	$value3 = mysqli_fetch_row($value3); 
	
	$value4 = mysqli_query($mysqli, "SELECT SUM(Amount) FROM particular, transaction WHERE particular.Type > 1 AND particular.Mark = 1 AND transaction.Mark = 1 AND Transaction = transaction.ID AND MONTH(transaction.Date) = MONTH(CURRENT_DATE())");
	$value4 = mysqli_fetch_row($value4);
	
	$link1 = "inventory.php";
	$link2 = "inventory.php?type=4";
	$link3 = "transactions.php";
	$link4 = "transactions.php";

echo '<div class="row" style="margin-top:0px">
	<div class="col-lg-4 col-md-8">
		<div class="panel panel-primary">
			<div class="panel panel-blue panel-widget ">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-5 widget-left">
						<svg class="glyph stroked tag"><use xlink:href="#stroked-tag"/></svg>
					</div>
					<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large">'.$value1[0].'</div>
						<div class="text-muted">'.$label1.'</div>
					</div>
				</div>
			</div>
			  <a href="'.$link1.'">
				<div class="panel-footer">
					<span class="pull-left">New Transaction</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-4 col-md-8">
		<div class="panel panel-green">
			<div class="panel panel-teal panel-widget">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-5 widget-left">
						<svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
					</div>
					<div class="col-sm-9 col-lg-7 widget-right">
						<div class="medium"><strong>$'.number_format($value3[0],2).'</strong></div>
						<div class="text-muted">'.$label3.'</div>
					</div>
				</div>
			</div>
			 <a href="'.$link3.'">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-4 col-md-8">
		<div class="panel panel-yellow">
			<div class="panel panel-red panel-widget">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-5 widget-left">
						<svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg>
					</div>
					<div class="col-sm-9 col-lg-7 widget-right">
						<div class="medium"><strong>&#8369 '. number_format($value4[0],2).'</strong></div>
						<div class="text-muted">'.$label4.'</div>
					</div>
				</div>
			</div>
			 <a href="'.$link4.'">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
</div>'
?>