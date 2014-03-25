
<?php print $this->element('subheader'); ?>

    <fieldset>
        <?php
			echo $this->Form->create('TaskProject');
			echo $this->Form->input('label',array('label'=>'Nom du projet'));
			echo $this->Form->input('id').'<br>';
			echo $this->Form->end(__('Modifier'));
        ?>
    </fieldset>

<?php print $this->element('end_view'); ?>
