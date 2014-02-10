<div class="span10 form">
	<br><br>
	<fieldset>
	<?php print $this->Form->create(false, array('type' => 'file'));?>
		<legend><?php echo __($title); ?></legend>
		<?php
			print $this->Form->input('old_price', array('label'=>'Price', 'default'=>$price[$id]['Price']['pp']));
			print $this->Form->input('old_description', array('label'=>'Description', 'type'=>'textfield', 'default'=>$price[$id]['Price']['description']));
		?>
	</fieldset>
	<br>
	<?php echo $this->Form->end(__('Set new price parameters'));?>
	<br>
</div>
