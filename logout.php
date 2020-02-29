<?php
	require_once('header.php');
?>

<?php unset($_SESSION['user']); ?>
<?php unset($_SESSION['employee']); ?>
<?php unset($_SESSION['loggedin_user_id']); ?>
<?php unset($_SESSION['coupon_price']); ?>
<?php unset($_SESSION['loggedin_customer_id']); ?>

<?php header('Location: index.php'); ?>

<?php
	require_once('footer.php');
?>