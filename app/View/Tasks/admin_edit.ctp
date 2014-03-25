
<?php print $this->element('subheader'); ?>

    <?php echo $this->Form->create('Task'); ?>
    <fieldset>
        <legend><?php echo __('Modifier cette tâche'); ?></legend>
        <?php
        echo $this->Form->input('task_project_id',array('label'=>'Projet', 'selected' =>$this->request->data['Task']['task_project_id']));
        echo $this->Form->input('subject',array('label'=>'Sujet'));
        echo $this->Form->input('task_type_id',array('label'=>'Type', 'selected' =>$this->request->data['Task']['task_type_id']));
        echo $this->Form->input('task_statut_id',array('label'=>'Statut', 'selected' =>$this->request->data['Task']['task_statut_id']));
        echo $this->Form->input('description',array('label'=>'Projet', 'selected' =>$this->request->data['Task']['task_project_id']));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Modifier')); ?>

<?php print $this->element('end_view'); ?>
