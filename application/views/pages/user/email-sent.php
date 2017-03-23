<h1><?php echo trans('pf_email_sent') ?></h1>
<div>
    <?php echo trans('pf_email_sent_text', $email) ?>
</div>
<!-- TODO Supprimer ce qui suit -->
<div>
    <a href="<?php echo site_url('user/login_confirm/' . $token) ?>"><?php echo site_url('user/login_confirm/' . $token) ?></a>
</div>
