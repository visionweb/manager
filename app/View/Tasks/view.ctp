
<?php print $this->element('subheader'); ?>

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
    <?foreach ($commentaires as $commentaire):?>
    <div class='comment'>
        <?php echo 'De '.h($commentaire['User']['nom_user']).' '.h($commentaire['User']['prenom']);?>
        <?php echo ' le '.h($this->Time->Format('d/m/y à H:i',$commentaire['Commentaire']['created']));?><br/>
        <?php echo $commentaire['Commentaire']['text_commentaire'];?>
    </div>
    <?php endforeach;?>

<?php print $this->element('end_view'); ?>
