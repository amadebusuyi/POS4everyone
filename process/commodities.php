<?php

session_start();

require_once "functions.php";
require_once "conn.php";

if(isset($_GET['add_category'])){
	$conn = $pdo->open();

	$query = $conn->prepare("SELECT count(*) as count from categories where name = :name AND deleted = 0");
	$query->execute(["name"=>stripper($_GET['cat_name'])]);
	$row = $query->fetch()['count'];
	if($row && $row > 0){
		echo json_encode(["status" => "failed", "message" => "Category name already exist, choose a different name"]);
	}

	else{
		try{
			$query = $conn->prepare("INSERT into categories (name, created_by, description) values (:name, :created_by, :description)");
			$query->execute([
				"name" => stripper($_GET['cat_name']),
				"created_by" => $_GET['add_category'],
				"description" => $_GET['description']
			]);

			echo json_encode([
				"status" => "success",
				"message" => stripper($_GET['cat_name'])." added to categories"
			]);
		}

		catch(PDOException $e){
			echo json_encode([
				"status" => "failed",
				"message" => "An error prevented the adding of category name to database. \n".$e
			]);
		}
	}
}

if(isset($_GET['update_category'])){
	$id = $_GET['update_category'];

	$conn = $pdo->open();

	try{
		$query = $conn->prepare("UPDATE categories set name = :name, description = :description where id = :id");
		$query->execute([
			"id" => $id,
			"name" => stripper($_GET['catname']),
			"description" => stripper($_GET['catdesc'])
		]);
		echo json_encode(["status"=>"success", "message"=>"Category information updated successfully"]);
	}
	catch(PDOException $e){
		echo json_encode(["status"=>"failed", "message"=>"Could not update category information"]);
	}
}

if(isset($_POST['fetch_categories'])){

	$conn = $pdo->open();

	if(!isset($_SESSION['role']) || $_SESSION['role'] == 0){
		echo json_encode(["status"=>"failed", "message"=>"You are not authorized to perform this process"]);
	}
	else{
		$query = $conn->prepare("SELECT * from categories where deleted = 0");
		$query->execute();

		$feedback = array();

		while($rows = $query->fetch()){

			$query_product = $conn->prepare("SELECT count(*) as count from commodities where category = :cat_id and deleted = 0");
			$query_product->execute(['cat_id'=>$rows['id']]);

			$rows['products_count'] = $query_product->fetch()['count'];

			$query_fname = $conn->prepare("SELECT first_name from users where id = :id");
			$query_fname->execute(["id"=>$rows["created_by"]]);

			$rows['created_by'] = $query_fname->fetch()['first_name'];

			$feed = loadFeed($rows, ["updated_at", "deleted"]);

			array_push($feedback, $feed);
		}

		echo json_encode(["status"=>"success", "message"=>"Commodities fetched successfully", "data"=> $feedback]);

	}
}

if(isset($_POST['multi_del_cat'])){
	$ids = $_POST['multi_del_cat'];

	$ids = explode(",", $ids);

	$conn = $pdo->open();
	$check = 0;
	$fail = array();
	for($i = 0; $i < count($ids); $i++){
		try{	
			$query = $conn->prepare("UPDATE categories set deleted = 1 where id = :id");
			$query->execute(["id" => $ids[$i]]);
			$check = 1;
		}

		catch(PDOException $e){
			array_push($fail, $i);
		}
	}

	if($check == 0){
		die(json_encode(["status"=>"failed", "message"=>"Could not delete categories"]));
	}

	elseif(count($fail) == 0){
		die(json_encode(["status"=>"success", "message"=>count($ids)." categories deleted from database"]));
	}

	else{
		die(json_encode(["status"=>"success", "message"=>"Could not delete ".count($fail)." categories from database"]));
	}
}

// END OF CATEGORIES -------->


// BEGINNING OF SUPPLIERS -------->

if(isset($_GET['add_supplier'])){
	$conn = $pdo->open();

	$query = $conn->prepare("SELECT count(*) as count from suppliers where name = :name AND deleted = 0");
	$query->execute(["name"=>stripper($_GET['sup_name'])]);
	$row = $query->fetch()['count'];
	if($row && $row > 0){
		echo json_encode(["status" => "failed", "message" => "Supplier name already exist, choose a different name"]);
	}

	else{
		try{
			$query = $conn->prepare("INSERT into suppliers (name, contact, description, created_by) values (:name, :contact, :description, :created_by)");
			$query->execute([
				"name" => stripper($_GET['sup_name']),
				"created_by" => $_GET['add_supplier'],
				"contact" => $_GET['sup_contact'],
				"description" => $_GET['sup_desc']
			]);

			echo json_encode([
				"status" => "success",
				"message" => stripper($_GET['sup_name'])." added to database"
			]);
		}

		catch(PDOException $e){
			echo json_encode([
				"status" => "failed",
				"message" => "An error prevented the addition of supplier to database. \n".$e
			]);
		}
	}
}

