<?php
	require_once('header.php');
?>

<?php
	if(is_employee_loggedin()){

		$employee_data=get_employee_data();
		$_SESSION['loggedin_user_id']=$employee_data['id'];
		$designation=$employee_data['employee_designation'];
		if($designation=='chef'){

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
			    <li class="nav-item active">
			      <a class="nav-link" href="#">Menu</a>
			    </li>
			    <li class="nav-item">
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


?>


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

