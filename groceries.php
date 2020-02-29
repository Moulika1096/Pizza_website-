<?php
	require_once('header.php');
?>

<?php
	if(is_employee_loggedin()){

		$employee_data=get_employee_data();
		$designation=$employee_data['employee_designation'];
		if($designation=='chef'){





if( isset($_POST['add'])){


	$name = filter_string($_POST['name']);
	$amount = $_POST['amount'];
	$errors = false;

		if( empty($name) ||  empty($amount)){
			$errors = true;
	}

       	// Insert grocery Item

				if( !$errors ){
					$insert_grocery_item = insert_grocery_item(
						[ 
							'name'=> $name,
							'amount' => $amount
						]);
					if($insert_grocery_item==true){

						$info= true;
          				$info="item added";
						
					}
				} 

 }



 if(isset($_POST['delete'])){

 	$id=$_POST['item_id'];

 	$delete_grocery_item=delete_grocery_item($id);

 	if ($delete_grocery_item) {
 		$info= true;
        $info="item deleted";
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
			      <a class="nav-link" href="#">Menu</a>
			    </li>
			    <li class="nav-item">
			      <a class="nav-link" href="update_menu.php">Update Menu</a>
			    </li>
			    <li class="nav-item">
			      <a class="nav-link view_orders" href="chef_orders.php">orders</a><span class="count"></span>
			    </li>
			     <li class="nav-item active">
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
				      <th scope="col"></th>
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
				      <form method="post">
				      	<input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
				      <td><input type="submit" name="delete" value="Delete" class="delete_grocery_item_button"></td>
				      </form>
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

<div class="groceries_table_container">
	<div class="container">
		<div class="groceries_table_heading">
			<h1>Add an item to Grocery List</h1>
		</div>
		<div class="row">
			<div class="col-md-2">
			
			</div>
			<div class="col-md-8 add-grocery-form">
				<form method="post">
					<input type="text" name="name" placeholder="name of item" class="grocery_input">
					<input type="text" name="amount" placeholder="amount of item" class="grocery_input">
					<input type="submit" name="add" value="Add Item" class="grocery_input_button">
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
 
 function load_new_time_ntfcn(view = '')
 {
  $.ajax({
   url:"chef_orders_fetch_ntfcn.php",
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
 
load_new_time_ntfcn();
 
 $(document).on('click', '.view_orders', function(){
  $('.count').html('');
  load_new_time_ntfcn('yes');
 });
 
 setInterval(function(){ 
  load_new_time_ntfcn();; 
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

