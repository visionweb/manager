
<?php print $this->element('subheader'); ?>

    <fieldset>
        <?php
			echo $this->Form->create('TaskType');
			echo $this->Form->input('label', array('label' => 'Nom du type'));
			echo $this->Form->input('active_task_type', array('type' => 'hidden', 'default' => true)).'<br>';
			echo $this->Form->end(__('Ajouter'));
        ?>
    </fieldset>
    
<?php print $this->element('end_view'); ?>
