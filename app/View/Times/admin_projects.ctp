<?php print $this->element('subheader'); ?>
	
	<ul class="nav nav-tabs">
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'admin_index'))?>">
				Time
			</a>
		</li>
		<li class="active">
			<a href="<?php print $this->Html->url(array('action' => 'admin_projects'))?>">
				Projects
			</a>
		</li>
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'admin_categories'))?>">
				Categories
			</a>
		</li>
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'admin_configutation'))?>">
				Configuration
			</a>
		</li>
	</ul>
	
	<?php
		print	
			'<div class="actions btn-group">
		<button class="btn">
			Client
		</button>
		<button class="btn dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">';
		foreach($clients as $client)
			print '<li><a href="'.$this->Html->url(array('action' => 'admin_projects', $client)).'">'.$client.'</a></li>';
		print
        '</ul>
      </div>';?>
      <br><br>
	
	<a href="<?php print $this->Html->url(array('action' => 'admin_add_projects'))?>">
		<button class="btn">
			New project
		</button>
	</a>
	<br>
	<br>
	<table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
			<tr>
				<th>
					<?php 
						print $this->Paginator->sort('name', 'Name');
					?>
				</th>
				<th>
					<?php 
						print $this->Paginator->sort('description', 'Description');
					?>
				</th>
				<th>
					<?php 
						print $this->Paginator->sort('recurent', 'Recurent time');
					?>
				</th>
				<th>
					<?php 
						print $this->Paginator->sort('remain', 'Remain time');
					?>
				</th>
				<th>
					<?php 
						print $this->Paginator->sort('status', 'Status');
					?>
				</th>
			</tr>
			<?php 
				foreach($projects as $project): 
			?>
			<tr>
				<td>
					<?php print $project['Project']['name'];?>
				</td>
				<td>
					<?php print $project['Project']['description'];?>
				</td>
				<td>
					<?php print $project['Project']['recurent'];?>
				</td>
				<td>
					<?php 
		if(substr($project['Project']['remain'], -2)<15)
			print substr($project['Project']['remain'], 0, strlen($project['Project']['remain'])-3).'h ('.$project['Project']['remain'].')';
		elseif(substr($project['Project']['remain'], -2)<30)
			print substr($project['Project']['remain'], 0, strlen($project['Project']['remain'])-3).'.25h ('.$project['Project']['remain'].')';
		elseif(substr($project['Project']['remain'], -2)<45)
			print substr($project['Project']['remain'], 0, strlen($project['Project']['remain'])-3).'.5h ('.$project['Project']['remain'].')';
		if(substr($project['Project']['remain'], -2)>45)
			print substr($project['Project']['remain'], 0, strlen($project['Project']['remain'])-3).'.75h ('.$project['Project']['remain'].')';
	?>
				</td>
				<td>
					<?php
					if($project['Project']['status']==0) print '<span style="color:red">Closed</span>';
					else print '<span style="color:green">Opened</span>';
					?>
				</td>
				<td class="actions btn-group">
					<button class="btn">Action</button>
					<button class="btn dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<?php 
							print '<li><a href="'.$this->Html->url(array('action' => 'admin_view_project', $project['Project']['id'])).'">View</a></li>';
							print '<li><a href="'.$this->Html->url(array('action' => 'admin_edit_project', $project['Project']['id'])).'">Edit</a></li>';
							if($project['Project']['status']==1)
								print '<li><a href="'.$this->Html->url(array('action' => 'admin_suspend_project', $project['Project']['id'])).'">Close</a></li>';
							else
								print '<li><a href="'.$this->Html->url(array('action' => 'admin_suspend_project', $project['Project']['id'])).'">Open</a></li>';
								?>
					</ul>
				</td>
			</tr>
			<?php 
				endforeach;
			?>
		</table>
		
		<?php print $this->Paginator->counter()?><br>
		<div class="pagination">
			<ul>
				<li>
					<?php 
						print $this->Paginator->first('<< First', null, null, array('class' => 'disabled'))
					?>
				</li>
				<li>
					<?php 
						print $this->Paginator->prev('< Previous', null, null, array('class' => 'disabled'))
					?>
				</li>
				<li>
					<?php 
						print $this->Paginator->next('Next >', null, null, array('class' => 'disabled'))
					?>
				</li>
				<li>
					<?php 
						print $this->Paginator->last('Last >>', null, null, array('class' => 'disabled'))
					?>
				</li>
			</ul>
		</div>
    
<?php print $this->element('end_view'); ?>
