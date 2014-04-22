<?php 
	if(isset($ajax) and $ajax==true)
		$this->Paginator->options(array(
		 'url' => $this->passedArgs,
		 'update' => '#content',
		 'evalScripts' => true,
		 'data'=>http_build_query($this->request->data),
		 'method'=>'POST'
		  ))
?>

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
