<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ユーザ編集</title>
</head>
<body>
<h1>ユーザ編集</h1>
<form action="" method="post">

<p>氏名(必須)<p>
	<?php echo form_error('name', '<p>', '</p>'); ?>
	<?php echo form_input('name',''); ?>
<p>ログインID(必須)<p>
	<?php echo form_error('login_id', '<p>', '</p>'); ?>
	<?php echo form_input('login_id',''); ?>
<p>パスワード(変更の場合のみ)<p>
	<?php echo form_error('login_pass', '<p>', '</p>'); ?>
	<?php echo form_input('login_pass','','placeholder="パスワード"'); ?>
<p>所属グループ(必須)<p>
	<?php echo form_error('group_id', '<p>', '</p>'); ?>
	<?php echo form_dropdown('group_id','$連想配列'); ?>
</form>
<p>
<?php echo form_submit('cancel', 'キャンセル'); ?>
<?php echo form_submit('add', '登録'); ?>
</p>
</form>
</body>
</html>