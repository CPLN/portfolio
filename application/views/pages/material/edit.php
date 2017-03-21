<h1><?php echo xss_clean($material->name) ?></h1>

<?php $this->load->view('pages/material/_form', ['submit' => lang('pf_edit')]) ?>

<p><a href="<?php echo site_url('/material/show/' . xss_clean($material->id)) ?>"><?php echo lang('pf_back') ?></a></p>
