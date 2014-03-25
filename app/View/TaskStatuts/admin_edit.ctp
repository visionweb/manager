
<?php print $this->element('subheader'); ?>

    <fieldset>
        <?php
			echo $this->Form->create('TaskStatut');
			echo $this->Form->input('label',array('label'=>'Nom du statut'));
			echo $this->Form->input('id').'<br>';
        ?>
    </fieldset>

<?php print $this->element('end_view'); ?>
