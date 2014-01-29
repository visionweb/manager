<div class="span10 form">
<?php echo $this->Form->create('Group'); ?>
	<fieldset>
		<legend><?php echo __('Modifier ce groupe'); ?></legend>
	<?php
		echo $this->Form->input('id');
        $choix = array('Association' => 'Association', 'Entreprise' => 'Entreprise', 'Particulier' => 'Particulier');
		echo $this->Form->input('type_group',array('options'=>$choix,'label'=>'Type Groupe'));
		echo $this->Form->input('nom_group',array('label'=>'Nom Groupe'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Modifier')); ?>
</div>

