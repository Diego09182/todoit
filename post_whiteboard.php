<?php
	
	require_once("dbtools.inc.php");
	
	$whiteboard = $_POST["subject"]; 
	$current_time = date("Y-m-d H:i:s");
	$id = 1;
	//建立資料連接
	$link = create_connection();
	
	//執行 UPDATE 陳述式來更新時間
	$sql = "UPDATE whiteboard SET billboard = '$whiteboard',date = '$current_time' WHERE id = '$id'";
	$result = execute_sql($link,"news",$sql);
	
	//關閉資料連接
	mysqli_close($link);
	
	//將網頁重新導向
	header("location:main.php");
	exit();
	
?>