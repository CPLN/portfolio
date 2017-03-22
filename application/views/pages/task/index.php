<?php
/**
 * Created by PhpStorm.
 * User: piferrari
 * Date: 08.03.17
 * Time: 15:42
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<script type="text/javascript">
    function draw() {
        var nodes = new vis.DataSet(
            [
                {id: 1, label: 'html color', color: 'lime'},
                {id: 2, label: 'rgb color', color: 'rgb(255,168,7)'},
                {id: 3, label: 'hex color', color: '#7BE141'},
                {id: 4, label: 'rgba color', color: 'rgba(97,195,238,0.5)'},
                {id: 5, label: 'colorObject', color: {background: 'pink', border: 'purple'}},
                {
                    id: 6,
                    label: 'colorObject + highlight',
                    color: {background: '#F03967', border: '#713E7F', highlight: {background: 'red', border: 'black'}}
                },
                {
                    id: 7,
                    label: 'colorObject + highlight + hover',
                    color: {
                        background: 'cyan',
                        border: 'blue',
                        highlight: {background: 'red', border: 'blue'},
                        hover: {background: 'white', border: 'red'}
                    }
                }
            ]);
        var edges = new vis.DataSet(
            [
                {from: 1, to: 3},
                {from: 1, to: 2},
                {from: 2, to: 4},
                {from: 2, to: 5},
                {from: 2, to: 6},
                {from: 4, to: 7},
            ]);
        var container = document.getElementById('netTasks');
        var data = {
            nodes: nodes,
            edges: edges
        };
        var options = {
            nodes: {borderWidth: 2},
            interaction: {hover: true}
        }
        var network = new vis.Network(container, data, options);
    }
</script>
<h1><?php echo lang('pf_tasks');?></h1>
<ul>
    <?php foreach ($tasks as $task): ?>
    <li><a href="<?php echo site_url('/task/show/' . xss_clean($task->id)) ?>"><?php echo xss_clean($task->name) ?></a> <a href="<?php echo site_url('/task/delete/' . xss_clean($task->id)) ?>"><?php echo lang('pf_delete') ?></a></li>
    <?php endforeach; ?>
    <li><a href="<?php echo site_url('/task/add') ?>"><?php echo lang('pf_add') ?></a></li>
</ul>
<div id="netTasks"></div>
