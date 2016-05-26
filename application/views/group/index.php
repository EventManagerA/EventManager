
<h1>部署一覧</h1>

<?php echo $this->pagination->create_links();?>

<?php echo form_open();?>
<table class="table table-bordered">
<tr>
   <th>部署ID</th>
   <th>部署名</th>
   <th>詳細</th>
</tr>
<?php foreach ($group_rowset_desc as  $group_row_desc):?>
<tr>
	<td><?php echo $group_row_desc->get_id();?></td>
	<td><?php echo htmlspecialchars($group_row_desc->get_name());?></td>
	<td><a class="btn btn-default" href="<?php echo base_url('group/detail/'.$group_row_desc->id);?>">詳細</a></td>
</tr>
<?php endforeach;?>
</table>
<p>
	<?php echo form_submit(['name'=>'add','class'=>'btn btn-primary','value'=>'部署の登録'])?>

<?php echo form_close();?>
