
<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			echo $this->Form->create('Ticket');
			echo $this->Form->input('id');
			echo $this->Form->input('categorie_ticket_id',array('label'=>'Catégorie Ticket'));
			echo $this->Form->input('titre',array('label'=>'Titre')).'<br>';
			echo $this->Form->end(__('Editez'));
		?>
	</fieldset>
	
<?php print $this->element('end_view'); ?>
