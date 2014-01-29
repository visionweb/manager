<div class="span10 form">
    <?php echo $this->Form->create('UserDetail'); ?>
    <fieldset>
        <legend><?php echo __('Ajouter un Numéro'); ?></legend>
        <?php
        //Numero
        //Define choices for the select
        $choice = array('NumeroFixe' => 'Numéro Fixe', 'NumeroMobile' => 'Numéro Mobile', 'NumeroFax' => 'Numéro Fax');
        echo $this->Form->input('type',array('label'=>'Type','options'=>$choice));
        echo $this->Form->input('valeur',array('label'=>'Numéro','type'=>'tel', 'maxLength' => '13'));
        echo $this->Form->input('key',array('type'=>'hidden','default'=>null));
        echo $this->Form->input('actif_user_detail',array('type'=>'hidden','default'=>true));
        echo $this->Form->input('user_id',array('type'=>'hidden','default'=>$infos['id']));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Ajouter')); ?>
</div>
