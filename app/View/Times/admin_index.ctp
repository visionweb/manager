<?php print $this->element('subheader'); ?>
	
	<ul class="nav nav-tabs">
		<li class="active">
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
	</ul>
	
	<table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
			<tr>
				<th>
					User
				</th>
				<th>
					Project
				</th>
				<th>
					Category
				</th>
				<th>
					Start time
				</th>
				<th>
					End time
				</th>
				<th>
					Time left
				</th>
			</tr>
		</table>
    
<?php print $this->element('end_view'); ?>
