<div class="span10 form">
<?php echo $this->Form->create('CategorieFaq'); ?>
	<fieldset>
		<legend><?php echo __('Ajouter une catégorie'); ?></legend>
	<?php
		echo $this->Form->input('titre_categorie',array('label'=>'Titre Catégorie'));
		echo $this->Form->input('description_categorie',array('label'=>'Description Catégorie'));
		echo $this->Form->input('actif_cat_faq',array('type'=>'hidden','default'=>true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Ajouter')); ?>
</div>
