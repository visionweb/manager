
<?php print $this->element('subheader'); ?>

    <?php foreach ($faqs as $faq): ?>
        <h3><?php echo $faq['Faq']['question']; ?></h3>
        <?php echo $faq['Faq']['reponse']; ?><br/>
    <?php endforeach; ?>
    
<?php print $this->element('end_view'); ?>
