<?php echo $this->TinyMCE->editor(array('theme' => 'simple', 'mode' => 'textareas')); ?>
<div class="span10 form">
<?php echo $this->Form->create('Faq'); ?>
	<fieldset>
		<legend><?php echo __('Modifier cette FAQ'); ?></legend>
	<?php
		echo $this->Form->input('id');
        echo $this->Form->input('categorie_faq_id',array('label'=>'Catégorie FAQ'));
		echo $this->Form->input('question',array('label'=>'Question'));
		echo $this->Form->input('reponse',array('label'=>'Réponse'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Modifier')); ?>
</div>
