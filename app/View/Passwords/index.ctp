<div class="span10 index">
    <h2><?php echo __('Mots de passe'); ?></h2>
    <?php echo $this->Html->link(__('Ajouter'),array('action'=>'add'));?>
    <br/><br/>
    <?php if(empty($passwords)): echo __('Aucun mot de passe');?>
    <?php else:?>
        <?php echo $this->Form->button('Voir les mots de passe', array('type' => 'button','id' => 'btnPassword','class' => 'btn')); ?><br/>
        <table class="table-hover table-condensed" cellpadding="0" cellspacing="0" id="passtable">
            <tr>
                <th><?php echo $this->Paginator->sort('password_service_id','Service'); ?></th>
                <th><?php echo $this->Paginator->sort('password_type_id','Type'); ?></th>
                <th><?php echo $this->Paginator->sort('login','Identifiant'); ?></th>
                <th><?php echo __('Mot de passe'); ?></th>
            </tr>
            <?php foreach ($passwords as $password): ?>
                <tr rel="<?php echo $password['Password']['id'];?>">
                    <td><?php echo h($passwordService[$password['Password']['password_service_id']]); ?>&nbsp;</td>
                    <td><?php echo h($passwordType[$password['Password']['password_type_id']]); ?>&nbsp;</td>
                    <td><?php echo h($password['Password']['login']); ?>&nbsp;</td>
                    <td>
                        <div class="passShow" id="passshow-<?php echo $password['Password']['id'];?>" style="display:none"><?php echo h($password['Password']['password']); ?>&nbsp;</div>
                        <div class="passHide" id="passhide-<?php echo $password['Password']['id'];?>" style="display:inline"><?php echo '**********'; ?>&nbsp;</div></td>
                    <td class="actions btn-group">
                        <button class="btn">Action</button>
                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->Html->url(array('action' => 'edit',$password['Password']['id']));?>"><span class="icon-edit"></span> <?php echo __('Modifier');?></a></li>
                            <li><?php echo $this->Form->postLink(
                                    __('Supprimer'),
                                    array('action' => 'delete', $password['Password']['id']),
                                    null,
                                    __('Etes-vous sûr de vouloir supprimer le mot de passe < %s >?', $password['Password']['login']));?></li>
                        </ul>
                    </td>
                </tr>
            <?php endforeach; ?>
           <?php

           ?>
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
    <?endif;?>
</div>
<?php echo $this->Html->script(array('password')); ?>


