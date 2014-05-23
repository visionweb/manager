<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			print $this->Form->create('Category');
			print $this->Form->input('name', array('label'=>'Category name', 'default'=>$current['Category']['name']));
			print $this->Form->input('description', array('type'=>'textarea', 'default'=>$current['Category']['description'], 'label'=>'Description'));
			print $this->Form->end(__('Save'));
		?>
	</fieldset>
	
<?php print $this->element('end_view'); ?>
