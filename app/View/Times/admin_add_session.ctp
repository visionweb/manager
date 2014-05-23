
<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			print $this->Form->create('Time');
			print $this->Form->input('category', array('label'=>'Category', 'options'=>$categories));
			print $this->Form->input('date', array('type'=>'date','label'=>'Date'));
			print $this->Form->input('start', array('id'=>'start','label'=>'Start', 'div'=>false));
			print '<div id="n1" class="btn" style=" margin-top:-10px; margin-left:10px;">
           Now
			</div>';
			print $this->Form->input('end', array('id'=>'end','label'=>'End', 'div'=>false));
			print '<button id="n2" class="btn" data-toggle="dropdown" style="margin-top:-10px; margin-left:10px;">
           Now
			</button>';
			print $this->Form->input('description', array('type'=>'textarea','label'=>'Description'));
			print $this->Form->end(__('Add'));
		?>
	</fieldset>
	
<?php print $this->element('end_view'); ?>
