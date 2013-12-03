<div class="span10">
    <h2><?php  echo __('Groupe'); ?></h2>
	<?php echo $this->Html->link('Modifiez les informations de ce groupe',array('controller'=>'groups','action'=>'view'));?>
	<br/><br/>
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
<div class='span10'>
    <div class="adresse">
        <h3><?php echo $this->Html->image('icone_adresse').'Adresse'; ?></h3>
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
                    <br/><br/>
                </div>
            <?php endforeach;?>
        <?php else: ?>
           <div class="blocAdresse"><?php echo __('Aucune adresse n\'est renseignée pour ce groupe.');?></div><br/>
        <?php endif; ?>
    </div>

    <div class="email">
        <h3><?php echo $this->Html->image('icone_email').'Email';?></h3>
            <?php if (isset($group['GroupDetail']['Email'])): ?>
                <?php foreach($group['GroupDetail']['Email']as $email): ?>
                    <div class="blocEmail">
                        <br/>
                        <?php echo $email['valeur'];?>
                       <br/>
                    </div>
                <?php endforeach;?>
            <?php else: ?>
                 <div class="blocEmail"><?php echo __('Aucun email n\'est renseigné pour ce groupe.');?></div>
            <?php endif; ?>
    </div>
    <div class="numero">
        <h3><?php echo $this->Html->image('icone_telephone').'Numéro';?></h3>
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
                </tr>
                <?php
                $i = 0;
                foreach ($group['User'] as $user): ?>
                    <tr>
                        <td><?php echo $user['nom_user']; ?></td>
                        <td><?php echo $user['prenom']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php
            else:
                echo __('Actuellement, il n\'y a aucun utilisateur associé à ce groupe.');
            endif;
        ?>
        <br/>
        <div class="actions actions2">
            <?php echo $this->Html->link(__('Nouveau utilisateur'),array('controller'=>'users','action'=>'add'));?>
        </div>
    </div>
  </div>
</div>

