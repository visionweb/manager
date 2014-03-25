
<?php print $this->element('subheader'); ?>

    <fieldset>
        <?php
			echo $this->Form->create('InvoiceStatut');
			echo $this->Form->input('label',array('label'=>'Nom du statut'));
			echo $this->Form->input('id');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Modifier')); ?>

<?php print $this->element('end_view'); ?>
