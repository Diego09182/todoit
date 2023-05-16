<?php
	
	require_once("dbtools.inc.php");
	
	function test_input($data) {
	  
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		
	}
	
	function error() {
		
		echo "<script>alert('輸入的資料不能為空');</script>";
		header("location:main.php");
		exit();
		
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {		 
		  
		if (empty($_POST["list"])) {
			error();
		} else {
			$list = test_input($_POST["list"]);
		}
		
	}
	
	$current_time = date("Y-m-d H:i:s");
	
	//建立資料連接
	$link = create_connection();
	
	//執行SQL查詢
	$sql = "INSERT INTO list(subject)
	        VALUES ('$list')";
	execute_sql($link, "todoit", $sql);
	
	//關閉資料連接
	mysqli_close($link);
	
	//將網頁重新導向
	header("location:main.php");
	exit();
	
?>