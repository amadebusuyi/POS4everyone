<?php

session_start();

require_once "functions.php";
require_once "conn.php";

if(isset($_POST['login'])){
	$login = $_POST['login'];
	$password = pass($_POST['password']);

	$conn = $pdo->open();

	$query = $conn->prepare("SELECT * from users where (email = :login and password = :password or username = :login and password = :password) AND deleted = 0");
	$query->execute(["login" => $login, "password" => $password]);

	$row = $query->fetch();
	if(!$row){
		echo json_encode(["status"=>"failed", "message"=>"Invalid username/email and password"]);
	}

	else{
		$_SESSION['user'] = $row['id'];
		$_SESSION['role'] = $row['role'];

		$feed = loadFeed($row, ["password", "updated_at", "deleted"]);
		echo json_encode(["status"=>"success", "message"=>"Login successful", "data"=>$feed]);
	}

}

if(isset($_POST['change_password'])){
	$id = $_POST['change_password'];
	$old_pass = pass($_POST['old_pass']);
	$new_pass = pass($_POST['new_pass']);
	$case = $_POST['pw_case'];

	$conn = $pdo->open();

	$count = 0;
	if($case == 2){
		if($old_pass === pass("adminKey"))
			$count = 1;
	}

	if($count == 0){
		$query = $conn->prepare("SELECT count(*) as count from users where id = :id and password = :password and deleted = 0");
		$query->execute(["id" => $id, "password" => $old_pass]);
		$count = $query->fetch()["count"];
	}

	if($count == 1){

		try{
			$query = $conn->prepare("UPDATE users set password = :new_pass where id = :id AND deleted = 0");
			$query->execute(["id" => $id, "new_pass" => $new_pass]);
			echo json_encode(["status"=>"success", "message"=>"Password changed successfully"]);
		}

		catch(PDOException $e){
			echo json_encode(["status"=>"failed", "message"=>"An internal error prevented password update"]);
		}

	}

	else{
		echo json_encode(["status"=>"failed", "message"=>"Password does not match!"]);
	}

}


if(isset($_POST['update_user'])){
	$id = $_POST['update_user'];
	$first_name = stripper($_POST['first_name']);
	$last_name = stripper($_POST['last_name']);
	$email = trim($_POST['email']);
	$phone = trim($_POST['phone']);
	$address = stripper($_POST['address']);

	$conn = $pdo->open();

	try{
		$query = $conn->prepare("UPDATE users set first_name = :first_name, last_name = :last_name, email = :email, phone = :phone, address = :address where id = :id AND deleted = 0");
		$query->execute(["id" => $id, "first_name" => $first_name, "last_name" => $last_name, "email" => $email, "phone" => $phone, "address" => $address]);
		echo json_encode(["status"=>"success", "message"=>"$first_name's information updated successfully"]);
	}
	catch(PDOException $e){
		echo json_encode(["status"=>"failed", "message"=>"Could not update user information"]);
	}
}

if(isset($_POST['delete_user'])){
	$ids = $_POST['delete_user'];

	$ids = explode(",", $ids);

	$conn = $pdo->open();
	$check = 0;
	$fail = array();
	for($i = 0; $i < count($ids); $i++){
		try{	
			$query = $conn->prepare("UPDATE users set deleted = 1 where id = :id");
			$query->execute(["id" => $ids[$i]]);
			$check = 1;
		}

		catch(PDOException $e){
			array_push($fail, $i);
		}
	}

	if($check == 0){
		die(json_encode(["status"=>"failed", "message"=>"Could not delete users"]));
	}

	elseif(count($fail) == 0){
		$users = "users";
		if(count($ids) == 1){
			$users = "user";
		}
		die(json_encode(["status"=>"success", "message"=>count($ids)." $users deleted from database"]));
	}

	else{
		die(json_encode(["status"=>"success", "message"=>"Could not delete count($fail) users from database"]));
	}
}

