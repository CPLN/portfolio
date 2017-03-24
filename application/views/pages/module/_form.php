<?php
$this->table->add_row(trans('pf_modules_ictcode', 'ictcode'),
    form_input('ictcode', isset($ictcode) ? $ictcode : '', 'id="ictcode" autofocus'), form_error('ictcode'));
$this->table->add_row(trans('pf_modules_title', 'title'),
    form_input('title', isset($title) ? $title : '', 'id="title"'), form_error('title'));


$this->table->add_row(['data' => form_submit('submit', $submit, 'style="width:100%"'), 'colspan' => 2, 'style' => 'text-align:center']);

echo form_open();
echo $this->table->generate();
echo form_close();
?>
