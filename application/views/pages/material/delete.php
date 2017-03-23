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
    <?php echo sprintf(trans('pf_delete_confirm'), xss_clean($material->name)) ?>
  </p>
  <p>
    <?php echo form_open() ?>
    <?php echo form_submit('delete_confirm', trans('pf_validate')) ?>
    <?php echo form_close() ?>
    <a href="<?php echo site_url('/material/') ?>"><?php echo trans('pf_back') ?></a>
  </p>
</div>
