<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			print $this->Form->create('Time');
			print $this->Form->input('category', array('label'=>'Category', 'options'=>$categories));
			print $this->Form->input('date', array('type'=>'date','label'=>'Date'));
			print $this->Form->input('start', array('label'=>'Start'));
			print $this->Form->input('end', array('label'=>'End'));
			print $this->Form->input('description', array('type'=>'textarea','label'=>'Description'));
			print $this->Form->end(__('Add'));
		?>
	</fieldset>
	
<?php print $this->element('end_view'); ?>
