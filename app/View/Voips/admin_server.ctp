<div class="span10 form">
	<br><br>
	<fieldset>
	<?php echo $this->Form->create('User'); ?>
		<legend><?php echo __($title); ?></legend>
		<?php
			print $this->Form->input('old_login', array('label'=>'Login', 'default'=>$voipdata[0]['Voip']['login']));
			print $this->Form->input('old_pass', array('label'=>'Password', 'default'=>$voipdata[0]['Voip']['pass']));
			print $this->Form->input('old_ip', array('label'=>'IP adress', 'default'=>$voipdata[0]['Voip']['ip'], 'maxLength'=>'15px'));
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Set new server parameters'));?>
	<br>
</div>
