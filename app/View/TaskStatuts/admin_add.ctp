
<?php print $this->element('subheader'); ?>

    <fieldset>
        <?php
			echo $this->Form->create('TaskStatut');
			echo $this->Form->input('label', array('label' => 'Nom du statut'));
			echo $this->Form->input('active_task_statut', array('type' => 'hidden', 'default' => true));
			echo $this->Form->end(__('Ajouter'));
        ?>
    </fieldset>

<?php print $this->element('end_view'); ?>
