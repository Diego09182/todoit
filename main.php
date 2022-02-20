<?php
	
	//資料庫
	require_once("dbtools.inc.php");
		
	//建立資料連接
	$link = create_connection();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>TODOIT</title>
  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="img/todolist.ico" type="image/x-icon" />
</head>
<style> 
	
	//卡片元件
	#card
	{
		border:5px solid #8B4513;
		padding:0px 20px; 
		border-radius:25px;
	}
	
	//分類元件
	#classification
	{	
		border-radius:25px;
	}
	
</style>
<body>
	
  <nav class="light lighten-1 brown" role="navigation">
  	<div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo center" @click="reset()"><b>TO DO IT</b></a>
  		<ul class="left hide-on-med-and-down">
  		</ul>
		<ul class="right hide-on-med-and-down">
			<li><a class="waves-effect" href="myhome.php">設定工具</a></li>
		</ul>
  		<ul id="slide-out" class="side-nav">
  			<li>
  				<div class="userView">
  					<div class="background">
  						<img src="img/head.jpg">
  					</div>
  					<?php
  						echo"<a>";
  							echo"<img class='circle' src='img/DOG.jpg'>";
  						echo"</a>";
  					?>
  					<a><span class="name">十三</span></a>
  				</div>
  			</li>
  			<blockquote>
  			<li><a class="waves-effect"><i class="material-icons">info_outline</i>聯絡資訊</a></li>
  			<li><a class="waves-effect">ssss.gladmasy@gmail.com</a></li>
  				<li class="no-padding">
  				  <ul class="collapsible collapsible-accordion">
  					<li>
  					  <a class="collapsible-header">開發者資訊<i class="material-icons">arrow_drop_down</i></a>
  					  <div class="collapsible-body">
  						<ul>
  						  <li><a href="#">ssss</a></li>
  						  <li><a href="https://github.com/Diego09182"><img src="images/GitHub.png"></a></li>
  						</ul>
  					  </div>
  					</li>
  				  </ul>
  				</li>
  			</blockquote>
  		</ul>
  		<a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
  	</div>
  </nav>
  
	<div class="section no-pad-bot" id="index-banner">
		<div class="container">
			<br><br>
			<h1 class="header center black-text"><b>TO DO IT</b></h1>
			<div class="row center">
				<h5 class="header col s12 light">A fast , convenient and practical task management tool</h5>
			</div>
			<br><br>
		</div>
	</div>
	
	<div class="fixed-action-btn horizontal click-to-toggle">
		<a class="btn-floating btn-large brown">
			<i class="material-icons">menu</i>
		</a>
		<ul>
			<li><a href="#modal1" class="btn-floating btn waves-effect waves-light blue"><i class="tooltipped" data-position="top" data-tooltip="發表任務"><i class="material-icons">mode_edit</i></i></a></li>
			<li><a href="#modal2" class="btn-floating btn waves-effect waves-light brown"><i class="tooltipped" data-position="top" data-tooltip="撰寫事項"><i class="material-icons">mode_edit</i></i></a></li>
			<li><a href="#modal3" class="btn-floating btn waves-effect waves-light green"><i class="tooltipped" data-position="top" data-tooltip="白板"><i class="material-icons">mode_edit</i></i></a></li>
		</ul>
	</div>
	
	<div id="modal1" class="modal">
		<div class="modal-content">
			<div class="card blue-grey darken-1 card">
				<form name="myForm" method="post" action="post.php" enctype="multipart/form-data">
						<div class="card-content white-text">
							<span class="card-title">發表任務</span>
							<div class="input-field col s12">
								<i class="material-icons prefix">mode_edit</i>
								<input class="validate" name="subject" type="text" size="15" length="15">
								<label for="icon_prefix2">任務主題</label>
							</div>
							<br>
							<div class="input-field col s12">
								<div class="input-field col s6">
									<i class="material-icons prefix">mode_edit</i>
									<textarea class="materialize-textarea" name="content" size="30" length="30"></textarea>
									<label for="icon_prefix2">任務內容</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s6">
									<i class="material-icons prefix">mode_edit</i>
									<input class="validate" name="tag" type="text" size="4" length="4">
									<label for="icon_prefix2">任務標籤</label>
								</div>
								<div class="input-field col s6">
									<select name="importance">
										<option value="" disabled selected>選擇任務重要性</option>
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
							<a class="waves-effect waves-light btn brown right" onClick="check_data()">確定</a>
							<a class="waves-effect waves-light btn brown right" onClick="reset()">重新輸入</a>
							<br><br>
						</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="modal2" class="modal">
		<div class="modal-content">
			<div class="card blue-grey darken-1 card">
				<form name="list" method="post" action="post_list.php" enctype="multipart/form-data">
					<div class="card-content white-text">
						<span class="card-title">發表事項</span>
						<div class="input-field col s12">
							<i class="material-icons prefix">mode_edit</i>
							<input class="validate" name="subject" type="text" size="15" length="15">
							<label for="icon_prefix2">任務事項</label>
						</div>
						<br>
						<a class="waves-effect waves-light btn brown right" onClick="check_list()">確定</a>
						<a class="waves-effect waves-light btn brown right" onClick="reset_list">重新輸入</a>
						<br><br>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="modal3" class="modal">
		<div class="modal-content">
			<div class="card blue-grey darken-1 card">
				<form name="billboard" method="post" action="post_whiteboard.php" enctype="multipart/form-data">
					<div class="card-content white-text">
						<span class="card-title">白板</span>
						<div class="input-field col s12">
							<i class="material-icons prefix">mode_edit</i>
							<input class="validate" name="subject" type="text" size="15" length="15">
							<label for="icon_prefix2">白板內容</label>
						</div>
						<br>
						<a class="waves-effect waves-light btn brown right" onClick="check_billboard()">確定</a>
						<a class="waves-effect waves-light btn brown right" onClick="reset_billboard()">重新輸入</a>
						<br><br>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div class="container">
		<div class="row">
		<?php	
			
			echo"<div class='col s12 m4 right'>";
					echo"<div class='collection center-align' id='classification'>";
						echo"<a  class='collection-item black-text'><h4>任務分類</h4></a>";
						echo"<a  class='collection-item black-text'>工作任務</a>";
						echo"<a  class='collection-item black-text'>長期計畫</a>";
						echo"<a  class='collection-item black-text'>休憩時間</a>";
						echo"<a  class='collection-item black-text'>旅遊安排</a>";
						echo"<a  class='collection-item black-text'>社交活動</a>";
					echo"</div>";
			echo"</div>";
					
			//指定每頁顯示幾筆記錄
			$records_per_page = 2;
								
			//取得要顯示第幾頁的記錄
			if (isset($_GET["page"]))
				$page = $_GET["page"];
			else
				$page = 1;
										
			//執行SQL查詢
			$sql = "SELECT id,tag,subject,date,schedule,finish_time,importance FROM list ORDER BY date DESC";
			$post_result = execute_sql($link, "news", $sql);
									
			//取得記錄數 
			$total_records = mysqli_num_rows($post_result);
								
			//計算總頁數
			$total_pages = ceil($total_records / $records_per_page);
								
			//計算本頁第一筆記錄的序號
			$started_record = $records_per_page * ($page - 1);
								
			//將記錄指標移至本頁第一筆記錄的序號
			mysqli_data_seek($post_result, $started_record);					
							  
			//顯示貼文
			$j = 1;
			while ($row = mysqli_fetch_assoc($post_result) and $j <= $records_per_page)
			{
				echo"<div class='col s12 m4'>";
					echo"<div class='card hoverable small center'  id='card'>";
						echo"<div class='card-content'>";
							echo"<h5>";
								echo"任務主題:".$row["subject"];
							echo"</h5>";
							echo"<br>";
							echo"<div class='chip left brown'>";
								echo"#".$row["tag"];
							echo"</div>";
							echo"<br><br>";
							echo"<p class='truncate right'>";
								echo"發布時間:".$row["date"];
							echo"</p>";
							echo"<br>";
							echo"<p class='truncate right'>";
								echo"完成時間:".$row["finish_time"];
							echo"</p>";
							echo"<br>";
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
							echo"<a class='waves-effect waves-light btn right brown' href='show_posts.php?id=".$row["id"]."'>";
								echo"查看";
							echo"</a>";
						echo"</div>";
					echo"</div>";
				echo"</div>";
							
				$j++;
			}
							
			//產生導覽列
			echo"<ul class='pagination center'>";						
				if ($page > 1)
					echo "<li class='waves-effect'><a href='main.php?page=". ($page - 1) ."'><i class='material-icons'>chevron_left</i></a></li>";
										
				for ($i = 1; $i <= $total_pages; $i++)
				{
					if ($i == $page)
						echo "<li class='waves-effect'><a href='main.php?page=$i'>$i</a></li>";
					else
						echo"<li class='waves-effect'><a href='main.php?page=$i'>$i</a></li>";
				}
									
				if ($page < $total_pages)
					echo"<li class='waves-effect'><a href='main.php?page=". ($page + 1) ."'><i class='material-icons'>chevron_right</i></a></li>";
				echo "</p>";		
			echo"</ul>";
		?>
		</div>
	</div>
	
	<?php
	
		//執行SQL查詢
		$sql = "SELECT id,billboard,date FROM whiteboard";
		$result = execute_sql($link,"news",$sql);
		$row = mysqli_fetch_assoc($result);
		
	?>
	
	<div class="container">
		<div class="container">
			<div class="center">
				<h3 class="tm-text-primary tm-section-title mb-4">白板</h3>
			</div>
			<div class="col s12 m6">
				<div class="card horizontal small">
				  <div class="card-stacked">
					<div class="card-content">
						<h4>
							<blockquote>
								<?php echo $row["billboard"] ?>
							</blockquote>
						</h4>
						<br><br><br><br><br>
						<h4 class="right">						
							<?php echo $row["date"] ?>
						</h4>
					</div>
				  </div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container">  
		<div class="section">	
		  <div class="row">
			<div class="col s12 m4">
			  <div class="icon-block">
				<h2 class="center brown-text"><i class="material-icons">flash_on</i></h2>
				<h5 class="center">快速上手</h5>
				<p class="light center">方便快速的使用方式</p>
			  </div>
			</div>
			<div class="col s12 m4">
			  <div class="icon-block">
				<h2 class="center brown-text"><i class="material-icons">group</i></h2>
				<h5 class="center">注重UI/UX</h5>
				<p class="light center">簡單UI設計</p>
			  </div>
			</div>
			<div class="col s12 m4">
			  <div class="icon-block">
				<h2 class="center brown-text"><i class="material-icons">mode_edit</i></h2>
				<h5 class="center">簡易編寫</h5>
				<p class="light center">響應式設計</p>
			  </div>
			</div>
		  </div>
		</div>
		<br><br><br>
	</div>

	<footer class="page-footer brown">
		<div class="container">
		  <div class="row">
			<div class="col l6 s12">
			  <h5 class="white-text">開發者:ssss</h5>
			  <h5 class="grey-text text-lighten-4">我是一個PHP學習者</h5>
			  <h5 class="grey-text text-lighten-4">這是一個藉由Materialize和PHP開發的小型工具</h5>
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
			<p class="center-align">Made by <a class="orange-text text-lighten-3" href="http://www.materializecss.cn">Materialize</a></p>
		  </div>
		</div>
	</footer>
	
