<?php echo $this->TinyMCE->editor(array('theme' => 'simple', 'mode' => 'textareas')); ?>
<div class="span10 form">
<?php echo $this->Form->create('Faq'); ?>
	<fieldset>
		<legend><?php echo __('Ajouter une FAQ'); ?></legend>
	<?php
        echo $this->Form->input('categorie_faq_id',array('label'=>'Catégorie FAQ','empty'=>'Choisissez'));
		echo $this->Form->input('question',array('label'=>'Question'));
		echo $this->Form->input('reponse',array('label'=>'Réponse'));
		echo $this->Form->input('actif_faq',array('type'=>'hidden','default'=>true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Ajouter')); ?>
</div>