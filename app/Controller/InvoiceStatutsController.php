<?php
/**
 * Created by JetBrains PhpStorm.
 * User: visionweb
 * Date: 01/07/13
 * Time: 10:39
 * To change this template use File | Settings | File Templates.
 */

class InvoiceStatutsController extends AppController{

    public function admin_index() {
        $options=array(
            'fields' => array('id','label','active_invoice_statut'),
            'recursive' => -1,
            'order'=> array('created'=>'desc'),
            'limit'=>10
        );
        $this->Paginator->settings = $options;
        $invoiceStatuts = $this->Paginator->paginate();
        $this->set(compact('invoiceStatuts'));
    }

    public function admin_switchActive($id,$flag = null){
        $this->InvoiceStatut->id = $id;
        if(!$this->InvoiceStatut->exists()){
            $this->Session->setFlash(__('Ce statut n\'existe pas.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        if($flag){
            if($this->InvoiceStatut->saveField('active_invoice_statut', false)){
                $this->Session->setFlash(__('Le statut a été désactivé'),'flash_success');
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Erreur dans la désactivation du statut'),'flash_error');
            $this->redirect(array('action' => 'index'));
        }
        else{
            if($this->InvoiceStatut->saveField('active_invoice_statut', true)){
                $this->Session->setFlash(__('Le statut a été activé'),'flash_success');
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Erreur dans l\'activation du statut'),'flash_error');
            $this->redirect(array('action' => 'index'));
        }
    }

    public function admin_add(){
        if ($this->request->is('post')){
            //Vérifie qu'aucun statut porte le même nom
            if (count($this->InvoiceStatut->find('list',array(
                    'recursive'=>-1,
                    'conditions'=> array(
                        'label'=>$this->request->data['InvoiceStatut']['label'])
                )))>0
            ){
                $this->Session->setFlash(__('Un statut porte déjà le même nom. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
            if ($this->InvoiceStatut->save($this->request->data)) {
                $this->Session->setFlash(__('Le statut a été crée'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le statut n\'a pas été crée.'),'flash_error');
            }
        }
    }

    public function admin_edit($id){
        if (!$this->InvoiceStatut->exists($id) || $this->InvoiceStatut->compare($this->modelClass,$id,'active_invoice_statut',false)) {
            $this->Session->setFlash(__('Ce statut n\'existe pas ou est désactivé.'),'flash_warning');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            //Vérifie qu'aucun statut porte le même nom
            if (count($this->InvoiceStatut->find('list',array(
                    'recursive'=>-1,
                    'conditions'=> array(
                        'label'=>$this->request->data['InvoiceStatut']['label'],
                        'NOT'=>array('id'=>$id))
                )))>0
            ){
                $this->Session->setFlash(__('Un statut porte déjà le même nom. Veuillez changer'),'flash_warning');
                $this->redirect($this->referer());
            }
            //If the statut has been saved in the database
            if ($this->InvoiceStatut->save($this->request->data)) {
                $this->Session->setFlash(__('Le nom a été sauvegardé.'),'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le nom n\'a pas été sauvegardé.'),'flash_error');
            }
        } else {
            $options = array(
                'conditions' => array('InvoiceStatut.' . $this->InvoiceStatut->primaryKey => $id),
                'recursive' => -1
            );
            $this->request->data = $this->InvoiceStatut->find('first', $options);
        }
    }
}