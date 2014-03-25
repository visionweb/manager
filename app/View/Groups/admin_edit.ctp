<br>
<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			echo $this->Form->create('Group');
			echo $this->Form->input('id');
			$choix = array('Association' => 'Association', 'Entreprise' => 'Entreprise', 'Particulier' => 'Particulier');
			echo $this->Form->input('type_group',array('options'=>$choix,'label'=>'Type Groupe'));
			echo $this->Form->input('nom_group',array('label'=>'Nom Groupe')).'<br>';
		?>
	</fieldset>

<?php print $this->element('end_view'); ?>

