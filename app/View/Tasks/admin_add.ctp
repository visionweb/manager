
<?php print $this->element('subheader'); ?>

    <?php echo $this->Form->create('Task',array('class' => 'form-horizontal')); ?>
    <fieldset>
        <div class="control-group">
            <?php echo $this->Form->label('TaskProjectId','Projet',array('class' => 'control-label required')); ?>
            <div class="controls">
                <?php echo $this->Form->input('task_project_id', array(
                    'label' => false,
                    'class' => 'input-medium',
                    'required' => true,
                    'empty' => 'Choisissez'
                ));?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $this->Form->label('TaskSubject','Sujet',array('class' => 'control-label required')); ?>
            <div class="controls">
                <?php echo $this->Form->input('subject', array(
                    'label' => false,
                    'class' => 'input-medium',
                    'required' => true
                ));?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $this->Form->label('TaskTypeId','Type',array('class' => 'control-label required')); ?>
            <div class="controls">
                <?php echo $this->Form->input('task_type_id', array(
                    'label' => false,
                    'class' => 'input-medium',
                    'required' => true,
                    'empty' => 'Choisissez'
                ));?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $this->Form->label('TaskStatutId','Statut',array('class' => 'control-label required')); ?>
            <div class="controls">
                <?php echo $this->Form->input('task_statut_id', array(
                    'label' => false,
                    'class' => 'input-medium',
                    'required' => true,
                    'default' => 2
                ));?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $this->Form->label('TaskDescription','Description',array('class' => 'control-label required')); ?>
            <div class="controls">
                <?php echo $this->Form->input('description', array(
                    'label' => false,
                    'class' => 'input-xxlarge'
                ));?>
            </div>
        </div>
        <?php echo $this->Form->input('active_task', array('type' => 'hidden', 'default' => true)); ?>
        <? $options=array(
            'label' => 'Ajouter',
            'class' => 'btn controls',
            'div' => false
        );?>
    </fieldset>
    <?php echo $this->Form->end($options) ?>

<?php print $this->element('end_view'); ?>
