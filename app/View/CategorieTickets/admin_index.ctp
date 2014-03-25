
<?php print $this->element('subheader'); ?>

    <?php echo $this->Html->link(__('Ajouter'),array('action'=>'add'));?>
    <br/>
	<table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('titre_categorie'); ?></th>
        </tr>
        <?php foreach ($categorieTickets as $categorieTicket): ?>
            <tr>
                <td><?php echo h($categorieTicket['CategorieTicket']['titre_categorie']); ?>&nbsp;</td>
                <td class="actions btn-group">
                    <button class="btn">Action</button>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $this->Html->url(array('action' => 'view', $categorieTicket['CategorieTicket']['id']));?>"><span class="icon-eye-open"></span> <?php echo __('Voir');?></a></li>
                        <li><a href="<?php echo $this->Html->url(array('action' => 'edit', $categorieTicket['CategorieTicket']['id']));?>"><span class="icon-edit"></span> <?php echo __('Modifier');?></a></li>
                        <li class="divider"></li>
                        <li><a><?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $categorieTicket['CategorieTicket']['id']), null, __('Etes-vous sûr de vouloir supprimer la catégorie < %s > ?', $categorieTicket['CategorieTicket']['titre_categorie']));?></a></li>
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
	</div>

<?php print $this->element('end_view'); ?>

