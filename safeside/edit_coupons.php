<?php  
session_start();
$user_name=$_SESSION["adname"];
$adminid=$_SESSION["aid"];
		
if($adminid=="") {
	header("location:index.php");
} 
else { 
	include(__DIR__ . '/../config.php'); 
	
 if (isset($_POST['submit'])) {
	  $coupon_code = $_POST["copoun_code"];
   if(!empty($_POST["start_date"])){$start_date = $_POST['start_date'];}else{$start_date = $_POST['start_dateo'];};
  if(!empty($_POST["end_date"])){$end_date = $_POST['end_date'];}else{$end_date = $_POST['end_dateo'];};
   
    $discount = $_POST["discount"];
   $couponid= $_POST['couponid'];
		$sql = "UPDATE ph_coupons SET coupon_code ='$coupon_code', discount='$discount', start_date='$start_date', end_date='$end_date' WHERE coupon_id='$couponid'";
   if ($conn->query($sql) === TRUE) {
             // echo "New record usr created successfully";
			 $locatoin = 'edit_coupons.php?edit='.$couponid.'&add=true';
        } else {
            // echo "Error: " . $sql . "<br>" . $conn->error;
			  $locatoin = 'edit_coupons.php?edit='.$couponid.'&add=false';
        }
header("location:".$locatoin);

}
$edit  = $_GET['edit'];
include('header.php');
	include('navigation.php');
	include('sidebar.php');
	
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h2 class="page-header">Edit Coupon</h2>
	  
<div class="col-sm-6 ">
<?php 
	 if($_REQUEST['add']=='true'){
      echo '<div class="alert alert-success"><strong>Coupon Update! </strong> Successfully.</div>';
	}
elseif($_REQUEST['add']=='false'){
      echo '<div class="alert alert-danger"><strong> Unable! </strong> to Edit Coupon.</div>';
	}
	
?>
      <?php
	  $sql_uid = "SELECT * FROM ph_coupons WHERE coupon_id='".$edit."'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
				while($row_sb = mysqli_fetch_assoc($result_uid)) {
				$couponcode = $row_sb['coupon_code'];
				$discount = $row_sb['discount'];
				$start_date = $row_sb['start_date'];
				$end_date = $row_sb['end_date'];
				
				
				
				
				 ?>
	 <form id="addcoupon" action="" method="post">
                            <fieldset>
                          	<div class="input-group form-group">
						  <span class="input-group-addon" id="basic-addon1"><span aria-hidden="true" class="glyphicon glyphicon-gift"></span></span>
							<input type="text" name="copoun_code" class="form-control cemail" id="copoun_code" placeholder="Copoun Code" value="<?php  echo $couponcode;?>"/>
						</div>
						<div class="input-group form-group">
						  <span class="input-group-addon" id="basic-addon1"><span aria-hidden="true" class="glyphicon glyphicon-gift"></span></span>
							<select name="discount" id="discount" class="form-control">
							<option <?php if($discount==5){echo 'selected="selected"';} ?> value="5">5%</option>
							<option <?php if($discount==10){echo 'selected="selected"';} ?> value="10">10%</option>
							<option <?php if($discount==15){echo 'selected="selected"';} ?> value="15">15%</option>
							<option <?php if($discount==20){echo 'selected="selected"';} ?> value="20">20%</option>
							<option <?php if($discount==25){echo 'selected="selected"';} ?> value="25">25%</option>
							<option <?php if($discount==30){echo 'selected="selected"';} ?> value="30">30%</option>
							<option <?php if($discount==35){echo 'selected="selected"';} ?> value="35">35%</option>
							</select>
							
						</div>
						<div class="form-group">
						<div class='input-group date' id='datetimepicker3'>
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="start_date" type='text' class="form-control" name="start_date" placeholder="<?php echo $start_date ;?>" value="<?php echo $start_date ;?>"/>
							
						</div>
					</div>
						<div class="form-group">
						<div class='input-group date' id='datetimepicker2'>
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="end_date" type='text' class="form-control" name="end_date" placeholder="<?php echo $end_date;?>" value="<?php echo $end_date;?>" />
							
						</div>
					</div>
					<input type='hidden' class="form-control" name="start_dateo" value="<?php echo $start_date ;?>"/>
					<input type='hidden' class="form-control" name="end_dateo" value="<?php echo $end_date ;?>"/>
						<input type="hidden" name="couponid" value="<?php echo $edit; ?>" />
	                           <input id="submit" type="submit" name="submit" class="btn btn-primary" value="Update Coupon"/>
                            </fieldset>
                        </form>
	 </div>
    </div>
	<?php }			
				} ?>
  </div>
</div>

	 

 <script type="text/javascript">
            $(function () {
                $('#datetimepicker3').datetimepicker();
				$('#datetimepicker3').data("DateTimePicker").format('YYYY-MM-DD');
				$('#datetimepicker3').data("DateTimePicker").minDate();
				$('#datetimepicker2').datetimepicker();
				$('#datetimepicker2').data("DateTimePicker").format('YYYY-MM-DD');
				//$('#datetimepicker2').data("DateTimePicker").minDate(new Date());
				
            });
        </script>
<?php
	include('footer.php');
} 
?>
