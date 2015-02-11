<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Sexes Controller
 *
 * @property \App\Model\Table\SexesTable $Sexes
 */
class SexesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('sexes', $this->paginate($this->Sexes));
        $this->set('_serialize', ['sexes']);
    }

    /**
     * View method
     *
     * @param string|null $id Sex id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sex = $this->Sexes->get($id, [
            'contain' => ['MemberHistories', 'Members']
        ]);
        $this->set('sex', $sex);
        $this->set('_serialize', ['sex']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sex = $this->Sexes->newEntity();
        if ($this->request->is('post')) {
            $sex = $this->Sexes->patchEntity($sex, $this->request->data);
            if ($this->Sexes->save($sex)) {
                $this->Flash->success('The sex has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The sex could not be saved. Please, try again.');
            }
        }
        $this->set(compact('sex'));
        $this->set('_serialize', ['sex']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Sex id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sex = $this->Sexes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sex = $this->Sexes->patchEntity($sex, $this->request->data);
            if ($this->Sexes->save($sex)) {
                $this->Flash->success('The sex has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The sex could not be saved. Please, try again.');
            }
        }
        $this->set(compact('sex'));
        $this->set('_serialize', ['sex']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Sex id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sex = $this->Sexes->get($id);
        if ($this->Sexes->delete($sex)) {
            $this->Flash->success('The sex has been deleted.');
        } else {
            $this->Flash->error('The sex could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
