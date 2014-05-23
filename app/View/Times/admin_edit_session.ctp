<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			print $this->Form->create('Time');
			print $this->Form->input('category', array('label'=>'Category', 'options'=>$categories, 'default'=>$session['Timesession']['category']));
			print $this->Form->input('date', array('type'=>'date','label'=>'Date', 'default'=>$session['Timesession']['date']));
			print $this->Form->input('start', array('label'=>'Start', 'default'=>$session['Timesession']['start']));
			print $this->Form->input('end', array('label'=>'End', 'default'=>$session['Timesession']['end']));
			print $this->Form->input('description', array('type'=>'textarea','label'=>'Description', 'default'=>$session['Timesession']['description']));
			print $this->Form->end(__('Add'));
		?>
	</fieldset>
	
<?php print $this->element('end_view'); ?>
