<div class="span10 form">
	<br><br>
	<fieldset>
	<?php echo $this->Form->create('User'); ?>
		<legend><?php echo __($title); ?></legend>
		<?php
			print $this->Form->input('old_login', array('label'=>'Login', 'default'=>$voipdata[0]['Voip']['login']));
			print $this->Form->input('old_pass', array('label'=>'Password', 'default'=>$voipdata[0]['Voip']['pass']));
			print $this->Form->input('old_ip', array('label'=>'IP adress', 'default'=>$voipdata[0]['Voip']['ip'], 'maxLength'=>'15px'));
			print $this->Form->input('old_s_port', array('label'=>'Port', 'default'=>$voipdata[0]['Voip']['port'], 'maxLength'=>'15px'));
			print $this->Form->input('old_proxy', array('label'=>'Proxy port', 'maxLength'=>'15px', 'default'=>$voipdata[0]['Voip']['pr_adress']));
			print $this->Form->input('old_port', array('label'=>'Proxy port', 'default'=>$voipdata[0]['Voip']['pr_port']));
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Set new server parameters'));?>
	<br>
</div>
