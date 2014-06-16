<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			print $this->Form->create('Backupconfig');
			print $this->Form->input('name', array('label'=>'Name'));
			print $this->Form->input('ip', array('label'=>'IP'));
		?>
	</fieldset>

<?php print $this->Form->end(__('Add'));?>
