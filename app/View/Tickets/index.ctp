<div class="span10 index">
	<h2><?php echo __('Tickets en cours'); ?></h2><br/>
	<?php echo $this->Html->image('flag', array('alt' => 'new')).__('Nouveau message');?><br/><br/>
	<?php if(!empty($ticketsNew) || !empty($ticketsOld)):?>
	<table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('categorie_ticket_id','Catégorie Ticket'); ?></th>
			<th><?php echo $this->Paginator->sort('titre','Titre'); ?></th>
            <th><?php echo $this->Paginator->sort('created','Crée le'); ?></th>
            <th><?php echo $this->Paginator->sort('username','Crée par'); ?></th>
	</tr>
	<?php foreach ($ticketsNew as $ticket): ?>
	<tr>
		<td>
			<?php echo h($ticket['CategorieTicket']['titre_categorie']);?>
		</td>
		<td><span class="flag"><?php echo $this->Html->image('flag.png', array('alt' => 'new'));?></span>
            <?php echo $this->Html->link($ticket['Ticket']['titre'], array('action' => 'view', $ticket['Ticket']['id']));?>
        </td>
        <td><?php echo h($this->Time->Format('d/m/y - h:i',$ticket['Ticket']['created']));?></td>
        <td><?php echo h($ticket['User']['username']);?></td>
        <td class="actions btn-group">
            <button class="btn">Action</button>
            <button class="btn dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="<?php echo $this->Html->url(array('action' => 'view',$ticket['Ticket']['id']));?>"><span class="icon-eye-open"></span> <?php echo __('Voir');?></a></li>
                <li><?php echo $this->Form->postLink(
                        __('Fermer ce ticket'),
                        array('action' => 'openedToClosed', $ticket['Ticket']['id']),
                        null,
                        __('Etes-vous sûr de vouloir fermer le ticket < %s >?', $ticket['Ticket']['titre']));?></li>
            </ul>
        </td>
	</tr>
<?php endforeach; ?>
<?php foreach ($ticketsOld as $ticket): ?>
	<tr>
		<td>
			<?php echo h($ticket['CategorieTicket']['titre_categorie']); ?>
		</td>
		<td><?php echo $this->Html->link($ticket['Ticket']['titre'], array('action' => 'view', $ticket['Ticket']['id']));?></td>
        <td><?php echo h($this->Time->Format('d/m/y - h:i',$ticket['Ticket']['created']));?></td>
        <td><?php echo h($ticket['User']['username']);?></td>
		<td class="actions btn-group">
            <button class="btn">Action</button>
            <button class="btn dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="<?php echo $this->Html->url(array('action' => 'view',$ticket['Ticket']['id']));?>"><span class="icon-eye-open"></span> <?php echo __('Voir');?></a></li>
                <li><?php echo $this->Form->postLink(
                        __('Fermer ce ticket'),
                        array('action' => 'openedToClosed', $ticket['Ticket']['id']),
                        null,
                        __('Etes-vous sûr de vouloir fermer le ticket < %s >?', $ticket['Ticket']['titre']));?></li>
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
	<?php	else:
			echo __('Il n\'y a actuellement aucun ticket en cours.');
		endif;
	?>
	</div>
</div>
