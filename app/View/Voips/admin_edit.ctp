<div class="span10 form">
	<br><br>
	<fieldset>
	<?php echo $this->Form->create('User'); ?>
		<legend><?php echo __($title); ?></legend>
		<?php
			$time = array('Europe/Paris' => 'Europe/Paris');
			$lang = array('fr_FR' => 'French');
			$music = array('default' => 'Default');
			$out_call_id=array('default' => 'Default','anonymous'=>'Anonymous', 'custom'=>'Custom');
			echo $this->Form->input('firstname', array('label'=>'First name', 'default'=>$userinfo['firstname']));
			echo $this->Form->input('lastname', array('label'=>'Last name', 'default'=>$userinfo['lastname']));
			echo $this->Form->input('timezone',array('options'=>$time, 'default'=>$userinfo['timezone']));
			echo $this->Form->input('language',array('options'=>$lang, 'default'=>$userinfo['language']));
			echo $this->Form->input('callerID', array('label'=>'Caller ID', 'default'=>$userinfo['callerid']));
			echo $this->Form->input('music_on_hold',array('options'=>$music,'default'=>'Default'));
			echo $this->Form->input('outgoing_caller_id',array('options'=>$out_call_id,'default'=>'Default'));
			echo $this->Form->input('mobile_phone_number', array('label'=>'Mobile phone number', 'default'=>$userinfo['mobilephonenumber']));
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Apply'));?>
	<br>
	<br>
	<br>
	<br>
