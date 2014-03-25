<?php echo $this->TinyMCE->editor(array('theme' => 'simple', 'mode' => 'textareas')); ?>

<?php print $this->element('subheader'); ?>

<?php  ?>
	<fieldset>
		<?php
			echo $this->Form->create('Faq');
			echo $this->Form->input('id');
			echo $this->Form->input('categorie_faq_id',array('label'=>'Catégorie FAQ'));
			echo $this->Form->input('question',array('label'=>'Question'));
			echo $this->Form->input('reponse',array('label'=>'Réponse'));
		?>
	</fieldset>
<?php echo $this->Form->end(__('Modifier')); ?>

<?php print $this->element('end_view'); ?>
