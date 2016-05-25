<h1>ユーザ登録</h1>
<?php echo form_open()?>

<div class="form-group">
	<?php echo form_label('氏名(必須)','InputName'); ?>
	<?php echo form_error('name', '<p>', '</p>'); ?>
	<?php echo form_input(['name'=>'name','class'=>'form-control','id'=>'InputName','placeholder'=>'氏名','value'=>set_value('name')])?>
</div>
<div class="form-group">
	<?php echo form_label('ログインID(必須)','InputId'); ?>
	<?php echo form_error('login_id', '<p>', '</p>'); ?>
	<?php echo form_input(['name'=>'login_id','class'=>'form-control','id'=>'InputId','placeholder'=>'ログインID','value'=>set_value('login_id')])?>
</div>
<div class="form-group">
	<?php echo form_label('パスワード(必須)','InputPass'); ?>
	<?php echo form_error('password', '<p>', '</p>'); ?>
	<?php echo form_input(['name'=>'password','class'=>'form-control','id'=>'InputPass','placeholder'=>'パスワード(必須)','value'=>set_value('password')])?>
</div>
<div class="form-group">
	<?php echo form_label('所属グループ(必須)','InputGroup'); ?>
	<?php echo form_error('group', '<p>', '</p>'); ?>
	<?php echo form_dropdown('group',$groupList,set_value('group'),"class='form-control' id ='InputGroup'")?>
</div>
<p>
	<?php echo form_submit(['name'=>'cancel','class'=>'btn btn-default','value'=>'キャンセル'])?>
	<?php echo form_submit(['name'=>'add','class'=>'btn btn-primary','value'=>'登録'])?>
</p>
<?php echo form_close()?>