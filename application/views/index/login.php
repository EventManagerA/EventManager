<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ログイン</title>
</head>
<body>
<p></p>
<?php echo form_open();

?>

<p><?php echo form_input('loginID','','placeholder="ログインID"'); ?></p>
<p><?php echo form_input('pass','','placeholder="パスワード"'); ?></p>
<p><?php echo form_button('login', 'ログイン', 'size=100%'); ?></p>

<?php echo form_close();?>

</body>
</html>