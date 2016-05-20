<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ログイン</title>
</head>
<body>
<?php echo form_open(); ?>
<p>Event Manager</p>
<p><?php echo form_input('login_id','','placeholder="ログインID"'); ?></p>
<p><?php echo form_input('login_pass','','placeholder="パスワード"'); ?></p>
<p><?php echo form_submit('login', 'ログイン'); ?></p>

<?php echo form_close(); ?>

</body>
</html>