<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
<h1>グループ編集</h1>
<p>グループ名</p>
<p>
             <?php echo form_error('name','<p>','</p>');?>
             <?php echo form_input('name','','placeholder=グループ名');?>
<p>
<?php echo form_submit('cancel','キャンセル');?>
<?php echo form_submit('add','保存');?>
</p>

</body>
</html>