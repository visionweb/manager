<?php
/**
 * Created by JetBrains PhpStorm.
 * User: visionweb
 * Date: 12/07/13
 * Time: 11:38
 * To change this template use File | Settings | File Templates.
 */
class PasswordServicesController extends AppController{

    public function admin_index() {
        $options=array(
            'fields' => array('id','label','active_password_service'),
            'recursive' => -1,
            'order'=> array('created'=>'desc'),
            'limit'=>10
        );
        $this->Paginator->settings = $options;
        $passwordServices = $this->Paginator->paginate();
        $this->set(compact('passwordServices'));
    }

    public function admin_switchActive($id,$flag = null){
        $this->PasswordService->id = $id;
        if(!$this->PasswordService->exists()){
            $this->Session->setFlash(__('Ce service n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        if($flag){
            if($this->PasswordService->saveField('active_password_service', false)){
                $this->Session->setFlash(__('Le service a été désactivé'),'flash_success');
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Erreur dans la désactivation du service'),'flash_error');
            $this->redirect(array('action' => 'index'));
        }
        else{
            if($this->PasswordService->saveField('active_password_service', true)){
                $this->Session->setFlash(__('Le service a été activé'),'flash_success');
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Erreur dans l\'activation du service'),'flash_error');
            $this->redirect(array('action' => 'index'));
        }
    }

    public function admin_add(){
        if ($this->request->is('post')){
            //Vérifie qu'aucun service porte le même nom
            if (count($this->PasswordService->find('list',array(
                    'recursive'=>-1,
                    'conditions'=> array(
                        'label'=>$this->request->data['PasswordService']['label'])
                )))>0
            ){
                $this->Session->setFlash(__('Un service porte déjà le même nom. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
            if ($this->PasswordService->save($this->request->data)) {
                $this->Session->setFlash(__('Le service a été crée'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le service n\'a pas été crée.'),'flash_error');
            }
        }
    }

    public function admin_edit($id){
        if (!$this->PasswordService->exists($id) || $this->PasswordService->compare($this->modelClass,$id,'active_password_service',false)) {
            $this->Session->setFlash(__('Ce service n\'existe pas ou est désactivé.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            //Vérifie qu'aucun service porte le même nom
            if (count($this->PasswordService->find('list',array(
                    'recursive'=>-1,
                    'conditions'=> array(
                        'label'=>$this->request->data['PasswordService']['label'],
                        'NOT'=>array('id'=>$id))
                )))>0
            ){
                $this->Session->setFlash(__('Un service porte déjà le même nom. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
            //If the actuality has been saved in the database
            if ($this->PasswordService->save($this->request->data)) {
                $this->Session->setFlash(__('Le nom a été sauvegardé.'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le nom n\'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array(
                'conditions' => array('PasswordService.' . $this->PasswordService->primaryKey => $id),
                'recursive' => -1
            );
            $this->request->data = $this->PasswordService->find('first', $options);
        }
    }
}