
<?php print $this->element('subheader_legend'); ?>

	<fieldset>
	    <?php	    
			print $this->Form->create(false, array('type' => 'file'));
			print $this->Form->input('mail_from', array('label'=>'From','default'=>$support[0]['Support']['mail_from']));
			print $this->Form->input('mail_to', array('label'=>'To','default'=>$support[0]['Support']['mail_to']));
			print $this->Form->input('host', array('label'=>'Host','default'=>$support[0]['Support']['host']));
			print $this->Form->input('portmail', array('label'=>'Port','default'=>$support[0]['Support']['port']));
			print $this->Form->input('pass', array('label'=>'Password','default'=>$support[0]['Support']['password']));
			print $this->Form->submit('Save', array('name' => 'save'));
		?>
	</fieldset>
    
    <?php print $this->element('end_view'); ?>
