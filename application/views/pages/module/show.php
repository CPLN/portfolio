<h1><?php echo xss_clean($module->ictCode . '-' . $module->title) ?></h1>

<p>
    <a href="<?php echo site_url('/module') ?>"><?php echo trans('pf_back') ?></a>
    <a href="<?php echo site_url('/module/edit/' . xss_clean($module->id)) ?>"><?php echo trans('pf_edit') ?></a>
</p>
