<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ユーザー詳細</title>
</head>
<body>
<h1>ユーザー詳細</h1>

<table border="1" rules="rows">
	<tr>
		<th>ID</th>
		<td><?php echo $user->id; ?></td>
	</tr>
	<tr>
		<th>氏名</th>
		<td><?php echo $user->name; ?></td>
	</tr>
	<tr>
		<th>所属グループ</th>
		<td><?php echo $user->group_id; ?></td>
	</tr>

<!-- DBから値をとってくる文を作成する -->


</table>
<?php echo form_open(); ?>
<p>
<?php echo form_submit('index', '一覧に戻る'); ?>
<?php echo form_submit('edit', '編集'); ?>
<?php echo form_submit('delete', '削除'); ?>
</p>
<?php echo form_close(); ?>
</body>
</html>