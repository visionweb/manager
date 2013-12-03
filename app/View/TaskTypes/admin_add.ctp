<div class="span10 form">
    <?php echo $this->Form->create('TaskType'); ?>
    <fieldset>
        <legend><?php echo __('Ajouter un type'); ?></legend>
        <?php
        echo $this->Form->input('label', array('label' => 'Nom du type'));
        echo $this->Form->input('active_task_type', array('type' => 'hidden', 'default' => true));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Ajouter')); ?>
</div>