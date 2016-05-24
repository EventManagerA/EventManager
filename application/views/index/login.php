<?php echo form_open(); ?>

<p><?php echo form_input('login_id','','placeholder="ログインID"'); ?></p>
<p><?php echo form_password('login_pass','','placeholder="パスワード"'); ?></p>
<p><?php echo form_submit('login_submit', 'ログイン'); ?></p>

<?php echo form_close(); ?>