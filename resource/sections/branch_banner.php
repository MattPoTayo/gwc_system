<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php"><img src="/resource/images/gwbannerlogo2.png" height="30" alt="Banner Image"/></a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<?php 
							require_once("../resource/database/hive.php");
							date_default_timezone_set ('Asia/Taipei');
							$date_today = date("Y-m-d");
							$time_now = date("Y-m-d H:i:s");
							
							$userID = $_SESSION['id'];
							
							$myname = mysqli_query($mysqli, "SELECT `Name` FROM `entity` WHERE `ID` = '$userID'");
							$myname = mysqli_fetch_row($myname);
							$userName = $myname[0];
							
							echo $date_today.' (<span id="clock"><script type="text/javascript">startclock();</script></span>) | Logged In as <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>'.$userName.'<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="about_profile.php"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
							<li><a href="logout.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>'; 
						?>
						
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>