<?php
	
	function whiteboard()
	{ 
		require_once("dbtools.inc.php");
	
		//建立資料連接
		$link = create_connection();
	  		
		//執行SQL查詢
		$sql = "SELECT * FROM whiteboard ORDER BY date DESC LIMIT 1";
		$result = execute_sql($link,"todoit",$sql);
		$row = mysqli_fetch_assoc($result);		
		
		echo '<div class="container">';
			echo '<div class="container">';
				echo '<div class="center">';
					echo '<h3 class="tm-text-primary tm-section-title mb-4">白板</h3>';
				echo '</div>';
				echo '<div class="col s12 m6">';
					echo '<div class="card horizontal small">';
						echo '<div class="card-stacked">';
							echo '<div class="card-content">';
								echo '<h4>';
									echo '<blockquote>';
										echo $row["whiteboard"];
									echo '</blockquote>';
								echo '</h4>';
								echo '<br><br><br><br><br><br>';
								echo '<h4 class="right">';
									echo $row["date"];
								echo '</h4>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	
	}
	
	function statistics()
	{ 
		require_once("dbtools.inc.php");
	
		//建立資料連接
		$link = create_connection();
	  	
		//執行SQL查詢
		$sql = "SELECT * FROM task ORDER BY date DESC";
		$task_result = execute_sql($link, "todoit", $sql);
		//取得記錄數 
		$task_total_records = mysqli_num_rows($task_result);
		
		//執行SQL查詢
		$sql = "SELECT * FROM statistics where id ='1'";
		$result = execute_sql($link,"todoit",$sql);
		$row = mysqli_fetch_assoc($result);
		
		echo"<div class='container'>";
			echo"<div class='section'>";
				echo"<div class='row'>";
					echo"<div class='col s12 m4'>";
						echo"<h2 class='center'>".$task_total_records."<h2>";
						echo"<h3 class='center'>目前的任務數</h3>";
					echo"</div>";
					echo"<div class='col s12 m4'>";
						echo"<h2 class='center'>".$row["task_finish"]."<h2>";
						echo"<h3 class='center'>完成過的任務數</h3>";
					echo"</div>";
					echo"<div class='col s12 m4'>";
						echo"<h2 class='center'>".$row["task_count"]."<h2>";
						echo"<h3 class='center'>發布過的任務數</h3>";
					echo"</div>";
				echo"</div>";
			echo"</div>";
			echo"<br>";
		echo"</div>";
	
	}
	
?>