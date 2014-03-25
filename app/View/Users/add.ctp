
<?php print $this->element('subheader'); ?>

    <fieldset>
        <?php
			echo $this->Form->create('User');
			echo $this->Form->input('group_id',array('type'=>'hidden'));
			$list=array('Madame'=>'Madame','Mademoiselle'=>'Mademoiselle','Monsieur'=>'Monsieur');
			echo $this->Form->input('civilite',array('label'=>'Civilité','options'=>$list,'default'=>'Monsieur'));
			echo $this->Form->input('nom_user',array('label'=>'Nom'));
			echo $this->Form->input('prenom',array('label'=>'Prénom'));
			echo $this->Form->input('username',array('label'=>'Nom d\'utilisateur'));
			echo $this->Form->input('password',array('label'=>'Mot de Passe'));
			echo $this->Form->input('actif_user',array('type'=>'hidden','default'=>true)).'<br>';
			echo $this->Form->end(__('Ajouter'));
        ?>
    </fieldset>

<?php print $this->element('end_view'); ?>
