<h1><?php echo xss_clean($task->name) ?></h1>
<?php
foreach($task as $key => $value) {
    print '<fieldset><legend>'.lang("pf_$key").'</legend>';
    print '<p>';
    switch($key) {
        case 'level':
            switch ($value) {
                case 1:
                    print lang('pf_very_easy');
                    break;
                case 2:
                    print lang('pf_easy');
                    break;
                case 3:
                    print lang('pf_normal');
                    break;
                case 4:
                    print lang('pf_hard');
                    break;
                case 5:
                    print lang('pf_very_hard');
                    break;
            }
            break;
        case 'mandatory':
            print $value === 1 ? lang('pf_yes') : lang('pf_no');
            break;
        case 'onlyOnce':
            print $value === 1 ? lang('pf_yes') : lang('pf_no');
            break;
        default:
            print $value;
    }
    print '</p></fieldset>';
}
?>
<p>
  <a href="<?php echo site_url('/task') ?>"><?php echo lang('pf_back') ?></a> <a href="<?php echo site_url('/task/edit/' . xss_clean($task->id)) ?>"><?php echo lang('pf_edit') ?></a>
</p>
