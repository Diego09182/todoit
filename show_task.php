<?php

	//資料庫	
	require_once("dbtools.inc.php");
	
	//取得要顯示之記錄
	$id = $_GET["id"];
	setcookie("task_id", $id);
	
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="img/todolist.ico" type="image/x-icon" />
</head>
<style type="text/css">
  
  body{
  	font-family: 'Noto Sans TC', sans-serif;
  }
  .fontSIZE:link,
  .fontSIZE:visited{
  	display:inline-block;
  	text-decoration:none;
  	text-align:center;
  	height:30px;
  	width:30px;
  	color:black;
  	background-color:white;
  	border:1px solid green;
  }
  .fontSIZE:hover,
  .fontSIZE:active{
  	color:white;
  }
  
</style>
<body>
<div id="app">

	<navigation></navigation>
	
	<banner></banner>
	
	<tools></tools>
	
	<div id="modal1" class="modal">
		<div class="modal-content">
			<div class="card blue-grey darken-1 card">
				<form name="MemberForm" method="post" action="post_member.php" enctype="multipart/form-data">
						<div class="card-content white-text">
							<span class="card-title">任務成員</span>
							<div class="input-field col s12">
								<i class="material-icons prefix">mode_edit</i>
								<input class="validate" name="member" v-model="member" type="text" size="10" length="10">
								<label for="icon_prefix2">成員名稱</label>
							</div>
							<div class="input-field col s12">
								<i class="material-icons prefix">mode_edit</i>
								<input class="validate" name="position" v-model="position" type="text" size="20" length="20">
								<label for="icon_prefix2">成員職位</label>
							</div>
							<div class="input-field col s12">
								<i class="material-icons prefix">mode_edit</i>
								<textarea class="materialize-textarea" name="work" v-model="work" size="30" length="30"></textarea>
								<label for="icon_prefix2">成員任務</label>
							</div>
							<br>
							<a class="waves-effect waves-light btn brown right" @click="check_member()">確定</a>
							<a class="waves-effect waves-light btn brown right" @click="reset()">重新輸入</a>
							<br>
						</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="modal3" class="modal">
		<div class="modal-content">
			<div class="card blue-grey darken-1 card">
				<form name="ProgressForm" method="post" action="post_progress.php" enctype="multipart/form-data">
					<div class="card-content white-text">
						<span class="card-title">任務進度</span>
						<div class="input-field col s12">
							<p class="range-field">
							    <input name="progress" type="range" id="test1" min="0" max="100" />
							</p>
						</div>
						<br>
						<a class="waves-effect waves-light btn brown right" @click="check_progress()">確定</a>
						<br><br>
					</div>
				</form>
			</div>
		</div>
	</div>
	 
	<br>
	
    <?php
	
	//執行SQL查詢
	$sql = "SELECT * FROM task WHERE id = $id";
	$result = execute_sql($link, "todoit", $sql);
						  
    //顯示原討論主題的內容
	while ($row = mysqli_fetch_assoc($result))
	{	
		echo"<div class='container'>";
			echo"<div class='row'>";
				echo"<div class='col s12 m12'>";
					echo"<div class='card'>";
							echo"<div class='card-content center'>";
								echo"<h5>";
									echo"<div class='left'>任務重要性:";
										echo"<b>".$row["importance"]."</b>";
									echo"</div>";
								echo"</h5>";
								echo"<h5>";
									echo"<div class='right'>任務狀況:";
										if($row["schedule"] == 1){
											echo"已完成";
										}
										if($row["schedule"] == 0){
											echo"未完成";
										}
									echo"</div>";
								echo"</h5>";
								echo"<br>";
								echo"<h3>".$row["subject"]."</h4>";
								echo"<h5 v-bind:style='fontStyle'>".$row["content"]."</h5>";
								echo"<br>";
								echo"<div class='chip left brown white-text'>";
									echo"#".$row["tag"];
								echo"</div>";
								echo"<p class='right'>發文時間:".$row["date"]."</p>";
								echo"<br>";
								echo"<p class='right'>完成時間:".$row["finish_time"]."</p>";
								echo"<br><br>";
								echo"<hr>";
								echo"<a class='waves-effect waves-light btn brown left' href='finish.php'>";
									echo"<b>完成</b>";
								echo"</a>";
								echo"<a class='waves-effect waves-light btn brown left' href='nofinish.php'>";
									echo"<b>未完成</b>";
								echo"</a>";
								echo"<a class='btn-floating halfway-fab waves-effect waves-light brown right' @click='decreasefontsize'><i class='tooltipped' data-delay='50' data-tooltip='字體縮小'><i class='material-icons'>zoom_out</i></i></a>";
								echo"<a class='btn-floating halfway-fab waves-effect waves-light brown right' @click='increasefontsize'><i class='tooltipped' data-delay='50' data-tooltip='字體放大'><i class='material-icons'>zoom_in</i></i></a>";
								echo"<a class='btn-floating halfway-fab waves-effect waves-light brown right' @click='DeleteTask($id)'><i class='tooltipped' data-delay='50' data-tooltip='刪除任務'><i class='material-icons'>delete</i></i></a>";
								echo"<a class='btn-floating halfway-fab waves-effect waves-light brown right' href='#modal1'><i class='tooltipped' data-delay='50' data-tooltip='添加成員'><i class='material-icons'>group_add</i></i></a>";
								echo"<a class='btn-floating halfway-fab waves-effect waves-light brown left' href='#modal2'><i class='tooltipped' data-delay='50' data-tooltip='成員'><i class='material-icons'>group</i></i></a>";
								echo"<a data-target='dropdown' class='btn-floating halfway-fab waves-effect waves-light brown left' href='#modal3' ><i class='tooltipped' data-delay='50' data-tooltip='選擇進度'><i class='material-icons'>timeline</i></i></a>";
								echo"<br><br>";
							echo"</div>";
							echo"<div class='progress'>";
								echo "<div class='determinate' style='width: ".$row["progress"]."%;'></div>";
							echo"</div>";
					echo"</div>";
				echo"</div>";	
			echo"</div>";
		echo"</div>";
		
		echo"<br>";
		
	}	
	
	// 指定每页显示几条记录
	$records_per_page = 4;
	
	// 取得要显示第几页的记录
	if (isset($_GET["page"]))
	    $page = $_GET["page"];
	else
	    $page = 1;
	
	// 执行 SQL 查询
	$sql = "SELECT * FROM members WHERE task_id = $id";
	$member_result = execute_sql($link, "todoit", $sql);
	
	// 取得记录数
	$total_records = mysqli_num_rows($member_result);
	
	// 计算總頁數
	$total_pages = ceil($total_records / $records_per_page);
	
	// 計算本頁第一筆記錄的序號
	$started_record = $records_per_page * ($page - 1);
	
	// 將記錄指標移至本頁第一筆記錄的序號
	mysqli_data_seek($member_result, $started_record);
	
	echo "<div id='modal2' class='modal'>";
		echo "<div class='modal-content'>";
			echo "<div class='card brown darken-1 card'>";
				// 如果記錄數為零
				if ($total_records == 0) {
					echo "<br>";
					echo "<h4 class='center-align'>";
						echo "沒有任務成員";
					echo "</h4>";
				}
				if (mysqli_num_rows($member_result) <> 0) {
					echo "<table class='centered responsive-table highlight'>";
						echo "<thead>";
							echo "<tr>";
								echo "<th>成員名稱</th>";
								echo "<th>成員職位</th>";
								echo "<th>負責任務</th>";
								echo "<th>操作</th>";
							echo "</tr>";
						echo "</thead>";
						echo "<tbody>";
							$p = 0;						
							while ($row = mysqli_fetch_assoc($member_result) and $p < $records_per_page) 
							{	
								$member_id = $row["id"];
								echo "<tr>";
									echo "<td>".$row["members"]."</td>";
									echo "<td>".$row["position"]."</td>";
									echo "<td>".$row["work"]."</td>";
									echo"<td><a class='btn-floating halfway-fab waves-effect waves-light brown' @click='DeleteMember($member_id)'><i class='tooltipped' data-delay='50' data-tooltip='刪除成員'><i class='material-icons'>delete</i></i></a></td>";
								echo "</tr>";
								$p++;
							}
						echo "</tbody>";
					echo "</table>";
				}
				// 產生導覽列
				echo "<ul class='pagination center'>";
				if ($page > 1)
					echo "<li class='waves-effect'><a href='show_task.php?id=" . $id . "&page=" . ($page - 1) . "'><i class='material-icons'>chevron_left</i></a></li>";
				for ($i = 1; $i <= $total_pages; $i++) {
					if ($i == $page)
						echo "<li class='waves-effect'><a href='show_task.php?id=$id&page=$i'>$i</a></li>";
					else
						echo "<li class='waves-effect'><a href='show_task.php?id=$id&page=$i'>$i</a></li>";
				}
				if ($page < $total_pages)
					echo "<li class='waves-effect'><a href='show_task.php?id=" . $id . "&page=" . ($page + 1) . "'><i class='material-icons'>chevron_right</i></a></li>";
				echo "</ul>";
				echo "<br>";
			echo "</div>";
		echo "</div>";
	echo "</div>";

	  
	echo"<div class='container'>";
		echo"<ul class='collection'>";
			echo"<li class='collection-item avatar'>";
				echo"<span class='title left'>管理是效率之母</span>";
				echo"<span class='author right'>開發者</span>";
				echo"<br>";
				echo"<p class='right'></p>";
				echo"<br>";
				echo"<hr>";
				echo"<p class='left'>善用創造力使用此工具</p>";
				echo"<br>";
				echo"<br>";
				echo"<br>";
			echo"</li>";
		echo"</ul>";
	echo"</div>";	
	
	//釋放記憶體空間
	mysqli_free_result($result);
	mysqli_close($link);
		
	?>

	<br><br>
	
	<footers></footers>

