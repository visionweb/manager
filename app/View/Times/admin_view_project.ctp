<?php print $this->element('subheader'); ?>

<table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
	<b>Project:</b> <?php print $projects[0]['Timesession']['name']?>
			<tr>
				<th>
					Date
				</th>
				<th>
					Start
				</th>
				<th>
					End
				</th>
				<th>
					Total time
				</th>
			</tr>
			<?php foreach($projects as $project):?>
			<tr>
				<td>
					<?php print $project['Timesession']['date_start']?>
				</td>
				<td>
					<?php print $project['Timesession']['time_start']?>
				</td>
				<td>
					<?php print $project['Timesession']['time_end']?>
				</td>
				<td>
					<?php print $project['Timesession']['total']?>
				</td>
			</tr>
			<?php endforeach?>
		</table>
	
<?php print $this->element('end_view'); ?>
