<div class="span10 view">
    <h2><?php echo __('Ticket - ').h($ticket['Ticket']['titre']);?></h2>
    <h3><?php echo __('Catégorie - ').h($ticket['CategorieTicket']['titre_categorie']);?></h3>
    <?php echo __('Crée le : ').h($this->Time->Format('d/m/y - h:i',$ticket['Ticket']['created'])).__(' par ').$this->Html->link($ticket['User']['username'],array('controller'=>'users','action'=>'view',$ticket['Ticket']['user_id']));?><br/>
    <span class="btn-group">
        <button class="btn">Action</button>
        <button class="btn dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="<?php echo $this->Html->url(array('controller'=>'tickets','action'=>'edit',$ticket['Ticket']['id']));?>"><span class="icon-edit"></span> <?php echo __('Modifier ce ticket');?></a></li>
            <li><a href="#"><?php echo $this->Form->postLink(__('Supprimez ce ticket'),array('controller'=>'tickets','action'=>'delete',$ticket['Ticket']['id']),null,__('Etes-vous sûr de vouloir supprimer le ticket < %s > ?',$ticket['Ticket']['titre']));?></a></li>
        </ul>
    </span><br/><br/>
    <?php
    if ($ticket['Ticket']['status']=='opened'):
        echo __('Ticket ouvert - ').$this->Form->postLink(__('Fermez ce ticket'),
            '/tickets/openedToClosed/'.$ticket['Ticket']['id'],
        null,
        __('Etes-vous sûr de vouloir fermer le ticket < %s > ?',$ticket['Ticket']['titre']));
    else:
        echo __('Ticket fermé - ').$this->Form->postLink(__('Ré-ouvrir ce ticket'),
        array('controller'=>'tickets','action'=>'closedToOpened',$ticket['Ticket']['id']),
        null,
        __('Etes-vous sûr de vouloir ré-ouvrir le ticket < %s > ?',$ticket['Ticket']['titre']));
    endif;
    ?>
</div>
<div class='span10 view'>
    <?php foreach($commentaires as $commentaire):?>
        <div class='comment'>
            <?php echo 'De '.h($commentaire['User']['nom_user']).' '.h($commentaire['User']['prenom']);?>
            <?php echo ' le '.h($this->Time->Format('d/m/y à h:i',$commentaire['Commentaire']['created']));?><br/>
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
</div>