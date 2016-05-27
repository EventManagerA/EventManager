<?php if ($this->uri->segment(3) != 'today'): ?>
<h1>イベント一覧</h1>
<?php else:?>
<h1>本日のイベント</h1>
<?php endif;?>

<nav class="pull-right">
<?php echo $this->pagination->create_links();?>
</nav>

<table class="table table-bordered">
	<tr>
		<th>タイトル</th>
		<th>開始日時</th>
		<th>場所</th>
		<th>対象グループ</th>
		<th>詳細</th>
	</tr>
	<?php foreach ($eventRowset  as $eventRow): ?>
	<tr>
		<td><?php echo (in_array ( $eventRow->get_id() , $join_event_id_list ,true )) ? htmlspecialchars($eventRow->get_title()).' <span class="label label-danger">参加</span>': htmlspecialchars($eventRow->get_title()); ?></td>
		<td><?php echo htmlspecialchars($eventRow->get_start_to_string()); ?></td>
		<td><?php echo htmlspecialchars($eventRow->get_place()); ?></td>
		<td><?php echo htmlspecialchars($eventRow->get_group_name()); ?></td>
		<td><a class="btn btn-default" href = "<?php echo base_url('event/detail/'.$eventRow->get_id()); ?>">詳細</a></td>
	</tr>
	<?php endforeach; ?>
</table>
<p>
<?php echo form_open()?>
<?php if($this->uri->segment(3) != 'today'):?>
<?php echo form_submit(['name'=>'add','class'=>'btn btn-primary','value'=>'イベントの登録'])?>
<?php endif;?>
<?php echo form_close()?>
</p>
