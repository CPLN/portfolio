<h1><?php echo xss_clean($domain->name) ?></h1>

<?php $this->load->view('pages/domain/_form', ['submit' => lang('pf_edit')]) ?>

<p><a href="<?php echo site_url('/domain/show/' . xss_clean($domain->id)) ?>"><?php echo lang('pf_back') ?></a></p>
