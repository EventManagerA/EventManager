<?php echo form_open(); ?>
<p><?php echo form_input('login_id','','placeholder="ログインID" class="form-control"'); ?></p>
<p><?php echo form_password('login_pass','','placeholder="パスワード" class="form-control"'); ?></p>
<p><?php echo form_submit('login_submit', 'ログイン', "class='btn btn-block'"); ?></p>
<?php echo form_close(); ?>