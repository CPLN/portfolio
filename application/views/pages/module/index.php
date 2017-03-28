<?php
/**
 * Created by PhpStorm.
 * User: piferrari
 * Date: 08.03.17
 * Time: 15:42
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');
?>
<h1><?php echo trans('pf_modules'); ?></h1>
<ul>
    <?php foreach ($modules as $module): ?>
        <li>
            <a href="<?php echo site_url('/module/show/' . xss_clean($module->id)) ?>"><?php echo xss_clean($module->ictCode . '-' . $module->title) ?></a>
            <a href="<?php echo site_url('/module/delete/' . xss_clean($module->id)) ?>"><?php echo trans('pf_delete') ?></a>
        </li>
    <?php endforeach ?>
    <li><a href="<?php echo site_url('/module/add') ?>"><?php echo trans('pf_add') ?></a></li>
</ul>
