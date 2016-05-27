<h1>イベント登録</h1>
<?php echo form_open()?>
<div class="form-group">
	<?php echo form_label('タイトル(必須)', 'InputTitle');?>
	<?php echo form_error('title','<p class="text-danger">','</p>')?>
	<?php echo form_input(['name'=>'title','class'=>'form-control','id'=>'InputTitle','value'=>set_value('title')])?>
</div>
<div class="form-group">
	<?php echo form_label('開始日時(必須)', 'InputStart');?>
	<?php echo form_error('start','<p class="text-danger">','</p>')?>
	<?php echo form_input(['name'=>'start','class'=>'form-control','id'=>'InputStart','placeholder'=>'0000-00-00 00:00:00','value'=>set_value('start')])?>
</div>
<div class="form-group">
	<?php echo form_label('終了日時', 'InputEnd');?>
	<?php echo form_error('end','<p class="text-danger">','</p>')?>
	<?php echo form_input(['name'=>'end','class'=>'form-control','id'=>'InputEnd','placeholder'=>'0000-00-00 00:00:00','value'=>set_value('end')])?>
</div>
	<?php echo form_input(['name'=>'sample','id'=>'datetimepicker'])?>

<div class="form-group">
	<?php echo form_label('場所(必須)', 'InputPlace');?>
	<?php echo form_error('place','<p class="text-danger">','</p>')?>
	<?php echo form_input(['name'=>'place','class'=>'form-control','id'=>'InputPlace','value'=>set_value('place')])?>
</div>
<div class="form-group">
	<?php echo form_label('対象グループ(必須)', 'InputGroup');?>
	<?php echo form_error('group','<p class="text-danger">','</p>')?>
	<?php echo form_dropdown('group',$groupList,set_value('group'),"class='form-control' id ='InputGroup'")?>
</div>
<div class="form-group">
	<?php echo form_label('詳細', 'InputDetail');?>
	<?php echo form_error('detail','<p class="text-danger">','</p>')?>
	<?php echo form_textarea(['name'=>'detail','class'=>'form-control','id'=>'InputDetail','value'=>set_value('detail')])?>
</div>
<p>
	<?php echo form_submit(['name'=>'cancel','class'=>'btn btn-default','value'=>'キャンセル'])?>
	<?php echo form_submit(['name'=>'add','class'=>'btn btn-primary','value'=>'登録'])?>
</p>
<?php echo form_close()?>
