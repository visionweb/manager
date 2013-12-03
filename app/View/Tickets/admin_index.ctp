<div class="span10 index">
    <h2><?php echo __('Tickets en cours'); ?></h2>
    <?php echo $this->Html->image('flag.png', array('alt' => 'new')).__('Nouveau Message');?><br/><br/>
    <?php if(!empty($ticketsNew) || !empty($ticketsOld)):?>
    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('group_id','Groupe'); ?></th>
            <th><?php echo $this->Paginator->sort('categorie_ticket_id','Catégorie Ticket'); ?></th>
            <th><?php echo $this->Paginator->sort('titre','Titre'); ?></th>
            <th><?php echo $this->Paginator->sort('created','Crée le'); ?></th>
            <th><?php echo $this->Paginator->sort('username','Crée par'); ?></th>
        </tr>
        <?php foreach ($ticketsNew as $ticket): ?>
            <tr>
                <td>
                    <?php echo $this->Html->link($ticket['Group']['nom_group'], array('controller' => 'groups', 'action' => 'view', $ticket['Group']['id'])); ?>
                </td>
                <td>
                    <?php echo $this->Html->link($ticket['CategorieTicket']['titre_categorie'], array('controller' => 'categorie_tickets', 'action' => 'view', $ticket['CategorieTicket']['id'])); ?>
                </td>
                <td><span class="flag"><?php echo $this->Html->Image('flag',array('alt'=>'new'));?></span>
                    <?php echo $this->Html->link($ticket['Ticket']['titre'], array('action' => 'view', $ticket['Ticket']['id']));?>
                </td>
                <td><?php echo h($this->Time->Format('d/m/y - h:i',$ticket['Ticket']['created']));?></td>
                <td><?php echo $this->Html->link($ticket['User']['username'], array('controller'=>'users','action' => 'view', $ticket['Ticket']['user_id']));?></td>
                <td class="actions btn-group">
                    <button class="btn">Action</button>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $this->Html->url(array('action' => 'view', $ticket['Ticket']['id']));?>"><span class="icon-eye-open"></span> <?php echo __('Voir');?></a></li>
                        <li><a href="<?php echo $this->Html->url(array('action' => 'edit', $ticket['Ticket']['id']));?>"><span class="icon-edit"></span> <?php echo __('Modifier');?></a></li>
                        <li><a href="#"><?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $ticket['Ticket']['id']), null, __('Etes-vous sûr de vouloir supprimer le ticket < %s > ?', $ticket['Ticket']['titre']));?></a></li>
                        <li><a href="#"><?php echo $this->Form->postLink(__('Fermer ce ticket'),
                                    '/tickets/openedToClosed/'.$ticket['Ticket']['id'],
                                    null,
                                    __('Etes-vous sûr de vouloir fermer le ticket < %s > ?',$ticket['Ticket']['titre'])
                                );?></a></li>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php foreach ($ticketsOld as $ticket): ?>
            <tr>
                <td>
                    <?php echo $this->Html->link($ticket['Group']['nom_group'], array('controller' => 'groups', 'action' => 'view', $ticket['Group']['id'])); ?>
                </td>
                <td>
                    <?php echo $this->Html->link($ticket['CategorieTicket']['titre_categorie'], array('controller' => 'categorie_tickets', 'action' => 'view', $ticket['CategorieTicket']['id'])); ?>
                </td>
                <td><?php echo $this->Html->link($ticket['Ticket']['titre'], array('action' => 'view', $ticket['Ticket']['id']));?></td>
                <td><?php echo h($this->Time->Format('d/m/y - h:i',$ticket['Ticket']['created']));?></td>
                <td><?php echo $this->Html->link($ticket['User']['username'], array('controller'=>'users','action' => 'view', $ticket['Ticket']['user_id']));?></td>
                <td class="actions btn-group">
                    <button class="btn">Action</button>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $this->Html->url(array('action' => 'view', $ticket['Ticket']['id']));?>"><span class="icon-eye-open"></span> <?php echo __('Voir');?></a></li>
                        <li><a href="<?php echo $this->Html->url(array('action' => 'edit', $ticket['Ticket']['id']));?>"><span class="icon-edit"></span> <?php echo __('Modifier');?></a></li>
                        <li><a href="#"><?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $ticket['Ticket']['id']), null, __('Etes-vous sûr de vouloir supprimer le ticket < %s > ?', $ticket['Ticket']['titre']));?></a></li>
                        <li><a href="#"><?php echo $this->Form->postLink(__('Fermer ce ticket'),
                                    '/tickets/openedToClosed/'.$ticket['Ticket']['id'],
                                    null,
                                    __('Etes-vous sûr de vouloir fermer le ticket < %s > ?',$ticket['Ticket']['titre'])
                                );?></a></li>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} / {:pages}')
        ));
        ?>	</p>
    <div class="paging">
        <?php
        echo $this->Paginator->prev('< ' . __('Précédent'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('Suivant') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
        <?php
            else:
                echo __('Il n\'y a actuellement aucun ticket en cours.');
            endif;
        ?>
    </div>
</div>