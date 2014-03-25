
<?php print $this->element('subheader'); ?>

    <fieldset>
        <?php
			echo $this->Form->create('Password');
			echo $this->Form->input('login',array('label'=>'Pseudo'));
			echo $this->Form->input('password',array('label'=>'Mot de passe','type'=>'text'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Modifier')); ?>

<?php print $this->element('end_view'); ?>
