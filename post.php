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
		  
		if (empty($_POST["tag"])) {
			error();
		} else {
			$tag = test_input($_POST["tag"]);
		}
		  
		if (empty($_POST["task"])) {
			error();
		} else {
			$task = test_input($_POST["task"]);
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
	$progress = 0;
	
	//建立資料連接
	$link = create_connection();
	
	//執行SQL查詢
	$sql = "INSERT INTO task(tag,subject,content,date,progress,schedule,importance)
	        VALUES ('$tag','$task','$content','$current_time','$progress','$schedule','$importance')";
	execute_sql($link,"todoit",$sql);
	
	//執行 UPDATE 陳述式來更新任務狀態
	$sql = "UPDATE statistics SET task_count = task_count + 1 WHERE id = 1";
	execute_sql($link, "todoit", $sql);
	
	//關閉資料連接
	mysqli_close($link);
	
	//將網頁重新導向
	header("location:main.php");
	exit();
  
?>