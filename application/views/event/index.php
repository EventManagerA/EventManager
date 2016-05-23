<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
<h1>イベント一覧</h1>

<div>
<?php echo $this->pagination->create_links();?>
</div>


<table rules="all">
	<tr>
		<th>タイトル</th>
		<th>開始日時</th>
		<th>場所</th>
		<th>対象グループ</th>
		<th>詳細</th>
	</tr>
	<?php foreach ($eventRowset  as $eventRow): ?>
	<tr>
		<td><?php echo $eventRow->get_id(); ?></td>
		<td><?php echo $eventRow->get_start_for_index(); ?></td>
		<td><?php echo $eventRow->get_place(); ?></td>
		<td><?php echo $eventRow->get_group_name(); ?></td>
		<td><a href = "<?php //echo base_url('event/detail'); ?>">詳細</a></td>
	</tr>
	<?php endforeach; ?>
</table>
<p>
<a href="<?php echo base_url(); ?>">ユーザの登録</a>
</p>
</body>
</html>