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
    var network = null;
    var data = null;
    var clusters = [];

    function onlyUnique(value, index, self) {
        return self.indexOf(value) === index;
    }

    function clusterByCid() {
        network.setData(data);
        var allCids = [];
        data.nodes.forEach(function(item) {
            allCids.push(item.cid);
        });
        var uniqueCids = allCids.filter(onlyUnique);

        var clusterOptionsByData;
        uniqueCids.forEach(function(cid) {
            clusterOptionsByData = {
                joinCondition:function(childOptions) {
                    return childOptions.cid == cid;
                },
                processProperties: function (clusterOptions, childNodes, childEdges) {
                    var totalMass = 0;
                    for (var i = 0; i < childNodes.length; i++) {
                        totalMass += childNodes[i].mass;
                    }
                    clusterOptions.mass = totalMass;
                    clusterOptions.label = childNodes[0].grp;
                    clusterOptions.color = childNodes[0].color;
                    return clusterOptions;
                },
                clusterNodeProperties: {id:'cluster:' + cid, borderWidth:3, shape:'triangleDown'}
            };
            network.cluster(clusterOptionsByData);
        });
    }

    function draw() {
        var nodes = new vis.DataSet(
            [
            <?php
            // permet de ne mettre dans vis qu'une fois le même noeuds car la requête retourne plusieurs fois la même
            // tâche si elle est associée à plusieurs autre tâche (prerequisite multiple)
            $ids = array();
            $colors = array('#C2FABC','#97C2FC','orange','#FB7E81');
            foreach ($tasks as $task) {
                if(!in_array($task->id, $ids)) {
                    $ids[] = $task->id;
                    print "{id:{$task->id}, label:'{$task->name}', color:'{$colors[$task->domainId]}', cid:{$task->domainId}, grp:'{$task->domainName}'},\n";
                }
            }
            ?>
            ]);
        var edges = new vis.DataSet(
            [
            <?php foreach ($tasks as $task):
                if(!is_null($task->taskId) and !is_null($task->prerequisiteId)):?>
                {from:<?php print $task->taskId;?>, to:<?php print $task->prerequisiteId;?>, arrows:'from', color:{color:'rgba(30,30,30,0.2)', highlight:'blue'}},
            <?php endif;endforeach; ?>
            ]);
        var container = document.getElementById('netTasks');
        data = {
            nodes: nodes,
            edges: edges
        };
        var options = {
            nodes: {borderWidth: 2},
            interaction: {hover: true},
            manipulation: {
                enabled: true,
                addNode: false,
                addEdge: true
            }
        };
        network = new vis.Network(container, data, options);
        network.on('selectNode', function(params) {
            if (params.nodes.length == 1) {
                if (network.isCluster(params.nodes[0]) == true) {
                    network.openCluster(params.nodes[0]);
                }
                else {
                    var item = nodes.get(params.nodes[0]);
                    window.location.href = '/task/show/' + item.id;
                }
            }
        });
    }
</script>
<h1><?php echo lang('pf_tasks');?></h1>
<ul>
    <li><a href="#" title="<?php echo lang('pf_reduct') ?>" onclick="clusterByCid();return false;"><img src="<?php print base_url();?>img/network/minus_p.png" alt="<?php echo lang('pf_reduct') ?>"/></a></li>
    <li><a href="<?php echo site_url('/task/add') ?>" title="<?php echo lang('pf_add') ?>"><img src="<?php print base_url();?>img/network/addNodeIcon.png" alt="<?php echo lang('pf_add') ?>"/></a></li>
</ul>
<div id="netTasks" style="width:90%;height: 700px;"></div>
