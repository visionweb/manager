<?php print $this->element('subheader'); ?>

	
	<ul class="nav nav-tabs">
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'admin_index'))?>">
				Time
			</a>
		</li>
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'admin_projects'))?>">
				Projects
			</a>
		</li>
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'admin_categories'))?>">
				Categories
			</a>
		</li>
		<li class="active">
			<a href="<?php print $this->Html->url(array('action' => 'admin_configutation'))?>">
				Configuration
			</a>
		</li>
	</ul>
	
	<fieldset>
		<?php
			if(!empty($current)){
				print $this->Form->create('Time', array('type' => 'file'));
				print $this->Form->input('company', array('label'=>'Company', 'default'=>$current['company']));
				print $this->Form->input('mail', array('label'=>'Email', 'default'=>$current['mail']));
				print $this->Form->input('city', array('label'=>'City', 'default'=>$current['city']));
				print $this->Form->input('city_code', array('label'=>'City code', 'default'=>$current['city_code']));
				print $this->Form->input('phone', array('label'=>'Phone', 'default'=>$current['phone']));
				print $this->Form->input('adress', array('type'=>'textarea','label'=>'Adress', 'default'=>$current['adress']));
				print $this->Form->input('footer', array('type'=>'textarea','label'=>'Footer', 'default'=>$current['footer']));
				}
			else{
				print $this->Form->create('Time', array('type' => 'file'));
				print $this->Form->input('company', array('label'=>'Company'));
				print $this->Form->input('mail', array('label'=>'Email'));
				print $this->Form->input('city', array('label'=>'City'));
				print $this->Form->input('city_code', array('label'=>'City code'));
				print $this->Form->input('phone', array('label'=>'Phone'));
				print $this->Form->input('adress', array('type'=>'textarea','label'=>'Adress'));
				print $this->Form->input('footer', array('type'=>'textarea','label'=>'Footer'));
				}
			print $this->Form->input('file',array('label'=>'Logotype', 'type' => 'file'))."<br>";
			print $this->Form->end(__('Save'));
		?>
	</fieldset>
	
<?php print $this->element('end_view'); ?>
