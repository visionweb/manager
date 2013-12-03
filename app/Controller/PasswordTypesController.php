<?php
/**
 * Created by JetBrains PhpStorm.
 * User: visionweb
 * Date: 12/07/13
 * Time: 11:38
 * To change this template use File | Settings | File Templates.
 */
class PasswordTypesController extends AppController{

    public function admin_index() {
        $options=array(
            'fields' => array('id','label','active_password_type'),
            'recursive' => -1,
            'order'=> array('created'=>'desc'),
            'limit'=>10
        );
        $this->Paginator->settings = $options;
        $passwordTypes = $this->Paginator->paginate();
        $this->set(compact('passwordTypes'));
    }

    public function admin_switchActive($id,$flag = null){
        $this->PasswordType->id = $id;
        if(!$this->PasswordType->exists()){
            $this->Session->setFlash(__('Ce type n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        if($flag){
            if($this->PasswordType->saveField('active_password_type', false)){
                $this->Session->setFlash(__('Le type a été désactivé'),'flash_success');
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Erreur dans la désactivation du type'),'flash_error');
            $this->redirect(array('action' => 'index'));
        }
        else{
            if($this->PasswordType->saveField('active_password_type', true)){
                $this->Session->setFlash(__('Le type a été activé'),'flash_success');
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Erreur dans l\'activation du type'),'flash_error');
            $this->redirect(array('action' => 'index'));
        }
    }

    public function admin_add(){
        if ($this->request->is('post')){
            //Vérifie qu'aucun type porte le même nom
            if (count($this->PasswordType->find('list',array(
                    'recursive'=>-1,
                    'conditions'=> array(
                        'label'=>$this->request->data['PasswordType']['label'])
                )))>0
            ){
                $this->Session->setFlash(__('Un type porte déjà le même nom. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
            if ($this->PasswordType->save($this->request->data)) {
                $this->Session->setFlash(__('Le type a été crée'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le type n\'a pas été crée.'),'flash_error');
            }
        }
    }

    public function admin_edit($id){
        if (!$this->PasswordType->exists($id) || $this->PasswordType->compare($this->modelClass,$id,'active_password_type',false)) {
            $this->Session->setFlash(__('Ce type n\'existe pas ou est désactivé.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            //Vérifie qu'aucun type porte le même nom
            if (count($this->PasswordType->find('list',array(
                    'recursive'=>-1,
                    'conditions'=> array(
                        'label'=>$this->request->data['PasswordType']['label'],
                        'NOT'=>array('id'=>$id))
                )))>0
            ){
                $this->Session->setFlash(__('Un type porte déjà le même nom. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
            //If the actuality has been saved in the database
            if ($this->PasswordType->save($this->request->data)) {
                $this->Session->setFlash(__('Le nom a été sauvegardé.'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le nom n\'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array(
                'conditions' => array('PasswordType.' . $this->PasswordType->primaryKey => $id),
                'recursive' => -1
            );
            $this->request->data = $this->PasswordType->find('first', $options);
        }
    }
}