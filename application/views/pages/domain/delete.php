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
    <?php echo lang('pf_delete_confirm') ?>
  </p>
  <p>
    <?php echo form_open() ?>
    <?php echo form_submit('delete_confirm', lang('pf_validate')) ?>
    <?php echo form_close() ?>
    <a href="<?php echo site_url('/domain/') ?>"><?php echo lang('pf_back') ?></a>
  </p>
</div>
