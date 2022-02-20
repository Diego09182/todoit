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
	
	//建立資料連接
	$link = create_connection();
	
	//執行SQL查詢
	$sql = "INSERT INTO todoit(subject,content,date)
	        VALUES ('$subject','$content','$current_time')";
	$result = execute_sql($link, "news", $sql);
	
	//關閉資料連接
	mysqli_close($link);
	
	//將網頁重新導向
	header("location:main.php");
	exit();
	
?>