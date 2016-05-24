<ul class="breadcrumb">
	<li>Event Manager</li>
	<?php //if($this-> session-> userdata('auth') === TRUE): ?>
		<li><a href="<?php echo base_url('event/index/today'); ?>">本日のイベント</a></li>
		<li><a href="<?php echo base_url('event/index'); ?>">イベント管理</a></li>
			<?php //if($this-> session-> userdata('type_id') === TRUE): ?>
				<li><a href="<?php echo base_url('user/index'); ?>">ユーザ管理</a></li>
				<li><a href="<?php echo base_url('group/index'); ?>">部署管理</a></li>
			<?php //endif; ?>
		<li>
			<div class="dropdown">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
					ユーザ名
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('index/logout'); ?>">ログアウト</a></li>
				</ul>
			</div>
		</li>
	<?php //endif; ?>
</ul>