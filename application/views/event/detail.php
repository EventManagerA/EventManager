<h1>イベント詳細</h1>

<table class='table'>
	<tr>
		<th>タイトル</th>
		<td><?php echo (in_array ( $event_row->get_id() , $join_event_id_list ,true )) ? $event_row->get_title().' <span class="label label-primary">参加</span>': $event_row->get_title(); ?></td>
	</tr>
	<tr>
		<th>開始日時</th>
		<td><?php echo $event_row->get_start_to_string(); ?></td>
	</tr>
	<tr>
		<th>終了日時</th>
		<td><?php echo $event_row->get_end() != 0 ? $event_row->get_end_to_string() : ''; ?></td>
	</tr>
	<tr>
		<th>場所</th>
		<td><?php echo $event_row->get_place(); ?></td>
	</tr>
	<tr>
		<th>対象グループ</th>
		<td><?php echo $event_row->get_group_name(); ?></td>
	</tr>
	<tr>
		<th>詳細</th>
		<td><?php echo $event_row->get_detail(); ?></td>
	</tr>
	<tr>
		<th>登録者</th>
		<td><?php echo $event_row->get_registered_by_name(); ?></td>
	</tr>
	<tr>
		<th>参加者</th>
		<td>
			<?php echo $event_row->get_string_joined_user_rowset()?>
		</td>
	</tr>
</table>
<p>
	<?php echo form_open()?>
	<?php echo form_submit(['name'=>'cancel','class'=>'btn btn-primary','value'=>'一覧に戻る'])?>
	<?php echo form_submit(['name'=>'join','class'=>'btn btn-info','value'=>'参加する'])?>
	<?php echo form_submit(['name'=>'defect','class'=>'btn btn-info','value'=>'参加を取り消す'])?>
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
	<?php echo form_close()?>
</p>