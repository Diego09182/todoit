<?php
	
	//資料庫
	require("dbtools.inc.php");
	//組件庫
	require("component.php");
	
	//建立資料連接
	$link = create_connection();
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	<title>TO DO IT</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet">
	<link rel="shortcut icon" href="img/todolist.ico" type="image/x-icon" />
</head>
<body>
<div id="app">

  	<navigation></navigation>
  
	<banner></banner>
	
	<tools></tools>
	
	<taskform></taskform>

	<div id="modal1" class="modal">
		<div class="modal-content">
			<div class="card blue-grey darken-1 card">
				<form name="TaskForm" method="post" action="post.php">
					<div class="card-content white-text">
						<span class="card-title">發表任務</span>
						<div class="input-field col s12">
							<i class="material-icons prefix">mode_edit</i>
							<input class="validate" name="task" v-model="task" type="text" size="15" length="15" @keyup.enter="check_task()">
							<label for="icon_prefix2">任務主題</label>
						</div>
						<br>
						<div class="input-field col s12">
							<div class="input-field col s6">
								<i class="material-icons prefix">mode_edit</i>
								<textarea class="materialize-textarea" name="content" v-model="content" size="30" length="30" @keyup.enter="check_task()"></textarea>
								<label for="icon_prefix2">任務內容</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s6">
								<select name="tag" v-model="tag">
									<option value="" disabled>選擇任務標籤</option>
									<option value="待處理">待處理</option>
									<option value="進行中">進行中</option>
								</select>
								<label>任務標籤:</label>
							</div>
							<div class="input-field col s6">
								<select name="importance">
									<option value="" disabled>選擇任務重要性</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								<label>任務重要性</label>
							</div>
						</div>
						<br>
						<a class="waves-effect waves-light btn brown right" @click="check_task()">確定</a>
						<a class="waves-effect waves-light btn brown right" @click="reset()">重新輸入</a>
						<br><br>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="modal2" class="modal">
		<div class="modal-content">
			<div class="card blue-grey darken-1 card">
				<form name="ListForm" method="post" action="post_list.php">
					<div class="card-content white-text">
						<span class="card-title">發表事項</span>
						<div class="input-field col s12">
							<i class="material-icons prefix">mode_edit</i>
							<input class="validate" name="list" v-model="list" type="text" size="7" length="7" @keyup.enter="check_list()">
							<label for="icon_prefix2">事項</label>
						</div>
						<br>
						<a class="waves-effect waves-light btn brown right" @click="check_list()">確定</a>
						<a class="waves-effect waves-light btn brown right" @click="reset_list()">重新輸入</a>
						<br><br>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="modal3" class="modal">
		<div class="modal-content">
			<div class="card blue-grey darken-1 card">
				<form name="WhiteboardForm" method="post" action="post_whiteboard.php">
					<div class="card-content white-text">
						<span class="card-title">白板</span>
						<div class="input-field col s12">
							<i class="material-icons prefix">mode_edit</i>
							<input class="validate" name="whiteboard" v-model="whiteboard" type="text" size="25" length="25" @keyup.enter="check_whiteboard()">
							<label for="icon_prefix2">白板內容</label>
						</div>
						<br>
						<a class="waves-effect waves-light btn brown right" @click="check_whiteboard()">確定</a>
						<a class="waves-effect waves-light btn brown right" @click="reset_whiteboard()">重新輸入</a>
						<br><br>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="modal4" class="modal">
		<div class="modal-content">
			<div class="card blue-grey darken-1 card">
				<form name="ActivityForm" method="post" action="post_activity.php">
					<div class="card-content white-text">
						<span class="card-title">活動</span>
						<div class="input-field col s12">
							<i class="material-icons prefix">mode_edit</i>
							<input class="validate" name="activity" v-model="activity" type="text" size="10" length="10" @keyup.enter="check_activity()">
							<label for="icon_prefix2">活動名稱</label>
						</div>
						<div class="input-field col s12">
							<i class="material-icons prefix">mode_edit</i>
							<input class="validate" name="content" v-model="content" type="text" size="20" length="20" @keyup.enter="check_activity()">
							<label for="icon_prefix2">活動內容</label>
						</div>
						<div class="input-field col s12">
							<i class="material-icons prefix">mode_edit</i>
							<input class="validate" name="location" v-model="location" type="text" size="20" length="20" @keyup.enter="check_activity()">
							<label for="icon_prefix2">活動地點</label>
						</div>
						<div class="input-field col s12">
							<i class="material-icons prefix">mode_edit</i>
							<input class="validate" name="date" v-model="date" type="date">
						</div>
						<br>
						<a class="waves-effect waves-light btn brown right" @click="check_activity()">確定</a>
						<a class="waves-effect waves-light btn brown right" @click="reset()">重新輸入</a>
						<br>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php
		
		echo"<div class='container'>";
		
			//指定每頁顯示幾筆記錄
			$records_per_page = 2;
								
			//取得要顯示第幾頁的記錄
			$page = isset($_GET["page"]) ? $_GET["page"] : 1;
			$list_page = isset($_GET["list_page"]) ? $_GET["list_page"] : 1;
			$activity_page = isset($_GET["activity_page"]) ? $_GET["activity_page"] : 1;
				
			//執行SQL查詢
			$sql = "SELECT * FROM task ORDER BY date DESC";
			$task_result = execute_sql($link, "todoit", $sql);
									
			//取得記錄數 
			$task_total_records = mysqli_num_rows($task_result);
								
			//計算總頁數
			$total_task_pages = ceil($task_total_records / $records_per_page);
								
			//計算本頁第一筆記錄的序號
			$started_record = $records_per_page * ($page - 1);
								
			//將記錄指標移至本頁第一筆記錄的序號
			mysqli_data_seek($task_result, $started_record);					
			
			echo"<div class='row'>";
				//如果記錄數為零
				if($task_total_records==0)
				{			
					echo"<div class='col s12 m4'>";    
						echo"<h4>";
							echo"目前沒有任務";
						echo"</h4>";
					echo"</div>";
				}
				else
				{
					//顯示貼文
					$j = 1;
					while ($row = mysqli_fetch_assoc($task_result) and $j <= $records_per_page)
					{
						echo"<div class='col s12 m6 l4'>";
							echo"<div class='card hoverable center' id='card'>";
								echo"<div class='card-content'>";
									echo"<br><br>";
									echo"<h5>";
										echo"任務主題:".$row["subject"];
									echo"</h5>";
									echo"<br>";
									echo"<div class='chip left brown white-text	'>";
										echo"#".$row["tag"];
									echo"</div>";
									echo"<br><br><br><br>";
									echo"<p class='truncate right'>";
										echo"發布時間:".$row["date"];
									echo"</p>";
									echo"<br>";
									echo"<p class='truncate right'>";
										echo"完成時間:".$row["finish_time"];
									echo"</p>";
									echo"<br><br><br>";
									echo"<div class='left'>任務重要性:";
										echo"<b>".$row["importance"]."</b>";
									echo"</div>";
									echo"<br>";
									echo"<div class='left'>任務狀況:";
										if($row["schedule"] == 1){
											echo"<b>已完成</b>";
										}
										if($row["schedule"] == 0){
											echo"<b>未完成</b>";
										}
									echo"</div>";
									echo"<a class='waves-effect waves-light btn right brown' href='show_task.php?id=".$row["id"]."'>";
										echo"查看";
									echo"</a>";
									echo"<br><br>";
									echo"<div class='progress'>";
										echo "<div class='determinate' style='width: ".$row["progress"]."%;'></div>";
									echo"</div>";
								echo"</div>";
							echo"</div>";
						echo"</div>";
						$j++;
					}
				}
			
				//指定每頁顯示幾筆記錄
				$records_per_page = 5;
					
				//執行SQL查詢
				$sql = "SELECT * FROM list";
				$list_result = execute_sql($link, "todoit", $sql);
											
				//取得記錄數 
				$total_records = mysqli_num_rows($list_result);
										
				//計算總頁數
				$total_list_pages = ceil($total_records / $records_per_page);
									
				//計算本頁第一筆記錄的序號
				$started_record = $records_per_page * ($list_page - 1);
				
				//將記錄指標移至本頁第一筆記錄的序號
				mysqli_data_seek($list_result, $started_record);					
									
				//顯示貼文
				echo "<div class='col s12 m12 l4 right'>";
					echo "<ul class='collection with-header'>";
						echo "<a class='collection-item black-text center'><h4>任務列表</h4></a>";
						//如果記錄數為零
						if($total_records==0){			    
							echo"<h4><li class='collection-item'>目前沒有事項</li></h4>";
						}
						else{
							$j = 1;
							while ($row = mysqli_fetch_assoc($list_result) and $j <= $records_per_page) 
							{
								$id = $row["id"];
								echo"<h4><li class='collection-item'><div>".$row["subject"]."<a href='delList.php?id=$id' class='secondary-content'><i class='material-icons'>delete</i></a></div></li></h4>";
								$j++;
							}
						}
					echo "</ul>";
				echo "</div>";
			echo"</div>";
			
			echo "<div class='row'>";
				// 分頁
				echo "<ul class='pagination left'>";
				if ($page > 1) {
					echo "<li class='waves-effect'><a href='main.php?page=" . ($page - 1) . "&list_page=$list_page&activity_page=$activity_page'><i class='material-icons'>chevron_left</i></a></li>";
				}
				for ($i = 1; $i <= $total_task_pages; $i++) {
					if ($i == $page) {
						echo "<li class='waves-effect active'><a href='main.php?page=$i&list_page=$list_page&activity_page=$activity_page'>$i</a></li>";
					} else {
						echo "<li class='waves-effect'><a href='main.php?page=$i&list_page=$list_page&activity_page=$activity_page'>$i</a></li>";
					}
				}
				if ($page < $total_task_pages) {
					echo "<li class='waves-effect'><a href='main.php?page=" . ($page + 1) . "&list_page=$list_page&activity_page=$activity_page'><i class='material-icons'>chevron_right</i></a></li>";
				}
				echo "</ul>";
				// 分頁
				echo "<ul class='pagination right'>";
				if ($list_page > 1) {
					echo "<li class='waves-effect'><a href='main.php?page=$page&list_page=" . ($list_page - 1) . "&activity_page=$activity_page'><i class='material-icons'>chevron_left</i></a></li>";
				}
				for ($k = 1; $k <= $total_list_pages; $k++) {
					if ($k == $list_page) {
						echo "<li class='waves-effect active'><a href='main.php?page=$page&list_page=$k&activity_page=$activity_page'>$k</a></li>";
					} else {
						echo "<li class='waves-effect'><a href='main.php?page=$page&list_page=$k&activity_page=$activity_page'>$k</a></li>";
					}
				}
				if ($list_page < $total_list_pages) {
					echo "<li class='waves-effect'><a href='main.php?page=$page&list_page=" . ($list_page + 1) . "&activity_page=$activity_page'><i class='material-icons'>chevron_right</i></a></li>";
				}
				echo "</ul>";
			echo "</div>";
	
		echo"</div>";
		
		//取得現在今天日期
		$currentDate = date("Y-m-d");
		
		//執行SQL查詢
		$sql = "SELECT date FROM activity WHERE DATE_FORMAT(date, '%Y-%m-%d') = '$currentDate'";
		$activity_result = execute_sql($link,"todoit",$sql);
		
		//取得記錄數
		$activity_total_records = mysqli_num_rows($activity_result);
							
		if (mysqli_num_rows($activity_result) > 0) {
		    echo "<script>alert('今天有活動到期');</script>";
		}
		
		//指定每頁顯示幾筆記錄
		$records_per_page = 3;
			
		//執行SQL查詢
		$sql = "SELECT * FROM activity ORDER BY date DESC";
		$activity_result = execute_sql($link, "todoit", $sql);
		
		//取得記錄數 
		$activity_total_records = mysqli_num_rows($activity_result);
							
		//計算總頁數
		$total_activity_pages = ceil($activity_total_records / $records_per_page);
							
		//計算本頁第一筆記錄的序號
		$started_record = $records_per_page * ($page - 1);
							
		//將記錄指標移至本頁第一筆記錄的序號
		mysqli_data_seek($activity_result, $started_record);		
		
		echo"<div class='container'>";
			echo"<div class='row'>";
				echo"<div class='center'>";
					echo"<h3 class='tm-text-primary tm-section-title mb-4'>活動</h3>";
				echo"</div>";
				//如果記錄數為零
				if($activity_total_records==0)
				{			
					echo"<div class='center'>";    
						echo"<h4>";
							echo"目前沒有活動";
						echo"</h4>";
					echo"</div>";
				}
				else
				{
					//顯示貼文
					$j = 1;
					while ($row = mysqli_fetch_assoc($activity_result) and $j <= $records_per_page)
					{	
						$id = $row["id"];
						echo"<div class='col s12 m4'>";
							echo"<div class='card'>";
								echo"<div class='card-image waves-effect waves-block waves-light'>";
									echo"<img class='activator' src='img/todolist.ico'>";
								echo"</div>";
								echo"<div class='card-content'>";
									echo"<span class='card-title activator'>".$row["activity"]."<i class='material-icons right'>more_vert</i></span>";
									echo"<br>";
									if ($currentDate == $row["date"]) {
									    echo"<span class='left'>活動到期</span>";
									}
									echo"<span class='right'>".$row["date"]."</span>";
									echo"<br><br>";
									echo"<a class='btn-floating halfway-fab waves-effect waves-light brown right' @click='delActivity($id)'><i class='tooltipped' data-delay='50' data-tooltip='刪除活動'><i class='material-icons'>delete</i></i></a>";
									echo"<br><br>";
								echo"</div>";
								echo"<div class='card-reveal'>";
									echo"<span class='card-title'>".$row["activity"]."<i class='material-icons right'>close</i></span>";
									echo"<br>";
									echo"<h4>".$row["content"]."</h4>";
								echo"</div>";
							echo"</div>";
						echo"</div>";
						$j++;
					}
				}
			echo"</div>";
		echo"</div>";
		
		echo "<div class='row'>";
			// 分頁
			echo "<ul class='pagination center'>";
				if ($activity_page > 1) {
					echo "<li class='waves-effect'><a href='main.php?page=" . ($activity_page - 1) . "&list_page=$list_page&activity_page=$activity_page'><i class='material-icons'>chevron_left</i></a></li>";
				}
				for ($i = 1; $i <= $total_activity_pages; $i++) {
					if ($i == $activity_page) {
						echo "<li class='waves-effect active'><a href='main.php?page=$i&list_page=$list_page&activity_page=$activity_page'>$i</a></li>";
					} else {
						echo "<li class='waves-effect'><a href='main.php?page=$i&list_page=$list_page&activity_page=$activity_page'>$i</a></li>";
					}
				}
				if ($activity_page < $total_activity_pages) {
					echo "<li class='waves-effect'><a href='main.php?page=" . ($activity_page + 1) . "&list_page=$list_page&activity_page=$activity_page'><i class='material-icons'>chevron_right</i></a></li>";
				}
			echo "</ul>";
		echo "</div>";
		
		whiteboard();
		
		statistics();
		
	?>
	
	<features></features>
	
	<footers></footers>
	
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.8/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-router/3.0.1/vue-router.js"></script>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>
<script type="text/javascript"></script>
</body>
</html>