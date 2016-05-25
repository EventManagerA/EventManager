<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
<h1>部署詳細</h1>
<?php echo form_open();?>
<table class="table">
<tr>
	<th>ID</th>
	<td><?php echo $group_rowset->get_id();?></td>
</tr>

<tr>
    <th>部署名</th>
    <td><?php echo $group_rowset->get_name();?></td>
</tr>
</table>

<p>
<?php echo form_submit('index','一覧に戻る');?>
<?php echo form_submit('edit','編集');?>
<?php echo form_submit('delete','削除');?>
</p>
<div class="modal fade" id="deleteModal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal"><span>×</span></button>
					<p>本当に削除してよろしいですか？</p>
				</div>
				<div class="modal-footer">
					<?php echo form_button(['data-dismiss'=>'modal','class'=>'btn btn-default','content'=>'Cancel'])?>
					<?php echo form_submit(['name'=>'delete','class'=>'btn btn-primary','value'=>'OK'])?>
				</div>
			</div>
		</div>
	</div>
<?php echo form_close();?>
</body>
</html>