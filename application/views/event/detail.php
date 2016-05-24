<h1>イベント詳細</h1>

<table class='table'>
	<tr>
		<th>タイトル</th>
		<td><?php echo $event_row->get_title(); ?></td>
	</tr>
	<tr>
		<th>開始日時</th>
		<td><?php echo $event_row->get_start(); ?></td>
	</tr>
	<tr>
		<th>終了日時</th>
		<td><?php echo $event_row->get_end(); ?></td>
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
<a href="<?php echo base_url('user/index'); ?>">一覧に戻る</a>
<a href="<?php echo base_url('ueer/edit'); ?>">編集</a>
<a href="<?php echo base_url('ueer/delete_done'); ?>">削除</a>
<!-- 上記、削除のリンク先を確認 -->
</p>
</body>
</html>