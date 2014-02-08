<div class="span10 form">
	<br><br>
	<fieldset>
	<?php echo $this->Form->create('User'); ?>
		<legend><?php echo __($title); ?></legend>
		<?php
			$time = array('Europe/Paris' => 'Europe/Paris');
			$lang = array('fr_FR' => 'French');
			print $this->Form->input('firstname', array('label'=>'First name', 'default'=>$userinfo['firstname']));
			print $this->Form->input('lastname', array('label'=>'Last name', 'default'=>$userinfo['lastname']));
			print $this->Form->input('timezone',array('options'=>$time,'default'=>'Europe/Paris', 'default'=>$userinfo['timezone']));
			print $this->Form->input('language',array('options'=>$lang, 'default'=>'French', 'default'=>$userinfo['language']));
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Apply'));?>
	<br>
	<br>
	<br>
	<br>
