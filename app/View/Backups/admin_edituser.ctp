<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			print $this->Form->create('Backupuser');
			print $this->Form->input('login', array('label'=>'Login', 'default'=>$default['login']));
			print $this->Form->input('server', array('label'=>'Server', 'options'=>$servers, 'default'=>$default['server']));
			print $this->Form->input('domain', array('label'=>'Domain', 'default'=>$default['domain']));
		?>
	</fieldset>

<?php print $this->Form->end(__('Save'));?>
