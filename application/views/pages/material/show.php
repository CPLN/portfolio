<h1><?php echo xss_clean($material->name) ?></h1>

<p>
  <a href="<?php echo site_url('/material') ?>"><?php echo lang('pf_back') ?></a> <a href="<?php echo site_url('/material/edit/' . xss_clean($material->id)) ?>"><?php echo lang('pf_edit') ?></a>
</p>
