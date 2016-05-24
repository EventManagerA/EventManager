<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
<p>本当によろしいですか？</p>
<?php echo form_open();?>

<?php echo form_submit('cancel','cancel');?>
<?php echo form_submit('add','OK');?>

<?php echo form_close();?>
</body>
</html>