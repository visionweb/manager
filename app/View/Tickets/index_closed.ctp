
<?php print $this->element('subheader'); ?>

    <?php if(!empty($tickets)):?>
    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('categorie_ticket_id','Catégorie Ticket'); ?></th>
            <th><?php echo $this->Paginator->sort('titre','Titre'); ?></th>
            <th><?php echo $this->Paginator->sort('created','Crée le'); ?></th>
            <th><?php echo $this->Paginator->sort('username','Crée par'); ?></th>
        </tr>
        <?php foreach ($tickets as $ticket): ?>
            <tr>
                <td>
                    <?php echo h($ticket['CategorieTicket']['titre_categorie']); ?>
                </td>
                <td><?php echo $this->Html->link($ticket['Ticket']['titre'], array('action' => 'view', $ticket['Ticket']['id']));?></td>
                <td><?php echo h($this->Time->Format('d/m/y - h:i',$ticket['Ticket']['created']));?></td>
                <td><?php echo h($ticket['User']['username']);?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('Voir'), array('action' => 'view', $ticket['Ticket']['id'])); ?>
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
        <?php	else:
            echo __('Il n\'y a actuellement aucun ticket fermé.');
        endif;
        ?>
    </div>

<?php print $this->element('end_view'); ?>
