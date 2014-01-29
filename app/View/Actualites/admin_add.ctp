<?php echo $this->TinyMCE->editor(array('theme' => 'simple', 'mode' => 'textareas')); ?>
<div class="span10 form">
<?php echo $this->Form->create('Actualite'); ?>
	<fieldset>
		<legend><?php echo __('Ajouter une actualitée'); ?></legend>
	<?php
		echo $this->Form->input('titre_actu',array('label'=>'Titre de l\'actualité'));
        echo $this->Form->input('contenu_actu',array('label'=>'Contenu de l\'actualité'));
        echo $this->Form->input('actif_actu',array('type'=>'hidden','default'=>1));
    ?>
	</fieldset>
<?php echo $this->Form->end(__('Ajouter')); ?>
</div>