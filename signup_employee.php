<?php
	require_once('header.php');
?>


<!-- signup -->

<?php
        
if( isset($_POST['signup'])){


	$name = filter_string($_POST['name']);
	$sur_name = filter_string($_POST['SurName']);
	$email= filter_string($_POST['email']);
	$password= $_POST['password'];
	$confirm_password= $_POST['confirm_password'];
	$errors = false;

		if( empty($name) ||  empty($sur_name) || empty($email) || empty($password) ){
			$errors = true;
	}

		if(!is_employee_email_exits($email)){

		 	$errors = true;
		 	$echo='This email is already rejistered. Please Login to visit your profile';

		}
	
		if(!filter_email($email)){
			$errors = true;
			$echo='Your email is not valid';
		}


		$passwords_match=do_passwords_match(
			[
				'password'=> $password,
				'confirm_password'=> $confirm_password
			]);
				if(!$passwords_match){
					$errors=true;
					$echo='Passwords do not Match';
				}


       	// Create user

				if( !$errors ){
					$new_user = create_manager(
						[ 
							'name'=> $name,
							'SurName' => $sur_name, 
							'email'=> $email, 
							'password'=> $password 
						]);

					if($new_user==true){

						header('location:login_employee.php');
						
					}
				} 

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

		    	<li class="nav-item dropdown">
		     		<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
		        		Login
		      		</a>
		      		<div class="dropdown-menu">
		        		<a class="dropdown-item" href="login_employee.php">Employee</a>
		        		<a class="dropdown-item" href="login_customer.php">Customer</a>
		      		</div>
		    	</li>
			    <li class="nav-item dropdown active">
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
					<h1>SIGN UP</h1>
					<p><a href="index.php">HOME </a> <a href="#"> SIGNUP</a></p>
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
						<input type="text" name="name" placeholder="First Name" class="Input">
					</div>

					<div class="input_box">
						<input type="text" name="SurName" placeholder="Last Name" class="Input">
					</div>

					<div class="input_box">
						<input type="email" name="email" placeholder="Email" class="Input">
					</div>

					<div class="input_box">
						<input type="password" name="password" placeholder="Password" id="txtNewPassword" class="Input">
					</div>

					<div class="input_box">
						<input type="password" name="confirm_password" placeholder="Confirm Password" id="txtConfirmPassword" onChange="checkPasswordMatch();" class="Input">
					</div>

					<div class="registrationFormalert input_box" id="divCheckPasswordMatch">
					</div>

					<div class="signup_button">
						<input type="submit" name="signup" value="Sign Up" class="signup_btn">
					</div>

					<p class="login_anchor">Already have an account? <a href="login_employee.php"> LOGIN</a></p>


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
