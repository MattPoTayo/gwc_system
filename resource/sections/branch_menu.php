
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<!--<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div> 
		</form>-->
		<ul class="nav menu">
			<li <?php if($page_type==1) echo "class='active'"; ?> ><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg><strong>DASHBOARD</strong></a></li>
			<!--<li <?php #if($page_type==2) #echo "class='active'"; ?> ><a href="users.php"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> USERS</a></li> -->
			<?php 
				$userId = $_SESSION['id']; 
				$checkUser = mysqli_query($mysqli,"SELECT `Code` FROM `user_permission` WHERE `Wid` = '$userId' AND `Code`= '101'");
				$checkClients = mysqli_query($mysqli,"SELECT `Code` FROM `user_permission` WHERE `Wid` = '$userId' AND `Code`= '103'");
				$checkSupplier = mysqli_query($mysqli,"SELECT `Code` FROM `user_permission` WHERE `Wid` = '$userId' AND `Code`= '102'");
				$checkInventory = mysqli_query($mysqli,"SELECT `Code` FROM `user_permission` WHERE `Wid` = '$userId' AND `Code`= '105'");
				$checkTransaction = mysqli_query($mysqli,"SELECT `Code` FROM `user_permission` WHERE `Wid` = '$userId' AND `Code`= '106'");
				$checkPayment = mysqli_query($mysqli,"SELECT `Code` FROM `user_permission` WHERE `Wid` = '$userId' AND `Code`= '104'");
				$checkReports = mysqli_query($mysqli,"SELECT `Code` FROM `user_permission` WHERE `Wid` = '$userId' AND `Code`= '108'");
				$checkCategory = mysqli_query($mysqli, "SELECT `Code` FROM `user_permission` WHERE `Wid` = '$userId' AND `Code`= '109'");
				$checkContact = mysqli_query($mysqli, "SELECT `Code` FROM `user_permission` WHERE `Wid` = '$userId' AND `Code`= '114'");
				$checkManager = mysqli_query($mysqli, "SELECT `Code` FROM `user_permission` WHERE `Wid` = '$userId' AND `Code`= '110'");
				$CheckPurchAcctng = mysqli_query($mysqli, "SELECT `Code` FROM `user_permission` WHERE `Wid` = '$userId' AND `Code`= '116'");
				$CheckGenManager = mysqli_query($mysqli, "SELECT `Code` FROM `user_permission` WHERE `Wid` = '$userId' AND `Code`= '115'");
				$checkBrand = mysqli_query($mysqli, "SELECT `Code` FROM `user_permission` WHERE `Wid` = '$userId' AND `Code` = '117'");
			?>
			<?php if($userId ==253 || $checkUser->num_rows > 0){?>
			<li <?php if($page_type==2) echo "class='active parent'"; else echo "class='parent'"; ?>>
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> USERS  
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="users.php">
							<svg class="glyph stroked dashboard-dial">svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> User List
						</a>
					</li>
					<li>
						<a class="" href="users_new.php">
							<svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"></use></svg> New User
						</a>
					</li>
				</ul>
			</li>
			<?php } ?>	
			<?php  if($userId ==253 || $checkSupplier->num_rows > 0){?>
			<li <?php if($page_type==9) echo "class='active parent'"; else echo "class='parent'"; ?>>
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-8"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> SUPPLIERS
				</a>
				<ul class="children collapse" id="sub-item-8">
					<li>
						<a class="" href="suppliers.php">
							<svg class="glyph stroked laptop computer and mobile"><use xlink:href="#stroked-laptop-computer-and-mobile"/></use></svg> Supplier List
						</a>
					</li>
					<li>
						<a class="" href="suppliers_new.php">
							<svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"></use></svg> Add New Supplier
						</a>
					</li>
					
				</ul>
			</li>	
			<?php } ?>
			<?php  if($userId ==253 || $checkCategory->num_rows > 0){?>
			<li <?php if($page_type==10) echo "class='active parent'"; else echo "class='parent'"; ?>>
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-10"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> CATEGORY
				</a>
				<ul class="children collapse" id="sub-item-10">
					<li>
						<a class="" href="category.php">
							<svg class="glyph stroked laptop computer and mobile"><use xlink:href="#stroked-laptop-computer-and-mobile"/></use></svg> Category List
						</a>
					</li>
					<li>
						<a class="" href="category_new.php">
							<svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"></use></svg> Add New Category
						</a>
					</li>
					
				</ul>
			</li>	
			<?php } ?>
			<?php  if($userId ==253 || $checkClients->num_rows > 0){?>
			<li <?php if($page_type==3) echo "class='active parent'"; else echo "class='parent'"; ?>>
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> CLIENTS 
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li>
						<a class="" href="leads.php">
							<svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg> Leads List
						</a>
					</li>
					<li>
						<a class="" href="clients.php">
							<svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg> Client List
						</a>
					</li>
					<li>
						<a class="" href="clients_new.php">
							<svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"></use></svg> Add New Client
						</a>
					</li>
				</ul>
			</li>	
			<?php } ?>
			<?php  if($userId ==253 || $checkBrand->num_rows > 0){?>
			<li <?php if($page_type==11) echo "class='active parent'"; else echo "class='parent'"; ?>>
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-11"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> BRAND
				</a>
				<ul class="children collapse" id="sub-item-11">
					<li>
						<a class="" href="brand.php">
							<svg class="glyph stroked laptop computer and mobile"><use xlink:href="#stroked-laptop-computer-and-mobile"/></use></svg> Brand List
						</a>
					</li>
					<li>
						<a class="" href="brand_new.php">
							<svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"></use></svg> Add New Brand
						</a>
					</li>
					
				</ul>
			</li>	
			<?php } ?>
			<?php  if($userId ==253 || $checkContact->num_rows > 0){?>
			<li <?php if($page_type==12) echo "class='active parent'"; else echo "class='parent'"; ?>>
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-12"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> CONTACTS
				</a>
				<ul class="children collapse" id="sub-item-12">
					<li>
						<a class="" href="contacts.php?type=0">
							<svg class="glyph stroked laptop computer and mobile"><use xlink:href="#stroked-laptop-computer-and-mobile"/></use></svg> Supplier Contact List
						</a>
					</li>
					<li>
						<a class="" href="contacts.php?type=1">
							<svg class="glyph stroked laptop computer and mobile"><use xlink:href="#stroked-laptop-computer-and-mobile"/></use></svg> Clients Contact List
						</a>
					</li>
					<li>
						<a class="" href="#">
							<svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"></use></svg> Add Contact
						</a>
					</li>
				</ul>
			</li>	
			<?php } ?>
			<?php  if($userId ==253 || $checkInventory->num_rows > 0){?>
			<li <?php if($page_type==4) echo "class='active parent'"; else echo "class='parent'"; ?>>
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-3"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> INVENTORY
				</a>
				<ul class="children collapse" id="sub-item-3">
					<li class="active">
						<a class="" href="inventory.php">
							<svg class="glyph stroked tag"><use xlink:href="#stroked-tag"/></svg> Available Inventory
						</a>
					</li>
					<li>
						<a class="" href="inventory.php?type=3">
							<svg class="glyph stroked flag"><use xlink:href="#stroked-flag"/></svg> Sold Inventory
						</a>
					</li>
					<li>
						<a class="" href="inventory.php?type=5">
							<svg class="glyph stroked chain"><use xlink:href="#stroked-chain"/></svg> Repair Requests
						</a>
					</li>
					<li>
						<a class="" href="inventory.php?type=6">
							<svg class="glyph stroked upload"><use xlink:href="#stroked-upload"/></svg> Repair Released
						</a>
					</li>
					<li>
						<a class="" href="inventory_all.php">
							<svg class="glyph stroked desktop"><use xlink:href="#stroked-desktop"/></svg> All Inventory
						</a>
					</li>
				</ul>
			</li>	
			<?php } ?>
			<?php  if($userId ==253 || $checkTransaction->num_rows > 0){?>
			<li <?php if($page_type==5) echo "class='active parent'"; else echo "class='parent'"; ?>>
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-4"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> TRANSACTION
				</a>
				<ul class="children collapse" id="sub-item-4">
					<li>
						<a class="" href="transactions.php">
							<svg class="glyph stroked tag"><use xlink:href="#stroked-tag"/></svg> Add Inventory List
						</a>
					</li>
					<li>
						<a class="" href="salesorderlist.php">
							<svg class="glyph stroked tag"><use xlink:href="#stroked-tag"/></svg> Sales Order List
						</a>
					</li>
					
					<li class="parent">
						<a href="#">
							<span data-toggle="collapse" href="#sub-item-5"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Record / Sell Item
						</a>
						<ul class="children collapse" id="sub-item-5">
							<li>
							<a class="" href="t_receiving.php">
								<svg class="glyph stroked download"><use xlink:href="#stroked-download"/></svg> Record (Add)
							</a>
							</li>
							<li>
							<a class="" href="create_salesorder.php">
								<svg class="glyph stroked upload"><use xlink:href="#stroked-upload"/></svg> Create Sales Order
							</a>
							</li>
						</ul>
					</li>
				</ul>
			</li>	
			<?php } ?>
			<?php  if($userId ==253 || $checkPayment->num_rows > 0){?>
			<li <?php if($page_type==7) echo "class='active parent'"; else echo "class='parent'"; ?>>
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-9"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> PAYMENTS
				</a>
				<ul class="children collapse" id="sub-item-9">
					<li>
						<a class="" href="payments.php">
							<svg class="glyph stroked table"><use xlink:href="#stroked-table"/></svg> Payment List
						</a>
					</li>
					<li>
						<a class="" href="payments_new.php">
							<svg class="glyph stroked paperclip"><use xlink:href="#stroked-paperclip"/></svg> New Payment
						</a>
					</li>
				</ul>
			</li>	
			<?php } ?>
			<?php  if($userId ==253 || $checkReports->num_rows > 0){?>
			<li <?php if($page_type==13) echo "class='active parent'"; else echo "class='parent'"; ?>>
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-13"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg></span> REPORTS
				</a>
				<ul class="children collapse" id="sub-item-13">
					<li>
						<a class="" href="activity.php">
							<svg class="glyph stroked tag"><use xlink:href="#stroked-tag"/></svg> Activity List
						</a>
					</li>
					<li>
						<a class="" href="add_report.php">
							<svg class="glyph stroked map"><use xlink:href="#stroked-map"/></svg> Add Daily Report
						</a>
					</li>
				</ul>
			</li>	
			<?php } ?>
			<?php if($userId ==253 || $checkManager->num_rows > 0){?>
			<li <?php if($page_type==14) echo "class='active parent'"; else echo "class='parent'"; ?>>
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-14"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg></span> MANAGER'S VIEW
				</a>
				<ul class="children collapse" id="sub-item-14">
					<li>
						<a class="" href="team_activity.php">
							<svg class="glyph stroked tag"><use xlink:href="#stroked-tag"/></svg> Team Activity List
						</a>
					</li>
					<li>
						<a class="" href="team_clients.php">
							<svg class="glyph stroked map"><use xlink:href="#stroked-map"/></svg> Team Client List
					</li>
				</ul>
			</li>	
			<?php } ?>
			<li role="presentation" class="divider"></li>
			<li  <?php if($page_type==8) echo "class='active'"; ?>><a href="about.php"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> ABOUT</a></li>
		</ul>
	</div><!--/.sidebar-->