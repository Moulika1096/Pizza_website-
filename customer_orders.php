<?php
	require_once('header.php');
?>
<?php
	$user_data=get_customer_data();
?>
<?php 
	if(is_customer_loggedin()){

		$user_data=get_customer_data();

		$_SESSION['loggedin_customer_id']=$user_data['id'];

		$loggedin_customer_id=$_SESSION['loggedin_customer_id'];
?>


<?php
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
			    <li class="nav-item">
			      <a class="nav-link" href="menu.php">Menu</a>
			    </li>
			    <li class="nav-item active">
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
  
$get_customer_order_data=get_customer_order_data($loggedin_customer_id);

if($get_customer_order_data){
  foreach ($get_customer_order_data as $orders_data) {

$image=$orders_data['image'];
$name=$orders_data['name'];
$discription=$orders_data['discription'];
$first_name=$orders_data['first_name'];
$last_name=$orders_data['last_name'];
$price=$orders_data['total_price'];    
$time=$orders_data['time'];
if ($time=='0') {
	$time="Soon, chef will inform you about time required";
}

$coupon_availed=$orders_data['coupon_availed'];
if ($coupon_availed=='0') {
	$coupon="No coupon used";
}
else{
	$coupon="You availed couppon of $".$coupon_availed;
}

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



<!-- <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  var OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "f5dfe7fb-a694-4bb3-8551-3a4881747069",
    });
  });
</script> -->


<?php
		
	} 
	else{
		header('Location: index.php');
		die();
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