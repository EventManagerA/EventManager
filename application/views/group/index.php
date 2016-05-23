<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>

</head>
<body>
<h1>グループ一覧</h1>

<table border="1">
<tr>
   <th>会員ID</th>
   <th>グループ名</th>
   <th>詳細</th>
</tr>
<?php foreach ($groups as  $grouplist):?>
<tr>
	<td><?php echo $grouplist->id;?></td>
	<td><?php echo $grouplist->name;?></td>
	<td><?php echo form_submit('detail',詳細)?>
</tr>
<?php endforeach;?>
</table>
<p>
	<a href="<?php echo base_url('group/add');?>">グループの登録</a>



</body>
</html>