<br>
<?php print $this->element('subheader'); ?>

    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('type_group','Type Groupe'); ?></th>
            <th><?php echo $this->Paginator->sort('nom_group','Nom Groupe'); ?></th>
        </tr>
        <?php foreach ($groups as $group): ?>
            <tr>
                <td><?php echo h($group['Group']['type_group']); ?>&nbsp;</td>
                <td><?php echo $this->Html->link(__(h($group['Group']['nom_group'])), array('action' => 'view', $group['Group']['id'])); ?>&nbsp;</td>
                <td class="actions btn-group">
                    <button class="btn">Action</button>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $this->Html->url(array('action' => 'view',$group['Group']['id']));?>"><span class="icon-eye-open"></span> <?php echo __('Voir');?></a></li>
                        <li><a href="<?php echo $this->Html->url(array('action' => 'edit',$group['Group']['id']));?>"><span class="icon-edit"></span> <?php echo __('Modifier');?></a></li>
                        <li><a href="#"><?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $group['Group']['id']), null, __('Etes-vous sûr de vouloir supprimer le groupe < %s >?', $group['Group']['nom_group']));?></a></li>
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
