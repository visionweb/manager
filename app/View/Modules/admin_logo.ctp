<?php print $this->element('subheader'); ?>
	
	<fieldset>
		<?php
			print $this->Form->create(false, array( 'type' => 'file'));
			print $this->Form->input('file',array('label'=>'Select new logotype', 'type' => 'file'))."<br>";
			print $this->Form->end('Submit');
		?>
	</fieldset>
    
<?php print $this->element('end_view'); ?>
