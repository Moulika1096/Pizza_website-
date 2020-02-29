<?php
	require_once('header.php');
?>

<?php
	if(is_employee_loggedin()){

		$employee_data=get_employee_data();
		$designation1=$employee_data['employee_designation'];
		if($designation1=='manager'){


        
if( isset($_POST['signup'])){


	$name = filter_string($_POST['name']);
	$sur_name = filter_string($_POST['SurName']);
	$email= filter_string($_POST['email']);
	$password= $_POST['password'];
	$confirm_password= $_POST['confirm_password'];
	$designation= $_POST['designation'];
	$errors = false;

		if( empty($name) ||  empty($sur_name) || empty($email) || empty($password) || empty($designation)){
			$errors = true;
	}

		if(!is_employee_email_exits($email)){

		 	$errors = true;
		 	$echo='This email is already rejistered. Please Login to visit your profile';

		}
		if ($designation=='admin') {
			
			if(!is_admin_designation_exits($designation)){

			 	$errors = true;
			 	$echo='This designation already exists. please login to see profile';

			}
		}
		if ($designation=='chef') {
			
			if(!is_chef_designation_exits($designation)){

			 	$errors = true;
			 	$echo='This designation already exists. please login to see profile';

			}
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
					$new_user = create_employee(
						[ 
							'name'=> $name,
							'SurName' => $sur_name, 
							'email'=> $email, 
							'password'=> $password,
							'designation'=> $designation 
						]);

					if($new_user==true){

						$info= true;
          				$info="Employee Added";
						
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
			      <a class="nav-link" href="manager.php">Menu</a>
			    </li>
			    <li class="nav-item active">
			      <a class="nav-link" href="add_employee.php">Add Employee</a>
			    </li>
			    <li class="nav-item">
			      <a class="nav-link" href="statistics.php">View Statistics</a>
			    </li>
			    <li class="nav-item">
			      <a class="nav-link" href="view_groceries.php">Groceries List</a>
			    </li>
			    
			    <li class="nav-item dropdown">
		     		<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
		        		<?php echo $designation1; ?>
		      		</a>
		      		<div class="dropdown-menu">
		        		<a class="dropdown-item" href="logout.php">logout</a>
		      		</div>
		    	</li>
		  	</ul>
		</div>  
	</div>
</nav>



<div class="Registration_form_bg">
	<div class="add_employee_heading">

		<h1>Add An Employee</h1>
	
	</div>
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
						<select name="designation">
							<option value="">Employee Designation</option>
							<option value="admin">Admin</option>
							<option value="chef">Chef</option>
							<option value="employee">employee</option>
						</select>
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


				</form>
			</div>
			<div class="col-md-2">
				<br><br><br><br>
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



<?php
			
		}

		else{
			header('Location: index.php');
			die();
		}
	}



?>

