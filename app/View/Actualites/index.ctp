<div class="span10 index">
	<h2><?php echo __('Actualités'); ?></h2>
<?php foreach ($actualites as $actualite): ?>
<h3><?php echo h($actualite['Actualite']['titre_actu']); ?> </h3>
<?php echo h($this->Time->format('d/m/Y',$actualite['Actualite']['created'])); ?>
<br/><br/>
<p><?php echo $actualite['Actualite']['contenu_actu']; ?></p>
<br/>
<?php endforeach; ?>
</div>


