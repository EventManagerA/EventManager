<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>

</head>
<body>
<h1>グループ一覧</h1>
<?php echo form_open();?>
<table border="1">
<tr>
   <th>グループID</th>
   <th>グループ名</th>
   <th>詳細</th>
</tr>
<?php foreach ($group_rowset as  $group_row):?>
<tr>
	<td><?php echo $group_row->get_id();?></td>
	<td><?php echo $group_row->get_name();?></td>
	<td><a href="<?php echo base_url('group/detail/'.$group_row->id);?>">詳細</a></td>
</tr>
<?php endforeach;?>
</table>
<p>
	<a href="<?php echo base_url('group/add');?>">グループの登録</a>

<?php echo form_close();?>

</body>
</html>