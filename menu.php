<?php
	require_once('header.php');
?>
<?php
	$user_data=get_customer_data();
?>
<?php 
	if(is_employee_loggedin()){

		$employee_data=get_employee_data();
		$designation=$employee_data['employee_designation'];
		if($designation=='manager'){
			header('Location: manager.php');
			die();
		}
		else if($designation=='chef'){
			header('Location: chef.php');
			die();
		}
		else if($designation=='admin'){
			header('Location: admin.php');
			die();
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
			      <a class="nav-link" href="index.php">Home</a>
			    </li>
			    <li class="nav-item active">
			      <a class="nav-link" href="menu.php">Menu</a>
			    </li>
			    
			    <li class="nav-item dropdown">
		     		<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
		        		<?php echo $employee_data['first_name'];?>
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
					<h1>OUR MENU</h1>
					<p><a href="index.php">HOME </a> <a href="#"> MENU</a></p>
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
			<h1>Menu</h1>
		</div>
		<div class="row">


<?php
  
  $get_menu_data=get_menu_data();

if($get_menu_data){
  foreach ($get_menu_data as $menu_data) {

    $item_id =$menu_data['id'];
    $menu_disc =$menu_data['discription'];
    $name=$menu_data['name'];
    $price=$menu_data['price'];
    $image=$menu_data['image'];


?>


			<div class="col-md-6">
				<div class="row menu_row_inner">
					<div class="col-md-6 menu_image">
						<img src="<?php echo $image;?>">
					</div>
					<div class="col-md-6 menu_disc">
						<div class="menu_disc_container">
							<h1><?php echo $name; ?></h1>
							<p><?php echo $menu_disc; ?></p>
						</div>
						<div class="row menu_price_container">
							<div class="col-md-4 menu_price">
								<?php echo $price; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php
	}
}
else{
?>
	
	<div class="no_menu">
		<p>sorry! no item is present in menu</p>
	</div>

<?php
	;
}


?>

			
			
		</div>
	</div>
</div>




<div class="footer">
	<div class="container">
		<div class="row">

			<div class="col-md-4">
				<div class="footer_1_text_conatiner">
					<h1>ABOUT US</h1>
					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
				</div>
				<div class="row icon_row">
					<div class="col-md-4">
						<div class="icon_container">
							<i class='fab fa-twitter'></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="icon_container">
							<i class='fab fa-facebook-f'></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="icon_container">
							<i class='fab fa-instagram'></i>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 service">
				<div class="footer_2_text_conatiner">
					<h1>SERVICES</h1>
					<ul>
						<li><a href="">Cooked</a></li>
						<li><a href="">Deliver</a></li>
						<li><a href="">Quality</a></li>
						<li><a href="">Foods</a></li>
						<li><a href="">Mixed</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-4 ">
				<div class="footer_3_text_conatiner">
					<h1>HAVE A QUESTION?</h1>
					<ul>
						<li>
							<i class='fas fa-map-marker-alt'></i><span>203 Fake St. Mountain View, San Francisco, California, USA</span>
						</li>
						<li>
							<i class='fas fa-phone'></i><span> +2 392 3929 210</span>
						</li>
						<li>
							<i class="material-icons">email</i><span>info@yourdomain.com</span>
						</li>
					</ul>
				</div>
			</div>
			
		</div>


	</div>
	
</div>

<?php
	}

	else if(is_customer_loggedin()){

		$user_data=get_customer_data();

		$_SESSION['loggedin_user_id']=$user_data['id'];

		$loggedin_customer_id=$user_data['id'];
?>


<?php


	if (isset($_POST['order'])) {


		if(isset($_SESSION['coupon_price'])){
			$user_id=$_POST['user_id'];
			$item_id=$_POST['item_id'];
			$price=$_POST['price'];
			$price=ltrim($price, '$'); 
			$coupon_price=$_SESSION['coupon_price'];
			$coupon_price=ltrim($coupon_price, '$'); 



			$total_price=$price-$coupon_price;

			$place_order=place_order(
				[
					'user_id'=>$user_id,
					'item_id'=>$item_id,
					'price'=>$total_price,
					'token_availed'=>$coupon_price
				]
			);

			if ($place_order==true) {
				$info= true;
	          	$info="Order placed!! We will soon inform you about time required";
			}
		}
		else{
			$user_id=$_POST['user_id'];
			$item_id=$_POST['item_id'];
			$price=$_POST['price'];

			$place_order=place_order(
				[
					'user_id'=>$user_id,
					'item_id'=>$item_id,
					'price'=>$price,
					'token_availed'=>0
				]
			);

			if ($place_order==true) {
				$info= true;
	          	$info="Order placed!! We will soon inform you about time required";
			}
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
			      <a class="nav-link" href="index.php">Home</a>
			    </li>
			    <li class="nav-item active">
			      <a class="nav-link" href="menu.php">Menu</a>
			    </li>
			    <li class="nav-item">
			      <a class="nav-link" href="customer_orders.php">Orders</a>
			    </li>
			    <li class="nav-item">
			      <a class="nav-link view_orders" href="customer_coupons_notification.php"><i class="fas fa-bell"></i></a><span class="count"></span>
			    </li>
			    
			    <li class="nav-item dropdown">
		     		<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
		        		<?php echo $user_data['first_name'];?>
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
					<h1>OUR MENU</h1>
					<p><a href="index.php">HOME </a> <a href="#"> MENU</a></p>
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
			<h1>Menu</h1>
		</div>
		<div class="row">


<?php
  
  $get_menu_data=get_menu_data();

if($get_menu_data){
  foreach ($get_menu_data as $menu_data) {

    $item_id =$menu_data['id'];
    $menu_disc =$menu_data['discription'];
    $name=$menu_data['name'];
    $price=$menu_data['price'];
    $image=$menu_data['image'];


?>


			<div class="col-md-6">
				<div class="row menu_row_inner">
					<div class="col-md-6 menu_image">
						<img src="<?php echo $image;?>">
					</div>
					<div class="col-md-6 menu_disc">
						<div class="menu_disc_container">
							<h1><?php echo $name; ?></h1>
							<p><?php echo $menu_disc; ?></p>
						</div>
						<div class="row menu_price_container">
							<div class="col-md-4 menu_price">
								<?php echo $price; ?>
							</div>
							<div class="col-md-4">
								<form method="post">

									<input type="hidden" name="item_id" value="<?php echo $item_id; ?>">

									<input type="hidden" name="user_id" value="<?php echo $loggedin_customer_id; ?>">

									<input type="hidden" name="price" value="<?php echo $price; ?>">

									<input class="btn btn-white btn-outline-white menu_order_button" type="submit" name="order" value="Order">

								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php
	}
}
else{
?>
	
	<div class="no_menu">
		<p>sorry! no item is present in menu</p>
	</div>

<?php
	;
}


?>

			
			
		</div>
	</div>
</div>




<div class="footer">
	<div class="container">
		<div class="row">

			<div class="col-md-4">
				<div class="footer_1_text_conatiner">
					<h1>ABOUT US</h1>
					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
				</div>
				<div class="row icon_row">
					<div class="col-md-4">
						<div class="icon_container">
							<i class='fab fa-twitter'></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="icon_container">
							<i class='fab fa-facebook-f'></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="icon_container">
							<i class='fab fa-instagram'></i>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 service">
				<div class="footer_2_text_conatiner">
					<h1>SERVICES</h1>
					<ul>
						<li><a href="">Cooked</a></li>
						<li><a href="">Deliver</a></li>
						<li><a href="">Quality</a></li>
						<li><a href="">Foods</a></li>
						<li><a href="">Mixed</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-4 ">
				<div class="footer_3_text_conatiner">
					<h1>HAVE A QUESTION?</h1>
					<ul>
						<li>
							<i class='fas fa-map-marker-alt'></i><span>203 Fake St. Mountain View, San Francisco, California, USA</span>
						</li>
						<li>
							<i class='fas fa-phone'></i><span> +2 392 3929 210</span>
						</li>
						<li>
							<i class="material-icons">email</i><span>info@yourdomain.com</span>
						</li>
					</ul>
				</div>
			</div>
			
		</div>


	</div>
	
</div>



<!-- <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  var OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "f5dfe7fb-a694-4bb3-8551-3a4881747069",
    });
  });
