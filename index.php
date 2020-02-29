<?php
	require_once('header.php');
?>
<?php
	$user_data=get_customer_data();
?>
<?php 
	if(is_employee_loggedin()){

		$employee_data=get_employee_data();
		$designation=$employee_data['employee_designation'];
		if($designation=='manager'){
			header('Location: manager.php');
			die();
		}
		else if($designation=='chef'){
			header('Location: chef.php');
			die();
		}
		else if($designation=='admin'){
			header('Location: admin.php');
			die();
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

		  		<li class="nav-item active">
			      <a class="nav-link" href="index.php">Home</a>
			    </li>

			    <li class="nav-item">
			      <a class="nav-link" href="menu.php">Menu</a>
			    </li>
			    
			    <li class="nav-item dropdown">
		     		<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
		        		<?php echo $employee_data['first_name'];?>
		      		</a>
		      		<div class="dropdown-menu">
		        		<a class="dropdown-item" href="logout.php">logout</a>
		      		</div>
		    	</li>
		  	</ul>
		</div>  
	</div>
</nav>


	<section class="home-slider owl-carousel img owl-loaded owl-drag">



	<div class="owl-stage-outer">
		<div class="owl-stage">

		<div class="owl-item"><div class="slider-item bg_3">
		<div class="overlay"></div>
		<div class="container">
		<div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
		<div class="col-md-7 col-sm-12 text-center ftco-animate fadeInUp ftco-animated">
		<span class="subheading">Welcome</span>
		<h1 class="mb-4">We cooked your desired Pizza Recipe</h1>
		<p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
		<p><a href="#menu" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
		</div>
		</div>
		</div>
		</div></div>
		<div class="owl-item">
		<div class="slider-item">
		<div class="overlay"></div>
		<div class="container">
		<div class="row slider-text align-items-center" data-scrollax-parent="true">
		<div class="col-md-6 col-sm-12 order-md-last ftco-animate fadeInUp ftco-animated">
		<span class="subheading">Crunchy</span>
		<h1 class="mb-4">Italian Pizza</h1>
		<p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
		<p><a href="#menu" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
		</div>
		<div class="col-md-6 ftco-animate fadeInUp ftco-animated">
		<img src="images/bg_2.png" class="img-fluid" alt="">
		</div>
		</div>
		</div>
		</div></div>
		<div class="owl-item"><div class="slider-item">
		<div class="overlay"></div>
		<div class="container">
		<div class="row slider-text align-items-center" data-scrollax-parent="true">
		<div class="col-md-6 col-sm-12 ftco-animate fadeInUp ftco-animated">
		<span class="subheading">Delicious</span>
		<h1 class="mb-4">Italian Cuizine</h1>
		<p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
		<p> <a href="#menu" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
		</div>
		<div class="col-md-6 ftco-animate fadeInUp ftco-animated">
		<img src="images/bg_1.png" class="img-fluid" alt="">
		</div>
		</div>
		</div>
		</div></div>
	</div>
	</div>

		<div class="owl-nav disabled"><button role="presentation" class="owl-prev"><span class="ion-md-arrow-back"></span></button><button role="presentation" class="owl-next"><span class="ion-chevron-right"></span></button></div>
		<div class="owl-dots"><button class="owl-dot"><span></span></button><button class="owl-dot"><span></span></button><button class="owl-dot"><span></span></button></div>
	</section>


<div class="container-fluid">
	<div class="row page_disc">
		<div class="col-md-6">
			<div class="image_container">
				<img src="images/disc_bg.png">
			</div>
		</div>
		<div class="col-md-6 board">
			<div class="board_content_container">
				<h1>WELCOME TO <img src="images/pizza_full.svg"> PIZZA A RESTAURANT</h1>
				<p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.</p>
			</div>
		</div>
	</div>
</div>


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






<script type="text/javascript" src="OwlCarousel2-2.3.4/docs/assets/vendors/jquery.min.js"></script>
<script type="text/javascript" src="OwlCarousel2-2.3.4/dist/owl.carousel.js"></script>
<script type="text/javascript">
	
	$('.owl-carousel').owlCarousel({
	    loop:true,
	    margin:10,
	    nav:true,
	    autoplay: true,
	    autoPlaySpeed: 6000,
	    autoPlayTimeout: 6000,
	    autoplayHoverPause: true,
	    navigation: true,
	  	navigationText: ["", ""],
	  	slideSpeed: 10000,
	  	paginationSpeed: 10000,
	  	mouseDrag: true,
	  	singleItem: true,
	  	animateIn: 'fadeIn', 
	  	animateOut: 'fadeOut',
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:1
	        },
	        1000:{
	            items:1
	        }
	    }
	})

