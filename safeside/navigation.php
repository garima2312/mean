<?php echo $_SESSION["adrole"];
if($_SESSION["adrole"]=='team_member'){?>
<!-- Static navbar -->
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
			<a href="<?php echo $domain; ?>" class="pull-left ad_logo"><img width="80" height="auto" alt="psd2html5" class="dark-logo" src="../img/logo-light.svg"> </a>
             <a class="navbar-brand" >Welcome : <?php echo $user_name; ?> </a> 

          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right top_links">
	    <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>&nbsp;Dashboard</a></li>
         <li><a href="assign_orders_list.php"><i class="fa fa-list-alt"></i>&nbsp;Assigned Orders List</a></li> 
		 <li><a href="comments.php"><i class="fa fa-comments"></i>&nbsp;Comments List</a></li>     
       </ul>
	   <form class="navbar-form navbar-right">
	   <a href="profile.php?user=<?php echo $_SESSION["aid"];?>" class="btn btn-primary" role="button"> <i class="fa fa-user-secret"></i> Profile</a> 
            <a href="logout.php" class="btn btn-primary" role="button"> <i class="fa fa-sign-out fa-fw"></i> Logout</a> 
          </form>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
<?php }else{?>
<!-- Static navbar -->
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
			<a href="<?php echo $domain; ?>" class="pull-left ad_logo"><img width="80" height="auto" alt="psd2html5" class="dark-logo" src="../img/logo-light.svg"> </a>
             <a class="navbar-brand" >Welcome : <?php echo $user_name; ?> </a> 

          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right top_links">
	    <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>&nbsp;Dashboard</a></li>
	    <li><a href="users.php"><i class="fa fa-user-secret"></i>&nbsp;Users List</a></li>
         <li><a href="orders.php"><i class="fa fa-list-alt"></i>&nbsp;Orders List</a></li> 
		 <li><a href="comments.php"><i class="fa fa-comments"></i>&nbsp;Comments List</a></li>     
		  <li><a href="coupons.php"><i class="fa fa-gift"></i>&nbsp;All Coupons</a></li>  
			<li><a href="add_coupons.php"><span aria-hidden="true" class="glyphicon glyphicon-gift"></span>&nbsp;Add Coupons</a></li>
		   <li><a href="team_members.php"><i class="fa fa-users"></i>&nbsp;Team Members</a></li>     
		   <li><a href="add_team_member.php"><i class="fa fa-user-plus"></i>&nbsp;Add Team Member</a></li>     
       </ul>
	   <form class="navbar-form navbar-right">
	            <a href="profile.php?user=<?php echo $_SESSION["aid"];?>" class="btn btn-primary" role="button"> <i class="fa fa-user-secret"></i> Profile</a> 
            <a href="logout.php" class="btn btn-primary" role="button"> <i class="fa fa-sign-out fa-fw"></i> Logout</a> 
          </form>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
<?php } ?>
	
	
	