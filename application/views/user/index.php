<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ユーザ一覧</title>
</head>
<body>
<h1>ユーザー一覧</h1>

<div>
<!-- ページネーション？-->
</div>

<?php echo form_open(); ?>
<table rules="all">
	<tr>
		<th>ID</th>
		<th>氏名</th>
		<th>所属グループ</th>
		<th>詳細</th>
	</tr>

	<?php foreach ($userlist  as $user): ?>

	<tr>
		<td><?php echo $user->get_id(); ?></td>
		<td><?php echo $user->get_name(); ?></td>
		<td><?php echo $user->get_group_name(); ?></td>
		<td><?php echo form_submit('detail', '詳細'); ?></td>
	</tr>
	<?php endforeach; ?>
</table>
<p>
<?php echo form_submit('add', 'ユーザの登録'); ?>
</p>
<?php echo form_close();?>
</body>
</html>