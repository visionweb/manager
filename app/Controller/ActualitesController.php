<?php
App::uses('AppController', 'Controller');
/**
 * Actualites Controller
 *
 * @property Actualite $Actualite
 */
class ActualitesController extends AppController {
    public $helpers = array('TinyMCE.TinyMCE');
/**
 * index method - Display the 5 latest actualities
 *
 * @return void
 */
	public function index() {
        $options=array(
            'fields'=>array('titre_actu','contenu_actu','created'),
            'recursive' => -1,
            'conditions'=>array('actif_actu'=>'1'),
            'order'=> array('created'=>'desc'),
            'limit'=>5
        );
        //Retrieves actualities
        $actualites=$this->Actualite->find('all',$options);
        //Send the data to the view
		$this->set(compact('actualites'));
		$this->set('title','Actualités');
	}


    /**
     * admin_index method - Retrieves actualities
     *
     * @return void
     */
    public function admin_index(){
        $options=array(
            'fields'=>array('id','titre_actu','created'),
            'recursive' => -1,
            'conditions'=>array('actif_actu'=>'1'),
            'order'=> array('created'=>'desc'),
            'limit'=>5
        );
        $this->paginate = $options;
        $actualites = $this->Paginator->paginate();
        $this->set(compact('actualites'));
        $this->set('title','Actualités');
    }

    /**
     * admin_add method - Add an actuality in the database
     *
     * @return void
     */
    public function admin_add() {
        //If there is data send by a form
        if ($this->request->is('post')) {
            $this->Actualite->create();
            //If the actuality has been saved in the database
            if ($this->Actualite->save($this->request->data)) {
                $this->Session->setFlash(__('L\'actualité a été sauvegardé.'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('L\'actualité n\'a pas pu être sauvegardé. Veuillez réessayer ultérieurement.'),'flash_error');
            }
        }
        $this->set('title','Actualités');
        $this->set('legend','Ajouter une actualitée');
    }

    /**
     * admin_view method - Display an actuality with more details
     *
     * @param string $id - Id of the actuality
     * @return void
     */
    public function admin_view($id = null) {
        //If the actuality doesn't exist in the database or if the actuality is not active
        if (!$this->Actualite->exists($id) || $this->Actualite->compare($this->modelClass,$id,'actif_actu',false) ){
            $this->Session->setFlash(__('Cette actualité n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        $options = array('conditions' => array('Actualite.' . $this->Actualite->primaryKey => $id));
        $this->set('actualite', $this->Actualite->find('first', $options));
    }

    /**
     * admin_edit method - Edit an actuality
     *
     * @param string $id - Id of the actuality
     * @return void
     */
    public function admin_edit($id = null) {
        //If the actuality doesn't exist in the database or if the actuality is not active
        if (!$this->Actualite->exists($id) || $this->Actualite->compare($this->modelClass,$id,'actif_actu',false)) {
            $this->Session->setFlash(__('Cette actualité n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        //If there is data send by a form
        if ($this->request->is('post') || $this->request->is('put')) {
            //If the actuality has been saved in the database
            if ($this->Actualite->save($this->request->data)) {
                $this->Session->setFlash(__('Les changements ont été sauvegardé.'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Les changements n\'ont pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array('conditions' => array('Actualite.' . $this->Actualite->primaryKey => $id));
            $this->request->data = $this->Actualite->find('first', $options);
        }
    }

    /**
     * admin_delete method - Turns the 'actif' field to false
     *
     * @param string $id - Id of the actuality
     * @return void
     */
    public function admin_delete($id = null) {
        $this->Actualite->id = $id;
        //If the actuality doesn't exist in the database or if the actuality is not active
        if (!$this->Actualite->exists() || $this->Actualite->compare($this->modelClass,$id,'actif_actu',false)) {
            $this->Session->setFlash(__('Cette actualité n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        $this->request->onlyAllow('post', 'delete');
        //If the 'actif' field has been changed
        if($this->Actualite->saveField('actif_actu', false)){
            $this->Session->setFlash(__('L\'actualité a été supprimé'),'flash_success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('L\'actualité n\'a pas été supprimé'),'flash_error');
        $this->redirect(array('action' => 'index'));
    }

}
