
<?php print $this->element('subheader'); ?>

    <fieldset>
        <?php
			echo $this->Form->create('User'); 
			echo $this->Form->input('id');
			echo $this->Form->input('group_id',array('label'=>'Groupe'));
			$list=array('Madame'=>'Madame','Mademoiselle'=>'Mademoiselle','Monsieur'=>'Monsieur');
			echo $this->Form->input('civilite',array('label'=>'Civilité','options'=>$list));
			echo $this->Form->input('nom_user',array('label'=>'Nom'));
			echo $this->Form->input('prenom',array('label'=>'Prénom'));
			echo $this->Form->input('username',array('label'=>'Nom d\'utilisateur'));
			echo $this->Form->input('password',array('label'=>'Nouveau mot de passe ?','default'=>'')).'<br>';
			echo $this->Form->end(__('Editez'));
        ?>
    </fieldset>

<?php print $this->element('end_view'); ?>
