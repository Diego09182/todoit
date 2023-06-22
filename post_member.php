<?php
	
	require_once("dbtools.inc.php");
	
	function test_input($data) {
	
		$data = trim($data);
		$data = stripslashes($data);
		return $data;
	
	}
	
	function error() {

		echo "<script>alert('輸入的資料不能為空');</script>";
		header("location:main.php");
		exit();
		
	}
	
	$task_id = $_COOKIE["task_id"];
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		  
		if (empty($_POST["member"])) {
			error();
		} else {
			$member = test_input($_POST["member"]);
		}
		  
		if (empty($_POST["position"])) {
			error();
		} else {
			$position = test_input($_POST["position"]);
		}
		  
		if (empty($_POST["work"])) {
			error();
		} else {
			$work = test_input($_POST["work"]);
		}		

	}
	
	//建立資料連接
	$link = create_connection();
	
	//執行SQL查詢
	$sql = "INSERT INTO members(members,position,work,task_id) VALUES ('$member','$position','$work','$task_id')";
	execute_sql($link,"todoit",$sql);
		
	//關閉資料連接
	mysqli_close($link);
	
	//將網頁重新導向
	header("location:show_task.php?id=".$task_id);
	exit();
	
?>