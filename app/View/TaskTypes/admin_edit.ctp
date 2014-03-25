
<?php print $this->element('subheader'); ?>

    <fieldset>
        <?php
			echo $this->Form->create('TaskType');
			echo $this->Form->input('label',array('label'=>'Nom du type'));
			echo $this->Form->input('id').'<br>';
			echo $this->Form->end(__('Editez'));
        ?>
    </fieldset>

<?php print $this->element('end_view'); ?>
