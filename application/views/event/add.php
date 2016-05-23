<h1>イベント登録</h1>
<?php echo form_open()?>
<p>タイトル(必須)<p>
<?php echo form_input('title')?>
<p>開始日時(必須)<p>
<?php echo form_input(['name'=>'start','placeholder'=>'0000-00-00 00:00:00','value'=>set_value('start')])?>
<p>終了日時<p>
<?php echo form_input(['name'=>'end','placeholder'=>'0000-00-00 00:00:00','value'=>set_value('end')])?>
<p>場所(必須)<p>
<?php echo form_input(['name'=>'place','value'=>set_value('place')])?>
<p>対象グループ(必須)<p>
<?php echo form_dropdown('group',$groupList,set_value('group'))?>

<p>
<?php echo form_submit('cancel','キャンセル')?>
<?php echo form_submit('add','登録')?>
</p>
<?php echo form_close()?>