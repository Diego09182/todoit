<?php
  require_once("dbtools.inc.php");

  $now_post_id = $_COOKIE{"news_id"};
  
  //建立資料連接
  $link = create_connection();
  
  $sql = "DELETE FROM list WHERE id = '$now_post_id'";
  
  $result = execute_sql($link, "news", $sql);
  
  //關閉資料連接
  mysqli_close($link);
  
  //將網頁重新導向
  header("location:main.php");
  exit();
?>