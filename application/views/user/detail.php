<h1>ユーザー詳細</h1>

<table class="table" >
	<tr>
		<th>ID</th>
		<td><?php echo $userList->get_id(); ?></td>
	</tr>
	<tr>
		<th>氏名</th>
		<td><?php echo $userList->get_name(); ?></td>
	</tr>
	<tr>
		<th>所属グループ</th>
		<td><?php echo $userList->get_group_name(); ?></td>
	</tr>

<!-- DBから値をとってくる文を作成する -->


</table>
<?php echo form_open(); ?>
<p>
<?php echo form_submit('cancel', '一覧に戻る'); ?>
<?php echo form_submit('edit', '編集'); ?>
<?php echo form_submit('delete', '削除'); ?>
</p>
<?php echo form_close(); ?>
</body>
</html>