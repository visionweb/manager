<?php
/**
 * Created by JetBrains PhpStorm.
 * User: visionweb
 * Date: 03/07/13
 * Time: 14:36
 * To change this template use File | Settings | File Templates.
 */
class PasswordsController extends AppController{

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function index(){
        $options=array(
            'fields'=>array('id','login','password','password_service_id','password_type_id'),
            'recursive' => 1,
            'conditions'=>array('active_password'=>true, 'group_id' =>$this->Auth->user('group_id')),
            'order'=> array('created'=>'desc'),
            'limit'=>10
        );
        $passwordService = $this->Password->PasswordService->find('list',array(
            'fields' => array('PasswordService.id', 'PasswordService.label'),
            'order'=>array('PasswordService.label'=>'asc')
        ));
        $passwordType = $this->Password->PasswordType->find('list',array(
            'fields' => array('PasswordType.id', 'PasswordType.label'),
            'order'=>array('PasswordType.label'=>'asc')
        ));

        $this->Paginator->settings = $options;
        $passwords = $this->Paginator->paginate();
        $this->set(compact('passwords','passwordService','passwordType'));
        $this->set('title','Mots de passe');
    }

    public function admin_index(){
        if($this->request->is('post') && !($this->request->data['Search']['group_id'] == '')){
            $options=array(
                'fields'=>array('id','login','password','password_service_id','password_type_id','group_id'),
                'recursive' => 1,
                'conditions'=>array('active_password'=>true, 'group_id' =>$this->request->data['Search']['group_id']),
                'order'=> array('created'=>'desc'),
                'limit'=>10
            );

        }else{
            $options=array(
                'fields'=>array('id','login','password','password_service_id','password_type_id','group_id'),
                'recursive' => 1,
                'conditions'=>array('active_password'=>true),
                'order'=> array('created'=>'desc'),
                'limit'=>10
            );
        }
        $passwordService = $this->Password->PasswordService->find('list',array(
            'fields' => array('PasswordService.id', 'PasswordService.label'),
            'order'=>array('PasswordService.label'=>'asc')
        ));
        $passwordType = $this->Password->PasswordType->find('list',array(
            'fields' => array('PasswordType.id', 'PasswordType.label'),
            'order'=>array('PasswordType.label'=>'asc')
        ));
        $groups = $this->Password->Group->find('list',array(
            'fields' => array('Group.id', 'Group.nom_group'),
            'conditions' => array('Group.actif_group' => true),
            'order'=>array('Group.nom_group'=>'asc')
        ));

        $this->Paginator->settings = $options;
        $passwords = $this->Paginator->paginate();
        $this->set(compact('passwords','passwordService','passwordType','groups'));
        $this->set('title','Mots de passe');
    }

    public function add(){
        //If there is data send by a form
        if ($this->request->is('post')) {
            $this->Password->create();
            if ($this->Password->save($this->request->data)) {
                $this->Session->setFlash(__('Le mot de passe  a été sauvegardé'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le mot de passe n\'a pas été sauvegardé.'),'flash_error');
            }
            $this->Session->setFlash(__('Aucun mot de passe crée.'),'flash_warning');
        }
        //Created a list of groups
        $passwordTypes = $this->Password->PasswordType->find('list',array(
            'fields' => array('PasswordType.id', 'PasswordType.label'),
            'conditions' => array('PasswordType.active_password_type' => true),
            'order'=>array('PasswordType.label'=>'asc')
        ));
        $passwordServices = $this->Password->PasswordService->find('list',array(
            'fields' => array('PasswordService.id', 'PasswordService.label'),
            'conditions' => array('PasswordService.active_password_service' => true),
            'order'=>array('PasswordService.label'=>'asc')
        ));
        $group_id=$this->Auth->user('group_id');
        $this->set(compact('passwordTypes','passwordServices','group_id'));
        $this->set('title','Mots de passe');
        $this->set('legend','Ajouter un mot de passe');
    }

