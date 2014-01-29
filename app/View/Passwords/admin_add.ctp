<div class="span10 form">
    <?php echo $this->Form->create('Password'); ?>
    <fieldset>
        <legend><?php echo __('Ajouter un mot de passe'); ?></legend>
        <?php
        echo $this->Form->input('password_service_id', array(
            'label' => 'Service',
            'empty' => 'Choisissez',
            'required' => true
        ));
        echo $this->Form->input('password_type_id', array(
            'label' => 'Type',
            'empty' => 'Choisissez',
            'required' => true
        ));
        echo $this->Form->input('group_id', array(
            'label' => 'Groupe',
            'empty' => 'Choisissez',
            'required' => true
        ));
        echo $this->Form->input('login', array('label' => 'Identifiant', 'required' => true));
        echo $this->Form->input('password', array('label' => 'Mot de passe','type'=>'text','required' => true));
        echo $this->Form->input('active_password', array('type' => 'hidden', 'default' => true));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Ajouter')); ?>
</div>