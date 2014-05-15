<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			print $this->Form->create('Project');
			print $this->Form->input('name', array('label'=>'Project name', 'default'=>$current['Project']['name']));
			print $this->Form->input('description', array('type'=>'textarea', 'default'=>$current['Project']['description'], 'label'=>'Description'));
			print $this->Form->end(__('Add'));
		?>
	</fieldset>
	
<?php print $this->element('end_view'); ?>
