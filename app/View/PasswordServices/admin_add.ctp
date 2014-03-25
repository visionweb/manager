<?php print $this->element('subheader'); ?>

    <fieldset>
        <?php
			echo $this->Form->create('PasswordService');
			echo $this->Form->input('label', array('label' => 'Nom du type'));
			echo $this->Form->input('active_password_service', array('type' => 'hidden', 'default' => true));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Ajouter')); ?>

<?php print $this->element('end_view'); ?>
