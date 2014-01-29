<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

    /**
     * compare method - Compare a value in the database with an other value
     *
     * @param null $model - Name of the model
     * @param null $id - Id of a record
     * @param null $field - The field we want to compare with
     * @param null $compareWith - The value we want to compare with the field
     * @return bool - true if its the same, false otherwise
     */
    public function compare($model=null,$id=null,$field=null,$compareWith=null){
        //Import the model
        App::import('model',$model);
        //Create an instance
        $MyModel=new $model();
        //If the field is the same as the value in compareWith
        if(($MyModel->field($field,array($MyModel->primaryKey=>$id))==$compareWith)){
            return true;
        }
        return false;
    }
}
