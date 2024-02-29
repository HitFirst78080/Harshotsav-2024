<?php
require_once 'api/config.php';
$table = tableName();
$errors = array(); 
$data = array();	

$conn = connectDB();
		$user_name = htmlspecialchars(strip_tags(trim($_POST['user_name'])));
        $user_mail = htmlspecialchars(strip_tags(trim($_POST['user_mail'])));
        $user_phone = htmlspecialchars(strip_tags(trim($_POST['user_phone'])));
		$user_city = htmlspecialchars(strip_tags(trim($_POST['user_city'])));
        $user_store = htmlspecialchars(strip_tags(trim($_POST['enquiry_for'])));
        $utm_source = htmlspecialchars(strip_tags(trim($_POST['utm_source'])));
        $utm_medium = htmlspecialchars(strip_tags(trim($_POST['utm_medium'])));
        $utm_campaign = htmlspecialchars(strip_tags(trim($_POST['utm_campaign'])));

	if (empty($user_name) || !isset($user_name)) {

		$errors['error'] = 'User Name Required';
		$data['success'] = false;
		$data['errors']  = $errors;
		mysqli_close($conn);	
		echo json_encode($data);
		exit;
	}
	if (empty($user_phone)){
		$errors['error'] = 'Mobile Number Required';
		$data['success'] = false;
		$data['errors']  = $errors;
		mysqli_close($conn);	
		echo json_encode($data);
		exit;
	}
	if(!preg_match("/^[2-9]\d{9}$/", $user_phone)){
		$errors['error'] = 'Incorrect Phone Number Format';
		$data['success'] = false;
		$data['errors']  = $errors;
		mysqli_close($conn);	
		echo json_encode($data);
		exit;
	}
	if($user_phone){
		$sql = "SELECT * FROM ". $table ." WHERE user_phone = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $user_phone);
		$stmt->execute();
		$stmt->store_result();
		$count = $stmt->num_rows;

		 if($count>0){
		 	$errors['error'] = 'Mobile number is already registered.';
		 	$data['success'] = false;
		 	$data['errors']  = $errors;
		 	mysqli_close($conn);	
		 	echo json_encode($data);
		 	exit;
		 }	

	    if (isset($_POST['user_phone'])) {
	    $sqls = "INSERT INTO ". $table ." (`user_name`, `user_mail`, `user_phone`, `user_city`, `interested_store`, `utm_source`, `utm_medium`, `utm_campaign`) 
        VALUES (?,?,?,?,?,?,?,?)";
		$stmts = $conn->prepare($sqls);
		$stmts->bind_param("ssssssss", $user_name,$user_mail,$user_phone,$user_city,$user_store,$utm_source,$utm_medium,$utm_campaign);
		$results = $stmts->execute();
		
		if(!$results){
		$errors['error'] = "Failure: Error: " . mysqli_error($conn);
		$data['success'] = false;
		$data['errors']  = $errors;
		}	
		else {
			$errors['error'] = null;
			$data['success'] = true;			
			$data['errors']  = $errors;
			//$res['message'] = "success";
		}
		
		mysqli_close($conn);	
		echo json_encode($data);
		exit;
	}	
}
?>

