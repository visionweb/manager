<div class="span10 view">
    <h2><?php  echo __('Facture'); ?></h2>
    <a class="pull-right"><?php echo $this->Form->postButton(__('Telecharger'), array('action' => 'sendFile', $invoice['Invoice']['id']));?></a>
    <br/>
    <table class="display-table">
        <tr>
            <td style="text-align: right"><b><?php echo __('Nom de la facture :');?></b></td>
            <td style="text-align: left"><?php echo h($invoice['Invoice']['name']);?></td>
        </tr>
        <tr>
            <td style="text-align: right"><b><?php echo __('Description :');?></b></td>
            <td style="text-align: left"><?php echo h($invoice['Invoice']['description']);?></td>
        </tr>
        <tr>
            <td style="text-align: right"><b><?php echo __('Crée le :');?></b></td>
            <td style="text-align: left"><?php echo h($invoice['Invoice']['created']);?></td>
        </tr>
        <tr>
            <td style="text-align: right"><b><?php echo __('Client :');?></b></td>
            <td style="text-align: left"><?php echo h($invoice['Group']['nom_group']);?></td>
        </tr>
        <tr>
            <td style="text-align: right"><b><?php echo __('Période :');?></b></td>
            <td style="text-align: left">
                <?php echo 'Du ';?>
                <?php echo h($this->Time->format('d/m/Y',$invoice['Invoice']['period_begin'])); ?>
                <?php echo ' au ';?>
                <?php echo h($this->Time->format('d/m/Y',$invoice['Invoice']['period_end'])); ?>
            </td>
        </tr>
        <tr>
            <td style="text-align: right"><b><?php echo __('Type :');?></b></td>
            <td style="text-align: left"><?php echo h($invoice['InvoiceType']['label']);?></td>
        </tr>
        <tr>
            <td style="text-align: right"><b><?php echo __('Statut :');?></b></td>
            <td style="text-align: left"><?php echo h($invoice['InvoiceStatut']['label']);?></td>
        </tr>
    </table>
</div>