<?php

	require_once("dbtools.inc.php");
	
	$current_time = date("Y-m-d H:i:s");
	$now_post_id = $_COOKIE["news_id"];
	$schedule = 1;
	
	//建立資料連接
	$link = create_connection();
	
	//執行 UPDATE 陳述式來更新任務狀態
	$sql = "UPDATE task SET schedule = '$schedule', finish_time = '$current_time' WHERE id = '$now_post_id'";
	execute_sql($link, "todoit", $sql);
	
	//關閉資料連接
	mysqli_close($link);
	
	//將網頁重新導向
	header("location:show_task.php?id=".$now_post_id."");
	exit();
  
?>