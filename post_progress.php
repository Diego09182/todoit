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
		
		if (empty($_POST["progress"])) {
			error();
		} else {
			$progress = test_input($_POST["progress"]);
		}	
		
	}
	
	$task_id = $_COOKIE["task_id"];	
	$progress = $_POST["progress"];
	
	//建立資料連接
	$link = create_connection();
	
	if ($progress==100){
		//執行SQL查詢
		$sql = "UPDATE task SET progress = '$progress',schedule = '1' WHERE id = $task_id";
	}
	else{
		//執行SQL查詢
		$sql = "UPDATE task SET progress = '$progress',schedule = '0' WHERE id = $task_id";
	}
	execute_sql($link,"todoit",$sql);
	
	//關閉資料連接
	mysqli_close($link);
	
	//將網頁重新導向
	header("location:main.php");
	exit();
  
?>