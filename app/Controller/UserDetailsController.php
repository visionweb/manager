<?php
App::uses('AppController', 'Controller');
/**
 * UserDetails Controller
 *
 * @property UserDetail $UserDetail
 */
class UserDetailsController extends AppController {

    /**
     * add_adresse method - Add an user's address
     *
     * @return void
     */
    public function add_adresse() {
        //If there is data send by a form
        if ($this->request->is('post')) {
            $this->UserDetail->create();
            //If the address has been saved in the database
            if ($this->UserDetail->saveAll($this->request->data['UserDetail'])) {
                $this->Session->setFlash(__('L\'adresse a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'users','action' => 'index'));
            } else {
                $this->Session->setFlash(__('L\'adresse n\'a pas été sauvegardé.'),'flash_error');
            }
        }
        $infos=array('id'=>$this->Auth->user('id'),'key'=>$this->UserDetail->createKey());
        $this->set(compact('infos'));
    }

    /**
     * add_email method - Add an user's email
     *
     * @return void
     */
    public function add_email() {
        //If there is data send by a form
        if ($this->request->is('post')) {
            $this->UserDetail->create();
            //If the email has been saved in the database
            if ($this->UserDetail->save($this->request->data)) {
                $this->Session->setFlash(__('L\'email a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'users','action' => 'index'));
            } else {
                $this->Session->setFlash(__('L\'email n\'a pas été sauvegardé.'),'flash_error');
            }
        }
        //Id of the user
        $infos=array('id'=>$this->Auth->user('id'));
        $this->set(compact('infos'));
    }

    /**
     * add_numero method - Add an user's phone/fax number
     *
     * @return void
     */
    public function add_numero() {
        //If there is data send by a form
        if ($this->request->is('post')) {
            //If number is not valide
            if(strlen($this->request->data['UserDetail']['valeur'])<10){
                $this->Session->setFlash(__('Le numéro est invalide.'),'flash_warning');
                $this->redirect($this->referer());
            }
            $this->UserDetail->create();
            //If the phone/fax number has been saved in the database
            if ($this->UserDetail->save($this->request->data)) {
                $this->Session->setFlash(__('Le numéro a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'users','action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le numéro n\'a pas été sauvegardé.'),'flash_error');
            }

        }
        $infos=array('id'=>$this->Auth->user('id'));
        $this->set(compact('infos'));
    }

    /**
     * edit_adresse method - Edit an user's address
     *
     * @param string $key - the key shared by the information of one address
     * @return void
     */
    public function edit_adresse($key=null) {
        //If the address is not active and doesn't belong to the user
        if($this->UserDetail->verifyAddress($key,$this->Auth->user('id'))){
            $this->Session->setFlash(__('Cette adresse n\'existe pas.'),'flash_warning');
            $this->redirect(array('controller'=>'users','action'=>'index'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            //If informations of the address has been saved in the database
            if ($this->UserDetail->saveAll($this->request->data)) {
                $this->Session->setFlash(__('L\'adresse a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'users','action' => 'index'));
            } else {
                $this->Session->setFlash(__('L\'adresse n\'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array('recursive'=>-1,'conditions' => array('UserDetail.key'=>$key));
            $this->request->data = $this->UserDetail->find('all', $options);
        }
    }

    /**
     * edit_email method - Edit an user's email
     *
     * @param string $id - id of the email
     * @return void
     */
    public function edit_email($id = null) {
        //If the email doesn't exist in the database or if the email doesn't belong the user or if the detail is not an email or if the email is not active
        if (!$this->UserDetail->exists($id) || !$this->UserDetail->compare($this->modelClass,$id,'user_id',$this->Auth->user('id')) || !$this->UserDetail->compare($this->modelClass,$id,'type','Email') || $this->UserDetail->compare($this->modelClass,$id,'actif_user_detail',false)) {
            $this->Session->setFlash(__('Cette email n\'existe pas.'),'flash_warning');
            $this->redirect(array('controller'=>'users','action' => 'index'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            //If the email has been saved in the database
            if ($this->UserDetail->save($this->request->data)) {
                $this->Session->setFlash(__('L\'email a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'users','action' => 'index'));
            } else {
                $this->Session->setFlash(__('L\'email n\'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array('conditions' => array('UserDetail.' . $this->UserDetail->primaryKey => $id));
            $this->request->data = $this->UserDetail->find('first', $options);
        }
    }

    /**
     *edit_numero method - Edit an user's phone/fax number
     *
     * @param string $id - id of the phone/fax number
     * @return void
     */
    public function edit_numero($id = null) {
        //If the number doesn't exist in the database
        $bool=!$this->UserDetail->exists($id);
        //If the number doesn't belong to  the user
        $bool=$bool || !$this->UserDetail->compare($this->modelClass,$id,'user_id',$this->Auth->user('id'));
        //If the detail is not a number
        $bool=$bool || (!$this->UserDetail->compare($this->modelClass,$id,'type','NumeroFixe') && !$this->UserDetail->compare($this->modelClass,$id,'type','NumeroMobile') && !$this->UserDetail->compare($this->modelClass,$id,'type','NumeroFax'));
        //If the number is not active
        $bool=$bool || $this->UserDetail->compare($this->modelClass,$id,'actif_user_detail',false);
        //If the $bool is true
        if($bool){
            $this->Session->setFlash(__('Ce numéro n\'existe pas.'),'flash_warning');
            $this->redirect(array('controller'=>'users','action'=>'index'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            //If number is not valide
            if(strlen($this->request->data['UserDetail']['valeur'])<10){
                $this->Session->setFlash(__('Le numéro est invalide.'),'flash_warning');
                $this->redirect($this->referer());
            }
            //If the phone/fax number has been saved in the database
            if ($this->UserDetail->save($this->request->data)) {
                $this->Session->setFlash(__('Le numéro a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'users','action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le numéro n\'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array('conditions' => array('UserDetail.' . $this->UserDetail->primaryKey => $id));
            $this->request->data = $this->UserDetail->find('first', $options);
        }
    }

    /**
     * delete_adresse method - Turns the 'actif' field to false of the address
     *
     * @param string $key - the key shared by informations of the address
     * @return void
     */
    public function delete_adresse($key = null) {
        //If the address doesn't belong to the user or if the address is not active
        if($this->UserDetail->verifyAddress($key,$this->Auth->user('id'))){
            $this->Session->setFlash(__('Cette adresse n\'existe pas.'),'flash_warning');
            $this->redirect($this->referer());
        }
        $this->request->onlyAllow('post', 'delete');
        $sql="update user_details as Ud set Ud.actif_user_detail = false where Ud.key = '".$key."';";
        //Execute the request
        $result=$this->UserDetail->query($sql);
        //If the request worked
        if (empty($result)) {
            $this->Session->setFlash(__('L\'adresse a été supprimé.'),'flash_success');
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('L\'adresse n\'a pas été supprimé.'),'flash_error');
    }

    /**
     *delete_email method - Turns the 'actif' field to false of the email
     *
     * @param string $id - id of the email
     * @return void
     */
    public function delete_email($id = null) {
        $this->UserDetail->id = $id;
        //If the email doesn't exist in the database or if the email doesn't belong to the user or if the detail is not an email or if the email is not active
        if (!$this->UserDetail->exists() || !$this->UserDetail->compare($this->modelClass,$id,'user_id',$this->Auth->user('id')) || !$this->UserDetail->compare($this->modelClass,$id,'type','Email') || $this->UserDetail->compare($this->modelClass,$id,'actif_user_detail',false)) {
            $this->Session->setFlash(__('Cette email n\'existe pas.'),'flash_warning');
            $this->redirect($this->referer());
        }
        $this->request->onlyAllow('post', 'delete');
        //If the 'actif' field has changed to false
        if ($this->UserDetail->saveField('actif_user_detail', false)) {
            $this->Session->setFlash(__('L\'email a été supprimé.'),'flash_success');
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('L\'email n\'a pas été supprimé.'),'flash_error');
    }

    /**
     *delete_numero method - Turns the 'actif' field to false of the phone/fax number
     *
     * @param string $id - id of the phone/fax number
     * @return void
     */
    public function delete_numero($id = null) {
        $this->UserDetail->id = $id;
        //If the number doesn't exist
        $bool=!$this->UserDetail->exists($id);
        //If the number doesn't belong to the user
        $bool=$bool || !$this->UserDetail->compare($this->modelClass,$id,'user_id',$this->Auth->user('id'));
        //If the detail is not a number
        $bool=$bool || (!$this->UserDetail->compare($this->modelClass,$id,'type','NumeroFixe') && !$this->UserDetail->compare($this->modelClass,$id,'type','NumeroMobile') && !$this->UserDetail->compare($this->modelClass,$id,'type','NumeroFax'));
        //If the number is not active
        $bool=$bool || $this->UserDetail->compare($this->modelClass,$id,'actif_user_detail',false);
        //If the $bool is true
        if($bool){
            $this->Session->setFlash(__('Ce numéro n\'existe pas.'),'flash_warning');
            $this->redirect($this->referer());
        }
        $this->request->onlyAllow('post', 'delete');
        //If the 'actif' field has changed to false
        if ($this->UserDetail->saveField('actif_user_detail', false)) {
            $this->Session->setFlash(__('Le numéro a été supprimé.'),'flash_success');
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Le numéro n\'a pas été supprimé.'),'flash_error');
    }

    /**
     * admin_add_adresse method - Add an user's address
     *
     * @param string $id - Id of the user
     * @return void
     */
    public function admin_add_adresse($id = null) {
        //If there is data send by a form
        if ($this->request->is('post')) {
            $this->UserDetail->create();
            //If the address has been saved in the database
            if ($this->UserDetail->saveAll($this->request->data['UserDetail'])) {
                $this->Session->setFlash(__('L\'adresse a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'users','action' => 'view',$id));
            } else {
                $this->Session->setFlash(__('L\'adresse n\'a pas été sauvegardé.'),'flash_error');
            }
        }
        $infos=array('id'=>$id,'key'=>$this->UserDetail->createKey());
        $this->set(compact('infos'));
    }

    /**
     * admin_add_email method - Add an user's email
     *
     * @param string $id - Id of the user
     * @return void
     */
    public function admin_add_email($id = null) {
        //If there is data send by a form
        if ($this->request->is('post')) {
            $this->UserDetail->create();
            //If the email has been saved in the database
            if ($this->UserDetail->save($this->request->data)) {
                $this->Session->setFlash(__('L\'email a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'users','action' => 'view',$id));
            } else {
                $this->Session->setFlash(__('L\'email n\'a pas été sauvegardé.'),'flash_error');
            }
        }
        //Id of the group
        $infos=array('id'=>$id);
        $this->set(compact('infos'));
    }

    /**
     * admin_add_numero method - Add an user's phone/fax number
     *
     * @param string $id - Id of the user
     * @return void
     */
    public function admin_add_numero($id = null) {
        //If there is data send by a form
        if ($this->request->is('post')) {
            //If number is not valide
            if(strlen($this->request->data['UserDetail']['valeur'])<10){
                $this->Session->setFlash(__('Le numéro est invalide.'),'flash_warning');
                $this->redirect($this->referer());
            }
            $this->UserDetail->create();
            //If the phone/fax number has been saved in the database
            if ($this->UserDetail->save($this->request->data)) {
                $this->Session->setFlash(__('Le numéro a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'users','action' => 'view',$id));
            } else {
                $this->Session->setFlash(__('Le numéro n\'a pas été sauvegardé.'),'flash_error');
            }
        }
        $infos=array('id'=>$id);
        $this->set(compact('infos'));
    }

    /**
     * admin_edit_adresse method - Edit an user's address
     *
     * @param string $key - the key shared by informations of the address
     * @return void
     */
    public function admin_edit_adresse($key=null) {
        //If the address is not active
        if($this->UserDetail->verifyAddress($key,null,true)){
            $this->Session->setFlash(__('Cette adresse n\'existe pas.'),'flash_warning');
            $this->redirect(array('controller'=>'users','action'=>'index'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            //If informations of the address has been saved in the database
            if ($this->UserDetail->saveAll($this->request->data)) {
                $this->Session->setFlash(__('L\'adresse a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'users','action' => 'view',$this->request->data [0]['UserDetail']['user_id']));
            } else {
                $this->Session->setFlash(__('L\'adresse n\'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array('recursive'=>-1,'conditions' => array('UserDetail.key'=>$key));
            $this->request->data = $this->UserDetail->find('all', $options);
        }
    }


    /**
     * admin_edit_email method - Edit an user's email
     *
     * @param string $id - Id of the email
     * @return void
     */
    public function admin_edit_email($id = null) {
        //If the email doesn't exist or if the detail is not an email or if the email is not active
        if (!$this->UserDetail->exists($id) || !$this->UserDetail->compare($this->modelClass,$id,'type','Email') || $this->UserDetail->compare($this->modelClass,$id,'actif_user_detail',false)) {
            $this->Session->setFlash(__('Cette email n\'existe pas.'),'flash_warning');
            $this->redirect(array('controller'=>'users','action' => 'index'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            //If the email has been saved in the database
            if ($this->UserDetail->save($this->request->data)) {
                $this->Session->setFlash(__('L\'email a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'users','action' => 'view',$this->request->data['UserDetail']['user_id']));
            } else {
                $this->Session->setFlash(__('L\'email n\'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array('conditions' => array('UserDetail.' . $this->UserDetail->primaryKey => $id));
            $this->request->data = $this->UserDetail->find('first', $options);
        }
    }

    /**
     * admin_edit_numero method - Edit an user's phone/fax number
     *
     * @param string $id - Id of the phone/fax number
     * @return void
     */
    public function admin_edit_numero($id = null) {
        //If the number doesn't exist in the database
        $bool=!$this->UserDetail->exists($id);
        //If the detail is not a number
        $bool=$bool || (!$this->UserDetail->compare($this->modelClass,$id,'type','NumeroFixe') && !$this->UserDetail->compare($this->modelClass,$id,'type','NumeroFixe') && !$this->UserDetail->compare($this->modelClass,$id,'type','NumeroFax'));
        //If the number is not active
        $bool=$bool || $this->UserDetail->compare($this->modelClass,$id,'actif_user_detail',false);
        //If $bool is true
        if($bool){
            $this->Session->setFlash(__('Ce  numéro n\'existe pas.'),'flash_warning');
            $this->redirect(array('controller'=>'users','action'=>'index'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            //If number is not valide
            if(strlen($this->request->data['UserDetail']['valeur'])<10){
                $this->Session->setFlash(__('Le numéro est invalide.'),'flash_warning');
                $this->redirect($this->referer());
            }
            //If the phone/fax number has been saved in the database
            if ($this->UserDetail->save($this->request->data)) {
                $this->Session->setFlash(__('Le numéro a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'users','action' => 'view',$this->request->data['UserDetail']['user_id']));
            } else {
                $this->Session->setFlash(__('Le numéro n\'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array('conditions' => array('UserDetail.' . $this->UserDetail->primaryKey => $id));
            $this->request->data = $this->UserDetail->find('first', $options);
        }
    }

    /**
     * admin_delete_adresse method - Turns the 'actif' field to false of the address
     *
     * @param string $key - the key shared by informations of the address
     * @return void
     */
    public function admin_delete_adresse($key = null) {
        //If the address is not active
        if($this->UserDetail->verifyAddress($key,null,false)){
            $this->Session->setFlash(__('Cette adresse n\'existe pas.'),'flash_warning');
            $this->redirect($this->referer());
        }
        $this->request->onlyAllow('post', 'delete');
        $sql="update user_details as Ud set Ud.actif_user_detail = false where Ud.key = '".$key."';";
        //Execute the query
        $result=$this->UserDetail->query($sql);
        //If the request worked
        if (empty($result)) {
            $this->Session->setFlash(__('L\'adresse a été supprimé.'),'flash_success');
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('L\'adresse n\'a pas été supprimé.'),'flash_error');
    }

    /**
     * admin_delete_email method - Turns the 'actif' field to false of the email
     *
     * @param string $id - Identifiant de l'email à supprimer
     * @return void
     */
    public function admin_delete_email($id = null) {
        $this->UserDetail->id = $id;
        //If the email doesn't exist or if the detail is not an email or if the email is not active
        if (!$this->UserDetail->exists() || !$this->UserDetail->compare($this->modelClass,$id,'type','Email') || $this->UserDetail->compare($this->modelClass,$id,'actif_user_detail',false)) {
            $this->Session->setFlash(__('Cette email n\'existe pas.'),'flash_warning');
            $this->redirect($this->referer());
        }
        $this->request->onlyAllow('post', 'delete');
        //If the 'actif' field has changed to false
        if ($this->UserDetail->saveField('actif_user_detail', false)) {
            $this->Session->setFlash(__('L\'email a été supprimé.'),'flash_success');
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('L\'email n\'a pas été supprimé.'),'flash_error');
    }

    /**
     * admin_delete_numero method - Turns the 'actif' field to false of the phone/fax number
     *
     * @param string $id - Id of the phone/fax number
     * @return void
     */
    public function admin_delete_numero($id = null) {
        $this->UserDetail->id = $id;
        //If the number doesn't exist in the database
        $bool=!$this->UserDetail->exists($id);
        //If the detail is not a number
        $bool=$bool || (!$this->UserDetail->compare($this->modelClass,$id,'type','NumeroFixe') && !$this->UserDetail->compare($this->modelClass,$id,'type','NumeroMobile') && !$this->UserDetail->compare($this->modelClass,$id,'type','NumeroFax'));
        //If the number is not active
        $bool=$bool || $this->UserDetail->compare($this->modelClass,$id,'actif_user_detail',false);
        //If the $bool is true
        if($bool){
            $this->Session->setFlash(__('Ce numéro n\'existe pas.'),'flash_warning');
            $this->redirect($this->referer());
        }
        $this->request->onlyAllow('post', 'delete');
        //If the 'actif' field has changed to false
        if ($this->UserDetail->saveField('actif_user_detail', false)) {
            $this->Session->setFlash(__('Le numéro a été supprimé.'),'flash_success');
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Le numéro n\'a pas été supprimé.'),'flash_error');
    }
}
