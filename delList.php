<?php

	require_once("dbtools.inc.php");

	//建立資料連接
	$link = create_connection();
  
	$id = $_GET['id'];

	$sql = "DELETE FROM list WHERE id = '$id'";
	
	execute_sql($link, "todoit", $sql);
  
	//關閉資料連接
	mysqli_close($link);
  
	//將網頁重新導向
	header("location:main.php");
	exit();
	
?>