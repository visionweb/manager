<div class="span10 index">
    <h2><?php echo __('Catégorie FAQs'); ?></h2>
    <?php echo $this->Html->link('Créer une nouvelle catégorie', array('controllers'=>'categorieFaqs','action'=>'add'));?>
    <br/><br/>
    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('titre_categorie','Titre Catégorie'); ?></th>
            <th><?php echo $this->Paginator->sort('description_categorie','Description Catégorie'); ?></th>
        </tr>
        <?php foreach ($categorieFaqs as $categorieFaq): ?>
            <tr>
                <td><?php echo h($categorieFaq['CategorieFaq']['titre_categorie']); ?>&nbsp;</td>
                <td><?php echo h($categorieFaq['CategorieFaq']['description_categorie']); ?>&nbsp;</td>
                <td class="actions btn-group">
                    <button class="btn">Action</button>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $this->Html->url(array('action' => 'view', $categorieFaq['CategorieFaq']['id']));?>"><span class="icon-eye-open"></span> <?php echo __('Voir');?></a></li>
                        <li><a href="<?php echo $this->Html->url(array('action' => 'edit', $categorieFaq['CategorieFaq']['id']));?>"><span class="icon-edit"></span> <?php echo __('Modifier');?></a></li>
                        <li><a href="#"><?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $categorieFaq['CategorieFaq']['id']), null, __('Etes-vous sûr de vouloir supprimer la catégorie < %s >?', $categorieFaq['CategorieFaq']['titre_categorie']));?></a></li>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} / {:pages}')
        ));
        ?>	</p>
    <div class="paging">
        <?php
        echo $this->Paginator->prev('< ' . __('Précédent'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('Suivant') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>