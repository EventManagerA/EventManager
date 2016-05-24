<?php echo form_open(); ?>
<?php if(isset($data)){$login_id = $data->login_id; }else{$login_id = '';} ?>
<?php echo form_error('login_id', '<div class="error">', '</div>'); ?>
<p><?php echo form_input('login_id',$login_id,'placeholder="ログインID" class="form-control"'); ?></p>
<p><?php echo form_password('password','','placeholder="パスワード" class="form-control"'); ?></p>
<p><?php echo form_submit('login_submit', 'ログイン', "class='btn btn-block'"); ?></p>
<?php echo form_close(); ?>