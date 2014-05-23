<?php print $this->element('subheader'); ?>

	<b>Project:</b> <?php print $project['Project']['name']?>;<br>
	<b>Client:</b> <?php print $project['Project']['client']?>;<br>
	<b>Time recurent:</b> <?php print $project['Project']['recurent']?>;<br>
	<b>Time remain:</b> <?php 
		if(substr($project['Project']['remain'], -2)<15)
			print substr($project['Project']['remain'], 0, strlen($project['Project']['remain'])-3).'.0h ('.$project['Project']['remain'].')';
		elseif(substr($project['Project']['remain'], -2)<30)
			print substr($project['Project']['remain'], 0, strlen($project['Project']['remain'])-3).'.25h ('.$project['Project']['remain'].')';
		elseif(substr($project['Project']['remain'], -2)<45)
			print substr($project['Project']['remain'], 0, strlen($project['Project']['remain'])-3).'.5h ('.$project['Project']['remain'].')';
		if(substr($project['Project']['remain'], -2)>45)
			print substr($project['Project']['remain'], 0, strlen($project['Project']['remain'])-3).'.75h ('.$project['Project']['remain'].')';
	?>;<br>
	<b>Status: </b> <?php if($project['Project']['status']) 
						print '<span style=\'color:green\'>Opened</span>.';
					else
						print '<span style=\'color:red\'>Closed</span>.';?>
	<br>
		<a href="<?php print $this->Html->url(array('action' => 'projects'))?>">
		<button class="btn">Back</button>
		</a>
		<a href="<?php print $this->Html->url(array('action' => 'download_pdf'))?>">
		<button class="btn">Create PDF</button>
		</a>
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
	
<?php print $this->element('end_view');
App::import('Vendor','xtcpdf');
 
$pdf = new XTCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
 
$pdf->AddPage();
 
print_r($project); 
 
$html = '
	<b>Project:</b> '.$project['Project']['name'].';<br>
	<b>Client:</b> '.$project['Project']['client'].';<br>
	<b>Time recurent:</b> '.$project['Project']['recurent'].';<br>
	<b>Time remain:</b>'; 
		if(substr($project['Project']['remain'], -2)<15)
			$html.= substr($project['Project']['remain'], 0, strlen($project['Project']['remain'])-3).'.0h ('.$project['Project']['remain'].')';
		elseif(substr($project['Project']['remain'], -2)<30)
			$html.= substr($project['Project']['remain'], 0, strlen($project['Project']['remain'])-3).'.25h ('.$project['Project']['remain'].')';
		elseif(substr($project['Project']['remain'], -2)<45)
			$html.= substr($project['Project']['remain'], 0, strlen($project['Project']['remain'])-3).'.5h ('.$project['Project']['remain'].')';
		if(substr($project['Project']['remain'], -2)>45)
			$html.= substr($project['Project']['remain'], 0, strlen($project['Project']['remain'])-3).'.75h ('.$project['Project']['remain'].')';
	$html.='<br><b>Status: </b>';
	if($project['Project']['status']) 
		$html.='<span style=\'color:green\'>Opened.</span><br><br><br>';
	else
		$html.= '<span style=\'color:red\'>Closed.</span><br><br><br>';
 
		$html.='<table class="table-hover table-condensed" cellpadding="3" cellspacing="0">
			<tr>
				<th>
					<b>Date</b>
				</th>
				<th>
					<b>Description</b>
				</th>
				<th>
					<b>Category</b>
				</th>
				<th>
					<b>Start</b>
				</th>
				<th>
					<b>End</b>
				</th>
				<th>
					<b>Duration</b>
				</th>
			</tr>';
		foreach($sessions as $session){
			$html.='<tr>
				<td>
					'.$session['Timesession']['date'].'
				</td>
				<td>
					'.$session['Timesession']['description'].'
				</td>
				<td>
					'.$session['Timesession']['category'].'
				</td>
				<td>
					'.$session['Timesession']['start'].'
				</td>
				<td>
					'.$session['Timesession']['end'].'
				</td>
				<td>';
					if(substr($session['Timesession']['duration'], -2)<15)
						$html.=substr($session['Timesession']['duration'], 0, strlen($session['Timesession']['duration'])-3).'h ('.$session['Timesession']['duration'].')';
					elseif(substr($session['Timesession']['duration'], -2)<30)
						$html.=substr($session['Timesession']['duration'], 0, strlen($session['Timesession']['duration'])-3).',25h ('.$session['Timesession']['duration'].')';	
					elseif(substr($session['Timesession']['duration'], -2)<45)
						$html.=substr($session['Timesession']['duration'], 0, strlen($session['Timesession']['duration'])-3).',5h ('.$session['Timesession']['duration'].')';
					if(substr($session['Timesession']['duration'], -2)>45)
						$html.=substr($session['Timesession']['duration'], 0, strlen($session['Timesession']['duration'])-3).',75h ('.$session['Timesession']['duration'].')';

				$html.='</td>
			</tr>';
		}
		$html.='</table>';
 
$pdf->writeHTML($html, true, false, true, false, '');
 
$pdf->lastPage();
 
echo $pdf->Output(APP . 'files/pdf' . DS . 'test.pdf', 'F');?>
