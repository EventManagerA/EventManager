<h1>ユーザ登録</h1>
<?php echo form_open()?>

<div class="form-group">
	<?php echo form_label('氏名(必須)','InputName'); ?>
	<?php echo form_error('name','<p class="text-danger">','</p>'); ?>
	<?php echo form_input(['name'=>'name','class'=>'form-control','id'=>'InputName','placeholder'=>'氏名','value'=>set_value('name')])?>
	<span id="helpBlock" class="help-block">ひらがな、カタカナ、漢字が使用できます。   例）田中 太郎、エリー ワトソン</span>
</div>
<div class="form-group">
	<?php echo form_label('ログインID(必須)','InputId'); ?>
	<?php echo form_error('login_id','<p class="text-danger">','</p>'); ?>
	<?php echo form_input(['name'=>'login_id','class'=>'form-control','id'=>'InputId','placeholder'=>'ログインID','value'=>set_value('login_id')])?>
	<span id="helpBlock" class="help-block">英数字、「-」「_」が使用できます。4字以上で記入してください。</span>
</div>
<div class="form-group">
	<?php echo form_label('パスワード(必須)','InputPass'); ?>
	<?php echo form_error('password', '<p class="text-danger">', '</p>'); ?>
	<?php echo form_password(['name'=>'password','class'=>'form-control','id'=>'InputPass','placeholder'=>'パスワード','value'=>set_value('password')])?>
	<span id="helpBlock" class="help-block">英数字のみ使用できます。6字以上で記入してください。</span>
</div>
<div class="form-group">
	<?php echo form_label('所属グループ(必須)','InputGroup'); ?>
	<?php echo form_error('group','<p class="text-danger">','</p>'); ?>
	<?php echo form_dropdown('group',$groupList,set_value('group'),"class='form-control' id ='InputGroup'")?>
</div>
<p>
	<?php echo form_submit(['name'=>'cancel','class'=>'btn btn-default','value'=>'キャンセル'])?>
	<?php echo form_submit(['name'=>'add','class'=>'btn btn-primary','value'=>'登録'])?>
</p>
<?php echo form_close()?>