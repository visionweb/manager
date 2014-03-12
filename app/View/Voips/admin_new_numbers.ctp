<div class="span10 form">
	<br><br>
	<h2><?php echo __($title); ?></h2>
	<br><br>

	<ul class="nav nav-tabs">
		<li><a href="<?php print $this->Html->url(array('action' => 'configuration'))?>">Price</a></li>
		<li  class="active"><a href="<?php print $this->Html->url(array('action' => 'newNumbers'))?>">New numbers</a></li>
		<li><a href="<?php print $this->Html->url(array('action' => 'listNumbers'))?>">Numbers list</a></li>
		<li><a href="<?php print $this->Html->url(array('action' => 'serverSetting'))?>">Server settings</a></li>
		<li><a href="<?php print $this->Html->url(array('action' => 'logo'))?>">Logotype</a></li>
	</ul>
	
	<fieldset>
		<?php print $this->Form->create(false, array('type' => 'file')); ?>
		<legend><?php echo __('Set new numbers'); ?></legend>
		<?php
			$pref = array('33' => '33', '44'=>'44');
			print $this->Form->input('prefix', array('label'=>'Prefix', 'options'=>$pref, 'default'=>'33'));
			print $this->Form->input('start_interval', array('label'=>'Start interval', 'default'=>$str['Number']['phone_number']+1, 'maxLength'=>'10px'));
			print $this->Form->input('end_interval', array('label'=>'End interval', 'default'=>$str['Number']['phone_number']+2, 'maxLength'=>'10px'));
			print $this->Form->end('Add new numbers', array('name' => 'submit'));
		?>
	</fieldset>
    <br>
    <br>
    <br>
    <br>
	
	</div>
