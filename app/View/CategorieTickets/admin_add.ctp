
<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			echo $this->Form->create('CategorieTicket');
			echo $this->Form->input('titre_categorie',array('label'=>'Titre Catégorie'));
			echo $this->Form->input('actif_cat_ticket',array('type'=>'hidden','default'=>true)).'<br>';
			echo $this->Form->end(__('Ajouter'));
		?>
	</fieldset>
	
<?php print $this->element('end_view'); ?>
