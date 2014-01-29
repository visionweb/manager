<div class="span10 view">
    <h2><?php  echo __('Groupe'); ?></h2>
    <br/>
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
        <h3><?php echo $this->Html->image('icone_adresse').'Email';?></h3>
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
        <h3><?php echo $this->Html->image('icone_adresse').'Numéro';?></h3>
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
</div>
