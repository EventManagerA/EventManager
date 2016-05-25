
<h1>グループ編集</h1>
<?php echo form_open();?>
<p>グループ名</p>
<p>
       <?php echo form_error('name','<p>','</p>');?>

         <?php echo form_input(array(
                  'name' => 'name',
                  'value' => set_value('name', $group_rowset->name),
                  'size' => 14
          )); ?>
<p>
<?php echo form_submit('cancel','キャンセル');?>
<?php echo form_submit('add','保存');?>
</p>
<?php echo form_close();?>
