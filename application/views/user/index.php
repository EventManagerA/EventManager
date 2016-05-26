
<h1>ユーザ一覧</h1>

<div>
<?php echo $this->pagination->create_links(); ?>
</div>

<table class="table table-bordered">
	<tr>
		<th>ID</th>
		<th>氏名</th>
		<th>所属グループ</th>
		<th>詳細</th>
	</tr>

	<?php foreach ($userList  as $user): ?>

	<tr>
		<td><?php echo $user->get_id(); ?></td>
		<td><?php echo htmlspecialchars($user->get_name()); ?></td>
		<td><?php echo htmlspecialchars($user->get_group_name()); ?></td>
		<td><a class="btn btn-default" href = "<?php echo base_url('user/detail/'.$user->get_id()); ?>">詳細</a></td>
	</tr>
	<?php endforeach; ?>
</table>
<p>
<?php echo form_open(); ?>
<?php echo form_submit(['name'=>'add','class'=>'btn btn-primary','value'=>'ユーザの登録'])?>
<?php echo form_close();?>
</p>
