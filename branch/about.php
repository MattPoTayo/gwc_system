<?php
	ob_start();
	session_start();
	require_once("verify_access.php");
	require_once("../resource/database/hive.php");
	$page_name = "About";
	$page_type = 8;
?>
<html>
        <link href="../resource/graphics/css/sb-admin-2.css" rel="stylesheet">
	<?php require_once("../resource/sections/branch_header.php"); ?>
	<body>
		<?php require_once("../resource/sections/branch_banner.php"); ?>
		<?php require_once("../resource/sections/branch_menu.php"); ?>
		
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
                <?php require_once("../resource/sections/branch_shortcuts.php"); ?>
        		<div class="row" style="margin-top:10px;">
        			<?php
        				if(isset($_SESSION['success'])) { echo "<p class='fsuccess'><img src='../graphics/images/active.png' style='width:10px;'/> ".$_SESSION['success']."</p>"; unset($_SESSION['success']); }
        				else if(isset($_SESSION['error'])) { echo "<p class='ffail'><img src='../graphics/images/delete.png' style='width:10px;'/> ".$_SESSION['error']."</p>"; unset($_SESSION['error']); }
        			?>
        			<div class="col-lg-4">
                                <div class="panel panel-default">
                                        <div class="panel-heading"><i class="fa fa-bell fa-fw"></i>   About GWC CRM and ASP System</div>                                                 
                                        <div class="panel-body">
                                                <div id="main" style="height: 30%;background-position:center;background-repeat:no-repeat;background-image:url('../resource/images/Logo-small.png')">

                                                </div>
                                                System Name: GWC System 1.0<br>
                                                System Version: 1.0.0<br>
                                                Date of Launch: N/A.<br>
                                                Last Day of Coding: N/A<br>
                                                Hosting Plan: N/A<br>
                                                System Developer: Engr. Matthew Tizon <br> 
                                                Team: Team Beta<br>
                                                Barcode System: Code128<br>
                                                Reset Database: <a href="reset_database.php">Reset</a><br><br>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-lg-8">
                                        <div class="panel panel-default">
                                                <div class="panel-heading"><i class="fa fa-bell fa-fw"></i>   Contact Support</div>                                                      
                                                <div class="panel-body">
                                                        For any questions or clarification, please contact us through the following channel:<br><br>
                                                        Text/Viber Message: +63 905 880 0741<br>
                                                        Email: matthew.tizon@gmail.com<br>
                                                        Skype: matt.nelsoft@gmail.com
                                                </div>
                                        </div>
                                </div>
                                
                                <div class="col-lg-8">
                                        <div class="panel panel-default">
                                                <div class="panel-heading"><i class="fa fa-bell fa-fw"></i>   Terms and Condition</div>                                                  
                                                <div class="panel-body">
                                                        This system was first implemented by a freelance developer, later on tranfer all controls and privilages to client company <strong>Gadget Works Corporation</strong>. All upcoming developments will be automatically credited to this company with proper turnover protocols from first provider.<br><br>
                                                        Development can be monitored via git repository hosted <a href="https://github.com/MattPoTayo/gwc_system" target="_blank">here</a>.
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
		
	</body>
</html>