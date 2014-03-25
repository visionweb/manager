
<?php print $this->element('subheader'); ?>
  
    <fieldset>
        <?php
			echo $this->Form->create('TaskProject');
			echo $this->Form->input('label', array('label' => 'Nom du projet'));
			echo $this->Form->input('active_task_project', array('type' => 'hidden', 'default' => true)).'<br>';
			echo $this->Form->end(__('Ajouter'));
        ?>

<?php print $this->element('end_view'); ?>
