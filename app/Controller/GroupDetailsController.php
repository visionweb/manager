<?php
App::uses('AppController', 'Controller');
/**
 * GroupDetails Controller
 *
 * @property GroupDetail $GroupDetail
 */
class GroupDetailsController extends AppController {

    /**
     * add_adresse method - Add an adress to the group
     *
     * @return void
     */
    public function add_adresse() {
        //If there is data send by a form
        if ($this->request->is('post')) {
            $this->GroupDetail->create();
            //If the adress has been saved in the database
            if ($this->GroupDetail->saveAll($this->request->data['GroupDetail'])) {
                $this->Session->setFlash(__('L\'adresse a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'groups','action' => 'view'));
            } else {
                $this->Session->setFlash(__('L\'adresse n\'a pas été sauvegardé.'),'flash_error');
            }
        }
        $infos=array('id'=>$this->Auth->user('group_id'),'key'=>$this->GroupDetail->createKey());
        $this->set(compact('infos'));
    }

    /**
     * add_email method - Add an email to the group
     *
     * @return void
     */
    public function add_email() {
        //IF there is data send by a form
        if ($this->request->is('post')) {
            $this->GroupDetail->create();
            //If the email has been saved in the database
            if ($this->GroupDetail->save($this->request->data)) {
                $this->Session->setFlash(__('L\'email a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'groups','action' => 'view'));
            } else {
                $this->Session->setFlash(__('L\'email n\'a pas été sauvegardé.'),'flash_error');
            }
        }
        $infos=array('id'=>$this->Auth->user('group_id'));
        $this->set(compact('infos'));
    }

    /**
     * add_numero method - Add a number to the group
     *
     * @return void
     */
    public function add_numero() {
        //If there is data send by a form
        if ($this->request->is('post')) {
            if(strlen($this->request->data['GroupDetail']['valeur'])<10){
                $this->Session->setFlash(__('Le numéro est invalide.'),'flash_warning');
                $this->redirect($this->referer());
            }
            $this->GroupDetail->create();
            //If the number has been saved in the database
            if ($this->GroupDetail->save($this->request->data)) {
                $this->Session->setFlash(__('Le numéro a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'groups','action' => 'view'));
            } else {
                $this->Session->setFlash(__('Le numéro n\'a pas été sauvegardé.'),'flash_error');
            }
        }
        $infos=array('id'=>$this->Auth->user('group_id'));
        $this->set(compact('infos'));
    }

    /**
     * edit_adresse method -Edit an adress to the group
     *
     * @param string $key - the key shared by informations of the address
     * @return void
     */
    public function edit_adresse($key=null) {
        //If the address is not active or doesn't belong to this user's group
        if($this->GroupDetail->verifyAddress($key,$this->Auth->user('group_id'))){
            $this->Session->setFlash(__('Cette adresse n\'existe pas.'),'flash_warning');
            $this->redirect(array('controller'=>'groups','action'=>'view'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            //If the adress has been saved in the database
            if ($this->GroupDetail->saveAll($this->request->data)) {
                $this->Session->setFlash(__('L\'adresse a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'groups','action' => 'view'));
            } else {
                $this->Session->setFlash(__('L\'adresse n\'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array('recursive'=>-1,'conditions' => array('GroupDetail.key'=>$key));
            $this->request->data = $this->GroupDetail->find('all', $options);
        }
    }

    /**
     * edit_email method - Edit an email to the group
     *
     * @param null $id - Id of the email
     */
    public function edit_email($id = null) {
        //If the email doesn't exist in the database or if the email doesn't belongs the current user's group or if the detail is not an email or if the email is not active
        if (!$this->GroupDetail->exists($id) || !$this->GroupDetail->compare($this->modelClass,$id,'group_id',$this->Auth->user('group_id')) || !$this->GroupDetail->compare($this->modelClass,$id,'type','Email') || $this->GroupDetail->compare($this->modelClass,$id,'actif_group_detail',false)){
            $this->Session->setFlash(__('Cette email n\'existe pas.'),'flash_warning');
            $this->redirect(array('controller'=>'groups','action' => 'view'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            //If the email has been saved in the database
            if ($this->GroupDetail->save($this->request->data)) {
                $this->Session->setFlash(__('L\'email a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'groups','action' => 'view'));
            } else {
                $this->Session->setFlash(__('L\'email n\'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array('conditions' => array('GroupDetail.' . $this->GroupDetail->primaryKey => $id));
            $this->request->data = $this->GroupDetail->find('first', $options);
        }
    }

    /**
     * edit_numero method - Edit a number to the group
     *
     * @param null $id - Id of the number
     */
    public function edit_numero($id = null) {
        //If the number doesn't exist
        $bool=!$this->GroupDetail->exists($id);
        //If the number doesn't belong to the user's group
        $bool=$bool || !$this->GroupDetail->compare($this->modelClass,$id,'group_id',$this->Auth->user('group_id'));
        //If the detail is not number
        $bool=$bool || (!$this->GroupDetail->compare($this->modelClass,$id,'type','NumeroFixe') && !$this->GroupDetail->compare($this->modelClass,$id,'type','NumeroMobile') && !$this->GroupDetail->compare($this->modelClass,$id,'type','NumeroFax'));
        //If the number is not active
        $bool=$bool || $this->GroupDetail->compare($this->modelClass,$id,'actif_group_detail',false);
        //If $bool is true
        if($bool){
            $this->Session->setFlash(__('Ce numéro n\'existe pas.'),'flash_warning');
            $this->redirect(array('controller'=>'groups','action'=>'view'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            //If the number is not valide
            if(strlen($this->request->data['GroupDetail']['valeur'])<10){
                $this->Session->setFlash(__('Le numéro est invalide.'),'flash_warning');
                $this->redirect($this->referer());
            }
            //If the number has been saved in the database
            if ($this->GroupDetail->save($this->request->data)) {
                $this->Session->setFlash(__('Le numéro a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'groups','action' => 'view'));
            } else {
                $this->Session->setFlash(__('Le numéro n\'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array('conditions' => array('GroupDetail.' . $this->GroupDetail->primaryKey => $id));
            $this->request->data = $this->GroupDetail->find('first', $options);
        }
    }

     /**
     * delete_adresse method - Turns the 'actif' field to false in the database
     *
     * @param string $key - the key shared by information of the address
     * @return void
     */
    public function delete_adresse($key = null) {
        //If the address is not active or doesn't belong to the current user's group
        if($this->GroupDetail->verifyAddress($key,$this->Auth->user('group_id'))){
            $this->Session->setFlash(__('Cette adresse n\'existe pas.'),'flash_warning');
            $this->redirect($this->referer());
        }
        $this->request->onlyAllow('post', 'delete');
        //Define the query
        $sql="update group_details as GroupDetail set GroupDetail.actif_group_detail = false where GroupDetail.key = '".$key."';";
        //Execute the query
        $result=$this->GroupDetail->query($sql);
        //If the query worked
        if (empty($result)) {
            $this->Session->setFlash(__('L\'adresse a été supprimé.'),'flash_success');
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('L\'adresse n\'a pas été supprimé.'),'flash_error');
    }

    /**
     * delete_email method - Turns the 'actif' field to false in the database
     *
     * @param null $id - Id of the email
     * @return void
     */
    public function delete_email($id = null) {
        $this->GroupDetail->id = $id;
        //If the email doesn't exist in the database or if the email doesn't belong to the current user's group or if the detail is not an email or if the email is not active
        if (!$this->GroupDetail->exists() || !$this->GroupDetail->compare($this->modelClass,$id,'group_id',$this->Auth->user('group_id')) || !$this->GroupDetail->compare($this->modelClass,$id,'type','Email') || $this->GroupDetail->compare($this->modelClass,$id,'actif_group_detail',false)) {
            $this->Session->setFlash(__('Cette email n\'existe pas.'),'flash_warning');
            $this->redirect($this->referer());
        }
        $this->request->onlyAllow('post', 'delete');
        //If the 'actif' field has changed to false
        if ($this->GroupDetail->saveField('actif_group_detail', false)) {
            $this->Session->setFlash(__('L\'email a été supprimé.'),'flash_success');
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('L\'email n\'a pas été supprimé.'),'flash_error');
    }

    /**
     * delete_numero method - Turns the 'actif' field to false in the database
     *
     * @param null $id - Id of the number
     * @return void
     */
    public function delete_numero($id = null) {
        $this->GroupDetail->id = $id;
        //If the number doesn't exist
        $bool=!$this->GroupDetail->exists($id);
        //If the number doesn't belong to the user's group
        $bool=$bool || !$this->GroupDetail->compare($this->modelClass,$id,'group_id',$this->Auth->user('group_id'));
        //If the detail is not a number
        $bool=$bool || (!$this->GroupDetail->compare($this->modelClass,$id,'type','NumeroFixe') && !$this->GroupDetail->compare($this->modelClass,$id,'type','NumeroMobile') && !$this->GroupDetail->compare($this->modelClass,$id,'type','NumeroFax'));
        //If the number is not active
        $bool=$bool || $this->GroupDetail->compare($this->modelClass,$id,'actif_group_detail',false);
        //If $bool is true
        if($bool){
            $this->Session->setFlash(__('Ce numéro n\'existe pas.'),'flash_warning');
            $this->redirect($this->referer());
        }
        $this->request->onlyAllow('post', 'delete');
        //If the 'actif' field has changed to false
        if ($this->GroupDetail->saveField('actif_group_detail', false)) {
            $this->Session->setFlash(__('Le numéro a été supprimé.'),'flash_success');
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Le numéro n\'a pas été supprimé.'),'flash_error');
    }

    /**
     * admin_add_adresse method - Add an adress to the group
     *
     * @param string $id - Id of the group
     * @return void
     */
    public function admin_add_adresse($id = null) {
        //If there is data send by a form
        if ($this->request->is('post')) {
            $this->GroupDetail->create();
            //If the adress has been saved in the database
            if ($this->GroupDetail->saveAll($this->request->data['GroupDetail'])) {
                $this->Session->setFlash(__('L\'adresse a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'groups','action' => 'view',$id));
            } else {
                $this->Session->setFlash(__('L\'adresse n\'a pas été sauvegardé.'),'flash_error');
            }
        }
        $infos=array('id'=>$id,'key'=>$this->GroupDetail->createKey());
        $this->set(compact('infos'));
    }

    /**
     * admin_add_email method - Add an email to the group
     *
     * @param string $id - Id of the group
     * @return void
     */
    public function admin_add_email($id = null) {
        //If there is data send by a form
        if ($this->request->is('post')) {
            $this->GroupDetail->create();
            //If the email has been saved in the database
            if ($this->GroupDetail->save($this->request->data)) {
                $this->Session->setFlash(__('L\'email a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'groups','action' => 'view',$id));
            } else {
                $this->Session->setFlash(__('L\'email n\'a pas été sauvegardé.'),'flash_error');
            }
        }
        $infos=array('id'=>$id);
        $this->set(compact('infos'));

    }

    /**
     * admin_add_numero method - Add a number to the group
     *
     * @param string $id - Id of the group
     * @return void
     */
    public function admin_add_numero($id = null) {
        //If there is data send by a form
        if ($this->request->is('post')) {
            if(strlen($this->request->data['GroupDetail']['valeur'])<10){
                $this->Session->setFlash(__('Le numéro est invalide.'),'flash_warning');
                $this->redirect($this->referer());
            }
            $this->GroupDetail->create();
            //If the number has been saved in the database
            if ($this->GroupDetail->save($this->request->data)) {
                $this->Session->setFlash(__('Le numéro a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'groups','action' => 'view',$id));
            } else {
                $this->Session->setFlash(__('Le numéro n\'a pas été sauvegardé.'),'flash_error');
            }
        }
        $infos=array('id'=>$id);
        $this->set(compact('infos'));
    }

    /**
     * admin_edit_adresse method - Edit an adress to the group
     *
     * @param string $key - the key shared by informations of the adress
     * @return void
     */
    public function admin_edit_adresse($key=null) {
        //If the address is not active
        if($this->GroupDetail->verifyAddress($key,null,true)){
            $this->Session->setFlash(__('Cette adresse n\'existe pas.'),'flash_warning');
            $this->redirect(array('controller'=>'groups','action'=>'index'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            //If the adress has been saved in the database
            if ($this->GroupDetail->saveAll($this->request->data)) {
                $this->Session->setFlash(__('L\'adresse a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'groups','action' => 'view',$this->request->data [0]['GroupDetail']['group_id']));
            } else {
                $this->Session->setFlash(__('L\'adresse n\'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array('recursive'=>-1,'conditions' => array('GroupDetail.key'=>$key));
            $this->request->data = $this->GroupDetail->find('all', $options);
        }
    }

    /**
     * admin_edit_email method - Edit an email to the group
     *
     * @param string $id - Id of the email
     * @return void
     */
    public function admin_edit_email($id = null) {
        //If the email doesn't exist in the database or if the detail is not an email or if the email is not active
        if (!$this->GroupDetail->exists($id) || !$this->GroupDetail->compare($this->modelClass,$id,'type','Email') || $this->GroupDetail->compare($this->modelClass,$id,'actif_group_detail',false)) {
            $this->Session->setFlash(__('Cette email n\'existe pas.'),'flash_warning');
            $this->redirect(array('controller'=>'groups','action' => 'index'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            //If the email has been saved in the database
            if ($this->GroupDetail->save($this->request->data)) {
                $this->Session->setFlash(__('L\'email a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'groups','action' => 'view',$this->request->data['GroupDetail']['group_id']));
            } else {
                $this->Session->setFlash(__('L\'email n\'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array('conditions' => array('GroupDetail.' . $this->GroupDetail->primaryKey => $id));
            $this->request->data = $this->GroupDetail->find('first', $options);
        }
    }

    /**
     * admin_edit_numero method - Edit a number to the group
     *
     * @param string $id - Id of the number
     * @return void
     */
    public function admin_edit_numero($id = null) {
        //If the number doesn't exist in the database
        $bool=!$this->GroupDetail->exists($id);
        //If the detail is not a number
        $bool=$bool || (!$this->GroupDetail->compare($this->modelClass,$id,'type','NumeroFixe') && !$this->GroupDetail->compare($this->modelClass,$id,'type','NumeroMobile') && !$this->GroupDetail->compare($this->modelClass,$id,'type','NumeroFax'));
        //If the number is not active
        $bool=$bool || $this->GroupDetail->compare($this->modelClass,$id,'actif_group_detail',false);
        //If $bool is true
        if($bool){
            $this->Session->setFlash(__('Ce numéro n\'existe pas.'),'flash_warning');
            $this->redirect(array('controller'=>'groups','action'=>'index'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            //If the number is valide
            if(strlen($this->request->data['GroupDetail']['valeur'])<10){
                $this->Session->setFlash(__('Le numéro est invalide.'),'flash_warning');
                $this->redirect($this->referer());
            }
            //If the number has been saved in the database
            if ($this->GroupDetail->save($this->request->data)) {
                $this->Session->setFlash(__('Le numéro a été sauvegardé.'),'flash_success');
                $this->redirect(array('controller'=>'groups','action' => 'view',$this->request->data['GroupDetail']['group_id']));
            } else {
                $this->Session->setFlash(__('Le numéro n\'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array('conditions' => array('GroupDetail.' . $this->GroupDetail->primaryKey => $id));
            $this->request->data = $this->GroupDetail->find('first', $options);
        }
    }

    /**
     * admin_delete_adresse method - Turns the 'actif' field to false
     *
     * @param string $key - the key shared by informations of the adress
     * @return void
     */
    public function admin_delete_adresse($key = null) {
        //If the address is not active
        if($this->GroupDetail->verifyAddress($key,null,true)){
            $this->Session->setFlash(__('Cette adresse n\'existe pas.'),'flash_warning');
            $this->redirect($this->referer());
        }
        $this->request->onlyAllow('post', 'delete');
        //Set the query
        $sql="update group_details as GroupDetail set GroupDetail.actif_group_detail = false where GroupDetail.key = '".$key."';";
        //Execute the query
        $result=$this->GroupDetail->query($sql);
        //If the query worked
        if (empty($result)) {
            $this->Session->setFlash(__('L\'adresse a été supprimé.'),'flash_success');
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('L\'adresse n\'a pas été supprimé.'),'flash_error');
    }

    /**
     * admin_delete_email method - Turns the 'actif' field to false
     *
     * @param string $id - Id of the email
     * @return void
     */
    public function admin_delete_email($id = null) {
        $this->GroupDetail->id = $id;
        //If the email doesn't exist in the database or if the detail is not an email or if the email is not active
        if (!$this->GroupDetail->exists() || !$this->GroupDetail->compare($this->modelClass,$id,'type','Email') || $this->GroupDetail->compare($this->modelClass,$id,'actif_group_detail',false)) {
            $this->Session->setFlash(__('Cette email n\'existe pas.'),'flash_warning');
            $this->redirect($this->referer());
        }
        $this->request->onlyAllow('post', 'delete');
        //If the 'actif' field has changed to false
        if ($this->GroupDetail->saveField('actif_group_detail', false)) {
            $this->Session->setFlash(__('L\'email a été supprimé.'),'flash_success');
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('L\'email n\'a pas été supprimé.'),'flash_error');
    }

    /**
     * admin_delete_numero method - Turns the 'actif' field to false
     *
     * @param string $id - Id of the number
     * @return void
     */
    public function admin_delete_numero($id = null) {
        $this->GroupDetail->id = $id;
        //If the number doesn't exist
        $bool=!$this->GroupDetail->exists($id);
        //If the detail is not a number
        $bool=$bool || (!$this->GroupDetail->compare($this->modelClass,$id,'type','NumeroFixe') && !$this->GroupDetail->compare($this->modelClass,$id,'type','NumeroMobile') && !$this->GroupDetail->compare($this->modelClass,$id,'type','NumeroFax'));
        //If the number is not active
        $bool=$bool || $this->GroupDetail->compare($this->modelClass,$id,'actif_group_detail',false);
        //If $bool is true
        if($bool){
            $this->Session->setFlash(__('Ce numéro n\'existe pas.'),'flash_warning');
            $this->redirect($this->referer());
        }
        $this->request->onlyAllow('post', 'delete');
        //If the 'actif' field has changed to false
        if ($this->GroupDetail->saveField('actif_group_detail', false)) {
            $this->Session->setFlash(__('Le numéro a été supprimé.'),'flash_success');
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Le numéro n\'a pas été supprimé.'),'flash_error');
    }

}
