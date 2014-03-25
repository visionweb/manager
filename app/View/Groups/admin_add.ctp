<br>
<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			echo $this->Form->create('Group');
			$choix = array('Association' => 'Association', 'Entreprise' => 'Entreprise', 'Particulier' => 'Particulier');
			echo $this->Form->input('type_group',array('options'=>$choix,'default'=>'Entreprise','label'=>'Type du Groupe'));
			echo $this->Form->input('nom_group',array('label'=>'Nom du Groupe'));
			echo $this->Form->input('actif_group',array('type'=>'hidden','default'=>true)).'<br>';
			echo $this->Form->end(__('Ajouter'));
		?>
	</fieldset>
	
<?php print $this->element('end_view'); ?>
