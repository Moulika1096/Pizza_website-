<?php
	require_once('header.php');
?>

<?php
	if(is_employee_loggedin()){

		$employee_data=get_employee_data();
		$designation=$employee_data['employee_designation'];
		if($designation=='manager'){

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
			    <li class="nav-item">
			      <a class="nav-link" href="add_employee.php">Add Employee</a>
			    </li>
			    <li class="nav-item active">
			      <a class="nav-link" href="statistics.php">View Statistics</a>
			    </li>
			     <li class="nav-item">
			      <a class="nav-link" href="view_groceries.php">Groceries List</a>
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


<div class="statistics">
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				
			</div>
			<div class="col-md-8">
				<table class="table">
					<tbody>
						<tr>
						  	<th scope="col">Name of customer registered</th>
		<?php


			$count="SELECT COUNT(id) FROM customers";
			$result=$conn->query($count);

					if($result->num_rows > 0)
					{
							while($row=$result->fetch_assoc())
						{ 				
					

		?>
						    <td><?php echo $row['COUNT(id)']; ?></td>
		<?php
						}

					}
					else{
					}
		?>
						  	
						</tr>
					
						<tr>
							<th scope="col">Number of orders</th>
		<?php


			$count="SELECT COUNT(order_id) FROM orders";
			$result=$conn->query($count);

					if($result->num_rows > 0)
					{
							while($row=$result->fetch_assoc())
						{ 				
					

		?>
						    <td><?php echo $row['COUNT(order_id)']; ?></td>
		<?php
						}

					}
					else{
					}
		?>
		

							
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-2">
				
			</div>
		</div>
		
			
	</div>
</div>


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

