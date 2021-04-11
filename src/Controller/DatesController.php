<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Dates Controller
 *
 * @property \App\Model\Table\DatesTable $Dates
 *
 * @method \App\Model\Entity\Date[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DatesController extends AppController
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
        $sword = $this->request->getQuery('sword') ?: '';
        $state = $this->request->getQuery('state') ?: '';
        $sleeping = $this->request->getQuery('sleeping') ?: false;

        $conditions = [];
        if ($sword) {
            $conditions[] = [
                'OR' => [
                    'Slams.title LIKE' => '%'.$sword.'%',
                    'Slams.city LIKE' => '%'.$sword.'%',
                    'Slams.venue LIKE' => '%'.$sword.'%',
                ],
            ];
        }
        if ($state) {
            $conditions[] = [
                'Slams.state' => $state,
            ];
        }
        if ($sleeping === false) {
            $conditions[] = [
                'Dates.starttime >' => new \DateTime(),
            ];
        }

        $this->paginate = [
            'sortWhitelist' => ['Dates.starttime', 'Slams.city'],
            'contain' => ['Users', 'Slams'],
            'order' => ['Dates.starttime' => 'ASC'],
            'conditions' => $conditions,
        ];

        $dates = $this->paginate($this->Dates);

        $this->set(compact('dates', 'sword', 'state', 'sleeping'));
    }

    /**
     * View method
     *
     * @param string|null $slug Date slug.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $relations = ['Users', 'Slams', 'Files'];

        if (is_numeric($slug)) {
            $date = $this->Dates->get($slug)->contain($relations);
        } else {
            $date = $this->Dates->findBySlug($slug)->contain($relations)->firstOrFail();
        }

        $this->set('date', $date);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $date = $this->Dates->newEmptyEntity();
        if ($this->request->is('post')) {
            $date = $this->Dates->patchEntity($date, $this->request->getData());
            if ($this->Dates->save($date)) {
                $this->Flash->success(__('The date has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The date could not be saved. Please, try again.'));
        }
        $users = $this->Dates->Users->find('list', ['limit' => 200]);
        $slams = $this->Dates->Slams->find('list', ['limit' => 200, 'order' => ['Slams.title ASC']]);
        $this->set(compact('date', 'users', 'slams'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Date id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $date = $this->Dates->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $date = $this->Dates->patchEntity($date, $this->request->getData());
            if ($this->Dates->save($date)) {
                $this->Flash->success(__('The date has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The date could not be saved. Please, try again.'));
        }
        $users = $this->Dates->Users->find('list', ['limit' => 200]);
        $slams = $this->Dates->Slams->find('list', ['limit' => 200]);
        $this->set(compact('date', 'users', 'slams'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Date id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $date = $this->Dates->get($id);
        if ($this->Dates->delete($date)) {
            $this->Flash->success(__('The date has been deleted.'));
        } else {
            $this->Flash->error(__('The date could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
