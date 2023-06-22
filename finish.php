<?php

	require_once("dbtools.inc.php");

	$finish_time = date("Y-m-d H:i:s");
	$task_id = $_COOKIE["task_id"];
	$schedule = 1;
	$progress = 100;

	//建立資料連接
	$link = create_connection();

	//執行SQL查詢
	$sql = "SELECT date FROM task WHERE id = $task_id";
	$result = execute_sql($link, "todoit", $sql);
	$row = mysqli_fetch_assoc($result);

	//將日期時間字串轉換為日期時間物件
	$date = new DateTime($row["date"]);
	$finishDateTime = new DateTime($finish_time);

	//計算時間差
	$timeDiff = $finishDateTime->diff($date);
	$time = $timeDiff->format("%H:%I:%S");

	//執行 UPDATE 陳述式來更新任務狀態
	$sql = "UPDATE task SET progress = '$progress', schedule = '$schedule', finish_time = '$finish_time', time = '$time' WHERE id = '$task_id'";
	execute_sql($link, "todoit", $sql);
	
	//執行 UPDATE 陳述式來更新任務狀態
	$sql = "UPDATE statistics SET task_finish = task_finish + 1 WHERE id = 1";
	execute_sql($link, "todoit", $sql);
	
	//關閉資料連接
	mysqli_close($link);

	//將網頁重新導向
	header("location:show_task.php?id=".$task_id."");
	exit();

?>