if(isset($_POST['update'])){
	$id = $_POST['update'];

	$conn = $pdo->open();

	$query = $conn->prepare("SELECT * from users where id = :id and deleted = 0");
	$query->execute(["id" => $id]);
	$row = $query->fetch();

	if($row){
		$_SESSION['role'] = $row['role'];

		$query = $conn->prepare("SELECT amount from sale_summary where created_by = :id");
		$query->execute(['id'=>$id]);

		$amount = array();
		$n = 0;

		while($rows = $query->fetch()){
			array_push($amount, $rows['amount']);
			$n++;
		}
		$feed = loadFeed($row, ["password", "updated_at", "deleted"]);

		$feed['sales_amount'] = $amount;
		$feed['sales_count'] = $n;

		echo json_encode(["status"=>"success", "data"=>$feed]);
	}

	else{
		echo json_encode(["status"=>"failed", "message"=>"User not found"]);
	}
}

if(isset($_POST['fetch_staff'])){

	$conn = $pdo->open();

	if(!isset($_SESSION['role']) || $_SESSION['role'] == 0){
		echo json_encode(["status"=>"failed", "message"=>"You are not authorized to perform this process"]);
	}
	else{
		$query = $conn->prepare("SELECT * from users where role != 2 and deleted = 0");
		$query->execute();

		$feedback = array();

		while($rows = $query->fetch()){

			$query1 = $conn->prepare("SELECT amount from sale_summary where created_by = :id");
			$query1->execute(['id'=>$rows['id']]);

			$amount = array();
			$n = 0;

			while($row = $query1->fetch()){
				array_push($amount, $row['amount']);
				$n++;
			}

			$feed = loadFeed($rows, ["password", "deleted"]);

			$feed['sales_amount'] = $amount;
			$feed['sales_count'] = $n;

			array_push($feedback, $feed);
		}

		echo json_encode(["status"=>"success", "message"=>"Staff fetched successfully", "data"=> $feedback]);

	}
}

if(isset($_POST['add_staff'])){

	$conn = $pdo->open();

	$query = $conn->prepare("SELECT count(*) as count from users where username = :username");
	$query->execute(['username'=>stripper($_POST['username'])]);
	$row = $query->fetch();

	if($row && $row['count'] > 0){
		echo json_encode(["status"=>"failed", "message"=>"Username already exist, choose a different username"]);
		return;
	}

	try{
		$query = $conn->prepare("INSERT into users (first_name, last_name, email, phone, username, password, role) VALUES (:first_name, :last_name, :email, :phone, :username, :password, :role)");
		$query->execute([
			"first_name" => stripper($_POST['first_name']),
			"last_name" => stripper($_POST['last_name']),
			"email" => stripper($_POST['email']),
			"phone" => stripper($_POST['phone']),
			"username" => stripper($_POST['username']),
			"password" => pass($_POST['password']),
			"role" => $_POST['role'],
		]);

		echo json_encode(["status"=>"success", "message"=> stripper($_POST['first_name'])." added to database"]);

	}

	catch(PDOException $e){
		echo json_encode(["status"=>"failed", "message"=>"Could not add user to database".$e]);
	}

}

if(isset($_GET['get_role'])){
	die($_SESSION['role']);
}

if(isset($_POST['fetch_username'])){
	$conn = $pdo->open();
	$query = $conn->prepare("SELECT * from users where username = :username AND role != 2 AND deleted = 0");
	$query->execute(["username" => stripper($_POST['fetch_username'])]);

	$row = $query->fetch();
	if(!$row){
		echo json_encode(["status"=>"failed", "message"=>"User not found!"]);
	}

	else{
		$query = $conn->prepare("SELECT amount from sale_summary where created_by = :id");
		$query->execute(['id'=>$row['id']]);

		$amount = array();
		$n = 0;

		while($rows = $query->fetch()){
			array_push($amount, $rows['amount']);
			$n++;
		}
		
		$row['sales_amount'] = $amount;
		$row['sales_count'] = $n;

		$feed = loadFeed($row, ["password", "updated_at", "deleted"]);

		echo json_encode(["status"=>"success", "message"=>"User fetch successful", "data"=>$feed]);
	}
}

 ?>