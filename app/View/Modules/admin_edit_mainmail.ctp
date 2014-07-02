<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			print $this->Form->create('Module');
			print $this->Form->input('adress', array('label'=>'Email adress','default'=>$mail['Support']['mail_from']));
			print $this->Form->input('host', array('label'=>'Host','default'=>$mail['Support']['host']));
			print $this->Form->input('password', array('label'=>'Password','default'=>$mail['Support']['password']));
			print $this->Form->input('port', array('label'=>'Port','default'=>$mail['Support']['port']));
		?>
	</fieldset>

<?php print $this->Form->end(__('Save new adress'));?>
