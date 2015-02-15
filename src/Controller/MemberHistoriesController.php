<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MemberHistories Controller
 *
 * @property \App\Model\Table\MemberHistoriesTable $MemberHistories
 */
class MemberHistoriesController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Members', 'Parts', 'MemberTypes', 'Statuses']
        ];
        $this->set('memberHistories', $this->paginate($this->MemberHistories));
        $this->set('_serialize', ['memberHistories']);
    }

    /**
     * View method
     *
     * @param string|null $id Member History id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $memberHistory = $this->MemberHistories->get($id, [
            'contain' => ['Members', 'Parts', 'MemberTypes', 'Statuses']
        ]);
        $this->set('memberHistory', $memberHistory);
        $this->set('_serialize', ['memberHistory']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $memberHistory = $this->MemberHistories->newEntity();
        if ($this->request->is('post')) {
            $memberHistory = $this->MemberHistories->patchEntity($memberHistory, $this->request->data);
            if ($this->MemberHistories->save($memberHistory)) {
                $this->Flash->success('The member history has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The member history could not be saved. Please, try again.');
            }
        }
        $members = $this->MemberHistories->Members->find('list', ['limit' => 200]);
        $parts = $this->MemberHistories->Parts->find('list', ['limit' => 200]);
        $memberTypes = $this->MemberHistories->MemberTypes->find('list', ['limit' => 200]);
        $statuses = $this->MemberHistories->Statuses->find('list', ['limit' => 200]);
        $this->set(compact('memberHistory', 'members', 'parts', 'memberTypes', 'statuses'));
        $this->set('_serialize', ['memberHistory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Member History id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $memberHistory = $this->MemberHistories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $memberHistory = $this->MemberHistories->patchEntity($memberHistory, $this->request->data);
            if ($this->MemberHistories->save($memberHistory)) {
                $this->Flash->success('The member history has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The member history could not be saved. Please, try again.');
            }
        }
        $members = $this->MemberHistories->Members->find('list', ['limit' => 200]);
        $parts = $this->MemberHistories->Parts->find('list', ['limit' => 200]);
        $memberTypes = $this->MemberHistories->MemberTypes->find('list', ['limit' => 200]);
        $statuses = $this->MemberHistories->Statuses->find('list', ['limit' => 200]);
        $this->set(compact('memberHistory', 'members', 'parts', 'memberTypes', 'statuses'));
        $this->set('_serialize', ['memberHistory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Member History id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $memberHistory = $this->MemberHistories->get($id);
        if ($this->MemberHistories->delete($memberHistory)) {
            $this->Flash->success('The member history has been deleted.');
        } else {
            $this->Flash->error('The member history could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
