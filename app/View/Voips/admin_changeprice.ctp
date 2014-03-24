<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			print $this->Form->create(false, array('type' => 'file'));
			print $this->Form->input('old_price', array('label'=>'Price', 'default'=>$price[$id]['Price']['pp']));
			print $this->Form->input('old_description', array('label'=>'Description', 'type'=>'textfield', 'default'=>$price[$id]['Price']['description'])).'<br>';
			print $this->Form->end(__('Set new price parameters'));
		?>
	</fieldset>

<?php print $this->element('end_view'); ?>
