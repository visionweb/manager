
<?php print $this->element('subheader'); ?>

	<?php 
		foreach ($actualites as $actualite): 
	?>
	
	<h3>
		<?php 
			print h($actualite['Actualite']['titre_actu']); 
		?> 
	</h3>
	
	<?php 
		print h($this->Time->format('d/m/Y',$actualite['Actualite']['created'])); 
	?>
	
	<br/>
	<br/>
	
	<p>
		<?php 
			print $actualite['Actualite']['contenu_actu']; 
		?>
	</p>
	
	<br/>
	<?php endforeach; ?>

<?php print $this->element('end_view'); ?>


