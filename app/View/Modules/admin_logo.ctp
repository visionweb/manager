<div class="span10 form">
	<br><br><?php print $this->Form->create(false, array('type' => 'file')); ?>
	<h2><?php echo __($title); ?></h2>
	<br><br>
	<legend><?php echo __('Logotype'); ?></legend>
	<?php
	echo $this->Form->create(false, array( 'type' => 'file'));
	echo $this->Form->input('file',array('label'=>'Select new logotype', 'type' => 'file'))."<br><br>";
	echo $this->Form->end('Submit');
	?>
    <br>
    <br>
    <br>
    <br>
	
	</div>
