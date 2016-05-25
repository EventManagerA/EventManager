<h1>ユーザ登録</h1>
<?php echo form_open()?>

<p>氏名(必須)<p>
	<?php echo form_error('name', '<p>', '</p>'); ?>
	<?php echo form_input('name',set_value('name'),'placeholder="氏名"'); ?>
<p>ログインID(必須)<p>
	<?php echo form_error('login_id', '<p>', '</p>'); ?>
	<?php echo form_input('login_id',set_value('login_id'),'placeholder="ログインID"'); ?>
<p>パスワード(必須)<p>
	<?php echo form_error('password', '<p>', '</p>'); ?>
	<?php echo form_input('password',set_value('password'),'placeholder="パスワード"'); ?>
<p>所属グループ(必須)<p>
	<?php echo form_error('group', '<p>', '</p>'); ?>
    <?php echo form_dropdown('group',$groupList,set_value('group')) ;?>
<p>
<?php echo form_submit('cancel', 'キャンセル'); ?>
<?php echo form_submit('add', '登録'); ?>
</p>
<?php echo form_close()?>