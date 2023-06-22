<?php
	
	require_once("dbtools.inc.php");
	
	function test_input($data) {
	  
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		
	}
	
	function error() {
		
		header("location:main.php");
		exit();
		
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {		 
		  
		if (empty($_POST["activity"])) {
			error();
		} else {
			$activity = test_input($_POST["activity"]);
		}
		
		if (empty($_POST["content"])) {
			error();
		} else {
			$content = test_input($_POST["content"]);
		}
		
		if (empty($_POST["location"])) {
			error();
		} else {
			$location = test_input($_POST["location"]);
		}
		
	}
	
	$date = $_POST["date"];
	
	//建立資料連接
	$link = create_connection();
	
	//執行SQL查詢
	$sql = "INSERT INTO activity(activity,content,location,date) VALUES ('$activity','$content','$location','$date')";
	execute_sql($link, "todoit", $sql);
	
	//關閉資料連接
	mysqli_close($link);
	
	//將網頁重新導向
	header("location:main.php");
	exit();
	
?>