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
			echo $this->Form->input('firstname', array('label'=>'First name'));
			echo $this->Form->input('lastname', array('label'=>'Last name'));
			echo $this->Form->input('timezone',array('options'=>$time,'default'=>'Europe/Paris'));
			echo $this->Form->input('language',array('options'=>$lang, 'default'=>'French'));
			echo $this->Form->input('callerID', array('label'=>'Caller ID'));
			echo $this->Form->input('owner',array('options'=>$userlist,'default'=>$this->Session->read('Auth.User.username')));
			echo $this->Form->input('music_on_hold',array('options'=>$music,'default'=>'Default'));
			echo $this->Form->input('short_phone_number',array('options'=>$short,'default'=>'Default'));
			echo $this->Form->input('outgoing_caller_id',array('options'=>$out_call_id,'default'=>'Default'));
			echo $this->Form->input('mobile_phone_number', array('label'=>'Mobile phone number'));
			echo $this->Form->input('external_phone_number', array('options'=>$ex_num, 'default'=>'+11 111111111'));
		?>
	</fieldset>
	 
	 
<?php echo $this->Form->end(__('Ajouter'));?>
</div>
