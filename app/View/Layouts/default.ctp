<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<?if(isset($this->request->data['isAjax'])): echo $this->fetch('content');?>
<?else:?>
    <!DOCTYPE html>
    <html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
            echo $this->Html->meta('icon');
            
			echo $this->Html->css('switch_button');
            echo $this->Html->css('manager');
            echo $this->Html->css('bootstrap.min');

            echo $this->Html->script(array('del_confirm.js', 'jquery-1.10.2.min.js','bootstrap.min'));

            echo $this->fetch('meta');
            echo $this->fetch('css');
            echo $this->fetch('script');
        ?>

    </head>
    <body>
        <div id="container">
            <div id="header">
                <?php echo $this->element('header'); ?>
                <? if($this->Session->read('Auth.User.Group.id') == Configure::read('root.adminID'))
                    echo $this->element('admin_menu');
                else echo $this->element('menu');?>
            </div>
            <div id="content">
                <div class="container-fluid">
                    <?php echo $this->Session->flash('auth'); ?>
                    <?php echo $this->Session->flash(); ?>
                    <div class="row-fluid">
                        <?php echo $this->fetch('content'); ?>
                    </div>
                </div>
            </div>
            <div id="footer"></div>
        </div>
        <?php
        if(strpos($_SERVER['SERVER_NAME'], 'local')) echo $this->element('sql_dump');
        ?>
    </body>
    </html>
<?endif;?>
