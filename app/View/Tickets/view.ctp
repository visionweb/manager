<?php print $this->element('subheader'); ?>

    <h3><?php echo __('Catégorie - ').h($ticket['CategorieTicket']['titre_categorie']);?></h3>
    <?php echo __('Crée le : ').h($this->Time->Format('d/m/y - h:i',$ticket['Ticket']['created'])).__(' par ').$ticket['User']['username'];?><br/>
    <?php
        if ($ticket['Ticket']['status']=='opened'):
            echo __('Ticket ouvert - ').$this->Form->postLink(__('Fermez ce ticket'),
            array('controller'=>'tickets','action' => 'openedToClosed', $ticket['Ticket']['id']),
            null,
            __('Etes-vous sûr de vouloir fermer le ticket < %s > ?', $ticket['Ticket']['titre']));
        else:
            echo __('Ticket fermé');
        endif;
    ?>
</div>
<div class='span10 view'>
    <?php foreach ($commentaires as $commentaire):?>
     <div class='comment'>
         <?php echo __('De ').h($commentaire['User']['nom_user']).' '.h($commentaire['User']['prenom']);?>
         <?php echo __(' le ').h($this->Time->Format('d/m/y à h:i',$commentaire['Commentaire']['created']));?><br/>
         <?php echo $commentaire['Commentaire']['text_commentaire'];?>
     </div>
    <?php
        endforeach;

        if($ticket['Ticket']['status']=='opened'):
    ?>
    <fieldset>
        <legend><?php echo __('Ajouter un commentaire');?></legend>
        <?php
        echo $this->Form->create('Commentaire');
        echo $this->Form->input('text_commentaire',array('label'=>'Commentaire'));
        echo $this->Form->input('ticket_id',array('type'=>'hidden'));
        echo $this->Form->input('user_id',array('type'=>'hidden'));
        echo $this->Form->end('Ajouter');
        ?>
    </fieldset>
    <?php endif;?>

<?php print $this->element('end_view'); ?>
