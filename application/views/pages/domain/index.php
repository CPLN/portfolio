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
    <li><?php echo $domain->name; ?></li>
    <?php endforeach; ?>
</ul>
