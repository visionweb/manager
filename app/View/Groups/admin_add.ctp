<div class="span10 form">
<?php echo $this->Form->create('Group'); ?>
	<fieldset>
		<legend><?php echo __('Ajouter un Groupe'); ?></legend>
	<?php
        $choix = array('Association' => 'Association', 'Entreprise' => 'Entreprise', 'Particulier' => 'Particulier');
		echo $this->Form->input('type_group',array('options'=>$choix,'default'=>'Entreprise','label'=>'Type du Groupe'));
		echo $this->Form->input('nom_group',array('label'=>'Nom du Groupe'));
		echo $this->Form->input('actif_group',array('type'=>'hidden','default'=>true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Ajouter')); ?>
</div>