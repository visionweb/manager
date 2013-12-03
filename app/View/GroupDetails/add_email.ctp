<div class="span10 form">
    <?php echo $this->Form->create('GroupDetail'); ?>
    <fieldset>
        <legend><?php echo __('Ajouter une Email'); ?></legend>
        <?php
        //Email
        echo $this->Form->input('type',array('type'=>'hidden','default'=>'Email'));
        echo $this->Form->input('valeur',array('label'=>'Email','type'=>'email'));
        echo $this->Form->input('key',array('type'=>'hidden','default'=>null));
        echo $this->Form->input('actif_group_detail',array('type'=>'hidden','default'=>true));
        echo $this->Form->input('group_id',array('type'=>'hidden','default'=>$infos['id']));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Ajouter')); ?>
</div>