</div>		
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.8/vue.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>
<script type="text/javascript">
	
	Vue.component('navigation', {
	  template:  
		`<nav class="light lighten-1 brown" role="navigation">
			<div class="nav-wrapper container"><a id="logo-container" href="main.php" class="brand-logo center"><b>TO DO IT</b></a>
				<ul class="left hide-on-med-and-down">
				</ul>
				<ul class="right hide-on-med-and-down">
					<li><a class="waves-effect" href="myhome.php">設定工具</a></li>
				</ul>
				<ul id="slide-out" class="side-nav">
					<li>
						<div class="userView">
							<div class="background brown">
								<img src="">
							</div>					
							<a>
								<img class='circle' src='img/TO DO LIST.png'>
							</a>
							<br>
						</div>
					</li>
					<blockquote>
					<li><a class="waves-effect"><i class="material-icons">info_outline</i>聯絡資訊</a></li>
					<li><a class="waves-effect">{{contect}}</a></li>
					<li><a class="collapsible-header">開發者資訊</a></li>
					<li><a href="https://github.com/Diego09182">{{developer}}</a></li>
					</blockquote>
				</ul>
				<a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
			</div>
		</nav>`,
		data: function(){
		    return {
				developer:"SSSS",
				contect:"ssss.gladmasy@gmail.com"
		    }
		}
	})
	
	Vue.component('banner', {
	  template:  
		`<div class="section no-pad-bot" id="banner">
			<div class="container">
				<br><br>
				<h1 class="header center black-text"><b>{{title}}</b></h1>
				<div class="row center">
					<h5 class="header col s12 light">{{slogan}}</h5>
				</div>
				<br><br>
			</div>
		</div>`,
		data: function(){
		    return {
				title:"TO DO IT",
				slogan:"A fast , convenient and practical task management tool"
		    }
		}
	})
	
	Vue.component('tools', {
	  template:  
		`<div class="fixed-action-btn horizontal click-to-toggle">
			<a class="btn-floating btn-large brown">
				<i class="material-icons">menu</i>
			</a>
			<ul>
				<li><a href="#modal1" class="btn-floating btn waves-effect waves-light blue"><i class="tooltipped" data-position="top" data-tooltip="添加成員"><i class="material-icons">group_add</i></i></a></li>
				<li><a href="#modal3" class="btn-floating btn waves-effect waves-light green"><i class="tooltipped" data-position="top" data-tooltip="選擇進度"><i class="material-icons">timeline</i></i></a></li>
			</ul>
		</div>`
	})
	
	Vue.component('footers', {
	  template:  
	    `<footer class="page-footer brown">
	      <div class="container">
	        <div class="row">
	          <div class="col l6 s12">
	            <h5 class="white-text">開發者:{{developer}}</h5>
	            <h5 class="grey-text text-lighten-4">{{info}}</h5>
	            <h5 class="grey-text text-lighten-4">{{introduction}}</h5>
	          </div>
	          <div class="col l3 s12">
	            <h5 class="white-text">相關連結</h5>
	            <ul>
	              <li><h5><a class="white-text" href="https://github.com/Diego09182">GitHub</a></h5></li>
	            </ul>
	          </div>
	        </div>
	      </div>
	      <div class="footer-copyright">
	        <div class="container">
	          <p class="center-align">© {{currentYear}} <a class="orange-text text-lighten-3" href="https://github.com/Diego09182">{{owner}}</a></p>
	        </div>
	      </div>
	    </footer>`,
	  data: function() {
	    return {
	      owner: "TO DO IT",
	      developer: "SSSS",
	      info: "一位初階PHP開發者",
	      introduction: "藉由PHP與Vue.js所驅動",
	      currentYear: new Date().getFullYear().toString()
	    }
	  }
	})
	
	new Vue({
		el: '#app',
		data: {
			fontsizesetting: 30,
			fontStyle: {
			'font-size': '30px'
			},
			member: '',
			position: '',
			work: '',
			message: '操作完成',
			delay: 1000
		},
		methods: {
			increasefontsize: function() {
				this.fontStyle['font-size'] = `${this.fontsizesetting += 5}px`;
			},
			decreasefontsize: function() {
				this.fontStyle['font-size'] = `${this.fontsizesetting -= 5}px`;
			},
			DeleteTask: function(id) {
			if (confirm("請確認是否刪除此任務？")) {
					Materialize.toast(this.message, this.delay);
					setTimeout(() => {
						location.href = "delTask.php?show_tasks=" + id;
					}, this.delay);
				}
			},
			DeleteMember: function(id) {
			if (confirm("請確認是否刪除此成員？")) {
					Materialize.toast(this.message, this.delay);
					setTimeout(() => {
						location.href = "delMember.php?id=" + id;
					}, this.delay);
				}
			},
			check_member: function() {
				if (this.member.length === 0) {
					alert("成員名稱一定要填寫");
					return false;
				}
				if (this.member.length > 10) {
					alert("成員名稱不能大於十個字");
					return false;
				}
				if (this.position.length > 20) {
					alert("成員職位不能大於二十個字");
					return false;
				}
				if (this.position.length === 0) {
					alert("成員職位一定要填寫");
					return false;
				}
				if (this.work.length === 0) {
					alert("成員任務內容一定要填寫");
					return false;
				}
				if (this.work.length > 30) {
					alert("成員任務內容不能大於三十個字");
					return false;
				}
				Materialize.toast(this.message, this.delay);
				setTimeout(() => {
					MemberForm.submit();
				}, this.delay);
			},
			check_progress: function() {
				Materialize.toast(this.message, this.delay);
				setTimeout(() => {
					ProgressForm.submit();
				}, this.delay);
			},
			reset: function() {
				this.member = "";
				this.position = "";
				this.work = "";
			}
		},
		mounted: function() {
			$('.parallax').parallax();
			$('.carousel.carousel-slider').carousel({ full_width: true });
			$('.modal').modal();
			$('.materialboxed').materialbox();
			$('.tooltipped').tooltip({ delay: 50 });
			$('.chips').material_chip();
			$('.collapsible').collapsible();
			$('.carousel').carousel();
			$('.slider').slider({ full_width: true });
			$('select').material_select();
		}
	});
	
</script>
</html>