<div class="span10 form">
    <?php echo $this->Form->create('UserDetail'); ?>
    <fieldset>
        <legend><?php echo __('Editez cet email'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('valeur',array('label'=>'Email','type'=>'email'));
        echo $this->Form->input('user_id',array('type'=>'hidden'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Editez')); ?>
</div>
