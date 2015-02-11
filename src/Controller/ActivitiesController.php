<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Activities Controller
 *
 * @property \App\Model\Table\ActivitiesTable $Activities
 */
class ActivitiesController extends AppController
{
    public function top()
    {
        $this->index();
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Members']
        ];
        //$this->set('activities', $this->paginate($this->Activities));
        $this->set('activities', $this->paginate($this->Activities->find()->order(['Activities.created' => 'DESC'])));
        $this->set('_serialize', ['activities']);
    }

    /**
     * View method
     *
     * @param string|null $id Activity id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $history = $this->Activities->get($id, [
            'contain' => ['Members']
        ]);
        $this->set('history', $history);
        $this->set('_serialize', ['history']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $history = $this->Activities->newEntity();
        if ($this->request->is('post')) {
            $history = $this->Activities->patchEntity($history, $this->request->data);
            if ($this->Activities->save($history)) {
                $this->Flash->success('The history has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The history could not be saved. Please, try again.');
            }
        }
        $members = $this->Activities->Members->find('list', ['limit' => 200]);
        $this->set(compact('history', 'members'));
        $this->set('_serialize', ['history']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Activity id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $history = $this->Activities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $history = $this->Activities->patchEntity($history, $this->request->data);
            if ($this->Activities->save($history)) {
                $this->Flash->success('The history has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The history could not be saved. Please, try again.');
            }
        }
        $members = $this->Activities->Members->find('list', ['limit' => 200]);
        $this->set(compact('history', 'members'));
        $this->set('_serialize', ['history']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Activity id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $history = $this->Activities->get($id);
        if ($this->Activities->delete($history)) {
            $this->Flash->success('The history has been deleted.');
        } else {
            $this->Flash->error('The history could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
