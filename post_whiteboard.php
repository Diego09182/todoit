<?php
	
	require_once("dbtools.inc.php");
	
	$whiteboard = $_POST["whiteboard"]; 
	$current_time = date("Y-m-d H:i:s");

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
		  
		if (empty($_POST["whiteboard"])) {
			error();
		} else {
			$whiteboard = test_input($_POST["whiteboard"]);
		}
		
	}

	//建立資料連接
	$link = create_connection();
	
	//執行 UPDATE 陳述式來更新時間
	$sql = "INSERT INTO whiteboard(whiteboard,date)
	VALUES ('$whiteboard','$current_time')";
	execute_sql($link, "todoit", $sql);
	
	//關閉資料連接
	mysqli_close($link);
	
	//將網頁重新導向
	header("location:main.php");
	exit();
	
?>