<?php echo $this->TinyMCE->editor(array('theme' => 'simple', 'mode' => 'textareas')); ?>
<div class="span10 form">
<?php echo $this->Form->create('Actualite'); ?>
	<fieldset>
		<legend><?php echo __('Editez cette actualitée'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('titre_actu',array('label'=>'Titre de l\'actualité'));
		echo $this->Form->input('contenu_actu',array('label'=>'Contenu de l\'actualité'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Editez')); ?>
</div>
