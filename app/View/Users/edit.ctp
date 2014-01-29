<div class="span10 form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Editez cet utilisateur'); ?></legend>
	<?php
		echo $this->Form->input('id');
        $list=array('Madame'=>'Madame','Mademoiselle'=>'Mademoiselle','Monsieur'=>'Monsieur');
        echo $this->Form->input('civilite',array('label'=>'Civilité','options'=>$list));
        echo $this->Form->input('nom_user',array('label'=>'Nom'));
        echo $this->Form->input('prenom',array('label'=>'Prénom'));
        echo $this->Form->input('password',array('label'=>'Nouveau mot de passe ?','default'=>''));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Editez')); ?>
</div>

