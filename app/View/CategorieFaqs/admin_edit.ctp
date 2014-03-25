
<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			echo $this->Form->create('CategorieFaq');
			echo $this->Form->input('id');
			echo $this->Form->input('titre_categorie', array('label'=>'Titre Catégorie'));
			echo $this->Form->input('description_categorie', array('label'=>'Description Catégorie')).'<br>';
			echo $this->Form->end(__('Modifier'));
		?>
	</fieldset>

<?php print $this->element('end_view'); ?>
