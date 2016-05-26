
<h1>部署編集</h1>
<?php echo form_open();?>
<p>
       <?php echo form_label('部署名', 'InputName');?>
        <?php echo form_error('name')?>
         <?php echo form_input(['name'=>'name','class'=>'form-control','id'=>'InputName','value'=>set_value('name',$group_row->get_name())])?>

<p>
<?php echo form_submit(['name'=>'cancel','class'=>'btn btn-default','value'=>'キャンセル'])?>
	<?php echo form_submit(['name'=>'add','class'=>'btn btn-primary','value'=>'保存'])?>
</p>
<?php echo form_close();?>
