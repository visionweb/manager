<div class="span10 form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Ajouter un utilisateur'); ?></legend>
	<?php
        echo $this->Form->input('group_id',array('label'=>'Groupe'));
        $list=array('Madame'=>'Madame','Mademoiselle'=>'Mademoiselle','Monsieur'=>'Monsieur');
		echo $this->Form->input('civilite',array('label'=>'Civilité','options'=>$list,'default'=>'Monsieur'));
		echo $this->Form->input('nom_user',array('label'=>'Nom'));
		echo $this->Form->input('prenom',array('label'=>'Prénom'));
		echo $this->Form->input('username',array('label'=>'Nom d\'utilisateur'));
		echo $this->Form->input('password',array('label'=>'Mot de Passe'));
		echo $this->Form->input('actif_user',array('type'=>'hidden','default'=>true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Ajouter')); ?>
</div>