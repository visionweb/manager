<?php print $this->element('subheader'); ?>

<table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
	<b>Project:</b> <?php print $pr['Time']['project']?>;<br>
	<b>Category:</b> <?php print $pr['Time']['category']?>;<br>
	<b>User:</b> <?php print $pr['Time']['user']?>;<br>
	<b>Time:</b> <?php print $pr['Time']['time']?>;<br>
	<b>Time rest:</b> <?php print $left?>;<br>
	<b>Status: </b> <?php if($pr['Time']['activ']) 
						print '<span style=\'color:green\'>Active</span>.';
					else
						print '<span style=\'color:red\'>Inactive</span>.';?>
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
