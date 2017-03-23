<?php
/**
 * Created by PhpStorm.
 * User: piferrari
 * Date: 08.03.17
 * Time: 15:42
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<h1><?php echo trans('pf_materials');?></h1>
<ul>
    <?php foreach ($materials as $material): ?>
    <li><a href="<?php echo site_url('/material/show/' . xss_clean($material->id)) ?>"><?php echo xss_clean($material->name) ?></a> <a href="<?php echo site_url('/material/delete/' . xss_clean($material->id)) ?>"><?php echo trans('pf_delete') ?></a></li>
    <?php endforeach; ?>
    <li><a href="<?php echo site_url('/material/add') ?>"><?php echo trans('pf_add') ?></a></li>
</ul>
