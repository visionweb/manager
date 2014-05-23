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
		
		<div class="actions btn-group">
		<button class="btn">
			Client
		</button>
		<button class="btn dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
			<?php 
				foreach($users as $user)
				print '<li><a href="'.$this->Html->url(array('action' => 'admin_index', $user['User']['username'].'?all')).'">'.$user['User']['username'].'</a></li>';
			?>
        </ul>
      </div>
		
		<?php if($display['client']!='0'){
		print	
			'<div class="actions btn-group">
		<button class="btn">
			Project
		</button>
		<button class="btn dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">';
		foreach($prname as $pr)
			print '<li><a href="'.$this->Html->url(array('action' => 'admin_index', $display['client'].'?'.$pr)).'">'.$pr.'</a></li>';
		print
        '</ul>
      </div>';}?>
      <?php if($display['project']!='all')
		print	
		'<a href="'.$this->Html->url(array('action' => 'admin_add_session', $current.'?'.$id)).'">
		<button class="btn">
			Add
		</button>
		</a>';
		if(isset($time_remain))
			print '<p align="right">Time remain: '.$time_remain.'</p>';
		else print '<br><br>'
		?>
	
	<table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
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
					<a href="<?php print $this->Html->url(array('action' => 'admin_edit_session', $session['Timesession']['id'].'?'.$id))?>">
						<button class="btn">
							Edit
						</button>
					</a>
				</td>
			</tr>
			<?php endforeach?>
		</table>
    
<?php print $this->element('end_view'); ?>
