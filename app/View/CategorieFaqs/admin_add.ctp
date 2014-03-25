
<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			echo $this->Form->create('CategorieFaq');
			echo $this->Form->input('titre_categorie',array('label'=>'Titre Catégorie'));
			echo $this->Form->input('description_categorie',array('label'=>'Description Catégorie'));
			echo $this->Form->input('actif_cat_faq',array('type'=>'hidden','default'=>true)).'<br>';
		?>
	</fieldset>

<?php print $this->element('end_view'); ?>
