
<h1>ユーザー一覧</h1>

<div>
<?php echo $this->pagination->create_links(); ?>
</div>

<table rules="all">
	<tr>
		<th>ID</th>
		<th>氏名</th>
		<th>所属グループ</th>
		<th>詳細</th>
	</tr>

	<?php foreach ($userList  as $user): ?>

	<tr>
		<td><?php echo $user->get_id(); ?></td>
		<td><?php echo $user->get_name(); ?></td>
		<td><?php echo $user->get_group_name(); ?></td>
		<td><a href="<?php echo base_url('user/detail/'.$user->get_id()); ?>">詳細</a></td>
		<?php var_dump($user->get_id()); ?>
	</tr>
	<?php endforeach; ?>
</table>
<p>
<?php echo form_open(); ?>
<?php echo form_submit('add', 'ユーザの登録'); ?>
<?php echo form_close();?>
</p>
</body>
</html>