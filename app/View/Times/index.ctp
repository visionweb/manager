<?php print $this->element('subheader'); ?>
	
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="<?php print $this->Html->url(array('action' => 'index'))?>">
				Time
			</a>
		</li>
		<li>
			<a href="<?php print $this->Html->url(array('action' => 'projects'))?>">
				Projects
			</a>
		</li>
	</ul>
	
		<div class="actions btn-group">
		<button class="btn">
			Project
		</button>
		<button class="btn dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
		<?php foreach($prname as $pr)
			print '<li><a href="'.$this->Html->url(array('action' => 'index', $pr)).'">'.$pr.'</a></li>';
		?>
        </ul>
      </div>
      <?php if(isset($time_remain)){
				print '<p align="right">Time reamain: ';
				if(substr($time_remain, -2)<15)
					print substr($time_remain, 0, strlen($time_remain)-3).'h ('.$time_remain.')';
				elseif(substr($time_remain, -2)<30)
					print substr($time_remain, 0, strlen($time_remain)-3).',25h ('.$time_remain.')';
				elseif(substr($time_remain, -2)<45)
					print substr($time_remain, 0, strlen($time_remain)-3).',5h ('.$time_remain.')';
				if(substr($time_remain, -2)>45)
					print substr($time_remain, 0, strlen($time_remain)-3).',75h ('.$time_remain.')';
				print '</p>';
				}
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
					<?php 
					if(substr($session['Timesession']['duration'], -2)<15)
						print substr($session['Timesession']['duration'], 0, strlen($session['Timesession']['duration'])-3).'h ('.$session['Timesession']['duration'].')';
					elseif(substr($session['Timesession']['duration'], -2)<30)
						print substr($session['Timesession']['duration'], 0, strlen($session['Timesession']['duration'])-3).',25h ('.$session['Timesession']['duration'].')';	
					elseif(substr($session['Timesession']['duration'], -2)<45)
						print substr($session['Timesession']['duration'], 0, strlen($session['Timesession']['duration'])-3).',5h ('.$session['Timesession']['duration'].')';
					if(substr($session['Timesession']['duration'], -2)>45)
						print substr($session['Timesession']['duration'], 0, strlen($session['Timesession']['duration'])-3).',75h ('.$session['Timesession']['duration'].')';
					?>
				</td>
			</tr>
			<?php endforeach?>
		</table>
    
<?php print $this->element('end_view'); ?>
