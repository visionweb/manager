
<?php print $this->element('subheader'); ?>

    <?php echo $this->Html->link(__('Ajouter'),array('action'=>'add'));?>
    <br/><br/>
    <?php if(empty($passwordServices)): echo __('Aucun service');?>
    <?php else:?>
        <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
            <tr>
                <th><?php echo $this->Paginator->sort('label','Nom du service'); ?></th>
                <th><?php echo $this->Paginator->sort('active_password_service','Etat'); ?></th>
            </tr>
            <?php foreach ($passwordServices as $passwordService): ?>
                <tr>
                    <td><?php echo h($passwordService['PasswordService']['label']); ?>&nbsp;</td>
                    <?php if ($passwordService['PasswordService']['active_password_service']==true): ?>
                        <td class="activatedStatut"><?php echo 'Activé'; ?>&nbsp;</td>
                        <td class="actions btn-group">
                            <button class="btn">Action</button>
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $this->Html->url(array('action' => 'edit', $passwordService['PasswordService']['id']));?>"><span class="icon-edit"></span> <?php echo __('Modifier');?></a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo $this->Html->url(array('action' => 'switchActive', $passwordService['PasswordService']['id'],$passwordService['PasswordService']['active_password_service']));?>" class="btn btn-danger btn-mini"><span class="icon-ban-circle"></span> <?php echo __('Désactiver');?></a></li>
                            </ul>
                        </td>
                    <?php else: ?>
                        <td class="disabledStatut"><?php echo 'Désactivé'; ?>&nbsp;</td>
                        <td class="actions btn-group">
                            <button class="btn">Action</button>
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $this->Html->url(array('action' => 'switchActive', $passwordService['PasswordService']['id'],$passwordService['PasswordService']['active_password_service']));?>" class="btn btn-success btn-mini"><span class="icon-ok"></span> <?php echo __('Activer');?></a></li>
                            </ul>
                        </td>
                    <?php endif; ?>
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
    <?php endif;?>

<?php print $this->element('end_view'); ?>
