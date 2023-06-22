<?php

	require_once("dbtools.inc.php");
	
	$current_time = '00:00:00';
	$task_id = $_COOKIE["task_id"];
	$schedule = 0;
	$progress = 0;
	
	//建立資料連接
	$link = create_connection();
	
	//執行 UPDATE 陳述式來更新任務狀態
	$sql = "UPDATE task SET progress = '$progress', schedule = '$schedule', finish_time = '$current_time' WHERE id = '$task_id'";
	execute_sql($link, "todoit", $sql);
	
	// 檢查 task_finish 是否為 0
	$sql = "SELECT task_finish FROM statistics WHERE id = 1";
	$result = execute_sql($link, "todoit", $sql);
	$row = mysqli_fetch_assoc($result);
	$taskFinish = $row['task_finish'];
	
	//執行 UPDATE 陳述式來更新任務狀態	
	if ($taskFinish > 0) {
	    $sql = "UPDATE statistics SET task_finish = task_finish - 1 WHERE id = 1";
	    execute_sql($link, "todoit", $sql);
	}
	
	//關閉資料連接
	mysqli_close($link);
	
	//將網頁重新導向
	header("location:show_task.php?id=".$task_id."");
	exit();
  
?>