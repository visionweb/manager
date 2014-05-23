<?php print $this->element('subheader'); ?>

<table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
	<b>Project:</b> <?php print $project['Project']['name']?>;<br>
	<b>Client:</b> <?php print $project['Project']['client']?>;<br>
	<b>Time recurent:</b> <?php print $project['Project']['recurent']?>;<br>
	<b>Time remain:</b> <?php print $project['Project']['remain']?>;<br>
	<b>Status: </b> <?php if($project['Project']['status']) 
						print '<span style=\'color:green\'>Opened</span>.';
					else
						print '<span style=\'color:red\'>Closed</span>.';?>
	<br>
	<a href="<?php print $this->Html->url(array('action' => 'admin_projects'))?>">
		<button class="btn">Back</button>
	</a>
	<a href="<?php print $this->Html->url(array('action' => 'admin_add_session', $id))?>">
		<button class="btn">Add session</button>
	</a>
	<?php if($project['Project']['status']) 
						print '<a href="'.$this->Html->url(array('action' => 'admin_suspend_project', $id.'?p')).'">
		<button class="btn">Close project</button>
	</a>';
					else
						print '<a href="'.$this->Html->url(array('action' => 'admin_suspend_project', $id.'?p')).'">
		<button class="btn">Open project</button>
	</a>';?>
			<tr>
				<th>
					Date
				</th>
				<th>
					Description
				</th>
				<th>
					Category
				</th>
				<th>
					Start
				</th>
				<th>
					End
				</th>
				<th>
					Duration
				</th>
			</tr>
			<?php foreach($sessions as $session):?>
			<tr>
				<td>
					<?php print $session['Timesession']['date']?>
				</td>
				<td>
					<?php print $session['Timesession']['description']?>
				</td>
				<td>
					<?php print $session['Timesession']['category']?>
				</td>
				<td>
					<?php print $session['Timesession']['start']?>
				</td>
				<td>
					<?php print $session['Timesession']['end']?>
				</td>
				<td>
					<?php print $session['Timesession']['duration']?>
				</td>
			
				<td class="actions btn-group">
					<button class="btn">Action</button>
					<button class="btn dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<?php 
							print '<li><a href="'.$this->Html->url(array('action' => 'admin_edit_session', $session['Timesession']['id'].'?'.$id.'?p')).'">Edit</a></li>';
							print '<li><a href="'.$this->Html->url(array('action' => 'admin_delete_session', $session['Timesession']['id'].'?'.$id)).'">Delete</a></li>';
								?>
					</ul>
				</td>
				
			</tr>
			<?php endforeach?>
		</table>
	
<?php print $this->element('end_view'); ?>
