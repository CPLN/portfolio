<?php
/**
 * Created by PhpStorm.
 * User: piferrari
 * Date: 08.03.17
 * Time: 16:16
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$this->load->view('pages/domain/_form', ['submit' => lang('pf_add')]);

?>
<p><a href="<?php echo site_url('/domain/') ?>"><?php echo lang('pf_back') ?></a></p>