<!--  Scripts-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.8/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-router/3.0.1/vue-router.js"></script>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.2.0/anime.js" integrity="sha256-kRbW+SRRXPogeps8ZQcw2PooWEDPIjVQmN1ocWVQHRY=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v6.0"></script>
<script src="js/init.js"></script>
<script type="text/javascript">
		
		function check_data()
		{
		  if (document.myForm.subject.value.length == 0)
		  {
				alert("主題一定要填寫");
				return false;
		  }
		  if (document.myForm.content.value.length == 0)
		  {
				alert("內容一定要填寫");
				return false;
		  }
		  
		  myForm.submit();
		}
		
		function check_billboard()
		{
		  if (document.billboard.subject.value.length == 0)
		  {
				alert("白板主題一定要填寫");
				return false;
		  }
		  
		  billboard.submit();
		}
		
		function check_list()
		{

		  if (document.list.content.value.length == 0)
		  {
				alert("事項內容一定要填寫");
				return false;
		  }
		  
		  list.submit();
		}
		
		function reset(){
			document.myForm.subject.value = ""
			document.myForm.content.value = ""
			document.myForm.tag.value = ""
		}
		
		function reset_billboard(){
			document.billboard.subject.value = ""
		}
		
		function reset_list(){
			document.list.subject.value = ""
		}
		
		$(document).ready(function(){
			$('.parallax').parallax();
			$('.button-collapse').sideNav();
			$('.carousel.carousel-slider').carousel({full_width: true});
			$('.modal').modal();
			$('.materialboxed').materialbox();
			$('.tooltipped').tooltip({delay: 50});
			$('.chips').material_chip();
			$('.collapsible').collapsible();
			$('.carousel').carousel();
			$('.slider').slider({full_width: true});
			$('select').material_select();
			$(".button-collapse").sideNav();
		});
	
</script>

  </body>
</html>
