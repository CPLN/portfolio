<?php
/**
 * Created by PhpStorm.
 * User: piferrari
 * Date: 08.03.17
 * Time: 16:16
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$this->table->add_row(lang('pf_name', 'name'), form_input('name', isset($name) ? $name : '', 'id="name"'), form_error('name'));
$this->table->add_row(array('data' => form_submit('add_domain', lang('pf_add'), 'style="width:100%"'), 'colspan' => 2, 'style' => 'text-align:center'));

echo form_open();
echo $this->table->generate();
echo form_close();
?>
