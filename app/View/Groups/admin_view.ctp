<div class="span10 view">
    <h2><?php  echo __('Groupe'); ?></h2>
    <span class="btn-group">
        <button class="btn">Action</button>
        <button class="btn dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="<?php echo $this->Html->url(array('action' => 'edit',$group['Group']['id']));?>"><span class="icon-edit"></span> <?php echo __('Modifiez ce groupe');?></a></li>
            <li><a href="#"><?php echo $this->Form->postLink(__('Supprimer ce groupe'), array('action' => 'delete', $group['Group']['id']), null, __('Etes-vous sûr de vouloir supprimer le groupe < %s > ?', $group['Group']['nom_group']));?></a></li>
        </ul>
    </span><br/>
    <dl>
        <dt><?php echo __('Type du Groupe'); ?></dt>
        <dd>
            <?php echo h($group['Group']['type_group']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Nom du Groupe'); ?></dt>
        <dd>
            <?php echo h($group['Group']['nom_group']); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class='span10 view'>
    <div class="adresse">
        <h3><?php echo $this->Html->image('icone_adresse').'Adresse'; ?></h3>
            <?php echo $this->Html->link('Ajouter une adresse',array('controller'=>'groupDetails','action'=>'add_adresse',$group['Group']['id']));?>
        <br/>
        <?php if (isset($group['GroupDetail']['Adresse'])): ?>
            <?php foreach($group['GroupDetail']['Adresse']as $adresse): ?>
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
                                $this->Html->image('edit.png', array('alt' => __('Modifiez'))), //le image
                                array('controller'=>'groupDetails','action'=>'edit_adresse',$adresse[0]['key']), //le url
                                array('escape' => false)//le escape
                            );
                            echo " - ";
                            echo $this->Form->postLink(
                                $this->Html->image('cross.png', array('alt' => __('Supprimez'))), //le image
                                array('controller'=>'groupDetails','action'=>'delete_adresse',$adresse[0]['key']), //le url
                                array('escape' => false), //le escape
                                __('Etes-vous sûr de vouloir supprimer cette adresse ?') //le confirm
                            );
                    ?>
                    <br/><br/>
                </div>
            <?php endforeach;?>
        <?php else: ?>
           <div class="blocAdresse"><?php echo __('Aucune adresse n\'est renseignée pour ce groupe.');?></div><br/>
        <?php endif; ?>
    </div>

    <div class="email">
        <h3><?php echo $this->Html->image('icone_email').'Email';?></h3>
            <?php echo $this->Html->link('Ajouter un email',array('controller'=>'groupDetails','action'=>'add_email',$group['Group']['id']));?>
            <?php if (isset($group['GroupDetail']['Email'])): ?>
                <?php foreach($group['GroupDetail']['Email']as $email): ?>
                    <div class="blocEmail">
                        <br/>
                        <?php echo $email['valeur'];?>
                        <?php echo $this->Html->link(
                                $this->Html->image('edit.png', array('alt' => __('Modifiez'))), //le image
                                array('controller'=>'groupDetails','action'=>'edit_email',$email['id']), //le url
                                array('escape' => false)//le escape
                            );
                            echo " - ";
                            echo $this->Form->postLink(
                                $this->Html->image('cross.png', array('alt' => __('Supprimez'))), //le image
                                array('controller'=>'groupDetails','action'=>'delete_email',$email['id']), //le url
                                array('escape' => false), //le escape
                                __('Etes-vous sûr de vouloir supprimer l\'email < %s >?', $email['valeur']) //le confirm
                            );
                        ?>
                        <br/>
                    </div>
                <?php endforeach;?>
            <?php else: ?>
                 <div class="blocEmail"><?php echo __('Aucun email n\'est renseigné pour ce groupe.');?></div>
            <?php endif; ?>
    </div>
    <div class="numero">
        <h3><?php echo $this->Html->image('icone_telephone').'Numéro';?></h3>
        <?php echo $this->Html->link('Ajouter un numéro',array('controller'=>'groupDetails','action'=>'add_numero',$group['Group']['id']));?>
        <?php if (isset($group['GroupDetail']['Numero'])): ?>
            <?php foreach($group['GroupDetail']['Numero']as $numero): ?>
                <div class="blocNumero">
                    <br/>
                    <?php
                        switch ($numero['type']) {
                            case 'NumeroFixe':
                                echo "Fixe: ";
                                break;
                            case 'NumeroMobile':
                                echo "Mobile: ";
                                break;
                            case 'NumeroFax':
                                echo "Fax: ";
                                break;
                        }
                    ?>
                    <?php   echo $numero['valeur'];?>
                    <?php   echo $this->Html->link(
                                $this->Html->image('edit.png', array('alt' => __('Modifiez'))), //le image
                                array('controller'=>'groupDetails','action'=>'edit_numero',$numero['id']), //le url
                                array('escape' => false)//le escape
                                );
                            echo " - ";
                            echo $this->Form->postLink(
                                $this->Html->image('cross.png', array('alt' => __('Supprimez'))), //le image
                                array('controller'=>'groupDetails','action'=>'delete_numero',$numero['id']), //le url
                                array('escape' => false), //le escape
                                __('Etes-vous sûr de vouloir supprimer le numéro < %s >?', $numero['valeur']) //le confirm
                                );
                    ?>
                    <br/>
                </div>
            <?php endforeach;?>
        <?php else: ?>
        <div class="blocNumero"><?php echo __('Aucun numéro n\'est renseigné pour ce groupe.');?></div>
        <?php endif; ?>
    </div>

    <div class="span10 related">
        <h3><?php echo __('Utilisateurs Associés'); ?></h3>
        <?php if (!empty($group['User'])): ?>
            <table class="table-hover table-condensed" cellpadding = "0" cellspacing = "0">
                <tr>
                    <th><?php echo __('Nom'); ?></th>
                    <th><?php echo __('Prénom'); ?></th>
                    <th><?php echo __('Username'); ?></th>
                </tr>
                <?php
                $i = 0;
                foreach ($group['User'] as $user): ?>
                    <tr>
                        <td><?php echo $user['nom_user']; ?></td>
                        <td><?php echo $user['prenom']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td class="actions btn-group">
                            <button class="btn">Action</button>
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'view', $user['id']));?>"><span class="icon-eye-open"></span> <?php echo __('Voir');?></a></li>
                                <li><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'edit', $user['id']));?>"><span class="icon-edit"></span> <?php echo __('Modifier');?></a></li>
                                <li><a href="#"><?php echo $this->Form->postLink(__('Supprimer'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Etes-vous sûr de vouloir supprimer l\'utilisateur < %s %s > ?', $user['nom_user'],$user['prenom']));?></a></li>
                            </ul>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php
            else:
                echo __('Actuellement, il n\'y a aucun utilisateur associé à ce groupe.');
            endif;
        ?><br/>
        <div class="actions actions2">
            <ul>
                <li><?php echo $this->Html->link(__('Nouveau Utilisateur'), array('controller' => 'users', 'action' => 'add')); ?> </li>
            </ul>
        </div>
    </div>

    <div class="span10 related">
        <h3><?php echo __('Tickets Associés'); ?></h3>
        <?php if (!empty($group['Ticket'])): ?>
            <table class="table-hover table-condensed" cellpadding = "0" cellspacing = "0">
                <tr>
                    <th><?php echo __('Catégorie Ticket'); ?></th>
                    <th><?php echo __('Titre'); ?></th>
                </tr>
                <?php
                $i = 0;
                foreach ($group['Ticket'] as $ticket): ?>
                    <tr>
                        <td><?php echo $this->Html->link($ticket['CategorieTicket']['titre_categorie'],array('controller'=>'categorieTickets','action'=>'view',$ticket['CategorieTicket']['id']));?></td>
                        <td><?php echo $ticket['titre']; ?></td>
                        <td class="actions btn-group">
                            <button class="btn">Action</button>
                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $this->Html->url(array('controller' => 'tickets', 'action' => 'view', $ticket['id']));?>"><span class="icon-eye-open"></span> <?php echo __('Voir');?></a></li>
                                <li><a href="<?php echo $this->Html->url(array('controller' => 'tickets', 'action' => 'edit', $ticket['id']));?>"><span class="icon-edit"></span> <?php echo __('Modifier');?></a></li>
                                <?if ($ticket['status']=='opened'):?>
                                    <li><a href="#"><?php echo $this->Form->postLink(__('Fermez ce ticket'),'/tickets/openedToClosed/'.$ticket['id'],null,__('Etes-vous sûr de vouloir fermer le ticket < %s > ?',$ticket['titre']));?></a></li>
                                <?else:?>
                                    <li><a href="#"><?php echo $this->Form->postLink(__('Ré-ouvrir ce ticket'),array('controller'=>'tickets','action'=>'closedToOpened',$ticket['id']),null,__('Etes-vous sûr de vouloir ré-ouvrir le ticket < %s > ?',$ticket['titre']));?></a></li>
                                <?endif; ?>
                                <li><a href="#"><?php echo $this->Form->postLink(__('Supprimer'), array('controller' => 'tickets', 'action' => 'delete', $ticket['id']), null, __('Etes-vous sûr de vouloir supprimer le ticket < %s > ?', $ticket['titre']));?></a></li>
                            </ul>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php
        else:
            echo __('Actuellement, il n\'y a aucun ticket associé à ce groupe.');
        endif;
        ?><br/><br/>
    </div>

    <div class="span10 related">
        <h3><?php echo __('Factures Associées'); ?></h3>
        <?php if (!empty($group['Invoice'])): ?>
            <table class="table-hover table-condensed" cellpadding = "0" cellspacing = "0">
                <tr>
                    <th><?php echo __('Nom Facture'); ?></th>
                    <th><?php echo __('Crée le'); ?></th>
                    <th><?php echo __('Type Facture'); ?></th>
                    <th><?php echo __('Statut Facture'); ?></th>
                </tr>
                <?php
                $flag = false;
                foreach ($group['Invoice'] as $invoice): ?>
                    <? if($invoice['active_invoice']){ ?>
                        <?$flag=true;?>
                        <tr>
                            <td><?php echo $this->Html->link($invoice['name'], array('controller' => 'invoices', 'action' => 'view', $invoice['id'])); ?></td>
                            <td><?php echo $invoice['created']; ?></td>
                            <td><?php echo $invoice['InvoiceType']['label']; ?></td>
                            <td><?php echo $invoice['InvoiceStatut']['label']; ?></td>
                            <td class="actions btn-group">
                                <button class="btn">Action</button>
                                <button class="btn dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $this->Html->url(array('controller' => 'invoices', 'action' => 'view', $invoice['id']));?>"><span class="icon-eye-open"></span> <?php echo __('Voir');?></a></li>
                                    <li><a href="<?php echo $this->Html->url(array('controller' => 'invoices', 'action' => 'sendFile', $invoice['id']));?>"><span class="icon-edit"></span> <?php echo __('Telecharger');?></a></li>
                                    <li><a href="#"><?php echo $this->Form->postLink(__('Supprimer'), array('controller' => 'invoices', 'action' => 'delete', $invoice['id']), null, __('Etes-vous sûr de vouloir supprimer la facture < %s > ?', $invoice['name']));?></a></li>
                                </ul>
                            </td>
                        </tr>
                    <?}?>
                <?php endforeach; ?>
                <?php if(!$flag) echo __('Actuellement, il n\'y a aucune facture associée à ce groupe.');?>
            </table>
        <?php
        else:
            echo __('Actuellement, il n\'y a aucune facture associée à ce groupe.');
        endif;
        ?><br/>
        <div class="actions actions2">
            <ul>
                <li><?php echo $this->Html->link(__('Nouvelle Facture'), array('controller' => 'invoices', 'action' => 'add')); ?> </li>
            </ul>
        </div>
        <br/>
    </div>
</div>
