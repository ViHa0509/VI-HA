<?php 

	session_start();
	unset($_SESSION['name_admin']);
	unset($_SESSION['id_admin']);
	
	header("location: /BanVang/tutphp/login/");	
 ?>