if(isset($_GET['update_supplier'])){
	$id = $_GET['update_supplier'];

	$conn = $pdo->open();

	try{
		$query = $conn->prepare("UPDATE suppliers set name = :name, description = :description, contact = :contact where id = :id");
		$query->execute([
			"id" => $id,
			"name" => stripper($_GET['supname']),
			"description" => stripper($_GET['supdesc']),
			"contact" => $_GET['supcontact'],
		]);
		echo json_encode(["status"=>"success", "message"=>"Category information updated successfully"]);
	}
	catch(PDOException $e){
		echo json_encode(["status"=>"failed", "message"=>"Could not update category information"]);
	}
}

if(isset($_POST['fetch_suppliers'])){

	$conn = $pdo->open();

	if(!isset($_SESSION['role']) || $_SESSION['role'] == 0){
		echo json_encode(["status"=>"failed", "message"=>"You are not authorized to perform this process"]);
	}
	else{
		$query = $conn->prepare("SELECT * from suppliers where deleted = 0");
		$query->execute();

		$feedback = array();

		while($rows = $query->fetch()){

			$query_product = $conn->prepare("SELECT count(*) as count from commodities where supplier = :sup_id and deleted = 0");
			$query_product->execute(['sup_id'=>$rows['id']]);

			$rows['products_count'] = $query_product->fetch()['count'];

			$query_fname = $conn->prepare("SELECT first_name from users where id = :id");
			$query_fname->execute(["id"=>$rows["created_by"]]);

			$rows['created_by'] = $query_fname->fetch()['first_name'];

			$feed = loadFeed($rows, ["updated_at", "deleted"]);

			array_push($feedback, $feed);
		}

		echo json_encode(["status"=>"success", "message"=>"Commodities fetched successfully", "data"=> $feedback]);

	}
}

if(isset($_POST['multi_del_sup'])){
	$ids = $_POST['multi_del_sup'];

	$ids = explode(",", $ids);

	$conn = $pdo->open();
	$check = 0;
	$fail = array();
	for($i = 0; $i < count($ids); $i++){
		try{	
			$query = $conn->prepare("UPDATE suppliers set deleted = 1 where id = :id");
			$query->execute(["id" => $ids[$i]]);
			$check = 1;
		}

		catch(PDOException $e){
			array_push($fail, $i);
		}
	}

	if($check == 0){
		die(json_encode(["status"=>"failed", "message"=>"Could not delete suppliers"]));
	}

	elseif(count($fail) == 0){
		die(json_encode(["status"=>"success", "message"=>count($ids)." suppliers deleted from database"]));
	}

	else{
		die(json_encode(["status"=>"success", "message"=>"Could not delete ".count($fail)." suppliers from database"]));
	}
}

// END OF SUPPLIERS ------------>

// BEGINNING OF PRODUCTS ------------>
if(isset($_GET['add_product'])){
	$conn = $pdo->open();

	try{
		$query = $conn->prepare("INSERT into commodities (generic_name, therapeutic, brand_name, category, supplier, quantity, description, unit_cost_price, unit_selling_price, created_by) values (:generic_name, :therapeutic, :brand_name, :category, :supplier, :quantity, :description, :unit_cost_price, :unit_selling_price, :created_by)");
		$query->execute([
			"generic_name" => stripper($_GET["pro_name"]),
			"therapeutic" => stripper($_GET["pro_tname"]),
			"brand_name" => stripper($_GET["pro_bname"]),
			"category" => $_GET["pro_cat"],
			"supplier" => $_GET["pro_sup"],
			"quantity" => $_GET["pro_qty"],
			"description" => stripper($_GET["pro_desc"]),
			"unit_cost_price" => $_GET["pro_cost"],
			"unit_selling_price" => $_GET["pro_sell"],
			"created_by" => $_GET["add_product"]
		]);

		echo json_encode([
			"status" => "success",
			"message" => stripper($_GET['pro_name'])." added to database"
		]);
	}

	catch(PDOException $e){
		echo json_encode([
			"status" => "failed",
			"message" => "An error prevented the addition of product to database. \n".$e
		]);
	}
}
// BEGINNING OF PRODUCTS ------------>
if(isset($_GET['add_multi_product'])){
	$conn = $pdo->open();
	$created_by = $_GET["add_multi_product"];
	$data = $_GET["data"];
	$data = json_decode($data);
	// echo $data;
	// return;
	$success = 0;
	$failed = 0;
	$errors = array();
	for ($i=0; $i < count($data); $i++) {
	$item = $data[$i];
		try{
			$query = $conn->prepare("INSERT into commodities (generic_name, therapeutic, category, supplier, quantity, description, unit_cost_price, unit_selling_price, created_by) values (:generic_name, :therapeutic, :category, :supplier, :quantity, :description, :unit_cost_price, :unit_selling_price, :created_by)");
			$query->execute([
				"generic_name" => stripper($item->generic_name),
				"therapeutic" => stripper($item->specific_name),
				"category" => $item->category,
				"supplier" => $item->supplier,
				"quantity" => $item->qty,
				"description" => stripper($item->description),
				"unit_cost_price" => explode("₦", $item->unit_cost_price)[1],
				"unit_selling_price" => explode("₦", $item->unit_selling_price)[1],
				"created_by" => $created_by
			]);

			$success++;

		}

		catch(PDOException $e){
			$failed++;
			array_push($errors, $e);
		}	
	}

	if($failed > 0 && $success == 0){
		echo json_encode([
			"status" => "failed",
			"message" => "An error prevented the addition of items to database.",
			"errors" => $errors
		]);
	}

	elseif($failed > 0 && $success > 0){
		echo json_encode([
			"status" => "failed",
			"message" => "Oops! Some of the items were not added to the database"
		]);
	}

	elseif($success > 0){
		echo json_encode([
			"status" => "success",
			"message" => "Items were added to database."
		]);
	}

	
}

