<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarEexample1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#" style="font-family:'Haettenschweiler'; font-size:25px">Event Manager</a>
		</div>
		<?php if(isset($_SESSION['auth'])): ?>
		<div class="collapse navbar-collapse" id="navbarEexample1">
			<ul class="nav navbar-nav">
				<li class="active"><a href="<?php echo base_url('event/index/today'); ?>">本日のイベント</a></li>
				<li><a href="<?php echo base_url('event/index'); ?>">イベント管理</a></li>
				<?php if($logged_in_user->is_admin_user() === TRUE): ?>
				<li><a href="<?php echo base_url('user/index'); ?>">ユーザ管理</a></li>
				<li><a href="<?php echo base_url('group/index'); ?>">部署管理</a></li>
				<?php endif; ?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle navbar-right" data-toggle="dropdown" role="button" aria-expanded="false">
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
						<?php echo $logged_in_user->name ?><span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li role="presentation"><a href="<?php echo base_url('index/logout'); ?>">ログアウト</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<?php endif; ?>
	</div>
</nav>
