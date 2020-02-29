<?php
	require_once('header.php');
?>

<?php
	if(is_employee_loggedin()){

		$employee_data=get_employee_data();
		$_SESSION['loggedin_user_id']=$employee_data['id'];
		$designation=$employee_data['employee_designation'];
		if($designation=='admin'){



		if (isset($_POST['push'])) {
			$discription=$_POST['discription'];
			$amount= $_POST['amount'];
			$valid=$_POST['valid'];

			$insert_coupon=insert_coupon([
				'discription'=>$discription,
				'amount'=>$amount,
				'valid'=> $valid
			]);

			if ($insert_coupon==true) {
				$info= true;
          		$info="Coupon created!!";
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
			    <li class="nav-item">
			      <a class="nav-link view_orders" href="admin_view_orders.php">View Orders</a><span class="count"></span>
			    </li>
			    <li class="nav-item active">
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


<div class="signup_background">
	<div class="signup_background_overlay">
		
	</div>
	
	<div class="signup_background_content">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					
				</div>
				<div class="col-md-6">
					<h1>CREATE COUPONS</h1>
					<p><a href="index.php">HOME </a> <a href="#"> COUPONS</a></p>
				</div>
				<div class="col-md-3">
					
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Registration form -->

<div class="Registration_form_bg">
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				
			</div>
			<div class="col-md-8 form-registration">	

				<form method='post'>	
					<div class="input_box">
						<textarea placeholder="Discription" name="discription"></textarea>
					</div>

					<div class="input_box">
						<input type="text" name="amount" placeholder="Amount" class="Input">
					</div>

					<div class="input_box">
						<input type="text" name="valid" placeholder="Valid till(days)" class="Input">
					</div>

					<div class="signup_button">
						<input type="submit" name="push" value="PUSH" class="signup_btn">
					</div>
					<br><br>


				</form>
			</div>
			<div class="col-md-2">
				
			</div>
			
			
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

<script>
$(document).ready(function(){
 
 function load_new_orders_ntfcn(view = '')
 {
  $.ajax({
   url:"admin_orders_fetch_ntfcn.php",
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
 
load_new_orders_ntfcn();
 
 $(document).on('click', '.view_orders', function(){
  $('.count').html('');
  load_new_orders_ntfcn('yes');
 });
 
 setInterval(function(){ 
  load_new_orders_ntfcn();; 
 }, 5000);
 
});
</script>

<?php
			
		}

		else{
			header('Location: index.php');
			die();
		}
	}



?>

