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
   $start_date = $_POST["start_date"];
   $end_date = $_POST["end_date"];
   $discount = $_POST["discount"];
  
	$sql_uid = "SELECT * FROM ph_coupons WHERE coupon_code ='$coupon_code'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {  $locatoin = 'add_coupons.php?add=exist';}
			else{
   $sql_nu = "INSERT INTO ph_coupons (coupon_code,discount,start_date,end_date) VALUES ('$coupon_code','$discount','$start_date','$end_date')";
        if ($conn->query($sql_nu) === TRUE) {
             // echo "New record usr created successfully";
			 $locatoin = 'add_coupons.php?add=true';
        } else {
            // echo "Error: " . $sql . "<br>" . $conn->error;
			  $locatoin = 'add_coupons.php?add=false';
        }
		}
header("location:".$locatoin);
}
include('header.php');
	include('navigation.php');
	include('sidebar.php');
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h2 class="page-header">Add Coupon</h2>
	  
<div class="col-sm-6 ">
<?php 
	 if($_REQUEST['add']=='true'){
      echo '<div class="alert alert-success"><strong>Coupon Added! </strong> Successfully.</div>';
	}
elseif($_REQUEST['add']=='false'){
      echo '<div class="alert alert-danger"><strong> Unable! </strong> to Add Coupon.</div>';
	}
	elseif($_REQUEST['add']=='exist'){
      echo '<div class="alert alert-danger"><strong> Coupon! </strong> All ready exist.</div>';
	}
?>
     
	 <form id="addcoupon" action="" method="post">
                            <fieldset>
                          	<div class="input-group form-group">
						  <span class="input-group-addon" id="basic-addon1"><span aria-hidden="true" class="glyphicon glyphicon-gift"></span></span>
							<input type="text" name="copoun_code" class="form-control cemail" id="copoun_code" placeholder="Copoun Code"/>
						</div>
						<div class="input-group form-group">
						  <span class="input-group-addon" id="basic-addon1"><span aria-hidden="true" class="glyphicon glyphicon-gift"></span></span>
							<select name="discount" id="discount" class="form-control">
							<option value="5">5%</option>
							<option value="10">10%</option>
							<option value="15">15%</option>
							<option value="20">20%</option>
							<option value="25">25%</option>
							<option value="30">30%</option>
							<option value="35">35%</option>
							</select>
							
						</div>
						<div class="form-group">
						<div class='input-group date' id='datetimepicker3'>
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="start_date" type='text' class="form-control" name="start_date" placeholder="Coupon Start Date/Time" />
						</div>
					</div>
						<div class="form-group">
						<div class='input-group date' id='datetimepicker2'>
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input id="end_date" type='text' class="form-control" name="end_date" placeholder="Coupon End Date/Time" />
						</div>
					</div>
						
	                           <input id="submit" type="submit" name="submit" class="btn btn-primary" value="Add Coupon"/>
                            </fieldset>
                        </form>
	 </div>
    </div>
  </div>
</div>

	 

 <script type="text/javascript">
            $(function () {
                $('#datetimepicker3').datetimepicker();
				$('#datetimepicker3').data("DateTimePicker").format('YYYY-MM-DD');
				//$('#datetimepicker3').data("DateTimePicker").minDate(new Date());
				$('#datetimepicker2').datetimepicker();
				$('#datetimepicker2').data("DateTimePicker").format('YYYY-MM-DD');
				//$('#datetimepicker2').data("DateTimePicker").minDate(new Date());
				
            });
        </script>
<?php
	include('footer.php');
} 
?>
