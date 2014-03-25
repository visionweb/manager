
<?php print $this->element('subheader'); ?>

    <?php echo $this->Form->postLink(__('Supprimez cette tâche'), array('action' => 'delete', $task['Task']['id']), null, __('Etes-vous sûr de vouloir supprimer la tâche < %s >?', $task['Task']['subject'])); ?>
    <br/><br/>

    <table class="table">
        <tr>
            <td><?php echo'Concerne le projet : '.h($task['TaskProject']['label']);?></td>
        </tr>
        <tr>
            <td><b><?php echo'Sujet : '?></b><?php echo h($task['Task']['subject']); ?></td>
        </tr>
        <tr>
            <td class="inline">
                <b><?php echo'Type de tâche : '?></b><?php echo h($task['TaskType']['label']);?><br/>
                <b><?php echo'Statut de la tâche : '?></b><?php echo h($task['TaskStatut']['label']);?>
            </td>
        </tr>
        <tr>
            <td>
                <b><?php echo'Details :'?></b><br/>
                <?php echo h($task['Task']['description']);?>
            </td>
        </tr>
        <tr>
            <td><?php echo'Date : '.h($this->Time->format('l\, j F Y\, H:i',$task['Task']['created']));?></td>
        </tr>
    </table>
    <?php
    foreach ($commentaires as $commentaire):?>
    <div class='comment'>
        <?php echo 'De '.h($commentaire['User']['nom_user']).' '.h($commentaire['User']['prenom']);?>
        <?php echo ' le '.h($this->Time->Format('d/m/y à H:i',$commentaire['Commentaire']['created']));?><br/>
        <?php echo $commentaire['Commentaire']['text_commentaire'];?>
    </div>
    <?php endforeach;?>
    <fieldset>
        <legend><?php echo __('Ajouter un commentaire');?></legend>
        <?php
        echo $this->Form->create('Commentaire');
        echo $this->Form->input('text_commentaire',array('label'=>'Commentaire'));
        echo $this->Form->input('task_id',array('type'=>'hidden'));
        echo $this->Form->input('user_id',array('type'=>'hidden'));
        echo $this->Form->end('Ajouter');
        ?>
    </fieldset>

<?php print $this->element('end_view'); ?>
