	<h1>ユーザ詳細</h1>

<table class="table" >
	<tr>
		<th>ID</th>
		<td><?php echo $userList->get_id(); ?></td>
	</tr>
	<tr>
		<th>氏名</th>
		<td><?php echo htmlspecialchars($userList->get_name()); ?></td>
	</tr>
	<tr>
		<th>所属グループ</th>
		<td><?php echo htmlspecialchars($userList->get_group_name()); ?></td>
	</tr>
</table>

<p>
<?php echo form_open(); ?>
<?php echo form_submit(['name'=>'cancel','class'=>'btn btn-primary','value'=>'一覧に戻る'])?>
<?php echo form_submit(['name'=>'edit','class'=>'btn btn-default','value'=>'編集'])?>
<?php echo form_button(['data-target'=>'#deleteModal','data-toggle'=>'modal','class'=>'btn btn-danger','content'=>'削除'])?>

	<!-- モーダル・ダイアログ -->
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
</P>
<?php echo form_close(); ?>
