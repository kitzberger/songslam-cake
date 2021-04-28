<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\SlamsTable;
use Cake\ORM\Query;

/**
 * Dates Controller
 *
 * @property \App\Model\Table\DatesTable $Dates
 *
 * @method \App\Model\Entity\Date[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DatesController extends AppController
{
    protected $allowedActionsForAnybody      = ['index', 'view'];
    protected $allowedActionsForRegularUsers = ['index', 'view', 'add', 'edit', 'delete'];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $sword    = $this->request->getQuery('sword') ?: '';
        $state    = $this->request->getQuery('state') ?: '';
        $type     = $this->request->getQuery('type') ?? SlamsTable::TYPE_SONGSLAM;
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
        if ($type) {
            $conditions[] = [
                'Slams.type' => $type,
            ];
        }
        if ($sleeping === false) {
            $conditions[] = [
                'Dates.starttime >' => new \DateTime(),
            ];
        }

        $this->paginate = [
            'sortWhitelist' => ['Dates.starttime', 'Slams.city', 'Slams.venue'],
            'contain' => ['Users', 'Slams', 'Slams.Users'],
            'order' => ['Dates.starttime' => 'ASC'],
            'conditions' => $conditions,
        ];

        $dates = $this->paginate($this->Dates);

        $this->set(compact('dates', 'sword', 'state', 'type', 'sleeping'));
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
        $relations = ['Users', 'Slams', 'Slams.Users', 'Files'];

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
                $this->informAdmin(__('New date has been added'), $this->request->getData());
                $this->Flash->success(__('The date has been saved.'));

                if ($this->request->getData('saveAndNew')) {
                    return $this->redirect(['action' => 'add', '?' => ['slam_id' => $this->request->getData('slam_id')]]);
                } else {
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The date could not be saved. Please, try again.'));
        }

        $slams = $this->Dates->Slams->find('list', [
            'order' => ['Slams.city'],
            'valueField' => function ($slam) {
                return $slam->city . ' (' . $slam->venue . '): ' . $slam->title;
            }
        ]);

        if ($this->user->admin === false) {
            $user_id = $this->user->id;
            $slams->matching('Users', function (Query $q) use ($user_id) {
                return $q->where(['Users.id' => $user_id]);
            });
        }

        $this->set(compact('date', 'slams'));
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
        $query = $this->Dates->find('all')
            ->where(['Dates.id' => $id]);

        if ($this->user->admin === false) {
            $user_id = $this->user->id;
            $query->matching('Slams.Users', function ($q) use ($user_id) {
                return $q->where(['SlamsUsers.user_id' => $user_id]);
            });
        };

        $date = $query->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $date = $this->Dates->patchEntity($date, $this->request->getData());
            if ($this->Dates->save($date)) {
                $this->informAdmin(__('Date has been edited'), $this->request->getData());
                $this->Flash->success(__('The date has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The date could not be saved. Please, try again.'));
        }

        $slams = $this->Dates->Slams->find('list', [
            'order' => ['Slams.city'],
            'valueField' => function ($slam) {
                return $slam->city . ' (' . $slam->venue . '): ' . $slam->title;
            }
        ]);

        if ($this->user->admin === false) {
            $user_id = $this->user->id;
            $slams->matching('Users', function (Query $q) use ($user_id) {
                return $q->where(['Users.id' => $user_id]);
            });
        }

        $this->set(compact('date', 'slams'));
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
        $query = $this->Dates->find('all', ['contain' => 'Slams'])
            ->where(['Dates.id' => $id]);

        if ($this->user->admin === false) {
            $user_id = $this->user->id;
            $query->matching('Slams.Users', function ($q) use ($user_id) {
                return $q->where(['SlamsUsers.user_id' => $user_id]);
            });
        };

        $date = $query->firstOrFail();

        $this->request->allowMethod(['post', 'delete']);
        if ($this->Dates->delete($date)) {
            $this->informAdmin(
                __('Date has been deleted'),
                [
                    'slam' => $date->slam->title,
                    'date' => $date->starttime ? $date->starttime->format('Y-m-d') : $date->id,
                    'user' => $this->user->email,
                ]
            );
            $this->Flash->success(__('The date has been deleted.'));
        } else {
            $this->Flash->error(__('The date could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
