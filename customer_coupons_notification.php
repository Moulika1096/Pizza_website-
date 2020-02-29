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


	if(isset($_POST['get_coupon'])){

		$price=$_POST['price'];

		$_SESSION['coupon_price']=$price;
		header('location:menu.php');
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
			    <li class="nav-item">
			      <a class="nav-link" href="menu.php">Menu</a>
			    </li>
			    <li class="nav-item">
			      <a class="nav-link" href="customer_orders.php">Orders</a>
			    </li>
			    <li class="nav-item active">
			      <a class="nav-link view_orders" href="#"><i class="fas fa-bell"></i></a><span class="count"></span>
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




<div class="menu" id="menu">
	<div class="container">
		<div class="row">


<?php
  
$get_coupons_data=get_coupons_data();

if($get_coupons_data){
  foreach ($get_coupons_data as $coupons_data) {

$id=$coupons_data['id'];
$discription=$coupons_data['discription'];
$amount=$coupons_data['amount'];
$valid=$coupons_data['valid'];
$time=$coupons_data['time'];

 if(chck_if_day_passed($time)){
 	global $conn;
    $delete_coupon="DELETE FROM `coupons` WHERE id=$id";

    if($conn->query($delete_coupon) === TRUE) {
    
          return true;

          }   
          else {
            return false;
        }
   }

   var_dump(chck_if_day_passed($time));


?>

	<div class="col-md-12">
		<div class="row show_orders_container">

			<div class="col-md-3">
				
			</div>
			<div class="col-md-6 show_orders_col2" style="text-align: center;">
				<h1 class="coupon_heading">Get upto <?php echo $amount; ?> discount</h1>


				<p><?php echo $discription; ?></p>

				<h4>Amount</h4>
				<p><?php echo $amount?></p>

				<h4>Valid till:</h4>
				<p><?php echo $valid; ?></p>


			<form method="post">
				<input type="hidden" name="price" value="<?php echo $amount?>">
				<input type="submit" name="get_coupon" value="Use Coupon" class="btn btn-primary p-3 px-xl-4 py-xl-3">
			</form>
			</div>
			<div class="col-md-3">
				
			</div>
			
		</div>
	</div>

<?php
	}
}
else{
?>
	
	<div class="no_menu">
		<p>No coupon yet!</p>
	</div>

<?php
	;
}


?>

			
			
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