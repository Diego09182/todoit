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
	<nav class="light lighten-1 brown" role="navigation">
		<div class="nav-wrapper container"><a id="logo-container" href="main.php" class="brand-logo center" @click="reset()"><b>TO DO IT</b></a>
		  <ul class="left hide-on-med-and-down">
		  </ul>
		  <ul class="right hide-on-med-and-down">
			<li><a class="waves-effect" href="myhome.php">設定工具</a></li>
			<?php
				if ($member_id == 45)
				{
					echo"<li><a class='waves-effect' href='review.php'>審查文章</a></li>";
				}
			?>
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
			<h1 class="header center"><b>TO DO IT</b></h1>
			<div class="row center">
				<h5 class="header col s12 light">A fast , convenient and practical task management tool</h5>
			</div>
			<br><br>
		</div>
	</div>

	
	<div class="container center" id="app">
	 
	<br>
	
    <?php	  
	
	//取得要顯示之記錄
	$id = $_GET["id"];
	
	setcookie("news_id", $id);
	
	//建立資料連接
	$link = create_connection();
				
	//執行SQL查詢
	$sql = "SELECT * FROM list WHERE id = $id";
	$result = execute_sql($link, "news", $sql);
						  
    //顯示原討論主題的內容
	while ($row = mysqli_fetch_assoc($result))
	{	
		
		echo"<div class='row'>";
			echo"<div class='col s12 m12'>";
				echo"<div class='card'>";
						echo"<div class='card-content'>";
							echo"<div class='left'>任務重要性:";
								echo"<b>".$row["importance"]."</b>";
							echo"</div>";
							echo"<div class='right'>任務狀況:";
								if($row["schedule"] == 1){
									echo"已完成";
								}
								if($row["schedule"] == 0){
									echo"未完成";
								}
							echo"</div>";
							echo"<br>";
							echo"<h3>".$row["subject"]."</h4>";
							echo"<h5 v-bind:style='fontStyle'>".$row["content"]."</h5>";
							echo"<br>";
							echo"<div class='chip left brown'>";
								echo"#".$row["tag"];
							echo"</div>";
							echo"<p class='right'>發文時間:".$row["date"]."</p>";
							echo"<br>";
							echo"<p class='right'>完成時間:".$row["finish_time"]."</p>";
							echo"<br><br>";
							echo"<a class='waves-effect waves-light btn brown left' href='finish.php'>";
								echo"<b>完成</b>";
							echo"</a>";
							echo"<a class='waves-effect waves-light btn brown left' href='nofinish.php'>";
								echo"<b>未完成</b>";
							echo"</a>";
							echo"<a class='waves-effect waves-light btn brown right' onclick='DeletePost($id)'>";
								echo"刪除";
							echo"</a>";
							echo"<br><br>";
						echo"</div>";
				echo"</div>";
			echo"</div>";	
		echo"</div>";
	echo"</div>";
		
		echo"<br>";
		
	}	
			

    //執行 SQL 命令
    $sql = "SELECT * FROM reply_message WHERE reply_id = $id";
    $result = execute_sql($link, "news", $sql);
	  
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
			
    if (mysqli_num_rows($result) <> 0)
    {		  	
      //顯示回覆主題的內容
		while ($row = mysqli_fetch_assoc($result))
		{	
			
			$avatar = $row["avater"];
			
			echo"<div class='container'>";
				echo"<ul class='collection'>";
					echo"<li class='collection-item avatar'>";
						echo"<img src='$avatar' alt='' class='circle'>";
						echo"<span class='title left'>".$row["subject"]."</span>";
						echo"<span class='author right'>發文者:".$row["author"]."</span>";
						echo"<br>";
						echo"<p class='right'>".$row["date"]."</p>";
						echo"<br>";
						echo"<hr>";
						echo"<span class='left'>".$row["content"]."</span>";
						echo"<br>";
						echo"<br>";
						echo"<br>";
					echo"</li>";
				echo"</ul>";
			echo"</div>";
		}
    }
		
		//釋放記憶體空間
		mysqli_free_result($result);
		mysqli_close($link);
		
	?>
	
	<div id="modal3" class="modal">
		<div class="modal-content">
			<h4 class="center-align">檢舉貼文</h4>
				<div class="col s12 m6">
					<div class="card blue-grey darken-1 card">
					<div class="card-content white-text">
					<span class="card-title">此貼文違反的規定</span>
						<form name="report" method="post" action="report.php">
							<div class="input-field col m4 right">
								<i class="material-icons prefix">perm_identity</i>
								<input class="validate" name="author" type="text" value="<?php echo $users_row{"account"} ?>" readonly>
								<input type="hidden" name="reply_id" value="<?php echo $id ?>">
								<label for="icon_prefix2">帳號</label>
							</div>
							<div class="row">
								<div class="input-field col s12 m12">
									<i class="material-icons prefix">mode_edit</i>
									<input name="report"  id="name" type="text" class="validate" length="15">
									<label for="last_name">檢舉原因</label>
								</div>
								<div class="input-field col s12 m12">
									<i class="material-icons prefix">mode_edit</i>
									<textarea name="report_content" id="textarea" class="materialize-textarea" length="40"></textarea>
									<label for="last_name">檢舉附註內容</label>
								</div>
							</div>
							<br>
							<div class="card-action center-align">
								<a class="waves-effect waves-light btn brown" id="button" onClick="check_report()">發送</a>
								<a class="waves-effect waves-light btn brown" id="button" onClick="reset_report()">重新輸入</a>
								<br>
								<br>
								<a href="main.php">回首頁</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div id="modal1" class="modal">
		<div class="modal-content">
			<h4 class="center-align">回覆貼文</h4>
			<div class="col s12 m6">
				<div class="card blue-grey darken-1 card">
					  <div class="card-content white-text">
						<form name="myForm" method="post" action="post_reply.php">
							<input type="hidden" name="reply_id" value="<?php echo $id ?>">
							<input type="hidden" name="avater" value="<?php echo $user_avatar ?>">
							<span class="card-title">留言板</span>
								<div class="input-field col s3 m3 right">
									<i class="material-icons prefix">perm_identity</i>
									<input class="validate" name="author" type="text" value="<?php echo $users_row{"account"} ?>" readonly>
									<label for="icon_prefix2">帳號</label>
								</div>
							<div class="row">
								<div class="input-field col s12 m12">
									<i class="material-icons prefix">mode_edit</i>
									<input name="subject"  id="last_name" type="text" class="validate" length="15">
									<label for="last_name">主題</label>
								</div>
								<div class="input-field col s12 m12">
								  <i class="material-icons prefix">mode_edit</i>
								  <textarea name="content" id="textarea1" class="materialize-textarea" length="40"></textarea>
								  <label for="last_name">內容</label>
								</div>
							</div>
							<br>
							<div class="card-action center-align">
								<a class="waves-effect waves-light btn brown" id="button" onClick="check_data()">發送</a>
								<a class="waves-effect waves-light btn brown" id="button" onClick="reset()">重新輸入</a>
								<br>
								<br>
								<a href="main.php">回首頁</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<br><br>
	
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
	
