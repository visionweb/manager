<div class="navbar" style="margin-top: 10px">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="nav-collapse collapse navbar-responsive-collapse">
                <ul class="nav">
                    <li><a href="<?php echo $this->Html->url(array('controller' => 'actualites', 'action' => 'index'));?>">Home</a></li>
                    <li><a href="<?php echo $this->Html->url(array('controller'=>'tasks','action' => 'index'));?>">Travaux</a></li>
                    <li><a href="<?php echo $this->Html->url(array('controller'=>'invoices','action' => 'index'));?>">Factures</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mots de passe <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'passwords','action' => 'index'));?>">Voir</a></li>
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'passwords','action' => 'add'));?>">Ajouter</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tickets <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'tickets','action' => 'index'));?>">Voir les tickets ouvert</a></li>
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'tickets','action' => 'index_closed'));?>">Voir les tickets fermé</a></li>
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'tickets','action' => 'index_all'));?>">Voir tout les tickets</a></li>
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'tickets','action' => 'add'));?>">Créer un ticket</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Accès Wiki</a></li>
                    <?php if(!empty($modules) and $modules[0]['Module']['activ']==0) print '<!--';?>
                    <li><a href="<?php echo $this->Html->url(array('controller'=>'voips','action' => 'index'));?>">VoIP</a></li>
                    <?php if(!empty($modules) and $modules[0]['Module']['activ']==0) print '-->';?>
                    
                    <?php if(!empty($modules) and $modules[1]['Module']['activ']==0) print '<!--';?>
                      <li>
                        <a href="<?php echo Configure::read('root.url')?>times">timeMan</a>
                      </li>
                     <?php if(!empty($modules) and $modules[0]['Module']['activ']==0) print '-->';?>
                    
                   </li>
                </ul>
                <ul class="nav pull-right">
                    <li class="divider-vertical"></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->Session->read('Auth.User.username');?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'index'));?>">Mon compte</a></li>
                            <li class="dropdown-submenu">
                                <a href="<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'index'));?>">Mon groupe</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $this->Html->url(array('controller'=>'groups','action' => 'view'));?>">Modifier</a></li>
                                    <li><a href="<?php echo $this->Html->url(array('controller'=>'users','action' => 'add'));?>">Ajouter un utilisateur</a></li>
                                </ul>
                            </li>
                            <li class="divider"></li>
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'logout'));?>">Déconnexion</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.nav-collapse -->
        </div>
    </div><!-- /navbar-inner -->
</div><!-- /navbar -->
