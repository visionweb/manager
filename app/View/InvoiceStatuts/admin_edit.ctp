<div class="span10 form">
    <?php echo $this->Form->create('InvoiceStatut'); ?>
    <fieldset>
        <legend><?php echo __('Modifier ce statut'); ?></legend>
        <?php
        echo $this->Form->input('label',array('label'=>'Nom du statut'));
        echo $this->Form->input('id');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Modifier')); ?>
</div>
