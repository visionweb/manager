<div class="span10 form">
    <?php echo $this->Form->create(); ?>
    <fieldset>
        <legend><?php echo __('Editez cette adresse'); ?></legend>
        <?php

        //Rue
        echo $this->Form->input('0.UserDetail.id',array('type'=>'hidden'));
        echo $this->Form->input('0.UserDetail.type',array('type'=>'hidden'));
        echo $this->Form->input('0.UserDetail.valeur',array('label'=>'Rue'));
        echo $this->Form->input('0.UserDetail.key',array('type'=>'hidden',));
        echo $this->Form->input('0.UserDetail.actif_user_detail',array('type'=>'hidden'));
        echo $this->Form->input('0.UserDetail.user_id',array('type'=>'hidden'));

        //NPA
        echo $this->Form->input('1.UserDetail.id',array('type'=>'hidden'));
        echo $this->Form->input('1.UserDetail.type',array('type'=>'hidden'));
        echo $this->Form->input('1.UserDetail.valeur',array('label'=>'Numéro Postal'));
        echo $this->Form->input('1.UserDetail.key',array('type'=>'hidden'));
        echo $this->Form->input('1.UserDetail.actif_user_detail',array('type'=>'hidden'));
        echo $this->Form->input('1.UserDetail.user_id',array('type'=>'hidden'));

        //Ville
        echo $this->Form->input('2.UserDetail.id',array('type'=>'hidden'));
        echo $this->Form->input('2.UserDetail.type',array('type'=>'hidden'));
        echo $this->Form->input('2.UserDetail.valeur',array('label'=>'Ville'));
        echo $this->Form->input('2.UserDetail.key',array('type'=>'hidden'));
        echo $this->Form->input('2.UserDetail.actif_user_detail',array('type'=>'hidden'));
        echo $this->Form->input('2.UserDetail.user_id',array('type'=>'hidden'));

        //Pays
        echo $this->Form->input('3.UserDetail.id',array('type'=>'hidden'));
        echo $this->Form->input('3.UserDetail.type',array('type'=>'hidden'));
        echo $this->Form->input('3.UserDetail.valeur',array('label'=>'Pays'));
        echo $this->Form->input('3.UserDetail.key',array('type'=>'hidden'));
        echo $this->Form->input('3.UserDetail.actif_user_detail',array('type'=>'hidden'));
        echo $this->Form->input('3.UserDetail.user_id',array('type'=>'hidden'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Editez')); ?>
</div>
