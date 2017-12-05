<?php echo $_SESSION["adrole"];
if($_SESSION["adrole"]=='team_member'){?>

    <div class="col-sm-3 col-md-2 sidebar">
      <ul class="nav nav-sidebar">
	  <?php $current_page = basename($_SERVER['PHP_SELF']);?>
	  <li <?php if($current_page=='dashboard.php'){ echo "class='active'" ;}?> ><a href="dashboard.php"><i class="fa fa-dashboard"></i>&nbsp;Dashboard</a></li>
	   <li <?php if($current_page=='assigned_orders_list.php'){ echo "class='active'" ;}?>><a href="assigned_orders_list.php"><i class="fa fa-list-alt"></i>&nbsp;Assigned Orders List</a></li>     
		  <li <?php if($current_page=='comments.php'){ echo "class='active'" ;}?>><a href="comments.php"><i class="fa fa-comments"></i>&nbsp;Comments</a></li>  
       </ul>
	  
    </div>
	<?php }else{?>
	
	    <div class="col-sm-3 col-md-2 sidebar">
      <ul class="nav nav-sidebar">
	  <?php $current_page = basename($_SERVER['PHP_SELF']);?>
	  <li <?php if($current_page=='dashboard.php'){ echo "class='active'" ;}?> ><a href="dashboard.php"><i class="fa fa-dashboard"></i>&nbsp;Dashboard</a></li>
	    <li <?php if($current_page=='users.php'){ echo "class='active'" ;}?> ><a href="users.php"><i class="fa fa-user-secret"></i>&nbsp;Users List</a></li>
         <li <?php if($current_page=='orders.php'){ echo "class='active'" ;}?>><a href="orders.php"><i class="fa fa-list-alt"></i>
&nbsp;Orders List</a></li>     
		  <li <?php if($current_page=='comments.php'){ echo "class='active'" ;}?>><a href="comments.php"><i class="fa fa-comments"></i>&nbsp;Comments</a></li>  
		    <li <?php if($current_page=='coupons.php'){ echo "class='active'" ;}?>><a href="coupons.php"><i class="fa fa-gift"></i>
&nbsp;All Coupons</a></li>  
			<li <?php if($current_page=='add_coupons.php'){ echo "class='active'" ;}?>><a href="add_coupons.php"><span aria-hidden="true" class="glyphicon glyphicon-gift"></span>&nbsp;Add Coupons</a></li>
		   <li <?php if($current_page=='team_members.php'){ echo "class='active'" ;}?>><a href="team_members.php"><i class="fa fa-users"></i>

&nbsp;Team Members</a></li>     
		   <li <?php if($current_page=='add_team_member.php'){ echo "class='active'" ;}?>><a href="add_team_member.php"><i class="fa fa-user-plus"></i>
&nbsp;Add Team Member</a></li>     
       </ul>
	  
    </div>
	<?php } ?>