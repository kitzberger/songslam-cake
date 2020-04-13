<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Slams Controller
 *
 * @property \App\Model\Table\SlamsTable $Slams
 *
 * @method \App\Model\Entity\Slam[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SlamsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['index', 'view']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $slams = $this->paginate($this->Slams);

        $this->set(compact('slams'));
    }

    /**
     * View method
     *
     * @param string|null $id Slam id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $slam = $this->Slams->get($id, [
            'contain' => ['Users', 'Tags', 'Dates'],
        ]);

        $this->set('slam', $slam);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $slam = $this->Slams->newEmptyEntity();
        if ($this->request->is('post')) {
            $slam = $this->Slams->patchEntity($slam, $this->request->getData());
            if ($this->Slams->save($slam)) {
                $this->Flash->success(__('The slam has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The slam could not be saved. Please, try again.'));
        }
        $users = $this->Slams->Users->find('list', ['limit' => 200]);
        $tags = $this->Slams->Tags->find('list', ['limit' => 200]);
        $this->set(compact('slam', 'users', 'tags'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Slam id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $slam = $this->Slams->get($id, [
            'contain' => ['Tags'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $slam = $this->Slams->patchEntity($slam, $this->request->getData());
            if ($this->Slams->save($slam)) {
                $this->Flash->success(__('The slam has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The slam could not be saved. Please, try again.'));
        }
        $users = $this->Slams->Users->find('list', ['limit' => 200]);
        $tags = $this->Slams->Tags->find('list', ['limit' => 200]);
        $this->set(compact('slam', 'users', 'tags'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Slam id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $slam = $this->Slams->get($id);
        if ($this->Slams->delete($slam)) {
            $this->Flash->success(__('The slam has been deleted.'));
        } else {
            $this->Flash->error(__('The slam could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
