<?php
	require_once('header.php');
?>

<?php
	if(is_employee_loggedin()){

		$employee_data=get_employee_data();
		$designation=$employee_data['employee_designation'];
		if($designation=='admin'){




if (isset($_POST['chef'])) {
	
	$order_id=$_POST['order_id'];

	$forward_to_chef=forward_to_chef($order_id);

	if ($forward_to_chef) {
		$info= true;
        $info="Order Forwaded";
	}

}

if (isset($_POST['update_time'])) {
	$order_id=$_POST['order_id'];
	$time=$_POST['new_time'];

	$update_time=update_new_time([

		'order_id'=>$order_id,
		'time'=>$time
	]);


	if ($update_time) {
		$info= true;
        $info="Time Updated";
	}
}
?>

<nav class="navbar navbar-expand-md navbar-dark">
	<div class="container">

		<a class="navbar-brand" href="index.html">
			<span class="flaticon-pizza"><img src="images/pizza.svg"></span>Pizza<br>
			<small>Delicous</small>
		</a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
		  <span class="navbar-toggler-icon"></span>Menu
		</button>

		<div class="collapse navbar-collapse" id="collapsibleNavbar">
		  	<ul class="navbar-nav ml-auto">
			    <li class="nav-item">
			      <a class="nav-link" href="admin.php">Menu</a>
			    </li>
			    <li class="nav-item active">
			      <a class="nav-link" href="#">View Orders</a>
			    </li>
			    <li class="nav-item">
			      <a class="nav-link" href="generate_coupons.php">Generate Coupons</a>
			    </li>
			    
			    <li class="nav-item dropdown">
		     		<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
		        		<?php echo $designation; ?>
		      		</a>
		      		<div class="dropdown-menu">
		        		<a class="dropdown-item" href="logout.php">logout</a>
		      		</div>
		    	</li>
		  	</ul>
		</div>  
	</div>
</nav>


<div class="menu_background">
	<div class="menu_background_overlay">
		
	</div>
	
	<div class="menu_background_content">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					
				</div>
				<div class="col-md-6">
					<h1>MY ORDERS</h1>
					<p><a href="index.php">HOME </a> <a href="#"> ORDERS</a></p>
				</div>
				<div class="col-md-3">
					
				</div>
			</div>
		</div>
	</div>
</div>


<div class="menu" id="menu">
	<div class="container">

		<div class="menu_heading">
			<h1>ORDERS</h1>
		</div>
		<div class="row">


<?php
  
$get_customer_order_data=get_admin_order_data();
if($get_customer_order_data){
  foreach ($get_customer_order_data as $orders_data) {

$order_id=$orders_data['order_id'];
$image=$orders_data['image'];
$name=$orders_data['name'];
$discription=$orders_data['discription'];
$first_name=$orders_data['first_name'];
$last_name=$orders_data['last_name'];
$price=$orders_data['total_price']; 
$unsigned_time=$orders_data['unsigned_time'];   
$time=$orders_data['time'];
if ($time=='0') {
	$time="Time not assigned";
}

$coupon_availed=$orders_data['coupon_availed'];
if ($coupon_availed=='0') {
	$coupon="No coupon used";
}
else{
	$coupon="Customer availed couppon of ".$coupon_availed;
}
echo $order_id;

if($unsigned_time==0 && $time==0){
?>

	<div class="col-md-12">
		<div class="row show_orders_container">

			<div class="col-md-6 show_orders_col1">
				<img src="<?php echo $image; ?>">
				<h1><?php echo $name; ?></h1>
				<p><?php echo $discription; ?></p>
			</div>
			<div class="col-md-6 show_orders_col2">
				<h4>Name:</h4>
				<p style="text-transform: uppercase;"><?php echo $first_name." ".$last_name;?></p>

				<h4>Total price</h4>
				<p><?php echo $price?></p>

				<h4>time:</h4>
				<p><?php echo $time; ?></p>

				<h4>Coupon Availed:</h4>
				<p><?php echo $coupon; ?></p>

				<form method="post">
					<input type="hidden" name="order_id" value="<?php echo $order_id;?>">


<?php

	$select_order="SELECT * FROM `orders` WHERE order_id=$order_id";

	$result=$conn->query($select_order);

		if($result->num_rows > 0)
		{
				while($row=$result->fetch_assoc())
			{ 		
			$forward_to_chef=$row['admin_forward'];
			if ($forward_to_chef==1) {
?>
			<input type="submit" name="chef" value="Forward to chef" class="chef_btn" disabled style="cursor: not-allowed;">
<?php
			}
			else{

?>
			<input type="submit" name="chef" value="Forward to chef" class="chef_btn">
<?php		

			}	
			}

		}
?>
				</form>
			</div>
			
		</div>
	</div>

<?php
		}

		else if ($unsigned_time!=0 && $time==0) {

?>


	<div class="col-md-12">
		<div class="row show_orders_container">

			<div class="col-md-6 show_orders_col1">
				<img src="<?php echo $image; ?>">
				<h1><?php echo $name; ?></h1>
				<p><?php echo $discription; ?></p>
			</div>
			<div class="col-md-6 show_orders_col2">
				<h4>Chef updated order time press update to inform Customer</h4><br>
				<h4>Name:</h4>
				<p style="text-transform: uppercase;"><?php echo $first_name." ".$last_name;?></p>

				<h4>Total price</h4>
				<p><?php echo $price?></p>

				<h4>time:</h4>
				<p><?php echo $unsigned_time; ?></p>

				<h4>Coupon Availed:</h4>
				<p><?php echo $coupon; ?></p>

				<form method="post">
					<input type="hidden" name="order_id" value="<?php echo $order_id;?>">
					<input type="hidden" name="new_time" value="<?php echo $unsigned_time;?>">


<?php

	$select_order="SELECT * FROM `orders` WHERE order_id=$order_id";

	$result=$conn->query($select_order);

		if($result->num_rows > 0)
		{
				while($row=$result->fetch_assoc())
			{ 		
			$time=$row['time'];
			if ($time==1) {
?>
			<input type="submit" name="update_time" value="Update Time" class="chef_btn" disabled style="cursor: not-allowed;">
<?php
			}
			else{

?>
			<input type="submit" name="update_time" value="Update Time" class="chef_btn">
<?php		

			}	
			}

		}
?>
				</form>
			</div>
			
		</div>
	</div>

<?php
		}

	else if ($time!=0) {

?>


	<div class="col-md-12">
		<div class="row show_orders_container">

			<div class="col-md-6 show_orders_col1">
				<img src="<?php echo $image; ?>">
				<h1><?php echo $name; ?></h1>
				<p><?php echo $discription; ?></p>
			</div>
			<div class="col-md-6 show_orders_col2">
				
				<h4>Name:</h4>
				<p style="text-transform: uppercase;"><?php echo $first_name." ".$last_name;?></p>

				<h4>Total price</h4>
				<p><?php echo $price?></p>

				<h4>time:</h4>
				<p><?php echo $unsigned_time; ?></p>

				<h4>Coupon Availed:</h4>
				<p><?php echo $coupon; ?></p>


			</div>
			
		</div>
	</div>

<?php
		}
	
	}
}
else{
?>
	
	<div class="no_menu">
		<p>No order yet!</p>
	</div>

<?php
	;
}


?>

			
			
		</div>
	</div>
</div>



	<!-- error div -->

	<?php if(isset($errors) && $errors){ ?>
		<div class="show-errors">
			<div class="errors" id="errors">
				<?php

					echo $echo;

				?>
					
			</div>
		</div>
	<?php } ?>

	<!-- Info Div  -->

  	<?php if(isset($info) && $info){ ?>
    	<div class="show-info">
      	<div class="info" id="info">
        	<?php

          	echo $info;

        	?>
          
      	</div>
    	</div>
  	<?php } ?>


<?php
	require_once('footer.php');
?>





<?php
			
		}

		else{
			header('Location: index.php');
			die();
		}
	}



?>

