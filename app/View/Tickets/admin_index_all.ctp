<div class="span10 index">
    <h2><?php echo __('Tous les tickets'); ?></h2>
    <?php if(!empty($tickets)):?>
    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('group_id','Groupe'); ?></th>
            <th><?php echo $this->Paginator->sort('categorie_ticket_id','Catégorie Ticket'); ?></th>
            <th><?php echo $this->Paginator->sort('titre','Titre'); ?></th>
            <th><?php echo $this->Paginator->sort('created','Crée le'); ?></th>
            <th><?php echo $this->Paginator->sort('username','Crée par'); ?></th>
            <th><?php echo'Etat';?></th>
        </tr>
        <?php foreach ($tickets as $ticket): ?>
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
                <?if ($ticket['Ticket']['status']=='opened'):?>
                    <td class="activatedStatut"><?php echo'Ouvert';?>&nbsp;</td>
                <?else:?>
                    <td class="disabledStatut"><?php echo'Fermer';?>&nbsp;</td>
                <?endif;?>
                <td class="actions btn-group">
                    <button class="btn">Action</button>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $this->Html->url(array('action' => 'view', $ticket['Ticket']['id']));?>"><span class="icon-eye-open"></span> <?php echo __('Voir');?></a></li>
                        <li><a href="<?php echo $this->Html->url(array('action' => 'edit', $ticket['Ticket']['id']));?>"><span class="icon-edit"></span> <?php echo __('Modifier');?></a></li>
                        <li><a href="#"><?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $ticket['Ticket']['id']), null, __('Etes-vous sûr de vouloir supprimer le ticket < %s > ?', $ticket['Ticket']['titre']));?></a></li>
                        <?if ($ticket['Ticket']['status']=='opened'):?>
                            <li><a href="#"><?php echo $this->Form->postLink(__('Fermer ce ticket'),
                                        '/tickets/openedToClosed/'.$ticket['Ticket']['id'],
                                        null,
                                        __('Etes-vous sûr de vouloir fermer le ticket < %s > ?',$ticket['Ticket']['titre'])
                                    );?></a>
                            </li>
                        <?else:?>
                            <li><a href="#"><?php echo $this->Form->postLink(
                                        __('Ré-ouvrir ce ticket'),
                                        array('action'=>'closedToOpened',$ticket['Ticket']['id']),
                                        null,
                                        __('Etes-vous sûr de vouloir ré-ouvrir le ticket < %s > ? ',$ticket['Ticket']['titre'])
                                    );?></a>
                            </li>
                        <?endif;?>
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
                echo __('Il n\'y a actuellement aucun ticket.');
            endif;
        ?>
    </div>
</div>
