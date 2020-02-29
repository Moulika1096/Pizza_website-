<?php
	require_once('header.php');
?>

<?php
	if(is_employee_loggedin()){

		$employee_data=get_employee_data();
		$designation=$employee_data['employee_designation'];
		if($designation=='chef'){




if (isset($_POST['update_time'])) {
	
	$order_id=$_POST['order_id'];
	$time=$_POST['time'];

	$update_time=update_time([

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
			      <a class="nav-link" href="chef.php">Menu</a>
			    </li>
			    <li class="nav-item">
			      <a class="nav-link" href="update_menu.php">Update Menu</a>
			    </li>
			    <li class="nav-item active">
			      <a class="nav-link" href="chef_orders.php">orders</a>
			    </li>
			     <li class="nav-item">
			      <a class="nav-link" href="groceries.php">Groceries</a>
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
  
$get_customer_order_data=get_chef_order_data();
if($get_customer_order_data){
  foreach ($get_customer_order_data as $orders_data) {

$order_id=$orders_data['order_id'];
$image=$orders_data['image'];
$name=$orders_data['name'];
$discription=$orders_data['discription'];
$first_name=$orders_data['first_name'];
$last_name=$orders_data['last_name'];
$price=$orders_data['total_price'];    
$time=$orders_data['time'];
$unsigned_time=$orders_data['unsigned_time'];

$coupon_availed=$orders_data['coupon_availed'];
if ($coupon_availed=='0') {
	$coupon="No coupon used";
}
else{
	$coupon="Customer availed couppon of ".$coupon_availed;
}
echo $order_id;

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
				<form method="post">

					<input type="hidden" name="order_id" value="<?php echo $order_id;?>">

<?php
					if ($unsigned_time==0) {
?>
						<input type="text" name="time" placeholder="Assign time" class="assign_time" autofocus="true">
						<br><br>
<?php
					}

					else{
?>
						<p><?php echo $unsigned_time?></p>
<?php

					}

?>

				<h4>Coupon Availed:</h4>
				<p><?php echo $coupon; ?></p>

				<input type="submit" name="update_time" value="update" class="chef_btn">
				</form>
			</div>
			
		</div>
	</div>

<?php
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

