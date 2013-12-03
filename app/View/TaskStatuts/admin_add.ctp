<div class="span10 form">
    <?php echo $this->Form->create('TaskStatut'); ?>
    <fieldset>
        <legend><?php echo __('Ajouter un statut'); ?></legend>
        <?php
        echo $this->Form->input('label', array('label' => 'Nom du statut'));
        echo $this->Form->input('active_task_statut', array('type' => 'hidden', 'default' => true));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Ajouter')); ?>
</div>