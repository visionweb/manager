<div class="span10 form">
    <?php echo $this->Form->create('UserDetail'); ?>
    <fieldset>
        <legend><?php echo __('Editez ce numéro'); ?></legend>
        <?php
        echo $this->Form->input('id');
        //Define choices for the select
        $choice = array('NumeroFixe' => 'Numéro Fixe', 'NumeroMobile' => 'Numéro Mobile', 'NumeroFax' => 'Numéro Fax');
        echo $this->Form->input('type',array('options'=>$choice));
        echo $this->Form->input('valeur',array('label'=>'Numero','type'=>'tel', 'maxLength' => '13'));
        echo $this->Form->input('user_id',array('type'=>'hidden'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Editez')); ?>
</div>
