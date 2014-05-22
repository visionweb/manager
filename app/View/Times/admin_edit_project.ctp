<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			print $this->Form->create('Project');
			print $this->Form->input('client', array('label'=>'Client', 'options'=>$clients, 'default'=>$project['Project']['client']));
			print $this->Form->input('name', array('label'=>'Project name', 'default'=>$project['Project']['name']));
			print $this->Form->input('recurent', array('label'=>'Recurent time', 'default'=>$project['Project']['recurent']));
			print $this->Form->input('time', array('label'=>'Project time', 'default'=>$project['Project']['remain']));
			print $this->Form->input('description', array('type'=>'textarea', 'label'=>'Description', 'default'=>$project['Project']['description']));
			print $this->Form->end(__('Save'));
		?>
	</fieldset>
	
<?php print $this->element('end_view'); ?>
