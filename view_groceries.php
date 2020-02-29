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
			    <li class="nav-item">
			      <a class="nav-link" href="statistics.php">View Statistics</a>
			    </li>
			    <li class="nav-item active">
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


<div class="groceries_table_container">
	<div class="container">
		<div class="groceries_table_heading">
			<h1>Groceries Table</h1>
		</div>
		<div class="row groceries_table">
			<div class="col-md-2">
				
			</div>
			<div class="col-md-8">
				<table class="table">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Name of Item</th>
				      <th scope="col">Amount</th>
				    </tr>
				  </thead>
				  <tbody>
<?php
  
  $get_grocery_data=get_grocery_data();

if($get_grocery_data){
  foreach ($get_grocery_data as $grocery_data) {

    $item_id =$grocery_data['id'];
    $name=$grocery_data['name'];
    $amount=$grocery_data['amount'];


?>
				    <tr class="grocery_row">
				      <th scope="row"><?php echo $item_id; ?></th>
				      <td><?php echo $name; ?></td>
				      <td><?php echo $amount; ?></td>
				    </tr>
<?php
	}
}
else{
?>
	
	<div class="no_menu">
		<p>sorry! no item is present in Groceries list</p>
	</div>

<?php
	;
}


?>
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

