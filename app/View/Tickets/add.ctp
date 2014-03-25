
<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			echo $this->Form->create();
			//Ticket
			echo $this->Form->input('Ticket.categorie_ticket_id',array('label'=>'Catégorie Ticket'));
			echo $this->Form->input('Ticket.titre',array('label'=>'Titre'));
			echo $this->Form->input('Ticket.status',array('type'=>'hidden','default'=>'opened'));
			echo $this->Form->input('Ticket.flag',array('type'=>'hidden','default'=>'user_answer'));
			echo $this->Form->input('Ticket.actif_ticket',array('type'=>'hidden','default'=>true));
			echo $this->Form->input('Ticket.group_id',array('type'=>'hidden','default'=>$infos['idgroupe']));
			echo $this->Form->input('Ticket.user_id',array('type'=>'hidden','default'=>$infos['id']));
			//Commentaire
			echo $this->Form->input('Commentaire.0.text_commentaire',array('label'=>'Description'));
			echo $this->Form->input('Commentaire.0.user_id',array('type'=>'hidden','default'=>$infos['id']));
		?>
    </fieldset>
<?php echo $this->Form->end(__('Créez')); ?>
</div>

