<div class="span10 view">
<h2><?php  echo __('Catégorie Ticket'); ?></h2>
    <span class="btn-group">
        <button class="btn">Action</button>
        <button class="btn dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="<?php echo $this->Html->url(array('controller'=>'categorieTickets','action'=>'edit',$categorieTicket['CategorieTicket']['id']));?>"><span class="icon-edit"></span> <?php echo __('Modifier cette catégorie');?></a></li>
            <li><a href="#"><?php echo $this->Form->postLink(__('Supprimez cette catégorie'),array('controller'=>'categorieTickets','action'=>'delete',$categorieTicket['CategorieTicket']['id']),null, __('Etes-vous sûr de vouloir supprimer la catégorie < %s >?', $categorieTicket['CategorieTicket']['titre_categorie']));?></a></li>
        </ul>
    </span><br/><br/>
    <dl>
		<dt><?php echo __('Titre Catégorie'); ?></dt>
		<dd>
			<?php echo h($categorieTicket['CategorieTicket']['titre_categorie']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="span10 view">
    <div class="related">
        <h3><?php echo __('Tickets ouverts associés'); ?></h3>
        <?php if (!empty($categorieTicket['Ticket'])): ?>
        <table cellpadding = "0" cellspacing = "0">
        <tr>
            <th><?php echo __('Groupe'); ?></th>
            <th><?php echo __('Titre'); ?></th>
        </tr>
        <?php
            $i = 0;
            foreach ($categorieTicket['Ticket'] as $ticket): ?>
            <tr>
                <td><?php echo $this->Html->link($ticket['Group']['nom_group'],array('controller'=>'groups','action'=>'view',$ticket['Group']['id']));?></td>
                <td><?php echo $ticket['titre']; ?></td>
                <td class="actions btn-group">
                    <button class="btn">Action</button>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $this->Html->url(array('controller' => 'tickets', 'action' => 'view', $ticket['id']));?>"><span class="icon-eye-open"></span> <?php echo __('Voir');?></a></li>
                        <li><a href="<?php echo $this->Html->url(array('controller' => 'tickets', 'action' => 'edit', $ticket['id']));?>"><span class="icon-edit"></span> <?php echo __('Modifier');?></a></li>
                        <li><a href="#"><?php echo $this->Form->postLink(__('Fermer ce ticket'),'/tickets/openedToClosed/'. $ticket['id'], null, __('Etes-vous sûr de vouloir fermer le ticket < %s > ?', $ticket['titre']));?></a></li>
                        <li class="divider"></li>
                        <li><a href="#"><?php echo $this->Form->postLink(__('Supprimer'), array('controller' => 'tickets', 'action' => 'delete', $ticket['id']), null, __('Etes-vous sûr de vouloir supprimer le ticket < %s > ?', $ticket['titre']));?></a></li>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
        <?php
            else:
                echo __('Actuellement, il n\'y a aucun ticket associé à cette catégorie.');
            endif;
        ?>
    </div>
</div>