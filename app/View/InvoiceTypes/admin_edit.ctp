<div class="span10 form">
    <?php echo $this->Form->create('InvoiceType'); ?>
    <fieldset>
        <legend><?php echo __('Editez ce type'); ?></legend>
        <?php
        echo $this->Form->input('label',array('label'=>'Nom du type'));
        echo $this->Form->input('id');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Editez')); ?>
</div>
