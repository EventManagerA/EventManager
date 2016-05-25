
<h1>ユーザ編集</h1>
<?php echo form_open(); ?>

<p>氏名(必須)<p>
	<?php echo form_error('name', '<p>', '</p>'); ?>
	<?php echo form_input(array(
			'name' => 'name',
			'value' => set_value('name', &users->name))); ?>

<p>ログインID(必須)<p>
	<?php echo form_error('login_id', '<p>', '</p>'); ?>
	<?php echo form_input(array(
			'name' => 'login_id',
			'value' => set_value('login_id', &users->login_id)
		)); ?>

<p>パスワード(変更の場合のみ)<p>
	<?php echo form_error('password', '<p>', '</p>'); ?>
	<?php echo form_input(array(
			'name' => 'password',
			'value' => set_value('password', &users->password)
		)); ?>

<p>所属グループ(必須)<p>
	<?php echo form_error('group', '<p>', '</p>'); ?>
	<?php echo form_dropdown('group',$groupList,set_value('group')) ;?>
</form>
<p>
<?php echo form_submit('cancel', 'キャンセル'); ?>
<?php echo form_submit('add', '登録'); ?>
<?php echo form_close() ;?>
</p>

