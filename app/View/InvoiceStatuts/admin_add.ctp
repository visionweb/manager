<div class="span10 form">
    <?php echo $this->Form->create('InvoiceStatut'); ?>
    <fieldset>
        <legend><?php echo __('Ajouter un statut'); ?></legend>
        <?php
        echo $this->Form->input('label', array('label' => 'Nom du statut'));
        echo $this->Form->input('active_invoice_statut', array('type' => 'hidden', 'default' => true));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Ajouter')); ?>
</div>