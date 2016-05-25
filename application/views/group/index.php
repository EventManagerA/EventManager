
<h1>部署一覧</h1>
<nav class="pull-right">
<?php echo $this->pagination->create_links();?>
</nav>
<?php echo form_open();?>
<table class="table table-bordered">
<tr>
   <th>部署ID</th>
   <th>部署名</th>
   <th>詳細</th>
</tr>
<?php foreach ($group_rowset as  $group_row):?>
<tr>
	<td><?php echo $group_row->get_id();?></td>
	<td><?php echo $group_row->get_name();?></td>
	<td><a class="btn btn-default" href="<?php echo base_url('group/detail/'.$group_row->id);?>">詳細</a></td>
</tr>
<?php endforeach;?>
</table>
<p>
	<?php echo form_submit(['name'=>'add','class'=>'btn btn-primary','value'=>'部署の登録'])?>

<?php echo form_close();?>
