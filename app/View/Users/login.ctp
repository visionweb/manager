<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo 'VisionWeb - Manager' ?>
    </title>
    <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css('manager');
    echo $this->Html->css('bootstrap.min');
    echo $this->fetch('meta');
    echo $this->fetch('css');
    ?>

</head>
<body>
    <div id="container">
        <div id="header">
            <h1 style="text-align: center"><?php echo $this->Html->image('logo.png', array('alt' => 'Manager')); ?></h1>
        </div>
        <div id="content">
            <?php echo $this->Session->flash('auth'); ?>
            <?php echo $this->Session->flash(); ?>
            <div class="login">
                <?php
                    echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login')));
                    echo $this->Form->input('User.username',array('label'=>'Nom d\'utilisateur'));
                    echo $this->Form->input('User.password',array('label'=>'Mot de passe'));
                    $options=array(
                        'label' => 'Connexion',
                        'class' => 'btn'
                    );
                    echo $this->Form->end($options);
                ?>
            </div>
        </div>
    </div>
</body>
</html>