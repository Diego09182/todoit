<?php

	require_once("dbtools.inc.php");
	
	$current_time = date("Y-m-d H:i:s");
	$now_post_id = $_COOKIE{"news_id"};
	$schedule = 1;
	
	//建立資料連接
	$link = create_connection();
	
	//執行 UPDATE 陳述式來更新任務狀態
	$sql = "UPDATE list SET schedule = '$schedule' WHERE id = '$now_post_id'";
	$result = execute_sql($link, "news", $sql);
	
	//執行 UPDATE 陳述式來更新完成時間
	$sql = "UPDATE list SET finish_time = '$current_time' WHERE id = '$now_post_id'";
	$result = execute_sql($link, "news", $sql);
	
	//關閉資料連接
	mysqli_close($link);
	
	//將網頁重新導向
	header("location:show_posts.php?id=".$now_post_id."");
	exit();
  
?>