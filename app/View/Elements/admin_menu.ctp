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
                            <li><a href="<?php echo Configure::read('root.url')?>admin/actualites/add">Ajouter</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Groupes <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo Configure::read('root.url')?>admin/groups/index">Voir</a></li>
                            <li><a href="<?php echo Configure::read('root.url')?>admin/groups/add">Ajouter</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Utilisateurs <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo Configure::read('root.url')?>admin/users/index">Voir</a></li>
                            <li><a href="<?php echo Configure::read('root.url')?>admin/users/add">Ajouter</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Travaux <b class="caret"></b></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo Configure::read('root.url')?>admin/tasks/index">Voir</a></li>
                            <li><a href="<?php echo Configure::read('root.url')?>admin/tasks/add">Ajouter</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-submenu">
                                <a href="<?php echo Configure::read('root.url')?>admin/taskProjects/index">Projets</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo Configure::read('root.url')?>admin/taskProjects/add">Ajouter</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="<?php echo Configure::read('root.url')?>admin/taskTypes/index">Types</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo Configure::read('root.url')?>admin/taskTypes/index">Ajouter</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="<?php echo Configure::read('root.url')?>admin/taskStatuts/index">Statuts</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo Configure::read('root.url')?>admin/taskStatuts/add">Ajouter</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Factures <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo Configure::read('root.url')?>admin/invoices/index">Voir</a></li>
                            <li><a href="<?php echo Configure::read('root.url')?>admin/invoices/add">Ajouter</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-submenu">
                                <a href="<?php echo Configure::read('root.url')?>admin/invoiceStatuts/index">Statuts</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo Configure::read('root.url')?>admin/invoiceStatuts/add">Ajouter</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="<?php echo Configure::read('root.url')?>admin/invoiceTypes/index">Types</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo Configure::read('root.url')?>admin/invoiceTypes/add">Ajouter</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mots de passe <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo Configure::read('root.url')?>admin/passwords/index">Voir</a></li>
                            <li><a href="<?php echo Configure::read('root.url')?>admin/passwords/add">Ajouter</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-submenu">
                                <a href="<?php echo Configure::read('root.url')?>admin/passwordServices/index">Services</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo Configure::read('root.url')?>admin/passwordServices/add">Ajouter</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a href="<?php echo Configure::read('root.url')?>admin/passwordTypes/index">Types</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo Configure::read('root.url')?>admin/passwordTypes/add">Ajouter</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tickets <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo Configure::read('root.url')?>admin/tickets/index">Voir les tickets ouvert</a></li>
                            <li><a href="<?php echo Configure::read('root.url')?>admin/tickets/index_closed">Voir les tickets fermé</a></li>
                            <li><a href="<?php echo Configure::read('root.url')?>admin/tickets/index_all">Voir tout les tickets</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-submenu">
                                <a href="<?php echo Configure::read('root.url')?>admin/categorieTickets/index">Catégories</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo Configure::read('root.url')?>admin/categorieTickets/add">Ajouter</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">Accès Wiki</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">FAQ <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo Configure::read('root.url')?>admin/faqs/index">Voir</a></li>
                            <li><a href="<?php echo Configure::read('root.url')?>admin/faqs/add">Ajouter</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-submenu">
                                <a href="<?php echo Configure::read('root.url')?>admin/categorieFaqs/index">Catégories</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo Configure::read('root.url')?>admin/categorieFaqs/add">Ajouter</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Modules <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo Configure::read('root.url')?>admin/modules/index">Gestion</a></li>
                            <li class="dropdown-submenu">
                                <a>Configuration</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo Configure::read('root.url')?>admin/modules/mail">Support mail</a></li>
                                    <li><a href="<?php echo Configure::read('root.url')?>admin/modules/logo">Logotype</a></li>
                                </ul>
                            </li>
                            <li class="divider"></li>
                            <?php if(!empty($modules) and $modules[0]['Module']['activ']==0) print '<!--';?>
                            <li class="dropdown-submenu">
                                <a href="<?php echo Configure::read('root.url')?>admin/voips">Voip</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo Configure::read('root.url')?>admin/voips/listAccount">Liste compte</a></li>
                                    <li><a href="<?php echo Configure::read('root.url')?>admin/voips/newAccount">Nouveau compte</a></li>
                                    <li><a href="<?php echo Configure::read('root.url')?>admin/voips/configuration">Configuration</a></li>
									<li><a href="<?php echo Configure::read('root.url')?>admin/voips/call_logs">Call log</a></li>
                                </ul>
                            </li>
                            <?php if(!empty($modules) and $modules[0]['Module']['activ']==0) print '-->';?>
                           
                            <?php if(!empty($modules) and $modules[1]['Module']['activ']==0) print '<!--';?>
                            <li class="dropdown-submenu">
                                <a href="<?php echo Configure::read('root.url')?>admin/times">timeMan</a>
                                <ul class="dropdown-menu">
                                    
                                </ul>
                            </li>
                            <?php if(!empty($modules) and $modules[0]['Module']['activ']==0) print '-->';?>
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
