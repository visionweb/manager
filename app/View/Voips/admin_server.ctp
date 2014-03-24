<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			print $this->Form->create('User');
			print $this->Form->input('old_login', array('label'=>'Login', 'default'=>$voipdata[0]['Voip']['login']));
			print $this->Form->input('old_pass', array('label'=>'Password', 'default'=>$voipdata[0]['Voip']['pass']));
			print $this->Form->input('old_ip', array('label'=>'IP adress', 'default'=>$voipdata[0]['Voip']['ip'], 'maxLength'=>'15px'));
			print $this->Form->input('old_s_port', array('label'=>'Port', 'default'=>$voipdata[0]['Voip']['port'], 'maxLength'=>'15px'));
			print $this->Form->input('old_proxy', array('label'=>'Proxy adress', 'maxLength'=>'15px', 'default'=>$voipdata[0]['Voip']['pr_adress']));
			print $this->Form->input('old_port', array('label'=>'Proxy port', 'default'=>$voipdata[0]['Voip']['pr_port']));
			print $this->Form->end(__('Set new server parameters'));
		?>
	</fieldset>

<?php print $this->Form->end(__('Set new server parameters'));?>
