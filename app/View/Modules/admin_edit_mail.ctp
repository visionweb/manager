<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			print $this->Form->create('Module');
			print $this->Form->input('adress', array('label'=>'Email adress', 'default'=>$mail['MailDest']['adress']));
		?>
	</fieldset>

<?php print $this->Form->end(__('Save new adress'));?>
