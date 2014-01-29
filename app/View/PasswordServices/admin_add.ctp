<div class="span10 form">
    <?php echo $this->Form->create('PasswordService'); ?>
    <fieldset>
        <legend><?php echo __('Ajouter un service'); ?></legend>
        <?php
        echo $this->Form->input('label', array('label' => 'Nom du type'));
        echo $this->Form->input('active_password_service', array('type' => 'hidden', 'default' => true));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Ajouter')); ?>
</div>