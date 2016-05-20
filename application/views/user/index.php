<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
<h1>ユーザー一覧</h1>

<div>
<!-- ページネーション？-->
</div>


<table rules="all">
	<tr>
		<th>ID</th>
		<th>氏名</th>
		<th>所属グループ</th>
		<th>詳細</th>
	</tr>
	<?php foreach ($X  as $user): ?>
	<tr>
		<td><?php echo $user->id; ?></td>
		<td><?php echo $user->name; ?></td>
		<td><?php echo $user->group_id; ?></td>
		<td><a href = "<?php echo base_url('user/detail'); ?>">詳細</a></td>
	</tr>
	<?php endforeach; ?>
</table>
<p>
<a href="<?php echo base_url(); ?>">ユーザの登録</a>
</p>
</body>
</html>