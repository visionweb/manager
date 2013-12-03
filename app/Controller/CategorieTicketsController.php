<?php
App::uses('AppController', 'Controller');
/**
 * CategorieTickets Controller
 *
 * @property CategorieTicket $CategorieTicket
 */
class CategorieTicketsController extends AppController {

/**
 * admin_index method - Display categories of tickets
 *
 * @return void
 */
	public function admin_index() {
        //Define options for the request
        $options=array(
            'recursive'=>0,
            'conditions'=>array('actif_cat_ticket'=>true),
            'order'=>array('titre_categorie'=>'asc')
        );
        $this->paginate=$options;
		$this->set('categorieTickets', $this->paginate());
	}

/**
 * admin_add method - Add a category in the database
 *
 * @return void
 */
	public function admin_add() {
        //If there is data send by a form
		if ($this->request->is('post')) {
            //Vérifie qu'aucune categorie porte le même nom
            if (count($this->CategorieTicket->find('list',array(
                    'recursive'=>-1,
                    'conditions'=> array(
                        'titre_categorie'=>$this->request->data['CategorieTicket']['titre_categorie'],
                        'actif_cat_ticket'=>true)
                )))>0
            ){
                $this->Session->setFlash(__('Une categorie porte déjà le même nom. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
			$this->CategorieTicket->create();
            //If the category has been saved
			if ($this->CategorieTicket->save($this->request->data)) {
				$this->Session->setFlash(__('La catégorie a été sauvegardé.'),'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La catégorie n\'a pas été sauvegardé.'),'flash_error');
			}
		}
	}


    /**
     * admin_view method - Display a category with more details
     *
     * @param string $id - Id of the category
     * @return void
     */
    public function admin_view($id = null) {
        //If the category doesn't exist or if the category is not active
        if (!$this->CategorieTicket->exists($id) || $this->CategorieTicket->compare($this->modelClass,$id,'actif_cat_ticket',false)) {
            $this->Session->setFlash(__('Cette catégorie n\'existe pas.'),'flash_warning');
            $this->redirect(array('controller'=>'categorieTickets','action'=>'index'));
        }
        $options = array(
            'recursive'=>2,
            'fields'=>array(
                'CategorieTicket.id',
                'CategorieTicket.titre_categorie',
            ),
            'conditions' => array(
                'CategorieTicket.' . $this->CategorieTicket->primaryKey => $id,
            ),
        );
        $this->set('categorieTicket', $this->CategorieTicket->find('first', $options));
    }

/**
 * admin_edit method - Edit a category
 *
 * @param string $id - Id of the category
 * @return void
 */
	public function admin_edit($id = null) {
        //If the category doesn't exist or if the category is not active
		if (!$this->CategorieTicket->exists($id) || $this->CategorieTicket->compare($this->modelClass,$id,'actif_cat_ticket',false)) {
			$this->Session->setFlash(__('Cette catégorie n\'existe pas.'),'flash_warning');
            $this->redirect(array('controller'=>'categorieTickets','action'=>'index'));
		}
        //If there is data send by a form
		if ($this->request->is('post') || $this->request->is('put')) {
            //Vérifie qu'aucune categorie porte le même nom
            if (count($this->CategorieTicket->find('list',array(
                    'recursive'=>-1,
                    'conditions'=> array(
                        'titre_categorie'=>$this->request->data['CategorieTicket']['titre_categorie'],
                        'actif_cat_ticket'=>true,
                        'NOT'=>array('id'=>$id))
                )))>0
            ){
                $this->Session->setFlash(__('Une categorie porte déjà le même nom. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
            //If the category has been saved
			if ($this->CategorieTicket->save($this->request->data)) {
				$this->Session->setFlash(__('La catégorie a été sauvegardé'),'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La catégorie n\'a pas été sauvegardé.'),'flash_error');
			}
		} else {
			$options = array('conditions' => array('CategorieTicket.' . $this->CategorieTicket->primaryKey => $id));
			$this->request->data = $this->CategorieTicket->find('first', $options);
		}
	}

/**
 * admin_delete method - Turns the 'actif' field to false
 *
 * @param string $id - Id of the category
 * @return void
 */
	public function admin_delete($id = null) {
		$this->CategorieTicket->id = $id;
        //If the category exists doesn't exist or if the category is not active
		if (!$this->CategorieTicket->exists() || $this->CategorieTicket->compare($this->modelClass,$id,'actif_cat_ticket',false)) {
			$this->Session->setFlash(__('Cette catégorie n\'existe pas.'),'flash_warning');
            $this->redirect($this->referer());
		}
		$this->request->onlyAllow('post', 'delete');
        //If the 'actif' field has been changed
		if ($this->CategorieTicket->saveField('actif_cat_ticket',false)) {
			$this->Session->setFlash(__('La catégorie a été supprimé.'),'flash_success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('La catégorie n\'a pas été supprimé.'),'flash_error');
		$this->redirect(array('action' => 'index'));
	}
}
