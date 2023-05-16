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
		  
		if (empty($_POST["tag"])) {
			error();
		} else {
			$tag = test_input($_POST["tag"]);
		}
		  
		if (empty($_POST["subject"])) {
			error();
		} else {
			$subject = test_input($_POST["subject"]);
		}
		  
		if (empty($_POST["content"])) {
			error();
		} else {
			$content = test_input($_POST["content"]);
		}		
		
	}
	
	$current_time = date("Y-m-d H:i:s");
	$schedule = 0;
	$importance = $_POST["importance"];
	
	//建立資料連接
	$link = create_connection();
				
	//執行SQL查詢
	$sql = "INSERT INTO task(tag,subject,content,date,schedule,importance)
	        VALUES ('$tag','$subject','$content','$current_time','$schedule','$importance')";
	execute_sql($link,"todoit",$sql);
	
	//關閉資料連接
	mysqli_close($link);
	
	//將網頁重新導向
	header("location:main.php");
	exit();
  
?>