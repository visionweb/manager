<?php
/**
 * Created by JetBrains PhpStorm.
 * User: visionweb
 * Date: 11/07/13
 * Time: 12:08
 * To change this template use File | Settings | File Templates.
 */
class TaskStatutsController extends AppController {

    public function admin_index(){
        $options=array(
            'fields' => array('id','label','active_task_statut'),
            'recursive' => -1,
            'order'=> array('created'=>'desc'),
            'limit'=>10
        );
        $this->Paginator->settings = $options;
        $taskStatuts = $this->Paginator->paginate();
        $this->set(compact('taskStatuts'));
        $this->set('title','Liste des statuts');
    }

    public function admin_edit($id=null){
        if (!$this->TaskStatut->exists($id) || $this->TaskStatut->compare($this->modelClass,$id,'active_task_statut',false)) {
            $this->Session->setFlash(__('Ce statut n\'existe pas ou est désactivé.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            //Vérifie qu'aucun statut porte le même nom
            if (count($this->TaskStatut->find('list',array(
                    'recursive'=>-1,
                    'conditions'=> array(
                        'label'=>$this->request->data['TaskStatut']['label'],
                        'NOT'=>array('id'=>$id))
                )))>0
            ){
                $this->Session->setFlash(__('Un statut porte déjà le même nom. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
            //If the project has been saved in the database
            if ($this->TaskStatut->save($this->request->data)) {
                $this->Session->setFlash(__('Le statut a été sauvegardé.'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le statut n\'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array(
                'conditions' => array('TaskStatut.' . $this->TaskStatut->primaryKey => $id),
                'recursive' => -1
            );
            $this->request->data = $this->TaskStatut->find('first', $options);
        }
        $this->set('title','Liste des statuts');
        $this->set('legend','Modifier ce statut');
    }

    public function admin_add(){
        if ($this->request->is('post')){
            //Vérifie qu'aucun statut porte le même nom
            if (count($this->TaskStatut->find('list',array(
                    'recursive'=>-1,
                    'conditions'=> array(
                        'label'=>$this->request->data['TaskStatut']['label'])
                )))>0
            ){
                $this->Session->setFlash(__('Un statut porte déjà le même nom. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
            if ($this->TaskStatut->save($this->request->data)) {
                $this->Session->setFlash(__('Le statut a été crée'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le statut n\'a pas été crée.'),'flash_error');
            }
        }
        $this->set('title','Liste des statuts');
        $this->set('legend','Ajouter un statut');
    }

    public function admin_switchActive($id,$flag = null){
        $this->TaskStatut->id = $id;
        if(!$this->TaskStatut->exists()){
            $this->Session->setFlash(__('Ce statut n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        if($flag){  //Si le statut est activé
            if($this->TaskStatut->saveField('active_task_statut', false)){
                $this->Session->setFlash(__('Le statut a été désactivé'),'flash_success');
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Erreur dans la désactivation du statut'),'flash_error');
            $this->redirect(array('action' => 'index'));
        }
        else{
            if($this->TaskStatut->saveField('active_task_statut', true)){
                $this->Session->setFlash(__('Le statut a été activé'),'flash_success');
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Erreur dans l\'activation du statut'),'flash_error');
            $this->redirect(array('action' => 'index'));
        }
    }
}