</script> -->

<script>
$(document).ready(function(){
 
 function load_coupon_ntfcn(view = '')
 {
  $.ajax({
   url:"coupons_ntfcn.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
load_coupon_ntfcn();
 
 $(document).on('click', '.view_orders', function(){
  $('.count').html('');
  load_coupon_ntfcn('yes');
 });
 
 setInterval(function(){ 
  load_coupon_ntfcn();; 
 }, 5000);
 
});
</script>


<?php
		
	} 
	else{
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
			      <a class="nav-link" href="#">Home</a>
			    </li>
			    <li class="nav-item active">
			      <a class="nav-link" href="menu.php">Menu</a>
			    </li>

		    	<li class="nav-item dropdown">
		     		<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
		        		Login
		      		</a>
		      		<div class="dropdown-menu">
		        		<a class="dropdown-item" href="login_employee.php">Employee</a>
		        		<a class="dropdown-item" href="login_customer.php">Customer</a>
		      		</div>
		    	</li>
			    <li class="nav-item dropdown">
		     		<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
		        		Signup
		      		</a>
		      		<div class="dropdown-menu">
		        		<a class="dropdown-item" href="signup_employee.php">Manager</a>
		        		<a class="dropdown-item" href="signup_customer.php">Customer</a>
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
					<h1>OUR MENU</h1>
					<p><a href="index.php">HOME </a> <a href="#"> MENU</a></p>
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
			<h1>Menu</h1>
		</div>
		<div class="row">


<?php
  
  $get_menu_data=get_menu_data();

if($get_menu_data){
  foreach ($get_menu_data as $menu_data) {

    $item_id =$menu_data['id'];
    $menu_disc =$menu_data['discription'];
    $name=$menu_data['name'];
    $price=$menu_data['price'];
    $image=$menu_data['image'];


?>


			<div class="col-md-6">
				<div class="row menu_row_inner">
					<div class="col-md-6 menu_image">
						<img src="<?php echo $image;?>">
					</div>
					<div class="col-md-6 menu_disc">
						<div class="menu_disc_container">
							<h1><?php echo $name; ?></h1>
							<p><?php echo $menu_disc; ?></p>
						</div>
						<div class="row menu_price_container">
							<div class="col-md-4 menu_price">
								<?php echo $price; ?>
							</div>
							<div class="col-md-4">
								<a href="login_customer.php" class="btn btn-white btn-outline-white menu_order_button">Order</a>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php
	}
}
else{
?>
	
	<div class="no_menu">
		<p>sorry! no item is present in menu</p>
	</div>

<?php
	;
}


?>

			
			
		</div>
	</div>
</div>





<div class="footer">
	<div class="container">
		<div class="row">

			<div class="col-md-4">
				<div class="footer_1_text_conatiner">
					<h1>ABOUT US</h1>
					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
				</div>
				<div class="row icon_row">
					<div class="col-md-4">
						<div class="icon_container">
							<i class='fab fa-twitter'></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="icon_container">
							<i class='fab fa-facebook-f'></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="icon_container">
							<i class='fab fa-instagram'></i>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 service">
				<div class="footer_2_text_conatiner">
					<h1>SERVICES</h1>
					<ul>
						<li><a href="">Cooked</a></li>
						<li><a href="">Deliver</a></li>
						<li><a href="">Quality</a></li>
						<li><a href="">Foods</a></li>
						<li><a href="">Mixed</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-4 ">
				<div class="footer_3_text_conatiner">
					<h1>HAVE A QUESTION?</h1>
					<ul>
						<li>
							<i class='fas fa-map-marker-alt'></i><span>203 Fake St. Mountain View, San Francisco, California, USA</span>
						</li>
						<li>
							<i class='fas fa-phone'></i><span> +2 392 3929 210</span>
						</li>
						<li>
							<i class="material-icons">email</i><span>info@yourdomain.com</span>
						</li>
					</ul>
				</div>
			</div>
			
		</div>


	</div>
	
</div>



<?php

	}
?>




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