<?php
declare(strict_types=1);

namespace App\Controller;

use App\Form\SlamSuggestForm;
use Cake\ORM\Query;

/**
 * Slams Controller
 *
 * @property \App\Model\Table\SlamsTable $Slams
 *
 * @method \App\Model\Entity\Slam[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SlamsController extends AppController
{
    protected $allowedActionsForAnybody      = ['index', 'view', 'map', 'suggest', 'xml'];
    protected $allowedActionsForRegularUsers = ['index', 'view', 'map', 'add', 'edit', 'delete', 'xml'];

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
                'Slams.sleeping' => false,
            ];
        }

        $this->paginate = [
            'contain' => ['Users'],
            'order' => ['Slams.state ASC', 'Slams.city ASC'],
            'conditions' => $conditions,
        ];

        $slams = $this->paginate($this->Slams);

        $this->set(compact('slams', 'sword', 'state', 'sleeping'));
    }

    /**
     * Map method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function map()
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
                'Slams.sleeping' => false,
            ];
        }

        $this->paginate = [
            'limit' => 200,
            'contain' => ['Users'],
            'order' => ['Slams.state ASC', 'Slams.city ASC'],
            'conditions' => $conditions,
        ];

        $slams = $this->paginate($this->Slams);

        $this->set(compact('slams', 'sword', 'state', 'sleeping'));
    }

    /**
     * Xml method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function xml()
    {
        $this->viewBuilder()->setLayout('sitemap');
        $this->RequestHandler->respondAs('xml');

        $slams = $this->Slams
            ->find()
            ->where([
                'Slams.sleeping' => false,
            ])
            ->contain([
                'Dates' => function (Query $q) {
                    return $q->where(['Dates.starttime >' => new \DateTime()]);
                }
            ]);

        $this->set(compact('slams'));
    }

    /**
     * View method
     *
     * @param string|null $slug Slam slug.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $relations = ['Users', 'Tags', 'Dates', 'Files'];

        if (is_numeric($slug)) {
            $slam =  $this->Slams->get($slug)->contain($relations);
        } else {
            $slam = $this->Slams->findBySlug($slug)->contain($relations)->firstOrFail();
        }

        $this->set('slam', $slam);
    }

    public function suggest()
    {
        $contact = new SlamSuggestForm();
        if ($this->request->is('post')) {
            if ($contact->execute($this->request->getData())) {
                $this->Flash->success('We will get back to you soon.');
            } else {
                $this->Flash->error('There was a problem submitting your form.');
            }
        }

        $this->set('contact', $contact);
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
                $this->informAdmin(__('New slam has been added'), $this->request->getData());
                $this->Flash->success(__('The slam has been saved.'));

                if ($this->request->getData('saveAndAddDates')) {
                    return $this->redirect(['controller' => 'Dates', 'action' => 'add', '?' => ['slam_id' => $slam->id]]);
                } else {
                    return $this->redirect(['action' => 'index']);
                }
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
        $query = $this->Slams->find('all', ['contain' => 'Tags'])
            ->where(['Slams.id' => $id]);

        if ($this->user->admin === false) {
            $user_id = $this->user->id;
            $query->matching('Users', function ($q) use ($user_id) {
                return $q->where(['SlamsUsers.user_id' => $user_id]);
            });
        };

        $slam = $query->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $slam = $this->Slams->patchEntity($slam, $this->request->getData());
            if ($this->Slams->save($slam)) {
                $this->informAdmin(__('Slam has been edited'), $this->request->getData());
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
        $query = $this->Slams->find('all', ['contain' => 'Tags'])
            ->where(['Slams.id' => $id]);

        if ($this->user->admin === false) {
            $user_id = $this->user->id;
            $query->matching('Users', function ($q) use ($user_id) {
                return $q->where(['SlamsUsers.user_id' => $user_id]);
            });
        };

        $slam = $query->firstOrFail();

        $this->request->allowMethod(['post', 'delete']);
        if ($this->Slams->delete($slam)) {
            $this->informAdmin(
                __('Slam has been deleted'),
                [
                    'slam' => $slam->title,
                    'user' => $this->user->email,
                ]
            );
            $this->Flash->success(__('The slam has been deleted.'));
        } else {
            $this->Flash->error(__('The slam could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
