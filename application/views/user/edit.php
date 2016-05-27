
<h1>ユーザ編集</h1>
<?php echo form_open(); ?>

<div class="form-group">
	<?php echo form_label('氏名(必須)','InputName')?>
	<?php echo form_error('name','<p class="text-danger">','</p>'); ?>
	<?php echo form_input(['name'=>'name','class'=>'form-control','id'=>'InputName','value'=>set_value('name',$users->get_name())]) ?>
	<span id="helpBlock" class="help-block">ひらがな、カタカナ、漢字、「・」が使用できます。   例）田中 太郎</span>
</div>

<div class="form-group">
	<?php echo form_label('ログインID(必須)','InputId')?>
	<?php echo form_error('login_id','<p class="text-danger">','</p>'); ?>
	<?php echo form_input(['name'=>'login_id','class'=>'form-control','id'=>'InputId','value'=>set_value('login',$users->get_login_id())]) ?>
	<span id="helpBlock" class="help-block">英数字、「-」「_」が使用できます。2字以上で記入してください。</span>
</div>

<div class="form-group">
	<?php echo form_label('パスワード(変更の場合のみ)','InputPass')?>
	<?php echo form_error('password','<p class="text-danger">','</p>'); ?>
	<?php echo form_password(['name'=>'password','class'=>'form-control','id'=>'InputPass','placeholder'=>'パスワード','value'=>set_value('password')]) ?>
	<span id="helpBlock" class="help-block">英数字、「-」「_」が使用できます。6字以上で記入してください。</span>
</div>

<div class="form-group">
	<?php echo form_label('所属グループ(必須)','InputGroup')?>
	<?php echo form_error('group','<p class="text-danger">','</p>'); ?>
	<?php echo form_dropdown('group',$groupList,set_value('group',$users->get_group_id()),"class='form-control' id ='InputGroup'")?>
</div>
<!-- model / users で$usersの確認-->
<p>
	<?php echo form_submit(['name'=>'cancel','class'=>'btn btn-default','value'=>'キャンセル'])?>
	<?php echo form_submit(['name'=>'add','class'=>'btn btn-primary','value'=>'保存'])?>
</p>
<?php echo form_close() ;?>

