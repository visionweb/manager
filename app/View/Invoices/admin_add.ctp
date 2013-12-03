<?php echo $this->Html->css('jquery-ui-1.10.3.custom.min');?>
<div class="span10 form">
    <?php echo $this->Form->create('Invoice',array('class' => 'form-horizontal', 'type' => 'file')); ?>
    <fieldset>
        <legend><?php echo __('Ajouter une facture'); ?></legend>
        <div class="control-group">
            <?php echo $this->Form->label('InvoiceLink','Inporter un fichier',array('class' => 'control-label required')); ?>
            <div class="controls">
                <?php echo $this->Form->input('link', array(
                    'type' => 'file',
                    'label' => false,
                    'required' => true
                ));?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $this->Form->label('InvoiceGroupId','Groupe',array('class' => 'control-label required')); ?>
            <div class="controls">
                <?php echo $this->Form->input('group_id', array(
                    'label' => false,
                    'class' => 'input-medium',
                    'required' => true,
                    'empty' => 'Choisissez'
                ));?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $this->Form->label('InvoiceTypeId','Type',array('class' => 'control-label required')); ?>
            <div class="controls">
                <?php echo $this->Form->input('invoice_type_id', array(
                    'label' => false,
                    'class' => 'input-medium',
                    'required' => true,
                    'empty' => 'Choisissez'
                ));?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $this->Form->label('InvoiceStatutId','Statut',array('class' => 'control-label required')); ?>
            <div class="controls">
                <?php echo $this->Form->input('invoice_statut_id', array(
                    'label' => false,
                    'class' => 'input-medium',
                    'required' => true,
                    'default' => '2'
                ));?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $this->Form->label('InvoicePeriod','Période',array('class' => 'control-label required')); ?>
            <div class="controls form-inline">
                <?php echo $this->Form->label('InvoicePeriodBegin','Du',array('div'=>false));?>&nbsp;
                <?php echo $this->Form->input('period_begin', array(
                    'label' => false,
                    'div'=>false,
                    'id'=>'from',
                    'readonly'=>true,
                    'required'=>true,
                    'type'=>'text',
                    'class'=>'input-small'
                ));?>
                &nbsp;
                <?php echo $this->Form->label('InvoicePeriodEnd','au',array('div'=>false));?>&nbsp;
                <?php echo $this->Form->input('period_end', array(
                    'label' => false,
                    'div'=>false,
                    'id'=>'to',
                    'readonly'=>true,
                    'required'=>true,
                    'type'=>'text',
                    'class'=>'input-small'
                ));?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $this->Form->label('InvoiceDescription','Description',array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $this->Form->input('description', array(
                    'label' => false
                ));?>
            </div>
        </div>
        <?php echo $this->Form->input('active_invoice', array('type' => 'hidden', 'default' => true)); ?>
        <? $options=array(
            'label' => 'Ajouter',
            'class' => 'btn controls',
            'div' => false
        );?>
    </fieldset>
    <?php echo $this->Form->end($options) ?>
</div>

<?php echo $this->Html->script(array('jquery-ui.custom.min','jquery.ui.datepicker-fr.min','date'));?>