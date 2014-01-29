<?php echo $this->Form->create(null,array('controller' => 'tasks','action' => 'switchStatut')); ?>
<?php
echo $this->Form->input('id', array('type' => 'hidden', 'value' => $task['Task']['id']));
echo $this->Form->input('task_statut_id', array(
    'label' => 'Statut',
    'selected' => $task['Task']['task_statut_id'],
    'class' => 'input-medium'
));
?>
<?php echo $this->Form->end(__('Changer')); ?>