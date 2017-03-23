<h1><?php echo xss_clean($domain->name) ?></h1>

<p>
  <a href="<?php echo site_url('/domain') ?>"><?php echo trans('pf_back') ?></a> <a href="<?php echo site_url('/domain/edit/' . xss_clean($domain->id)) ?>"><?php echo trans('pf_edit') ?></a>
</p>
