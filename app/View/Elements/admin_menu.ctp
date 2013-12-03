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
                    <li><a href="<?php echo Configure::read('root.url')?>admin/actualites">Home</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Actualités <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo Configure::read('root.url')?>admin/actualites">Voir</a></li>
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'actualites','action' => 'add'));?>">Ajouter</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Groupes <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'groups','action' => 'index'));?>">Voir</a></li>
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'groups','action' => 'add'));?>">Ajouter</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Utilisateurs <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'users','action' => 'index'));?>">Voir</a></li>
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'users','action' => 'add'));?>">Ajouter</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Travaux <b class="caret"></b></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'tasks','action' => 'index'));?>">Voir</a></li>
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'tasks','action' => 'add'));?>">Ajouter</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-submenu">
                                <a href="<?php echo $this->Html->url(array('controller'=>'taskProjects','action' => 'index'));?>">Projets</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $this->Html->url(array('controller'=>'taskProjects','action' => 'add'));?>">Ajouter</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="<?php echo $this->Html->url(array('controller'=>'taskTypes','action' => 'index'));?>">Types</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $this->Html->url(array('controller'=>'taskTypes','action' => 'add'));?>">Ajouter</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="<?php echo $this->Html->url(array('controller'=>'taskStatuts','action' => 'index'));?>">Statuts</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $this->Html->url(array('controller'=>'taskStatuts','action' => 'add'));?>">Ajouter</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Factures <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'invoices','action' => 'index'));?>">Voir</a></li>
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'invoices','action' => 'add'));?>">Ajouter</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-submenu">
                                <a href="<?php echo $this->Html->url(array('controller'=>'invoiceStatuts','action' => 'index'));?>">Statuts</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $this->Html->url(array('controller'=>'invoiceStatuts','action' => 'add'));?>">Ajouter</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="<?php echo $this->Html->url(array('controller'=>'invoiceTypes','action' => 'index'));?>">Types</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $this->Html->url(array('controller'=>'invoiceTypes','action' => 'add'));?>">Ajouter</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mots de passe <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'passwords','action' => 'index'));?>">Voir</a></li>
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'passwords','action' => 'add'));?>">Ajouter</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-submenu">
                                <a href="<?php echo $this->Html->url(array('controller'=>'passwordServices','action' => 'index'));?>">Services</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $this->Html->url(array('controller'=>'passwordServices','action' => 'add'));?>">Ajouter</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="<?php echo $this->Html->url(array('controller'=>'passwordTypes','action' => 'index'));?>">Types</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $this->Html->url(array('controller'=>'passwordTypes','action' => 'add'));?>">Ajouter</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tickets <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'tickets','action' => 'index'));?>">Voir les tickets ouvert</a></li>
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'tickets','action' => 'index_closed'));?>">Voir les tickets fermé</a></li>
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'tickets','action' => 'index_all'));?>">Voir tout les tickets</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-submenu">
                                <a href="<?php echo $this->Html->url(array('controller'=>'categorieTickets','action' => 'index'));?>">Catégories</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $this->Html->url(array('controller'=>'categorieTickets','action' => 'add'));?>">Ajouter</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">Accès Wiki</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">FAQ <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'faqs','action' => 'index'));?>">Voir</a></li>
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'faqs','action' => 'add'));?>">Ajouter</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-submenu">
                                <a href="<?php echo $this->Html->url(array('controller'=>'categorieFaqs','action' => 'index'));?>">Catégories</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $this->Html->url(array('controller'=>'categorieFaqs','action' => 'add'));?>">Ajouter</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Modules <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->Html->url(array('controller'=>'modules','action' => 'index'));?>">Gestion</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-submenu">
                                <a href="<?php echo $this->Html->url(array('controller'=>'voips','action' => 'index'));?>">Voip</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $this->Html->url(array('controller'=>'voips','action' => 'listAccount'));?>">Liste compte</a></li>
                                    <li><a href="<?php echo $this->Html->url(array('controller'=>'voips','action' => 'newAccount'));?>">Nouveau compte</a></li>
                                    <li><a href="<?php echo $this->Html->url(array('controller'=>'voips','action' => 'consommation'));?>">Consommation</a></li>
                                    <li><a href="<?php echo $this->Html->url(array('controller'=>'voips','action' => 'configuration'));?>">Configuration</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav pull-right">
                    <li class="divider-vertical"></li>
                    <li><a href="<?php echo Configure::read('root.url')?>admin/acl/aros">Droit</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->Session->read('Auth.User.username');?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo Configure::read('root.url')?>users/logout">Déconnexion</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.nav-collapse -->
        </div>
    </div><!-- /navbar-inner -->
</div><!-- /navbar -->