
<?php print $this->element('subheader'); ?>

	<ul>
	<?php foreach ($faqs as $faq): ?>
		<li><h3><?php echo $this->Html->link(h($faq['CategorieFaq']['titre_categorie']),array('action'=>'view',$faq['CategorieFaq']['id'])); ?></h3><?php echo $faq['CategorieFaq']['description_categorie'];?></li>		
		<br/>
	<?php endforeach; ?>
	</ul>

<?php print $this->element('end_view'); ?>
