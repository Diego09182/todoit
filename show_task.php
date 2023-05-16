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
	
	setcookie("task_id", $id);
	
	//建立資料連接
	$link = create_connection();
				
	//執行SQL查詢
	$sql = "SELECT * FROM task WHERE id = $id";
	$result = execute_sql($link, "todoit", $sql);
						  
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
							echo"<div class='chip left brown white-text'>";
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
							echo"<a class='waves-effect waves-light btn brown right' onclick='DeleteTask($id)'>";
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
	
	function DeleteTask(id)
	{
	  if (confirm("請確認是否刪除此任務？"))
	    location.href = "delTask.php?show_tasks=" + id;
	}
	
	
	function reset(){
		document.myForm.subject.value = ""
		document.myForm.content.value = ""
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