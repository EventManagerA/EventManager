<?php echo form_open(); ?>
<?php if(isset($data)){$login_id = $data->login_id; }else{$login_id = '';} ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h5 class="panel-title" style="font-family:'Haettenschweiler'; font-size:25px">Event Manager</h5>
	</div>
	<div class="panel-body">
		<?php echo form_error('login_id', '<div class="error">', '</div>'); ?>
		<p><?php echo form_input('login_id',$login_id,'placeholder="ログインID" class="form-control"'); ?></p>
		<p><?php echo form_password('password','','placeholder="パスワード" class="form-control"'); ?></p>
		<p><?php echo form_submit('login_submit', 'ログイン', "class='btn btn-block btn-primary'"); ?></p>
	</div>
</div>
<?php echo form_close(); ?>

