<?php print $this->element('subheader'); ?>

<table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
	<b>Project:</b> <?php print $project['Project']['name']?>;<br>
	<b>Client:</b> <?php print $project['Project']['client']?>;<br>
	<b>Time recurent:</b> <?php print $project['Project']['recurent']?>;<br>
	<b>Time remain:</b> <?php print $project['Project']['remain']?>;<br>
	<b>Status: </b> <?php if($project['Project']['status']) 
						print '<span style=\'color:green\'>Active</span>.';
					else
						print '<span style=\'color:red\'>Inactive</span>.';?>
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
			</tr>
			<?php endforeach?>
		</table>
	
<?php print $this->element('end_view'); ?>
