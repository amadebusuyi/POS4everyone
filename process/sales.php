<?php
session_start();
require_once "functions.php";
require_once "conn.php";

if(isset($_GET['add_customer'])){
	$name = $_GET['customer_name'];
	$phone = $_GET['customer_phone'];
	$email = $_GET['customer_email'];
	$address = $_GET['customer_address'];

	$conn = $pdo->open();

	try{
		$query = $conn->prepare("INSERT into customers (name, phone, email, address, created_by) values(:name, :phone, :email, :address, :created_by)");
		$query->execute(['name'=>$name, 'phone'=>$phone, 'email'=> $email, 'address'=>$address, 'created_by'=>$_SESSION['user']]);
		echo json_encode(['status'=>"success", "message"=>"Customer added to database"]);
	}

	catch(PDOException $e){
		echo json_encode(['status'=>"failed", "message"=>"Failed to add customer to database", "reason"=>$e]);
	}

	$pdo->close();
}

if(isset($_GET['update_customer'])){
	$name = $_GET['update_customer_name'];
	$phone = $_GET['update_customer_phone'];
	$email = $_GET['update_customer_email'];
	$address = $_GET['update_customer_address'];
	$id = $_GET['update_customer'];


	$conn = $pdo->open();

	try{
		$query = $conn->prepare("UPDATE customers set name = :name, phone = :phone, email = :email, address = :address where id = :id");
		$query->execute(['name'=>$name, 'phone'=>$phone, 'email'=> $email, 'address'=>$address, 'id'=>$id]);
		echo json_encode(['status'=>"success", "message"=>"Customer information updated"]);
	}

	catch(PDOException $e){
		echo json_encode(['status'=>"failed", "message"=>"Failed to update customer's information", "reason"=>$e]);
	}

	$pdo->close();
}

if(isset($_GET['fetch_customers'])){

	$conn = $pdo->open();
	
	$query = $conn->prepare("SELECT id, name, phone, email, address from customers where deleted = 0");
	$query->execute();

	$feedback = array();

	while($rows = $query->fetch()){
		array_push($feedback, $rows);

	}
	echo json_encode(["status"=>"success", "message"=>"customers fetched successfully", "data"=> $feedback]);

	$pdo->close();
}

if(isset($_POST['add_sale'])){
	$conn = $pdo->open();

	try{
		$query = $conn->prepare("INSERT into sale_summary (customer, amount, profit, created_by) VALUES (:customer, :amount, :profit, :created_by)");
		$query->execute(['customer'=>$_POST['customer'], 'amount'=>$_POST['amount'], 'profit'=>$_POST['profit'], 'created_by'=>$_SESSION['user']]);

		$sale_id = $conn->lastInsertId();

		$items = json_decode($_POST['items']);

		$status = 1;

		$reasons = array();

		for ($i=0; $i < count($items); $i++) { 
			try{
				$query = $conn->prepare("INSERT into sales (commodity, cost_price, selling_price, quantity, sale_id) VALUES (:commodity, :cost_price, :selling_price, :quantity, :sale_id)");
				$query->execute(['commodity'=>$items[$i]->id, 'cost_price'=>$items[$i]->cost_price, 'selling_price'=>$items[$i]->selling_price, 'quantity'=>$items[$i]->quantity, 'sale_id'=>$sale_id]);
			}

			catch(PDOException $e){
				$status = 0;
				array_push($reasons, $e);
			}
		}

		if($status === 1){
			for ($i=0; $i < count($items); $i++) { 
				$query = $conn->prepare("UPDATE commodities set quantity = quantity-:quantity where id = :id");
				$query->execute(['quantity'=>$items[$i]->quantity, 'id'=>$items[$i]->id]);
			}

			echo json_encode(["status"=>"success", "message"=>"Sale completed successfully", "id"=>$sale_id]);
		}

		else{
			$query = $conn->prepare("DELETE from sale_summary where id = :id");
			$query->execute(["id"=>$sale_id]);
			echo json_encode(["status"=>"failed", "message"=>"Could not add sale to database", "reason"=>$reasons]);
		}
	}

	catch(PDOException $e){
		echo json_encode(["status"=>"failed", "message"=>"Could not add sale to database", "reason"=>$e]);
	}

	$pdo->close();
}


if(isset($_POST['multiple_deletion'])){
	$ids = $_POST['multiple_deletion'];

	$ids = explode(",", $ids);

	$conn = $pdo->open();
	$check = 0;
	$fail = array();
	for($i = 0; $i < count($ids); $i++){
		try{	
			$query = $conn->prepare("UPDATE customers set deleted = 1 where id = :id");
			$query->execute(["id" => $ids[$i]]);
			$check = 1;
		}

		catch(PDOException $e){
			array_push($fail, $i);
		}
	}

	if($check == 0){
		die(json_encode(["status"=>"failed", "message"=>"Could not delete customers"]));
	}

	elseif(count($fail) == 0){
		die(json_encode(["status"=>"success", "message"=>count($ids)." customers deleted from database"]));
	}

	else{
		die(json_encode(["status"=>"success", "message"=>"Could not delete ".count($fail)." customers from database"]));
	}
}

if(isset($_GET['sale_history'])){
	$id = $_GET['sale_history'];
	$conn = $pdo->open();

	$query = $conn->prepare("SELECT sales.selling_price, sales.quantity, commodities.generic_name, commodities.therapeutic from sales left join commodities on commodities.id = sales.commodity where sale_id = :sale_id");
	$query->execute(["sale_id"=>$id]);
	$list = array();
	while($result = $query->fetch()){
		if($result['therapeutic'] != "")
			$res['name'] = $result['generic_name']." (".$result['therapeutic'].")";
		else
			$res['name'] = $result['generic_name'];
		$res['amount'] = "₦".$result["selling_price"];
		$res['quantity'] = $result["quantity"];
		array_push($list, $res);
	}

	echo json_encode(["status" => "success", "data" => $list]);

	$pdo->close();
}

if(isset($_GET['sales_count'])){
	$conn = $pdo->open();
	$sales = array(
		"Jan" => 0,
		"Feb" => 0,
		"Mar" => 0,
		"Apr" => 0,
		"May" => 0,
		"Jun" => 0,
		"Jul" => 0,
		"Aug" => 0,
		"Sep" => 0,
		"Oct" => 0,
		"Nov" => 0,
		"Dec" => 0
	);
	$currDate = date("Y-m-d");
	$query = $conn->prepare("SELECT * from sale_summary where deleted = 0 and YEAR(created_at) = YEAR(:currDate)");
	$query->execute(["currDate"=>$currDate]);
	while($sales_row = $query->fetch()){
	  $month = getMonthName(getMonth($sales_row['created_at']));
	  $sales[$month] = $sales[$month] + 1;
	}
	$sales = array_values($sales);
	echo json_encode($sales);
	$pdo->close();
}

?>