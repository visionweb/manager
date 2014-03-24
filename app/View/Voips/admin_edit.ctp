<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			$time = array('Europe/Paris' => 'Europe/Paris');
			$lang = array('fr_FR' => 'French');
			print $this->Form->create('User');
			print $this->Form->input('firstname', array('label'=>'First name', 'default'=>$userinfo['firstname']));
			print $this->Form->input('lastname', array('label'=>'Last name', 'default'=>$userinfo['lastname']));
			print $this->Form->input('timezone',array('options'=>$time,'default'=>'Europe/Paris', 'default'=>$userinfo['timezone']));
			print $this->Form->input('language',array('options'=>$lang, 'default'=>'French', 'default'=>$userinfo['language']));
			print $this->Form->input('owner',array('options'=>$userlist,'default'=>$owner));
			print $this->Form->end(__('Apply'));
		?>
	</fieldset>
	
<?php print $this->element('end_view'); ?>
