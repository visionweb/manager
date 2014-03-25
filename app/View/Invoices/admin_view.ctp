<?php print $this->element('subheader'); ?>

    <span class="btn-group">
        <button class="btn">Action</button>
        <button class="btn dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="<?php echo $this->Html->url(array('action' => 'sendFile', $invoice['Invoice']['id']));?>"><span class="icon-download"></span> <?php echo __('Télécharger');?></a></li>
            <li><a href="#"><?php echo $this->Form->postLink(__('Supprimer cette facture'), array('action' => 'delete', $invoice['Invoice']['id']), null, __('Etes-vous sûr de vouloir supprimer la facture < %s >?', $invoice['Invoice']['name']));?></a></li>
        </ul>
    </span><br/><br/><br/>

    <ul class="inline">
        <li><dt><?php echo __('Nom de la facture :'); ?></dt></li>
        <li><?php echo h($invoice['Invoice']['name']); ?></li>
    </ul>
    <ul class="inline">
        <li><dt><?php echo __('Nom du fichier :'); ?></dt></li>
        <li><?php echo h($invoice['Invoice']['name_file']); ?></li>
    </ul>
    <ul class="inline">
        <li><dt><?php echo __('Description :'); ?></dt></li>
        <li><?php echo h($invoice['Invoice']['description']); ?></li>
    </ul>
    <ul class="inline">
        <li><dt><?php echo __('Crée le :'); ?></dt></li>
        <li><?php echo h($invoice['Invoice']['created']); ?></li>
    </ul>
    <ul class="inline">
        <li><dt><?php echo __('Client :'); ?></dt></li>
        <li><?php echo h($invoice['Group']['nom_group']); ?></li>
    </ul>
    <ul class="inline">
        <li><dt><?php echo __('Période :'); ?></dt></li>
        <li>
            <?php echo'Du ';?> <?php echo h($this->Time->format('d/m/Y',$invoice['Invoice']['period_begin']));?>
            <?php echo' au ';?> <?php echo h($this->Time->format('d/m/Y',$invoice['Invoice']['period_end']));?>
        </li>
    </ul>
    <ul class="inline">
        <li><dt><?php echo __('Type :'); ?></dt></li>
        <li><?php echo h($invoice['InvoiceType']['label']); ?></li>
    </ul>
    <ul class="inline">
        <li><dt><?php echo __('Statut :'); ?></dt></li>
        <li><?php echo h($invoice['InvoiceStatut']['label']); ?></li>
    </ul>

<?php print $this->element('end_view'); ?>
