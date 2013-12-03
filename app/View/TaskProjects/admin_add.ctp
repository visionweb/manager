<div class="span10 form">
    <?php echo $this->Form->create('TaskProject'); ?>
    <fieldset>
        <legend><?php echo __('Ajouter un projet'); ?></legend>
        <?php
        echo $this->Form->input('label', array('label' => 'Nom du projet'));
        echo $this->Form->input('active_task_project', array('type' => 'hidden', 'default' => true));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Ajouter')); ?>
</div>