<div class="span10 index">
	<h2><?php echo __('Foire aux Questions - Catégories'); ?></h2><br/>
	<ul>
	<?php foreach ($faqs as $faq): ?>
		<li><h3><?php echo $this->Html->link(h($faq['CategorieFaq']['titre_categorie']),array('action'=>'view',$faq['CategorieFaq']['id'])); ?></h3><?php echo $faq['CategorieFaq']['description_categorie'];?></li>		
		<br/>
	<?php endforeach; ?>
	</ul>
</div>
