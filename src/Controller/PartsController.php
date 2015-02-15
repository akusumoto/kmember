<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Parts Controller
 *
 * @property \App\Model\Table\PartsTable $Parts
 */
class PartsController extends AppController
{

    public function detail($id = null)
    {
        $part = $this->Parts->get($id, [
            'contain' => ['MemberHistories', 'Members']
        ]);
        $this->set('part', $part);
        $this->set('_serialize', ['part']);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('parts', $this->paginate($this->Parts));
        $this->set('_serialize', ['parts']);
    }

    /**
     * View method
     *
     * @param string|null $id Part id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $part = $this->Parts->get($id, [
            'contain' => ['MemberHistories', 'Members']
        ]);
        $this->set('part', $part);
        $this->set('_serialize', ['part']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $part = $this->Parts->newEntity();
        if ($this->request->is('post')) {
            $part = $this->Parts->patchEntity($part, $this->request->data);
            if ($this->Parts->save($part)) {
                $this->Flash->success('The part has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The part could not be saved. Please, try again.');
            }
        }
        $this->set(compact('part'));
        $this->set('_serialize', ['part']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Part id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $part = $this->Parts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $part = $this->Parts->patchEntity($part, $this->request->data);
            if ($this->Parts->save($part)) {
                $this->Flash->success('The part has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The part could not be saved. Please, try again.');
            }
        }
        $this->set(compact('part'));
        $this->set('_serialize', ['part']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Part id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $part = $this->Parts->get($id);
        if ($this->Parts->delete($part)) {
            $this->Flash->success('The part has been deleted.');
        } else {
            $this->Flash->error('The part could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
