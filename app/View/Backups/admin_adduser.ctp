<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			print $test;
			print $this->Form->create('Backupuser');
			print $this->Form->input('login', array('label'=>'Login'));
			print $this->Form->input('server', array('label'=>'Server', 'options'=>$servers));
			print $this->Form->input('domain', array('label'=>'Domain'));
		?>
	</fieldset>

<?php print $this->Form->end(__('Add'));?>
