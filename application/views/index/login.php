<?php echo form_open(); ?>
<?php if(! isset($login_id)){$login_id = '';} ?>
<?php echo form_error('login_id', '<div class="error">', '</div>'); ?>
<?php echo form_error('password', '<div class="error">', '</div>'); ?>
<?php if(isset($auth_error)){echo $auth_error;} ?>
<p><?php echo form_input('login_id',$login_id,'placeholder="ログインID" class="form-control"'); ?></p>
<p><?php echo form_password('password','','placeholder="パスワード" class="form-control"'); ?></p>
<p><?php echo form_submit('login_submit', 'ログイン', "class='btn btn-block'"); ?></p>
<?php echo form_close(); ?>