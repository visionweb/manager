<div class="span10 index"><br/>
    <h2><?php echo __('Factures'); ?></h2><br/>
    <? if(empty($invoices) && !$search): echo 'Aucune facture enregistrée' ?>
    <?else :?>
        <?php echo $this->Form->create('Search',array('class' => 'form-search')); ?>
        <?php echo $this->Form->label('SearchGroupId','Groupe'); ?>
        <?php echo $this->Form->input('group_id',array(
            'label' => false,
            'class' => 'input-medium',
            'empty' => 'All',
            'div' => false
        )); ?>&nbsp;&nbsp;
        <?php echo $this->Form->label('SearchInvoiceStatutId','Statut'); ?>
        <?php echo $this->Form->input('invoice_statut_id',array(
            'label' => false,
            'class' => 'input-medium',
            'empty' => 'All',
            'div' => false
        )); ?>
        <? $options=array(
            'label' => 'Search',
            'class' => 'btn',
            'div' => false
        );?>
        <?php echo $this->Form->end($options) ?>
        <div id="listInv">
            <? if(empty($invoices)): echo 'Aucun résultat retourné' ?>
            <?else :?>
                <table class="table-hover table-condensed" cellpadding="0" cellspacing="0" id="invTable">
                    <tr>
                        <th><?php echo $this->Paginator->sort('name','Nom facture'); ?></th>
                        <th><?php echo $this->Paginator->sort('created','Créé le'); ?></th>
                        <th><?php echo $this->Paginator->sort('invoice_statut_id','Statut'); ?></th>
                        <th><?php echo $this->Paginator->sort('period_begin','Début'); ?></th>
                        <th><?php echo $this->Paginator->sort('period_end','Fin'); ?></th>
                    </tr>
                    <?php foreach ($invoices as $invoice): ?>
                        <tr>
                            <td><?php echo $this->Html->link(h($invoice['Invoice']['name']), array('action' => 'view', $invoice['Invoice']['id'])); ?>&nbsp;</td>
                            <td><?php echo h($this->Time->format('d/m/Y - H:i',$invoice['Invoice']['created'])); ?>&nbsp;</td>
                            <td><?php echo h($invoiceStatuts[$invoice['Invoice']['invoice_statut_id']]); ?>&nbsp;</td>
                            <td><?php echo h($this->Time->format('d/m/Y',$invoice['Invoice']['period_begin'])); ?>&nbsp;</td>
                            <td><?php echo h($this->Time->format('d/m/Y',$invoice['Invoice']['period_end'])); ?>&nbsp;</td>
                            <td class="actions btn-group">
                                <?php echo $this->Form->button('Statut',array('class' => 'btnStatut btn',
                                    'rel' => $this->Html->url(array('controller'=>'invoices','action'=>'formStatut',$invoice['Invoice']['id'])))); ?>
                                <button class="btn">Action</button>
                                <button class="btn dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $this->Html->url(array('action' => 'view', $invoice['Invoice']['id']));?>"><span class="icon-eye-open"></span> <?php echo __('Voir');?></a></li>
                                    <li><a href="<?php echo $this->Html->url(array('action' => 'sendFile', $invoice['Invoice']['id']));?>"><span class="icon-download"></span> <?php echo __('Télécharger');?></a></li>
                                    <li><a href="#"><?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $invoice['Invoice']['id']), null, __('Etes-vous sûr de vouloir supprimer la facture < %s >?', $invoice['Invoice']['name']));?></a></li>
                                </ul>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <p>
                    <?php
                    echo $this->Paginator->counter(array(
                        'format' => __('Page {:page} / {:pages}')
                    ));
                    ?>
                </p>
                <div class="paging">
                    <?php
                    echo $this->Paginator->prev('< ' . __('Précédent'), array(), null, array('class' => 'prev disabled'));
                    echo $this->Paginator->numbers(array('separator' => ''));
                    echo $this->Paginator->next(__('Suivant') . ' >', array(), null, array('class' => 'next disabled'));
                    ?>
                </div>
            <?endif?>
        </div>
    <?php endif;?>
</div>
<?php echo $this->Html->script(array('tools','invoice')); ?>