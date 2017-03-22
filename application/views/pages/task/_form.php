<?php
$this->table->add_row(lang('pf_name', 'name'), form_input('name', isset($task->name) ? $task->name : '', 'id="name"'), form_error('name'));
$this->table->add_row(lang('pf_description', 'description'), form_textarea('description', isset($task->description) ? $task->description : '', 'id="description"'), form_error('description'));
$this->table->add_row(lang('pf_goal', 'objectif'), form_textarea('goal', isset($task->goal) ? $task->goal : '', 'id="goal"'), form_error('goal'));
$this->table->add_row(lang('pf_duration', 'duration'), form_input('duration', isset($task->duration) ? $task->duration : '', 'id="duration"'), form_error('duration'));
$options = [
    '1' => lang('pf_very_easy'),
    '2' => lang('pf_easy'),
    '3' => lang('pf_normal'),
    '4' => lang('pf_hard'),
    '5' => lang('pf_very_hard')
];

$this->table->add_row(lang('pf_level', 'level'), form_dropdown('level', $options, isset($task->level) ? [$task->level] : ['1'], 'id="level"'), form_error('level'));
/*
 * Checkbox
 * Si on crée une tâche sans cocher les checkbox, celle-ci n'existent pas dans le tableau POST mais dans la table, il y a une valeur entière
 * à mettre. On test donc l'existance des checkbox et on place 0 si elle n'existe pas et 1 si elle existe indépendament de value="".
 *
 * Le problème c'est qu'on arrive dans ce fichier par plusieurs chemins:
 * add:
 *   Dans ce cas, la checkbox existe ou n'existe pas
 * edit:
 *   Dans ce cas, c'est le contenu de la table que l'on reçoit et le contenu vaut 1 ou 0. La valeur existe toujours.
 *
 * Donc:
 * add  -> mandatory existe et value="1"  -> empty retourne FALSE -> on check la case        -> TRUE
 * add  -> mandatory n'existe pas         -> empty retourne TRUE  -> on ne check pas la case -> FALSE
 * edit -> mandatory existe et contient 0 -> empty retourne TRUE  -> on ne check pas la case -> FALSE
 * edit -> mandatory existe et contient 1 -> empty retourne FALSE -> on check la case        -> TRUE
 */
$this->table->add_row(lang('pf_mandatory', 'mandatory'), form_checkbox('mandatory', '1', !empty($task->mandatory), 'id="mandatory"'), form_error('mandatory'));
$this->table->add_row(lang('pf_onlyOnce', 'onlyOnce'), form_checkbox('onlyOnce', '1', !empty($task->onlyOnce), 'id="onlyOnce"'), form_error('onlyOnce'));
$this->table->add_row(array('data' => form_submit('submit', $submit, 'style="width:100%"'), 'colspan' => 2, 'style' => 'text-align:center'));

echo form_open();
echo $this->table->generate();
echo form_close();
?>
