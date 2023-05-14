<?php

	require_once("dbtools.inc.php");
	
	$current_time = '00:00:00';
	$now_post_id = $_COOKIE["news_id"];
	$schedule = 0;
	
	//建立資料連接
	$link = create_connection();
				
	//執行 UPDATE 陳述式來更新任務狀態
	$sql = "UPDATE list SET schedule = '$schedule' WHERE id = '$now_post_id'";	
	$result = execute_sql($link, "todoit", $sql);
	
	//執行 UPDATE 陳述式來更新時間
	$sql = "UPDATE list SET finish_time = '$current_time' WHERE id = '$now_post_id'";
	$result = execute_sql($link, "todoit", $sql);
	
	//關閉資料連接
	mysqli_close($link);
	
	//將網頁重新導向
	header("location:show_posts.php?id=".$now_post_id."");
	exit();
  
?>