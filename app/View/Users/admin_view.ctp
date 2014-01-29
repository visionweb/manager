<div class="span10 view">
    <h2><?php  echo __('Utilisateur'); ?></h2>
    <span class="btn-group">
        <button class="btn">Action</button>
        <button class="btn dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="<?php echo $this->Html->url(array('controller'=>'users','action'=>'edit',$user['User']['id']));?>"><span class="icon-edit"></span> <?php echo __('Modifiez cet utilisateur');?></a></li>
            <li><a href="#"><?php echo $this->Form->postLink(__('Supprimer cet utilisateur'), array('action' => 'delete', $user['User']['id']), null, __('Etes-vous sûr de vouloir supprimer l\'utilisateur < %s %s > ?', $user['User']['nom_user'],$user['User']['prenom']));?></a></li>
        </ul>
    </span>
    <br/><br/>
    <table class="display-table">
        <tr>
            <td style="text-align: right"><b><?php echo __('Civilité');?></b></td>
            <td style="text-align: left"><?php echo h($user['User']['civilite']);?></td>
        </tr>
        <tr>
            <td style="text-align: right"><b><?php echo __('Nom');?></b></td>
            <td style="text-align: left"><?php echo h($user['User']['nom_user']);?></td>
        </tr>
        <tr>
            <td style="text-align: right"><b><?php echo __('Prénom');?></b></td>
            <td style="text-align: left"><?php echo h($user['User']['prenom']);?></td>
        </tr>
        <tr>
            <td style="text-align: right"><b><?php echo __('Nom d\'utilisateur');?></b></td>
            <td style="text-align: left"><?php echo h($user['User']['username']);?></td>
        </tr>
        <tr>
            <td style="text-align: right"><b><?php echo __('Groupe');?></b></td>
            <td style="text-align: left"><?php echo h($user['Group']['nom_group']);?>
                &nbsp;<span><?php echo $this->Html->link(__('Voir groupe'),array('controller' => 'groups','action' => 'view',$user['Group']['id']));?></span>
            </td>
        </tr>
    </table>
    <div class="adresse">
        <h3><?php echo $this->Html->image('icone_adresse').'Adresse'; ?></h3>
        <?php echo $this->Html->link(__('Ajouter une adresse'),array('controller'=>'userDetails','action'=>'add_adresse',$user['User']['id']));?>
        <br/>
        <?php if (isset($user['UserDetail']['Adresse'])): ?>
            <?php foreach($user['UserDetail']['Adresse']as $adresse): ?>
                <div class="blocAdresse">
                    <br/>
                    <span class="rue"><?php echo $adresse[0]['valeur'];?></span>
                    <br/>
                    <span class="npa"><?php echo $adresse[1]['valeur'].', ';?></span>
                    <span class="ville"><?php echo $adresse[2]['valeur'];?></span>
                    <br/>
                    <span class="pays"><?php echo $adresse[3]['valeur'];?></span>
                    <br/>
                    <?php   echo $this->Html->link(
                        $this->Html->image('edit.png', array('alt' => __('Modifiez'))),
                        array('controller'=>'userDetails','action'=>'edit_adresse',$adresse[0]['key']),
                        array('escape' => false)
                    );
                    echo " - ";
                    echo $this->Form->postLink(
                        $this->Html->image('cross.png', array('alt' => __('Supprimez'))),
                        array('controller'=>'userDetails','action'=>'delete_adresse',$adresse[0]['key']),
                        array('escape' => false),
                        __('Etes-vous sûr de vouloir supprimer cette adresse ?')
                    );
                    ?>
                    <br/><br/>
                </div>
            <?php endforeach;?>
        <?php else: ?>
            <div class="blocAdresse"><?php echo __('Aucune adresse n\'est renseignée pour cet utilisateur.');?></div><br/>
        <?php endif; ?>
    </div>

    <div class="email">
        <h3><?php echo $this->Html->image('icone_email').'Email';?></h3>
        <?php echo $this->Html->link(__('Ajouter un email'),array('controller'=>'userDetails','action'=>'add_email',$user['User']['id']));?>
        <?php if (isset($user['UserDetail']['Email'])): ?>
            <?php foreach($user['UserDetail']['Email']as $email): ?>
                <div class="blocEmail">
                    <br/>
                    <?php echo $email['valeur'];?>
                    <?php echo $this->Html->link(
                        $this->Html->image('edit.png', array('alt' => __('Modifiez'))),
                        array('controller'=>'userDetails','action'=>'edit_email',$email['id']),
                        array('escape' => false)
                    );
                    echo " - ";
                    echo $this->Form->postLink(
                        $this->Html->image('cross.png', array('alt' => __('Supprimez'))),
                        array('controller'=>'userDetails','action'=>'delete_email',$email['id']),
                        array('escape' => false),
                        __('Etes-vous sûr de vouloir supprimer l\'email < %s >?', $email['valeur'])
                    );
                    ?>
                    <br/>
                </div>
            <?php endforeach;?>
        <?php else: ?>
            <div class="blocEmail"><?php echo __('Aucun email n\'est renseigné pour cet utilisateur.');?></div>
        <?php endif; ?>
    </div>
    <div class="numero">
        <h3><?php echo $this->Html->image('icone_telephone').'Numéro';?></h3>
        <?php echo $this->Html->link(__('Ajouter un numéro'),array('controller'=>'userDetails','action'=>'add_numero',$user['User']['id']));?>
        <?php if (isset($user['UserDetail']['Numero'])): ?>
            <?php foreach($user['UserDetail']['Numero']as $numero): ?>
                <div class="blocNumero">
                    <br/>
                    <?php
                    switch ($numero['type']) {
                        case 'NumeroFixe':
                            echo __('Fixe: ');
                            break;
                        case 'NumeroMobile':
                            echo __('Mobile: ');
                            break;
                        case 'NumeroFax':
                            echo __('Fax: ');
                            break;
                    }
                    ?>
                    <?php   echo $numero['valeur'];?>
                    <?php   echo $this->Html->link(
                        $this->Html->image('edit.png', array('alt' => __('Modifiez'))),
                        array('controller'=>'userDetails','action'=>'edit_numero',$numero['id']),
                        array('escape' => false)
                    );
                    echo " - ";
                    echo $this->Form->postLink(
                        $this->Html->image('cross.png', array('alt' => __('Supprimez'))),
                        array('controller'=>'userDetails','action'=>'delete_numero',$numero['id']),
                        array('escape' => false),
                        __('Etes-vous sûr de vouloir supprimer le numéro < %s >?', $numero['valeur'])
                    );
                    ?>
                    <br/>
                </div>
            <?php endforeach;?>
        <?php else: ?>
            <div class="blocNumero"><?php echo __('Aucun numéro n\'est renseigné pour cet utilisateur.');?></div>
        <?php endif; ?>
    </div>
</div>