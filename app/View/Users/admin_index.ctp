
<?php print $this->element('subheader'); ?>

    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('Civilité'); ?></th>
            <th><?php echo $this->Paginator->sort('Nom'); ?></th>
            <th><?php echo $this->Paginator->sort('Prénom'); ?></th>
            <th><?php echo $this->Paginator->sort('Username'); ?></th>
            <th><?php echo $this->Paginator->sort('Groupe'); ?></th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo h($user['User']['civilite']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['nom_user']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['prenom']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
                <td>
                    <?php echo $this->Html->link($user['Group']['nom_group'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
                </td>
                <td class="actions btn-group">
                    <button class="btn">Action</button>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $this->Html->url(array('action' => 'view', $user['User']['id']));?>"><span class="icon-eye-open"></span> <?php echo __('Voir');?></a></li>
                        <?php if($user['User']['username']=='superuser') print "<!--";?>
                        <li><a href="<?php echo $this->Html->url(array('action' => 'edit', $user['User']['id']));?>"><span class="icon-edit"></span> <?php echo __('Modifier');?></a></li>
                        <li class="divider"></li>
                        <li><a href="#"><?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $user['User']['id']), null, __('Etes-vous sûr de vouloir supprimer l\'utilisateur < %s %s > ?', $user['User']['nom_user'],$user['User']['prenom']));?></a></li>
						<?php if($user['User']['username']=='superuser') print "-->";?>
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
