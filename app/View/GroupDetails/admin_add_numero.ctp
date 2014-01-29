<div class="span10 form">
    <?php echo $this->Form->create('GroupDetail'); ?>
    <fieldset>
        <legend><?php echo __('Ajouter un Numéro'); ?></legend>
        <?php
        //Numero
        //Défini les choix du select
        $choix = array('NumeroFixe' => 'Numéro Fixe', 'NumeroMobile' => 'Numéro Mobile', 'NumeroFax' => 'Numéro Fax');
        echo $this->Form->input('type',array('label'=>'Type','options'=>$choix));
        echo $this->Form->input('valeur',array('label'=>'Numéro','type'=>'tel','minLength'=>'10','maxLength' => '13'));
        echo $this->Form->input('key',array('type'=>'hidden','default'=>null));
        echo $this->Form->input('actif_group_detail',array('type'=>'hidden','default'=>true));
        echo $this->Form->input('group_id',array('type'=>'hidden','default'=>$infos['id']));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Ajouter')); ?>
</div>
