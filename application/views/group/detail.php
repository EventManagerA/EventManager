<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
<h1>グループ詳細</h1>
<?php echo form_open();?>
<table class="table">
<tr>
	<th>ID</th>
	<td><?php echo $group_rowset->get_id();?></td>
</tr>

<tr>
    <th>グループ名</th>
    <td><?php echo $group_rowset->get_name();?></td>
</tr>
</table>

<p>
<?php echo form_submit('index','一覧に戻る');?>
<?php echo form_submit('edit','編集');?>
<?php echo form_submit('delete','削除');?>
</p>
<?php echo form_close();?>
</body>
</html>