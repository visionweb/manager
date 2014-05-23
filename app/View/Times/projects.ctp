<?php print $this->element('subheader'); ?>
	
	<ul class="nav nav-tabs">
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'index'))?>">
				Time
			</a>
		</li>
		<li class="active">
			<a href="<?php print $this->Html->url(array('action' => 'projects'))?>">
				Projects
			</a>
		</li>		
	</ul>
	
	
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
					<?php print $project['Project']['remain'];?>
				</td>
				<td>
					<?php
					if($project['Project']['status']==0) print '<span style="color:red">Closed</span>';
					else print '<span style="color:green">Opened</span>';
					?>
				</td>
				<td>
					<a href="<?php print $this->Html->url(array('action' => 'view_project', $project['Project']['id']))?>">
						<button class="btn">
							View
						</button>
					</a>
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
