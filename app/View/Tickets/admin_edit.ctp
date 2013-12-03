<div class="span10 form">
<?php echo $this->Form->create('Ticket'); ?>
	<fieldset>
		<legend><?php echo __('Editez ce ticket'); ?></legend>
	<?php
        echo $this->Form->input('id');
        echo $this->Form->input('categorie_ticket_id',array('label'=>'Catégorie Ticket'));
		echo $this->Form->input('titre',array('label'=>'Titre'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Editez')); ?>
</div>