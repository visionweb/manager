<?php echo $this->Form->create(null,array('controller' => 'invoices','action' => 'switchStatut')); ?>
<?php
echo $this->Form->input('id', array('type' => 'hidden', 'value' => $invoice['Invoice']['id']));
echo $this->Form->input('invoice_statut_id', array(
    'label' => 'Statut',
    'selected' => $invoice['Invoice']['invoice_statut_id'],
    'class' => 'input-medium'
));
?>
<?php echo $this->Form->end(__('Changer')); ?>