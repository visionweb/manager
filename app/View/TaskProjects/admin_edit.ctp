<div class="span10 form">
    <?php echo $this->Form->create('TaskProject'); ?>
    <fieldset>
        <legend><?php echo __('Modifier ce projet'); ?></legend>
        <?php
        echo $this->Form->input('label',array('label'=>'Nom du projet'));
        echo $this->Form->input('id');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Modifier')); ?>
</div>