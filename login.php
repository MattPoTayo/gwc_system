<?php 
	ob_start(); 
	$page_name = "Login";
	$page_section = 0; //Login Page
	require_once("resource/sections/head_login.php");
	session_start();
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Forms</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in</div>
				<div class="panel-body">
					<form role="form">
						<fieldset>
						<div>
						<?php
							require_once("resource/database/hive.php");
							
							if(isset($_SESSION['success'])) { echo "<p class='fsuccess'>".$_SESSION['success']."</p>"; unset($_SESSION['success']); }
							else if(isset($_SESSION['fail'])) { echo "<p class='ffail'>".$_SESSION['fail']."</p>"; unset($_SESSION['fail']); }
							
							$username = "";
							$password = "";
							
							if($_POST)
							{
								$username = $mysqli->real_escape_string($_POST['email']);
								$password = $mysqli->real_escape_string(md5 ($_POST['password']));
								#echo(md5($_POST['password']));
								$user = mysqli_query($mysqli, "SELECT * FROM entity WHERE `Username` = '$username' AND `Password` = '$password' AND `Mark` = 1");
								
								if(!$user or mysqli_num_rows($user) != 1) 
								{
									echo "<p class='ffail'>Invalid user details!</p>";	
								}				
								else
								{
									$session_data = $user->fetch_assoc();
									$_SESSION['id'] =  $session_data['ID'];
									$_SESSION['name'] = $session_data['Name'];
									
									ob_end_clean();
									header("location:homepage.php");
								}
							}
						?>
					</div>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Remember Me
								</label>
							</div>
							<a href="index.html" class="btn btn-primary">Login</a>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
		

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
