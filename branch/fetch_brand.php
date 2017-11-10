<?php
	require_once("../resource/database/hive.php");
	$output = '';
	$sql = "SELECT 
		    B.`ID` AS 'ID', B.`Name` AS 'Name'
 		FROM
		    `brand` AS B
		        LEFT JOIN
		    `supplier_brand` AS SB ON SB.`BrandID` = B.`ID`
		        LEFT JOIN
		    `supplier` AS S ON S.`ID` = SB.`SupplierID`
		WHERE
		    S.`ID` = '".$_POST["entityId"]."'";
	$result = mysqli_query($mysqli,$sql);
	$output = '<option value="">Select Brand</option>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '<option value="'.$row["ID"].'">'.$row["Name"].'</option>';
	}
	echo $output;	
?>