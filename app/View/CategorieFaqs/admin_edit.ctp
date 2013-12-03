<div class="span10 form">
<?php echo $this->Form->create('CategorieFaq'); ?>
	<fieldset>
		<legend><?php echo __('Modifier cette catégorie'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('titre_categorie', array('label'=>'Titre Catégorie'));
		echo $this->Form->input('description_categorie', array('label'=>'Description Catégorie'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Modifier')); ?>
</div>