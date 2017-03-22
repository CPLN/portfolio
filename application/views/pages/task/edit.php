<h1><?php echo xss_clean($task->name) ?></h1>

<?php $this->load->view('pages/task/_form', ['submit' => lang('pf_edit')]) ?>

<p><a href="<?php echo site_url('/task/show/' . xss_clean($task->id)) ?>"><?php echo lang('pf_back') ?></a></p>
