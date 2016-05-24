<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>

</head>
<body>
<h1>グループ一覧</h1>
<nav>
	<ul class="pagination">
		<li>
			<a href="#" aria-label="前のページへ">
				<span aria-hidden="true">«</span>
			</a>
		</li>
		<li><a href="#">1</a></li>
		<li ><a href="#">2</a></li>
		<li><a href="#">3</a></li>
		<li><a href="#">4</a></li>
		<li><a href="#">5</a></li>
		<li>
			<a href="#" aria-label="次のページへ">
				<span aria-hidden="true">»</span>
			</a>
		</li>
	</ul>
</nav>
<div>
<?php echo $this->pagination->create_links();?>
</div>
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
	<?php echo form_submit('add','グループの登録');?>

<?php echo form_close();?>

</body>
</html>