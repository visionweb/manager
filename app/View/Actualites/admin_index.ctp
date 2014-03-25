<?php print $this->element('subheader'); ?>

    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
			<th>
				<?php print $this->Paginator->sort('titre_actu','Titre Actualité')?>
			</th>
			<th>
				<?php print $this->Paginator->sort('created','Créé le');?>
			</th>
		</tr>
        <?php foreach ($actualites as $actualite): ?>
            <tr>
                <td><?php echo h($actualite['Actualite']['titre_actu']); ?>&nbsp;</td>
                <td><?php echo h($this->Time->format('d/m/Y - H:i:s',$actualite['Actualite']['created'])); ?>&nbsp;</td>
                <td class="actions btn-group">
                    <button class="btn">Action</button>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $this->Html->url(array('action' => 'view',$actualite['Actualite']['id']));?>"><span class="icon-eye-open"></span> <?php echo __('Voir');?></a></li>
                        <li><a href="<?php echo $this->Html->url(array('action' => 'edit',$actualite['Actualite']['id']));?>"><span class="icon-edit"></span> <?php echo __('Modifier');?></a></li>
                        <li><a href="#"><?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $actualite['Actualite']['id']), null, __('Etes-vous sûr de vouloir supprimer l\'actualité < %s >?', $actualite['Actualite']['titre_actu']));?></a></li>
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
