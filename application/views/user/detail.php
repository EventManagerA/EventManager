<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
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
</table>
<p>
<a href="<?php echo base_url('user/index'); ?>">一覧に戻る</a>
<a href="<?php echo base_url('ueer/edit'); ?>">編集</a>
<a href="<?php echo base_url('ueer/delete_done'); ?>">削除</a>
<!-- 上記、削除のリンク先を確認 -->
</p>
</body>
</html>