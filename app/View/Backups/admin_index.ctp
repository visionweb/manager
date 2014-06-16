<?php print $this->element('subheader'); ?>
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="<?php print $this->Html->url(array('action' => 'admin_index'))?>">
				List
			</a>
		</li>
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'admin_users'))?>">
				Users
			</a>
		</li>		
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'admin_config'))?>">
				Configuration
			</a>
		</li>	
	</ul>
	
	
<?php print $this->element('end_view'); ?>
