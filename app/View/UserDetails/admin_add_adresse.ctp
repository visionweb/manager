<div class="span10 form">
    <?php echo $this->Form->create(); ?>
    <fieldset>
        <legend><?php echo __('Ajouter une Adresse'); ?></legend>
        <?php
        //Rue
        echo $this->Form->input('UserDetail.0.type',array('type'=>'hidden','default'=>'Rue'));
        echo $this->Form->input('UserDetail.0.valeur',array('label'=>'Rue'));
        echo $this->Form->input('UserDetail.0.key',array('type'=>'hidden','default'=>$infos['key']));
        echo $this->Form->input('UserDetail.0.actif_user_detail',array('type'=>'hidden','default'=>true));
        echo $this->Form->input('UserDetail.0.user_id',array('type'=>'hidden','default'=>$infos['id']));

        //NPA
        echo $this->Form->input('UserDetail.1.type',array('type'=>'hidden','default'=>'NPA'));
        echo $this->Form->input('UserDetail.1.valeur',array('label'=>'Numéro Postal'));
        echo $this->Form->input('UserDetail.1.key',array('type'=>'hidden','default'=>$infos['key']));
        echo $this->Form->input('UserDetail.1.actif_user_detail',array('type'=>'hidden','default'=>true));
        echo $this->Form->input('UserDetail.1.user_id',array('type'=>'hidden','default'=>$infos['id']));

        //Ville
        echo $this->Form->input('UserDetail.2.type',array('type'=>'hidden','default'=>'Ville'));
        echo $this->Form->input('UserDetail.2.valeur',array('label'=>'Ville'));
        echo $this->Form->input('UserDetail.2.key',array('type'=>'hidden','default'=>$infos['key']));
        echo $this->Form->input('UserDetail.2.actif_user_detail',array('type'=>'hidden','default'=>true));
        echo $this->Form->input('UserDetail.2.user_id',array('type'=>'hidden','default'=>$infos['id']));

        //Pays
        echo $this->Form->input('UserDetail.3.type',array('type'=>'hidden','default'=>'Pays'));
        echo $this->Form->input('UserDetail.3.valeur',array('label'=>'Pays'));
        echo $this->Form->input('UserDetail.3.key',array('type'=>'hidden','default'=>$infos['key']));
        echo $this->Form->input('UserDetail.3.actif_user_detail',array('type'=>'hidden','default'=>true));
        echo $this->Form->input('UserDetail.3.user_id',array('type'=>'hidden','default'=>$infos['id']));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Ajouter')); ?>
</div>
