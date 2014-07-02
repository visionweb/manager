<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			print $this->Form->create('Backupconfig');
			print $this->Form->input('name', array('label'=>'Name','default'=>$config['name']));
			print $this->Form->input('ip', array('label'=>'IP','default'=>$config['ip']));
		?>
	</fieldset>

<?php print $this->Form->end(__('Save'));?>
