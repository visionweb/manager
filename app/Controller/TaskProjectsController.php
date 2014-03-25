<?php
/**
 * Created by JetBrains PhpStorm.
 * User: visionweb
 * Date: 11/07/13
 * Time: 12:07
 * To change this template use File | Settings | File Templates.
 */
class TaskProjectsController extends AppController {

    public function admin_index(){
        $options=array(
            'fields' => array('id','label','active_task_project'),
            'recursive' => -1,
            'order'=> array('created'=>'desc'),
            'limit'=>10
        );
        $this->Paginator->settings = $options;
        $taskProjects = $this->Paginator->paginate();
        $this->set(compact('taskProjects'));
        $this->set('title','Liste des projets');
    }

    public function admin_edit($id=null){
        if (!$this->TaskProject->exists($id) || $this->TaskProject->compare($this->modelClass,$id,'active_task_project',false)) {
            $this->Session->setFlash(__('Ce projet n\'existe pas ou est désactivé.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            //Vérifie qu'aucun projet porte le même nom
            if (count($this->TaskProject->find('list',array(
                    'recursive'=>-1,
                    'conditions'=> array(
                        'label'=>$this->request->data['TaskProject']['label'],
                        'NOT'=>array('id'=>$id))
                )))>0
            ){
                $this->Session->setFlash(__('Un projet porte déjà le même nom. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
            //If the project has been saved in the database
            if ($this->TaskProject->save($this->request->data)) {
                $this->Session->setFlash(__('Le projet a été sauvegardé.'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le projet n\'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array(
                'conditions' => array('TaskProject.' . $this->TaskProject->primaryKey => $id),
                'recursive' => -1
            );
            $this->request->data = $this->TaskProject->find('first', $options);
        }
        $this->set('title','Liste des projets');
        $this->set('legend','Modifier ce projet');
    }

    public function admin_add(){
        if ($this->request->is('post')){
            //Vérifie qu'aucun projet porte le même nom
            if (count($this->TaskProject->find('list',array(
                    'recursive'=>-1,
                    'conditions'=> array(
                        'label'=>$this->request->data['TaskProject']['label'])
                )))>0
            ){
                $this->Session->setFlash(__('Un projet porte déjà le même nom. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
            if ($this->TaskProject->save($this->request->data)) {
                $this->Session->setFlash(__('Le projet a été crée'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le projet n\'a pas été crée.'),'flash_warning');
            }
        }
        $this->set('title','Liste des projets');
        $this->set('legend','Ajouter un projet');
    }

    public function admin_switchActive($id,$flag = null){
        $this->TaskProject->id = $id;
        if(!$this->TaskProject->exists()){
            $this->Session->setFlash(__('Ce projet n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        if($flag){  //Si le projet est activé
            if($this->TaskProject->saveField('active_task_project', false)){
                $this->Session->setFlash(__('Le projet a été désactivé'),'flash_success');
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Erreur dans la désactivation du projet'),'flash_error');
            $this->redirect(array('action' => 'index'));
        }
        else{   //Sinon s'il est désactivé
            if($this->TaskProject->saveField('active_task_project', true)){
                $this->Session->setFlash(__('Le projet a été activé'),'flash_success');
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Erreur dans l\'activation du projet'),'flash_error');
            $this->redirect(array('action' => 'index'));
        }
    }
}
