<?php $this->Paginator->options(array(
     'update' => '#content',
       'evalScripts' => true));?>

<div class="span10 form">
	
	<br/>
	<br/>
	
	<h2>
		<?php echo __($title); ?>
	</h2>
	
	<?php if(isset($legend))
	print "
	<legend>
		{$legend}
	</legend>
	";?>
