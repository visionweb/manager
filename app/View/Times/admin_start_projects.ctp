<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			print $this->Form->create('Time');
			print $this->Form->input('user', array('label'=>'User', 'options'=>$users));
			print $this->Form->input('category', array('label'=>'Category', 'options'=>$categories));
			print $this->Form->input('project', array('label'=>'Project'));
			print $this->Form->input('time', array('label'=>'Workhours'));
			print $this->Form->end(__('Start'));
		?>
	</fieldset>
	
<?php print $this->element('end_view'); ?>
