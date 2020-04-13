<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * SlamsTags Controller
 *
 * @property \App\Model\Table\SlamsTagsTable $SlamsTags
 *
 * @method \App\Model\Entity\SlamsTag[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SlamsTagsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Slams', 'Tags'],
        ];
        $slamsTags = $this->paginate($this->SlamsTags);

        $this->set(compact('slamsTags'));
    }

    /**
     * View method
     *
     * @param string|null $id Slams Tag id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $slamsTag = $this->SlamsTags->get($id, [
            'contain' => ['Slams', 'Tags'],
        ]);

        $this->set('slamsTag', $slamsTag);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $slamsTag = $this->SlamsTags->newEmptyEntity();
        if ($this->request->is('post')) {
            $slamsTag = $this->SlamsTags->patchEntity($slamsTag, $this->request->getData());
            if ($this->SlamsTags->save($slamsTag)) {
                $this->Flash->success(__('The slams tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The slams tag could not be saved. Please, try again.'));
        }
        $slams = $this->SlamsTags->Slams->find('list', ['limit' => 200]);
        $tags = $this->SlamsTags->Tags->find('list', ['limit' => 200]);
        $this->set(compact('slamsTag', 'slams', 'tags'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Slams Tag id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $slamsTag = $this->SlamsTags->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $slamsTag = $this->SlamsTags->patchEntity($slamsTag, $this->request->getData());
            if ($this->SlamsTags->save($slamsTag)) {
                $this->Flash->success(__('The slams tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The slams tag could not be saved. Please, try again.'));
        }
        $slams = $this->SlamsTags->Slams->find('list', ['limit' => 200]);
        $tags = $this->SlamsTags->Tags->find('list', ['limit' => 200]);
        $this->set(compact('slamsTag', 'slams', 'tags'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Slams Tag id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $slamsTag = $this->SlamsTags->get($id);
        if ($this->SlamsTags->delete($slamsTag)) {
            $this->Flash->success(__('The slams tag has been deleted.'));
        } else {
            $this->Flash->error(__('The slams tag could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
