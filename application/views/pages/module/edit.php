<h1><?php echo xss_clean($module->ictCode . '-' . $module->title) ?></h1>

<?php $this->load->view('pages/module/_form', ['submit' => trans('pf_edit')]) ?>

<p><a href="<?php echo site_url('/module/show/' . xss_clean($module->id)) ?>"><?php echo trans('pf_back') ?></a></p>