    public function admin_add(){
        //If there is data send by a form
        if ($this->request->is('post')) {
            $this->Password->create();
            if ($this->Password->save($this->request->data)) {
                $this->Session->setFlash(__('Le mot de passe  a été sauvegardé'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le mot de passe n\'a pas été sauvegardé.'),'flash_error');
            }
            $this->Session->setFlash(__('Aucun mot de passe crée.'),'flash_warning');
        }
        //Created a list of groups
        $passwordTypes = $this->Password->PasswordType->find('list',array(
            'fields' => array('PasswordType.id', 'PasswordType.label'),
            'conditions' => array('PasswordType.active_password_type' => true),
            'order'=>array('PasswordType.label'=>'asc')
        ));
        $passwordServices = $this->Password->PasswordService->find('list',array(
            'fields' => array('PasswordService.id', 'PasswordService.label'),
            'conditions' => array('PasswordService.active_password_service' => true),
            'order'=>array('PasswordService.label'=>'asc')
        ));
        $groups = $this->Password->Group->find('list',array(
            'fields' => array('Group.id', 'Group.nom_group'),
            'conditions' => array('Group.actif_group' => true),
            'order'=>array('Group.nom_group'=>'asc')
        ));
        $this->set(compact('passwordTypes','passwordServices','groups'));
        $this->set('title','Mots de passe');
        $this->set('legend','Ajouter un mot de passe');
    }

    public function edit($id){
        if (!$this->Password->exists($id) || $this->Password->compare($this->modelClass,$id,'active_password',false)) {
            $this->Session->setFlash(__('Ce mot de passe n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Password->id=$id;
            //If the password has been saved in the database
            if ($this->Password->save($this->request->data)) {
                $this->Session->setFlash(__('Les changements ont été sauvegardé.'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Les changements n\'ont pas été sauvegardé.'),'flash_error');
            }
        }else {
            $options = array('conditions' => array('Password.' . $this->Password->primaryKey => $id),'recursive' => -1);
            $this->request->data = $this->Password->find('first', $options);
        }
        $this->set('title','Mots de passe');
        $this->set('legend','Modifier ce mot de passe');
    }

    public function admin_edit($id){
        if (!$this->Password->exists($id) || $this->Password->compare($this->modelClass,$id,'active_password',false)) {
            $this->Session->setFlash(__('Ce mot de passe n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Password->id=$id;
            //If the password has been saved in the database
            if ($this->Password->save($this->request->data)) {
                $this->Session->setFlash(__('Les changements ont été sauvegardé.'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Les changements n\'ont pas été sauvegardé.'),'flash_error');
            }
        }else {
            $groups = $this->Password->Group->find('list',array(
                'fields' => array('Group.id', 'Group.nom_group'),
                'conditions' => array('Group.actif_group' => true),
                'order'=>array('Group.nom_group'=>'asc')
            ));
            $options = array('conditions' => array('Password.' . $this->Password->primaryKey => $id),'recursive' => -1);
            $this->request->data = $this->Password->find('first', $options);
            $this->set(compact('groups'));
        }
        $this->set('title','Mots de passe');
        $this->set('legend','Modifier ce mot de passe');
    }

    public function admin_delete($id){
        $this->Password->id = $id;
        //If the actuality doesn't exist in the database or if the actuality is not active
        if (!$this->Password->exists() || $this->Password->compare($this->modelClass,$id,'active_password',false)) {
            $this->Session->setFlash(__('Ce mot de passe n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        $this->request->onlyAllow('post', 'delete');
        //If the 'actif' field has been changed
        if($this->Password->saveField('active_password', false)){
            $this->Session->setFlash(__('Le mot de passe a été supprimé'),'flash_success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Le mot de passe n\'a pas été supprimé'),'flash_error');
        $this->redirect(array('action' => 'index'));
    }

    public function delete($id){
        $this->Password->id = $id;
        //If the actuality doesn't exist in the database or if the actuality is not active
        if (!$this->Password->exists() || $this->Password->compare($this->modelClass,$id,'active_password',false)) {
            $this->Session->setFlash(__('Ce mot de passe n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        $this->request->onlyAllow('post', 'delete');
        //If the 'actif' field has been changed
        if($this->Password->saveField('active_password', false)){
            $this->Session->setFlash(__('Le mot de passe a été supprimé'),'flash_success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Le mot de passe n\'a pas été supprimé'),'flash_error');
        $this->redirect(array('action' => 'index'));
    }

}
