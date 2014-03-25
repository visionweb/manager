
<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			echo $this->TinyMCE->editor(array('theme' => 'simple', 'mode' => 'textareas'));
			echo $this->Form->create('Actualite');
			echo $this->Form->input('id');
			echo $this->Form->input('titre_actu',array('label'=>'Titre de l\'actualité'));
			echo $this->Form->input('contenu_actu',array('label'=>'Contenu de l\'actualité')).'<br>';
			echo $this->Form->end(__('Editez'));
		?>
	</fieldset>

<?php print $this->element('end_view'); ?>
