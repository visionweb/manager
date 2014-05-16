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
	
	<a href="<?php print $this->Html->url(array('action' => 'admin_start_projects'))?>">
		Start new project
	</a>
	
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
					Time
				</th>
				<th>
					Activity
				</th>
			</tr>
			<?php foreach($times as $time):?>
			<tr>
				<td>
					<?php print $time['Time']['user']?>
				</td>
				<td>
					<?php print $time['Time']['project']?>
				</td>
				<td>
					<?php print $time['Time']['category']?>
				</td>
				<td>
					<?php print $time['Time']['time']?>
				</td>
				<td>
					<?php if($time['Time']['activ'])
						print '<span style=\'color:green\'>Yes</span>';
					else
						print '<span style=\'color:red\'>No</span>';?>
					
				</td>
				<td class="actions btn-group">
					<button class="btn">Action</button>
					<button class="btn dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<?php 
							print '<li><a href="'.$this->Html->url(array('action' => 'admin_view_project', $time['Time']['id'])).'">View</a></li>';
							if($time['Time']['activ'])
								print '<li><a href="'.$this->Html->url(array('action' => 'admin_suspend_project', $time['Time']['id'])).'">Suspend</a></li>';
							else
								print '<li><a href="'.$this->Html->url(array('action' => 'admin_suspend_project', $time['Time']['id'])).'">Resume</a></li>';
						;?>
					</ul>
				</td>
			</tr>
			<?php endforeach?>
		</table>
    
<?php print $this->element('end_view'); ?>
