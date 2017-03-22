<?php
/**
 * Created by PhpStorm.
 * User: piferrari
 * Date: 08.03.17
 * Time: 16:19
 */
?>
<div>
  <p>
    <?php echo sprintf(lang('pf_delete_confirm'), xss_clean($task->name)) ?>
  </p>
  <p>
    <?php echo form_open() ?>
    <?php echo form_submit('delete_confirm', lang('pf_validate')) ?>
    <?php echo form_close() ?>
    <a href="<?php echo site_url('/task/') ?>"><?php echo lang('pf_back') ?></a>
  </p>
</div>
