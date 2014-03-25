
<?php print $this->element('subheader'); ?>

    <fieldset>
        <?php
			echo $this->Form->create('InvoiceStatut');
			echo $this->Form->input('label', array('label' => 'Nom du statut'));
			echo $this->Form->input('active_invoice_statut', array('type' => 'hidden', 'default' => true));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Ajouter')); ?>

<?php print $this->element('end_view'); ?>
