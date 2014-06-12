<?php print $this->element('subheader'); ?>

	<fieldset>
		<?php
			print $this->Form->create('Time');
			print $this->Form->input('company', array('label'=>'Company'));
			print $this->Form->input('mail', array('type'=>'date', 'style'=>'width:100px;', 'label'=>'Email'));
			print $this->Form->input('city', array('id'=>'start','style'=>'width:100px;','label'=>'City'));
			print $this->Form->input('city_code', array('id'=>'end','style'=>'width:100px;','label'=>'City code', 'default'=>$session['Timesession']['end']));
			print $this->Form->input('phone', array('type'=>'textarea','style'=>'width:600px;','label'=>'Phone'));
			print $this->Form->input('mail', array('type'=>'textarea','style'=>'width:600px;','label'=>'Adress'));
			print $this->Form->input('file',array('label'=>'Logotype', 'type' => 'file'))."<br>";
			print $this->Form->end(__('Save'));
		?>
	</fieldset>
	
<?php print $this->element('end_view'); ?>
