<div class="span10 form">
    <?php echo $this->Form->create('Password'); ?>
    <fieldset>
        <legend><?php echo __('Modifier ce mot de passe'); ?></legend>
        <?php
        echo $this->Form->input('login',array('label'=>'Pseudo'));
        echo $this->Form->input('password',array('label'=>'Mot de passe','type'=>'text'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Modifier')); ?>
</div>