</script>

<?php
	}

	else if(is_customer_loggedin()){
		$_SESSION['loggedin_user_id']=$user_data['id'];

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
			      <a class="nav-link" href="index.php">Home</a>
			    </li>

			    <li class="nav-item">
			      <a class="nav-link" href="menu.php">Menu</a>
			    </li>

			    <li class="nav-item">
			      <a class="nav-link" href="customer_orders.php">Orders</a>
			    </li>
			    <li class="nav-item">
			      <a class="nav-link view_orders" href="customer_coupons_notification.php"><i class="fas fa-bell"></i></a><span class="count"></span>
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


	<section class="home-slider owl-carousel img owl-loaded owl-drag">



	<div class="owl-stage-outer">
		<div class="owl-stage">

		<div class="owl-item"><div class="slider-item bg_3">
		<div class="overlay"></div>
		<div class="container">
		<div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
		<div class="col-md-7 col-sm-12 text-center ftco-animate fadeInUp ftco-animated">
		<span class="subheading">Welcome</span>
		<h1 class="mb-4">We cooked your desired Pizza Recipe</h1>
		<p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
		<p><a href="menu.php" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> <a href="#menu" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
		</div>
		</div>
		</div>
		</div></div>
		<div class="owl-item">
		<div class="slider-item">
		<div class="overlay"></div>
		<div class="container">
		<div class="row slider-text align-items-center" data-scrollax-parent="true">
		<div class="col-md-6 col-sm-12 order-md-last ftco-animate fadeInUp ftco-animated">
		<span class="subheading">Crunchy</span>
		<h1 class="mb-4">Italian Pizza</h1>
		<p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
		<p><a href="menu.php" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> <a href="#menu" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
		</div>
		<div class="col-md-6 ftco-animate fadeInUp ftco-animated">
		<img src="images/bg_2.png" class="img-fluid" alt="">
		</div>
		</div>
		</div>
		</div></div>
		<div class="owl-item"><div class="slider-item">
		<div class="overlay"></div>
		<div class="container">
		<div class="row slider-text align-items-center" data-scrollax-parent="true">
		<div class="col-md-6 col-sm-12 ftco-animate fadeInUp ftco-animated">
		<span class="subheading">Delicious</span>
		<h1 class="mb-4">Italian Cuizine</h1>
		<p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
		<p><a href="menu.php" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> <a href="#menu" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
		</div>
		<div class="col-md-6 ftco-animate fadeInUp ftco-animated">
		<img src="images/bg_1.png" class="img-fluid" alt="">
		</div>
		</div>
		</div>
		</div></div>
	</div>
	</div>

		<div class="owl-nav disabled"><button role="presentation" class="owl-prev"><span class="ion-md-arrow-back"></span></button><button role="presentation" class="owl-next"><span class="ion-chevron-right"></span></button></div>
		<div class="owl-dots"><button class="owl-dot"><span></span></button><button class="owl-dot"><span></span></button><button class="owl-dot"><span></span></button></div>
	</section>


<div class="container-fluid">
	<div class="row page_disc">
		<div class="col-md-6">
			<div class="image_container">
				<img src="images/disc_bg.png">
			</div>
		</div>
		<div class="col-md-6 board">
			<div class="board_content_container">
				<h1>WELCOME TO <img src="images/pizza_full.svg"> PIZZA A RESTAURANT</h1>
				<p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.</p>
			</div>
		</div>
	</div>
</div>


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






<script type="text/javascript" src="OwlCarousel2-2.3.4/docs/assets/vendors/jquery.min.js"></script>
<script type="text/javascript" src="OwlCarousel2-2.3.4/dist/owl.carousel.js"></script>



<!-- <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  var OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "f5dfe7fb-a694-4bb3-8551-3a4881747069",
    });
  });
</script> -->

<script type="text/javascript">
	
	$('.owl-carousel').owlCarousel({
	    loop:true,
	    margin:10,
	    nav:true,
	    autoplay: true,
	    autoPlaySpeed: 6000,
	    autoPlayTimeout: 6000,
	    autoplayHoverPause: true,
	    navigation: true,
	  	navigationText: ["", ""],
	  	slideSpeed: 10000,
	  	paginationSpeed: 10000,
	  	mouseDrag: true,
	  	singleItem: true,
	  	animateIn: 'fadeIn', 
	  	animateOut: 'fadeOut',
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:1
	        },
	        1000:{
	            items:1
	        }
	    }
	})

