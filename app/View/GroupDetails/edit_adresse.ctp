<div class="span10 form">
    <?php echo $this->Form->create(); ?>
    <fieldset>
        <legend><?php echo __('Editez cette adresse'); ?></legend>
        <?php

        //Rue
        echo $this->Form->input('0.GroupDetail.id',array('type'=>'hidden'));
        echo $this->Form->input('0.GroupDetail.type',array('type'=>'hidden'));
        echo $this->Form->input('0.GroupDetail.valeur',array('label'=>'Rue'));
        echo $this->Form->input('0.GroupDetail.key',array('type'=>'hidden',));
        echo $this->Form->input('0.GroupDetail.actif_group_detail',array('type'=>'hidden'));
        echo $this->Form->input('0.GroupDetail.group_id',array('type'=>'hidden'));

        //NPA
        echo $this->Form->input('1.GroupDetail.id',array('type'=>'hidden'));
        echo $this->Form->input('1.GroupDetail.type',array('type'=>'hidden'));
        echo $this->Form->input('1.GroupDetail.valeur',array('label'=>'Numéro Postal'));
        echo $this->Form->input('1.GroupDetail.key',array('type'=>'hidden'));
        echo $this->Form->input('1.GroupDetail.actif_group_detail',array('type'=>'hidden'));
        echo $this->Form->input('1.GroupDetail.group_id',array('type'=>'hidden'));

        //Ville
        echo $this->Form->input('2.GroupDetail.id',array('type'=>'hidden'));
        echo $this->Form->input('2.GroupDetail.type',array('type'=>'hidden'));
        echo $this->Form->input('2.GroupDetail.valeur',array('label'=>'Ville'));
        echo $this->Form->input('2.GroupDetail.key',array('type'=>'hidden'));
        echo $this->Form->input('2.GroupDetail.actif_group_detail',array('type'=>'hidden'));
        echo $this->Form->input('2.GroupDetail.group_id',array('type'=>'hidden'));

        //Pays
        echo $this->Form->input('3.GroupDetail.id',array('type'=>'hidden'));
        echo $this->Form->input('3.GroupDetail.type',array('type'=>'hidden'));
        echo $this->Form->input('3.GroupDetail.valeur',array('label'=>'Pays'));
        echo $this->Form->input('3.GroupDetail.key',array('type'=>'hidden'));
        echo $this->Form->input('3.GroupDetail.actif_group_detail',array('type'=>'hidden'));
        echo $this->Form->input('3.GroupDetail.group_id',array('type'=>'hidden'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Editez')); ?>
</div>
