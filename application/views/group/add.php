<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
<h1>部署登録</h1>
<?php echo form_open();?>
<div class="form-group">
  <?php echo form_label('部署名','InputName');?>
<?php echo form_error('name')?>
<?php echo form_input(['name'=>'name','class'=>'form-control','name'=>'InputPlace','value'=>set_value('name')])?>

</div>
<p>
<?php echo form_submit(['name'=>'cancel','class'=>'btn btn-default','value'=>'キャンセル'])?>
	<?php echo form_submit(['name'=>'add','class'=>'btn btn-primary','value'=>'登録'])?>
</p>
<?php echo form_close();?>
</body>
</html>