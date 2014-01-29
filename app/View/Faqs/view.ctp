<div class="span10 view">
<h2><?php  echo __('Foire aux Questions - '.$faqs[0]['CategorieFaq']['titre_categorie']); ?></h2><br/>
    <?php foreach ($faqs as $faq): ?>
        <h3><?php echo $faq['Faq']['question']; ?></h3>
        <?php echo $faq['Faq']['reponse']; ?><br/>
    <?php endforeach; ?>
</div>
