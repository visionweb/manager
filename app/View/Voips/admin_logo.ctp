<div class="span10 form">
	<br><br><?php print $this->Form->create(false, array('type' => 'file')); ?>
	<h2><?php echo __($title); ?></h2>
	<br><br>

	<ul class="nav nav-tabs">
		<li><a href="<?php print $this->Html->url(array('action' => 'configuration'))?>">Price</a></li>
		<li><a href="<?php print $this->Html->url(array('action' => 'newNumbers'))?>">New numbers</a></li>
		<li><a href="<?php print $this->Html->url(array('action' => 'listNumbers'))?>">Numbers list</a></li>
		<li><a href="<?php print $this->Html->url(array('action' => 'serverSetting'))?>">Server settings</a></li>
		<li  class="active"><a href="<?php print $this->Html->url(array('action' => 'logo'))?>">Logotype</a></li>
	</ul>
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
