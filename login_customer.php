<?php
	require_once('header.php');
?>

<!-- login user -->

<?php
	if( isset($_POST['login'])){
		$email= filter_string($_POST['login-email']);
		$password= $_POST['login-password'];
		$errors = false;

		if( empty($email) || empty($password)){
			$errors = true;
		}

		if(!filter_email($email)){
			$errors = true;
			$echo='Your email is not valid';
		}



		if( !$errors ){
			$user_exists = login_customer(
				[ 
					'email'=> $email, 
					'password'=> $password 
				]);

			if(!$user_exists){
				
				$errors=true;
				$echo="Sorry this account does not exist. Please confirm your email or Password";
			}

		}
}

?>



<?php 
	if(is_customer_loggedin()){

		header('Location: index.php');
		die();
	} 
?>
<?php 
	if(is_employee_loggedin()){

		header('Location: index.php');
		die();
	} 
?>






	<!--  Header  -->
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

		    	<li class="nav-item dropdown active">
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

<div class="signup_background">
	<div class="signup_background_overlay">
		
	</div>
	
	<div class="signup_background_content">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					
				</div>
				<div class="col-md-6">
					<h1>LOGIN</h1>
					<p><a href="index.php">HOME </a> <a href="#"> LOGIN</a></p>
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

				<form method='post' class="recaptchaform">	
					<div class="input_box">
						<input type="email" name="login-email" placeholder="Email" class="Input">
					</div>

					<div class="input_box">
						<input type="password" name="login-password" placeholder="Password" class="Input" id="password">
					</div>

					<div class="signup_button">
						<input type="submit" name="login" value="LOGIN" class="signup_btn">
					</div>

					<p class="login_anchor">Not a member yet? <a href="signup_customer.php"> Join now</a></p>


				</form>
			</div>
			<div class="col-md-2">
				
			</div>
			
			
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




	<?php if(isset($errors) && $errors){ ?>
		<div class="show-errors">
			<div class="errors" id="errors">
				<?php

					echo $echo;

				?>
					
			</div>
		</div>
	<?php } ?>


<?php
	require_once('footer.php');

?>

<script src="https://www.google.com/recaptcha/api.js"></script>


<script>
	




</script>
