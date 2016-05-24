<?php var_dump($logged_in_user)?>
<ul class="breadcrumb">
	<li style="font-family:'Haettenschweiler'; font-size:25px">Event Manager</li>
	<?php if(isset($_SESSION['auth'])): ?>
		<li><a href="<?php echo base_url('event/index/today'); ?>">本日のイベント</a></li>
		<li><a href="<?php echo base_url('event/index'); ?>">イベント管理</a></li>
			<?php //if($logged_in_user->type_id === TRUE): ?>
				<li><a href="<?php echo base_url('user/index'); ?>">ユーザ管理</a></li>
				<li><a href="<?php echo base_url('group/index'); ?>">部署管理</a></li>
			<?php //endif; ?>
		<li>
			<div class="dropdown">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
					<?php echo $logged_in_user->name ?>
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('index/logout'); ?>">ログアウト</a></li>
				</ul>
			</div>
		</li>
	<?php endif; ?>
</ul>