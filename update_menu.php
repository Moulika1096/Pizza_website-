<?php
	require_once('header.php');
?>

<?php
	if(is_employee_loggedin()){

		$employee_data=get_employee_data();
		$designation=$employee_data['employee_designation'];
		if($designation=='chef'){


        
if( isset($_POST['submit'])){


	$name = filter_string($_POST['name']);
	$discription = filter_string($_POST['discription']);
	$price = $_POST['price'];

	$imagename=$_FILES["foodPic"]["name"];
	$menu_image= 'images/'.$imagename;
	$errors = false;

		if( empty($name) ||  empty($discription) || empty($price)){
			$errors = true;
	}

       	// Insert menu Item

				if( !$errors ){
					$insert_menu_item = insert_menu_item(
						[ 
							'name'=> $name,
							'discription' => $discription, 
							'price'=> $price, 
							'imagename'=> $menu_image
						]);
					if($insert_menu_item==true){

						$info= true;
          				$info="menu item added";
						
					}
				} 

 }



 if(isset($_POST['delete'])){

 	$id=$_POST['menu_item_id'];

 	$delete_menu_item=delete_menu_item($id);
 	if ($delete_menu_item) {
 		$info= true;
        $info="item deleted";
 	}
 }


 if (isset($_POST['update_menu'])) {
 

 	$id = $_POST['item_id'];
	$name = filter_string($_POST['new_name']);
	$discription = filter_string($_POST['new_discription']);
	$price = $_POST['new_price'];
	$previous_pic = $_POST['previous_pic'];
	$imagename=$_FILES["new_foodPic"]["name"];

	if (empty($imagename)) {
		$menu_image=$previous_pic;
	}
	else{
		$menu_image= 'images/'.$imagename;
	}



	$errors = false;

		if( empty($name) ||  empty($discription) || empty($price)){
			$errors = true;
	}

       	// Insert menu Item

				if( !$errors ){
					$insert_menu_item = update_menu_item(
						[ 
							'id'=> $id,
							'name'=> $name,
							'discription' => $discription, 
							'price'=> $price, 
							'imagename'=> $menu_image
						]);
					if($insert_menu_item==true){

						$info= true;
          				$info="menu item updated";
						
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
			      <a class="nav-link" href="chef.php">Menu</a>
			    </li>
			    <li class="nav-item active">
			      <a class="nav-link" href="update_menu.php">Update Menu</a>
			    </li>
			    <li class="nav-item">
			      <a class="nav-link view_orders" href="chef_orders.php">orders</a><span class="count"></span>
			    </li>
			     <li class="nav-item">
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
    $id=$menu_data['id'];

?>
<div class="Registration_form_bg update_menu" id="update_menu<?php echo $id;?>">
	<div class="add_employee_heading">

		<h1>Update Menu Item</h1>
	
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				
			</div>
			<div class="col-md-8 form-registration">	

				<form method='post' enctype="multipart/form-data">	
					<div class="input_box">
						<input type="text" name="new_name" placeholder="Name of item" class="Input" value="<?php echo $name; ?>">
					</div>

					<div class="input_box">
						<textarea name="new_discription" placeholder="discription of item"><?php echo $menu_disc; ?></textarea>
					</div>

					<div class="input_box">
						<input type="text" name="new_price" placeholder="price" class="Input" value="<?php echo $price; ?>">
					</div>
					<img src="<?php echo $image; ?>" class="update_menu_image" id="show_menu_image">
					<div class="input_box">
						<input type="file" name="new_foodPic" class="menu_image_input" onchange="loadFile_formenuphoto(event)">
					</div>

					<input type="hidden" name="previous_pic" value="<?php echo $image; ?>">

					<input type="hidden" name="item_id" value="<?php echo $id; ?>">

					<div class="signup_button">
						<input type="submit" name="update_menu" value="Submit item" class="signup_btn">
					</div>


				</form>
			</div>


		</div>
	</div>
</div>

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
						<br>
						<div class="row menu_price_container">
							<div class="col-md-2">
								
							</div>
							<div class="col-md-4">
							<form method="post">
								<input type="hidden" name="menu_item_id" value="<?php echo $id; ?>">
								<a href="#update_menu<?php echo $id;?>"><input type="button" name="edit" value="Edit" class="btn btn-white btn-outline-white menu_order_button" onclick="updateform('update_menu<?php echo $id;?>')"></a>
							</form>
							</div>
							<div class="col-md-4">
							<form method="post">
								<input type="hidden" name="menu_item_id" value="<?php echo $id; ?>">
								<input type="submit" name="delete" value="Delete" class="btn btn-white btn-outline-white menu_order_button">
							</form>
							</div>
							<div class="col-md-2">
								
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


<div class="Registration_form_bg">
	<div class="add_employee_heading">

		<h1>Add A Menu Item</h1>
	
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				
			</div>
			<div class="col-md-8 form-registration">	

				<form method='post' enctype="multipart/form-data">	
					<div class="input_box">
						<input type="text" name="name" placeholder="Name of item" class="Input">
					</div>

					<div class="input_box">
						<textarea name="discription" placeholder="discription of item"></textarea>
					</div>

					<div class="input_box">
						<input type="text" name="price" placeholder="price" class="Input">
					</div>
					<div class="input_box">
						<input type="file" name="foodPic" class="menu_image_input">
					</div>

					<div class="signup_button">
						<input type="submit" name="submit" value="Submit item" class="signup_btn">
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

