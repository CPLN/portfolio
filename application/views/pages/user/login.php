<?php

$this->table->add_row(lang('pf_email', 'email'), form_input('email', '', 'id="email" autofocus'), form_error('email'));
$this->table->add_row(['data' => form_submit('submit', trans('pf_validate')), 'colspan' => 2, 'style' => 'text-align:center']);

 ?>
<h1><?php echo trans('pf_login') ?></h1>
<?php echo $this->table->generate() ?>
