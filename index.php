<?php require "process/functions.php"; ?>
<?php require "inc/header.php"; ?>

<?php 

session_start();

if(isset($_SESSION['user'])){
	require("routes.php");
}

else{
	if(isset($_GET['page'])){
        $page = trim($_GET['page']);
        if($page == "login"){
			require "pages/login.html";
        }
        else{
        	redirect("./login");
        }
	}
	else{
        	redirect("./login");
	}
}

 ?>

	
<?php require "inc/scripts.php"; ?>