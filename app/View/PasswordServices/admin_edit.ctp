<div class="span10 form">
    <?php echo $this->Form->create('PasswordService'); ?>
    <fieldset>
        <legend><?php echo __('Editez ce service'); ?></legend>
        <?php
        echo $this->Form->input('label',array('label'=>'Nom du type'));
        echo $this->Form->input('id');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Editez')); ?>
</div>
