<?php
  require_once("dbtools.inc.php");

	$task_id = $_COOKIE["task_id"];
  
  //建立資料連接
  $link = create_connection();
  
  $sql = "DELETE FROM task WHERE id = '$task_id'";
  
  execute_sql($link, "todoit", $sql);
  
  //關閉資料連接
  mysqli_close($link);
  
  //將網頁重新導向
  header("location:main.php");
  exit();
?>