</div>		
</body>
<!--  Scripts-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.8/vue.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.2.0/anime.js" integrity="sha256-kRbW+SRRXPogeps8ZQcw2PooWEDPIjVQmN1ocWVQHRY=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="js/init.js"></script>
<script type="text/javascript">
	
	new Vue({
	    el: '#app',
	    data: {
	        fontsizesetting: 30,
	        fontStyle: {
	            'font-size': '30px'
	        }
	    },
	    methods: {
	        increasefontsize() {
	            this.fontStyle['font-size'] = `${this.fontsizesetting+= 5}px`
	        },
	        decreasefontsize() {
	            this.fontStyle['font-size'] = `${this.fontsizesetting-= 5}px`
	        },
	    }
	})
	
	function DeletePost(id)
	{
	  if (confirm("請確認是否刪除此貼文？"))
	    location.href = "delPost.php?show_posts=" + id;
	}
	
	function check_data()
	{		
		if (document.myForm.subject.value.length == 0)
		  {
			alert("回覆主題一定要填寫");
			return false;
		  }
		  if (document.myForm.subject.value.length > 15)
		  {
			alert("回覆主題不可以超過15個字元");
			return false;
		  }
		  if (document.myForm.content.value.length == 0)
		  {
			alert("回覆內容一定要填寫");
			return false;
		  }
		  if (document.myForm.content.value.length > 40)
		  {
			alert("回覆內容不可以超過40個字元");
			return false;
		  }				
	  myForm.submit();
	}
	
	function check_report()
	{		
		if (document.report.report.value.length == 0)
		  {
			alert("檢舉原因一定要填寫");
			return false;
		  }
		  if (document.report.report.value.length > 15)
		  {
			alert("檢舉原因不可以超過15個字元");
			return false;
		  }
		  if (document.report.report_content.value.length == 0)
		  {
			alert("檢舉附註內容一定要填寫");
			return false;
		  }
		  if (document.report.report_content.value.length > 40)
		  {
			alert("檢舉附註內容不可以超過40個字元");
			return false;
		  }				
	  report.submit();
	}
	
	function reset(){
		document.myForm.subject.value = ""
		document.myForm.content.value = ""
	}
	
	function reset_report(){
		document.report.report.value = ""
		document.report.report_content.value = ""
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
</html>