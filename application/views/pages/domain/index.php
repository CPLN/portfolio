<?php
/**
 * Created by PhpStorm.
 * User: piferrari
 * Date: 08.03.17
 * Time: 15:42
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<h1><?php echo lang('pf_domains');?></h1>
<ul>
    <?php foreach ($domains as $domain): ?>
    <li><a href="<?php echo site_url('/domain/show/' . $domain->id) ?>"><?php echo $domain->name; ?></a> <a href="<?php echo site_url('/domain/delete/' . $domain->id) ?>"><?php echo lang('pf_delete') ?></a></li>
    <?php endforeach; ?>
    <li><a href="<?php echo site_url('/domain/add') ?>"><?php echo lang('pf_add') ?></a></li>
</ul>
