<div class="span10 form">
    <?php echo $this->Form->create('GroupDetail'); ?>
    <fieldset>
        <legend><?php echo __('Editez ce numéro'); ?></legend>
        <?php
        echo $this->Form->input('id');
        //Défini les choix du select
        $choix = array('NumeroFixe' => 'Numéro Fixe', 'NumeroMobile' => 'Numéro Mobile', 'NumeroFax' => 'Numéro Fax');
        echo $this->Form->input('type',array('options'=>$choix));
        echo $this->Form->input('valeur',array('label'=>'Numero','type'=>'tel','minLength'=>'10','maxLength' => '13'));
        echo $this->Form->input('group_id',array('type'=>'hidden'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Editez')); ?>
</div>