if(isset($_GET['update_product'])){
	$conn = $pdo->open();

	try{
		$query = $conn->prepare("UPDATE commodities set generic_name = :generic_name, therapeutic = :therapeutic, brand_name = :brand_name, category = :category, supplier = :supplier, quantity = :quantity, description = :description, unit_cost_price = :unit_cost_price, unit_selling_price = :unit_selling_price where id = :id");
		$query->execute([
			"id" => $_GET["update_product"],
			"generic_name" => stripper($_GET["proname"]),
			"therapeutic" => stripper($_GET["protname"]),
			"brand_name" => stripper($_GET["probname"]),
			"category" => $_GET["procat"],
			"supplier" => $_GET["prosup"],
			"quantity" => $_GET["proqty"],
			"description" => stripper($_GET["prodesc"]),
			"unit_cost_price" => $_GET["procost"],
			"unit_selling_price" => $_GET["prosell"]
		]);

		echo json_encode([
			"status" => "success",
			"message" => stripper($_GET['proname'])." added to database"
		]);
	}

	catch(PDOException $e){
		echo json_encode([
			"status" => "failed",
			"message" => "An error prevented the addition of product to database. \n".$e
		]);
	}
}

if(isset($_POST['fetch_products'])){

	$conn = $pdo->open();

	$query = $conn->prepare("SELECT * from commodities where deleted = 0 order by id desc");
	$query->execute();

	$feedback = array();

	while($rows = $query->fetch()){
		if($rows["supplier"]){
			$query_sname = $conn->prepare("SELECT name from suppliers where id = :id");
			$query_sname->execute(["id"=>$rows["supplier"]]);
			$rows['supplier'] = $query_sname->fetch()['name'];
		}
		else
			$rows['supplier'] = "";

		if($rows['category']){
			$query_cname = $conn->prepare("SELECT name from categories where id = :id");
			$query_cname->execute(["id"=>$rows["category"]]);
			$rows['category'] = $query_cname->fetch()['name'];	
		}
		else
			$rows['category'] = "";	

		$feed = loadFeed($rows, ["updated_at", "deleted", "image", "note", "unit"]);

		array_push($feedback, $feed);
	}

	echo json_encode(["status"=>"success", "message"=>"Products fetched successfully", "data"=> $feedback]);
}

if(isset($_POST['multi_del_product'])){
	$ids = $_POST['multi_del_product'];

	$ids = explode(",", $ids);

	$conn = $pdo->open();
	$check = 0;
	$fail = array();
	for($i = 0; $i < count($ids); $i++){
		try{	
			$query = $conn->prepare("UPDATE commodities set deleted = 1 where id = :id");
			$query->execute(["id" => $ids[$i]]);
			$check = 1;
		}

		catch(PDOException $e){
			array_push($fail, $i);
		}
	}

	if($check == 0){
		die(json_encode(["status"=>"failed", "message"=>"Could not delete products"]));
	}

	elseif(count($fail) == 0){
		die(json_encode(["status"=>"success", "message"=>count($ids)." products deleted from database"]));
	}

	else{
		die(json_encode(["status"=>"success", "message"=>"Could not delete ".count($fail)." products from database"]));
	}
}

 ?>