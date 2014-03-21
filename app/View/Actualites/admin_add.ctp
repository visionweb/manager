
<?php print $this->element('subheader_legend'); ?>

	<fieldset>
		<?php
			print $this->TinyMCE->editor(array('theme' => 'simple', 'mode' => 'textareas'));
			print $this->Form->create('Actualite');
			print $this->Form->input('titre_actu',array('label'=>'Titre de l\'actualité'));
			print $this->Form->input('contenu_actu',array('label'=>'Contenu de l\'actualité'));
			print $this->Form->input('actif_actu',array('type'=>'hidden','default'=>1));
			print $this->Form->end(__('Ajouter'));
		?>
	</fieldset>
	
<?php print $this->element('end_view'); ?>

