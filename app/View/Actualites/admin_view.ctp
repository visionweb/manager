<div class="span10 view">
<h2><?php  echo __('Actualité'); ?></h2>
    <span class="btn-group">
        <button class="btn">Action</button>
        <button class="btn dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="<?php echo $this->Html->url(array('action' => 'edit',$actualite['Actualite']['id']));?>"><span class="icon-edit"></span> <?php echo __('Modifier');?></a></li>
            <li><a href="#"><?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $actualite['Actualite']['id']), null, __('Etes-vous sûr de vouloir supprimer l\'actualité < %s >?', $actualite['Actualite']['titre_actu']));?></a></li>
        </ul>
    </span>
    <br/><br/>
    <dl>
		<dt><?php echo __('Titre Actualité'); ?></dt>
		<dd>
			<?php echo h($actualite['Actualite']['titre_actu']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contenu Actualité'); ?></dt>
		<dd>
			<?php echo $actualite['Actualite']['contenu_actu']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Créé le'); ?></dt>
		<dd>
			<?php echo h($actualite['Actualite']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>