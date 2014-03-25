
<?php print $this->element('subheader'); ?>

    <fieldset>
        <?php
			echo $this->Form->create('PasswordType');
			echo $this->Form->input('label',array('label'=>'Nom du type'));
			echo $this->Form->input('id');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Editez')); ?>

<?php print $this->element('end_view'); ?>
