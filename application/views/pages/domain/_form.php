<?php
$this->table->add_row(lang('pf_name', 'name'), form_input('name', isset($name) ? $name : '', 'id="name" autofocus'), form_error('name'));
$this->table->add_row(array('data' => form_submit('submit', $submit), 'colspan' => 2, 'style' => 'text-align:center'));

echo form_open();
echo $this->table->generate();
echo form_close();
?>
