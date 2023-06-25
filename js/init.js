
Vue.component('navigation', {
	  template:  
		`<nav class="light lighten-1 brown" role="navigation">
			<div class="nav-wrapper container"><a id="logo-container" href="main.php" class="brand-logo center"><b>TO DO IT</b></a>
				<ul class="left hide-on-med-and-down">
				</ul>
				<ul class="right hide-on-med-and-down">
					<li><a class="waves-effect" href="main.php">設定工具</a></li>
				</ul>
				<ul id="slide-out" class="side-nav">
					<li>
						<div class="userView">
							<div class="background brown">
							</div>					
							<a>
								<img class='circle' alt="TO DO IT圖標" src='img/TO DO LIST.png'>
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
					<h5 class="header col m12 light">{{slogan}}</h5>
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
				<li><a href="#modal1" class="btn-floating btn waves-effect waves-light blue"><i class="tooltipped" data-position="top" data-tooltip="發表任務"><i class="material-icons">description</i></i></a></li>
				<li><a href="#modal2" class="btn-floating btn waves-effect waves-light brown"><i class="tooltipped" data-position="top" data-tooltip="撰寫事項"><i class="material-icons">assignment</i></i></a></li>
				<li><a href="#modal3" class="btn-floating btn waves-effect waves-light green"><i class="tooltipped" data-position="top" data-tooltip="白板"><i class="material-icons">mode_edit</i></i></a></li>
				<li><a href="#modal4" class="btn-floating btn waves-effect waves-light red"><i class="tooltipped" data-position="top" data-tooltip="添加活動"><i class="material-icons">place</i></i></a></li>
			</ul>
		</div>`
	})
	
	Vue.component('features', {
	  template:  
		`<div class="container">  
			<div class="section">	
				<div class="row">
					<div class="col s12 m4">
						<div class="icon-block">
							<h2 class="center brown-text"><i class="material-icons">flash_on</i></h2>
							<h5 class="center">{{fast}}</h5>
							<p class="light center">{{fast_content}}</p>
						</div>
					</div>
					<div class="col s12 m4">
						<div class="icon-block">
							<h2 class="center brown-text"><i class="material-icons">mode_edit</i></h2>
							<h5 class="center">{{easy}}</h5>
							<p class="light center">{{easy_content}}</p>
						</div>
					</div>
					<div class="col s12 m4">
						<div class="icon-block">
							<h2 class="center brown-text"><i class="material-icons">view_quilt</i></h2>
							<h5 class="center">{{UX}}</h5>
							<p class="light center">{{UX_content}}</p>
						</div>
					</div>
				</div>
			</div>
			<br>
		</div>`,
		data: function(){
		    return {
				fast:"快速上手",
				fast_content:"方便快速的使用方式",
				easy:"簡易編寫",
				easy_content:"簡單的UI設計",
				UX:"注重UI/UX",
				UX_content:"響應式UI設計"
		    }
		}
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
					<p class="center-align">© {{year}} <a class="orange-text text-lighten-3" href="https://github.com/Diego09182">{{owner}}</a></p>
				</div>
			</div>
		</footer>`,
		data: function(){
		    return {
				year:"2023",
				owner:"TO DO IT",
				developer:"SSSS",
				info:"一位初階PHP開發者",
				introduction:"藉由PHP與Vue.js所驅動"
		    }
		}
	})
	
	new Vue({
	el: '#app',
		data: {
			task: '',
			content: '',
			importance: '',
			tag: '',
			whiteboard: '',
			list: '',
			message: '操作完成',
			activity: '',
			content: '',
			location: '',
			date:'',
			delay: 1000
		},
		methods: {
			check_task: function() {
				if (this.task.length === 0) {
					alert("任務主題一定要填寫");
					return false;
				}
				if (this.task.length > 15) {
					alert("任務主題不能大於十五個字");
					return false;
				}
				if (this.content.length === 0) {
					alert("任務內容一定要填寫");
					return false;
				}
				if (this.content.length > 30) {
					alert("任務內容不能大於三十個字");
					return false;
				}
				Materialize.toast(this.message, this.delay);
				setTimeout(() => {
					TaskForm.submit();
				}, this.delay);
			},
			check_whiteboard: function() {
				if (this.whiteboard.length === 0) {
					alert("白板主題一定要填寫");
					return false;
				}
				Materialize.toast(this.message, this.delay);
				setTimeout(() => {
					WhiteboardForm.submit();
				}, this.delay);
			},
			check_list: function() {
				if (this.list.length === 0) {
					alert("事項內容一定要填寫");
					return false;
				}
				if (this.list.length > 7) {
					alert("事項內容不能大於七個字");
					return false;
				}
				Materialize.toast(this.message, this.delay);
				setTimeout(() => {
					ListForm.submit();
				}, this.delay);
			},
			check_activity: function() {
				if (this.activity.length === 0) {
					alert("活動名稱一定要填寫");
					return false;
				}
				if (this.content.length === 0) {
					alert("活動內容一定要填寫");
					return false;
				}
				if (this.location.length === 0) {
					alert("活動地點一定要填寫");
					return false;
				}
				if (this.content.length > 10) {
					alert("活動名稱不能大於十個字");
					return false;
				}
				if (this.content.length > 20) {
					alert("活動內容不能大於二十個字");
					return false;
				}
				if (this.location.length > 20) {
					alert("活動地點不能大於二十個字");
					return false;
				}
				if (this.date.length > 20) {
					alert("活動時間不能大於二十個字");
					return false;
				}
				Materialize.toast(this.message, this.delay);
				setTimeout(() => {
					ActivityForm.submit();
				}, this.delay);
			},
			delActivity: function(id) {
			if (confirm("請確認是否刪除此活動？")) {
					Materialize.toast(this.message, this.delay);
					setTimeout(() => {
						location.href = "delActivity.php?id=" + id;
					}, this.delay);
				}
			},
			reset: function() {
				this.task = "";
				this.content = "";
				this.tag = "";
			},
			reset_whiteboard: function() {
				this.whiteboard = "";
			},
			reset_list: function() {
				this.list = "";
			},
			reset_activity: function() {
				this.activity = "";
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
		$('.button-collapse').sideNav();
	  }
	});