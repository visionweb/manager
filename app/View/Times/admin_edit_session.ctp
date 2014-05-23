<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			print $this->Form->create('Time');
			print $this->Form->input('category', array('label'=>'Category', 'options'=>$categories, 'default'=>$session['Timesession']['category']));
			print $this->Form->input('date', array('type'=>'date','label'=>'Date', 'default'=>$session['Timesession']['date']));
			print $this->Form->input('start', array('id'=>'start','div'=>false,'label'=>'Start', 'default'=>$session['Timesession']['start']));
			print '<div id="n1" class="btn" style=" margin-top:-10px; margin-left:10px;">
           Now
			</div>';
			print $this->Form->input('end', array('id'=>'end','label'=>'End', 'div'=>false, 'default'=>$session['Timesession']['end']));
			print '<div id="n2" class="btn" style=" margin-top:-10px; margin-left:10px;">
           Now
			</div>';
			print $this->Form->input('description', array('type'=>'textarea','label'=>'Description', 'default'=>$session['Timesession']['description']));
			print $this->Form->end(__('Save'));
		?>
	</fieldset>
	
<?php print $this->element('end_view'); ?>