</script>
<script>
$(document).ready(function(){
 
 function load_coupon_ntfcn(view = '')
 {
  $.ajax({
   url:"coupons_ntfcn.php",
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
 
load_coupon_ntfcn();
 
 $(document).on('click', '.view_orders', function(){
  $('.count').html('');
  load_coupon_ntfcn('yes');
 });
 
 setInterval(function(){ 
  load_coupon_ntfcn();; 
 }, 5000);
 
});
</script>


<?php
		
	} 
	else{
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
			      <a class="nav-link" href="#">Home</a>
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


	<section class="home-slider owl-carousel img owl-loaded owl-drag">



	<div class="owl-stage-outer">
		<div class="owl-stage">

		<div class="owl-item"><div class="slider-item bg_3">
		<div class="overlay"></div>
		<div class="container">
		<div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
		<div class="col-md-7 col-sm-12 text-center ftco-animate fadeInUp ftco-animated">
		<span class="subheading">Welcome</span>
		<h1 class="mb-4">We cooked your desired Pizza Recipe</h1>
		<p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
		<p><a href="menu.php" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> <a href="#menu" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
		</div>
		</div>
		</div>
		</div></div>
		<div class="owl-item">
		<div class="slider-item">
		<div class="overlay"></div>
		<div class="container">
		<div class="row slider-text align-items-center" data-scrollax-parent="true">
		<div class="col-md-6 col-sm-12 order-md-last ftco-animate fadeInUp ftco-animated">
		<span class="subheading">Crunchy</span>
		<h1 class="mb-4">Italian Pizza</h1>
		<p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
		<p><a href="menu.php" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> <a href="#menu" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
		</div>
		<div class="col-md-6 ftco-animate fadeInUp ftco-animated">
		<img src="images/bg_2.png" class="img-fluid" alt="">
		</div>
		</div>
		</div>
		</div></div>
		<div class="owl-item"><div class="slider-item">
		<div class="overlay"></div>
		<div class="container">
		<div class="row slider-text align-items-center" data-scrollax-parent="true">
		<div class="col-md-6 col-sm-12 ftco-animate fadeInUp ftco-animated">
		<span class="subheading">Delicious</span>
		<h1 class="mb-4">Italian Cuizine</h1>
		<p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
		<p><a href="menu.php" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> <a href="#menu" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
		</div>
		<div class="col-md-6 ftco-animate fadeInUp ftco-animated">
		<img src="images/bg_1.png" class="img-fluid" alt="">
		</div>
		</div>
		</div>
		</div></div>
	</div>
	</div>

		<div class="owl-nav disabled"><button role="presentation" class="owl-prev"><span class="ion-md-arrow-back"></span></button><button role="presentation" class="owl-next"><span class="ion-chevron-right"></span></button></div>
		<div class="owl-dots"><button class="owl-dot"><span></span></button><button class="owl-dot"><span></span></button><button class="owl-dot"><span></span></button></div>
	</section>


<div class="container-fluid">
	<div class="row page_disc">
		<div class="col-md-6">
			<div class="image_container">
				<img src="images/disc_bg.png">
			</div>
		</div>
		<div class="col-md-6 board">
			<div class="board_content_container">
				<h1>WELCOME TO <img src="images/pizza_full.svg"> PIZZA A RESTAURANT</h1>
				<p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.</p>
			</div>
		</div>
	</div>
</div>


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






<script type="text/javascript" src="OwlCarousel2-2.3.4/docs/assets/vendors/jquery.min.js"></script>
<script type="text/javascript" src="OwlCarousel2-2.3.4/dist/owl.carousel.js"></script>
<script type="text/javascript">
	
	$('.owl-carousel').owlCarousel({
	    loop:true,
	    margin:10,
	    nav:true,
	    autoplay: true,
	    autoPlaySpeed: 6000,
	    autoPlayTimeout: 6000,
	    autoplayHoverPause: true,
	    navigation: true,
	  	navigationText: ["", ""],
	  	slideSpeed: 10000,
	  	paginationSpeed: 10000,
	  	mouseDrag: true,
	  	singleItem: true,
	  	animateIn: 'fadeIn', 
	  	animateOut: 'fadeOut',
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:1
	        },
	        1000:{
	            items:1
	        }
	    }
	})

</script>

<?php

	}
?>

<?php
	require_once('footer.php');
?>