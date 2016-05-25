
<h1>ユーザ編集</h1>
<?php echo form_open(); ?>

<div class="form-group">
	<?php echo form_label('氏名(必須)','InputName')?>
	<?php echo form_error('name', '<p>', '</p>'); ?>
	<?php echo form_input(['name'=>'name','class'=>'form-control','id'=>'InputName','value'=>set_value('name',$users->name)]) ?>
</div>

<div class="form-group">
	<?php echo form_label('ログインID(必須)','InputId')?>
	<?php echo form_error('login_id', '<p>', '</p>'); ?>
	<?php echo form_input(['name'=>'login_id','class'=>'form-control','id'=>'InputId','value'=>set_value('InputId',$users->login_id)]) ?>
</div>

<div class="form-group">
	<?php echo form_label('パスワード(変更の場合のみ)','InputPass')?>
	<?php echo form_error('password', '<p>', '</p>'); ?>
	<?php echo form_input(['name'=>'password','class'=>'form-control','id'=>'InputPass','placeholder'=>'パスワード','value'=>set_value('InputPass')]) ?>
</div>

<div class="form-group">
	<?php echo form_label('所属グループ(必須)','InputGroup')?>
	<?php echo form_error('group', '<p>', '</p>'); ?>
	<?php echo form_dropdown('group',$groupList,$users->group_id,"class='form-control' id ='InputGroup'")?>
</div>
<!-- model / users で$usersの確認-->
<p>
	<?php echo form_submit(['name'=>'cancel','class'=>'btn btn-default','value'=>'キャンセル'])?>
	<?php echo form_submit(['name'=>'add','class'=>'btn btn-primary','value'=>'保存'])?>
</p>
<?php echo form_close() ;?>

