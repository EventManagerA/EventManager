<h1>イベント編集</h1>
<?php echo form_open()?>
<p>タイトル(必須)<p>
<?php echo form_error('title')?>
<?php echo form_input('title',$event_row->get_title())?>
<p>開始日時(必須)<p>
<?php echo form_error('start')?>
<?php echo form_input(['name'=>'start','placeholder'=>'0000-00-00 00:00:00','value'=>$event_row->get_start()])?>
<p>終了日時<p>
<?php echo form_error('end')?>
<?php echo form_input(['name'=>'end','placeholder'=>'0000-00-00 00:00:00','value'=>$event_row->get_end()])?>
<p>場所(必須)<p>
<?php echo form_error('place')?>
<?php echo form_input(['name'=>'place','value'=>$event_row->get_place()])?>
<p>対象グループ(必須)<p>
<?php echo form_error('group')?>
<?php echo form_dropdown('group',$groupList,$event_row->get_group_id())?>
<p>詳細</p>
<?php echo form_error('detail')?>
<?php echo form_textarea('detail',$event_row->get_detail())?>
<p>
<?php echo form_submit('cancel','キャンセル')?>
<?php echo form_submit('add','保存')?>
</p>
<?php echo form_close()?>
