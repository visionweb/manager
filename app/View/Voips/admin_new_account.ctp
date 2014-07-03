<?php print $this->element('subheader');?>
	<br><br>
	<fieldset>
	<?php 
		if($connect==1){
			echo $this->Form->create('User');
			$time = array('Europe/Paris' => 'Europe/Paris');
			$lang = array('fr_FR' => 'French');
			$music = array('default' => 'Default');
			$out_call_id=array('default' => 'Default','anonymous'=>'Anonymous', 'custom'=>'Custom');
			echo $this->Form->input('firstname', array('label'=>'First name'));
			echo $this->Form->input('lastname', array('label'=>'Last name'));
			echo $this->Form->input('timezone',array('options'=>$time,'default'=>'Europe/Paris'));
			echo $this->Form->input('language',array('options'=>$lang, 'default'=>'French'));
			echo $this->Form->input('owner',array('options'=>$userlist,'default'=>$this->Session->read('Auth.User.username')));
			echo $this->Form->input('short_phone_number',array('options'=>$short,'default'=>'Default'));
			echo $this->Form->input('external_phone_number', array('options'=>$ex_num));
			echo $this->Form->end(__('Ajouter'));
			}
		?>
	</fieldset>	 

<?php print $this->element('end_view'); ?>
