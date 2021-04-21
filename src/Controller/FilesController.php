<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 *
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilesController extends AppController
{
    protected $allowedActionsForAnybody      = [];
    protected $allowedActionsForRegularUsers = ['index', 'view'];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $sword = $this->request->getQuery('sword') ?: '';

        $this->paginate = [
            'contain' => ['Users', 'Slams', 'Dates'],
            'order' => ['Files.modified DESC'],
            'conditions' => ['Files.title LIKE' => '%'.$sword.'%'],
        ];
        $files = $this->paginate($this->Files);

        $this->set(compact('files', 'sword'));
    }

    /**
     * View method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => ['Users', 'Dates', 'Slams'],
        ]);

        $this->set('file', $file);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $file = $this->Files->newEmptyEntity();

        if ($this->request->is('post')) {
            try {
                $fileInfo = $this->storeFile();
            } catch (\Exception $e) {
                $fileInfo = false;
                $this->Flash->error(__('File upload failed! Message:') . ' ' . $e->getMessage());
            }
            if ($fileInfo) {
                #debug($this->request->getData());
                $file = $this->Files->patchEntity($file, $this->request->getData());
                #debug($fileInfo);
                $file = $this->Files->patchEntity($file, $fileInfo);
                #debug($file);
                die('x');
                if ($this->Files->save($file)) {
                    $this->Flash->success(__('The file has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The file could not be saved. Please, try again.'));
                }
            }
        }

        $dates = $this->Files->Dates->find('list', [
            'contain' => ['Slams'],
            'order' => ['Slams.city'],
            'valueField' => function ($date) {
                return $date->slam->city . ' (' . $date->slam->venue . '): ' . $date->slam->title . ' - ' . ($date->starttime ? $date->starttime->format('Y-m-d') : $date->id);
            }
        ]);

        $slams = $this->Files->Slams->find('list', [
            'order' => ['Slams.city'],
            'valueField' => function ($slam) {
                return $slam->city . ' (' . $slam->venue . '): ' . $slam->title;
            }
        ]);

        $this->set(compact('file', 'users', 'dates', 'slams'));
    }

    /**
     * Edit method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => ['Dates', 'Slams'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $file = $this->Files->patchEntity($file, $this->request->getData());
            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The file could not be saved. Please, try again.'));
        }

        $users = $this->Files->Users->find('list', ['limit' => 200]);

        $dates = $this->Files->Dates->find('list', [
            'contain' => ['Slams'],
            'order' => ['Slams.city'],
            'valueField' => function ($date) {
                return $date->slam->city . ' (' . $date->slam->venue . '): ' . $date->slam->title . ' - ' . ($date->starttime ? $date->starttime->format('Y-m-d') : $date->id);
            }
        ]);

        $slams = $this->Files->Slams->find('list', [
            'order' => ['Slams.city'],
            'valueField' => function ($slam) {
                return $slam->city . ' (' . $slam->venue . '): ' . $slam->title;
            }
        ]);

        $this->set(compact('file', 'users', 'dates', 'slams'));
    }

    /**
     * Delete method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $file = $this->Files->get($id);
        if ($this->Files->delete($file)) {
            $this->Flash->success(__('The file has been deleted.'));
        } else {
            $this->Flash->error(__('The file could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function upload()
    {
        $file = $this->Files->newEmptyEntity();

        if ($this->request->is('post')) {
            try {
                $fileInfo = $this->storeFile();
            } catch (\Exception $e) {
                $fileInfo = false;
                $this->set('error', __('File upload failed! Message:') . ' ' . $e->getMessage());
                $this->response->header('HTTP/1.1 500', 'Internal Server Error');
            }

            if ($fileInfo) {
                #debug($this->request->getData());
                $file = $this->Files->patchEntity($file, $this->request->getData());
                #debug($fileInfo);
                $file = $this->Files->patchEntity($file, $fileInfo);
                #debug($file);
                if ($this->Files->save($file)) {
                    $this->set('file', $file->id);
                    if ($file->slams) {
                        $this->set('slams', array_column($file->slams, 'id'));
                    }
                    if ($file->dates) {
                        $this->set('dates', array_column($file->dates, 'id'));
                    }
                } else {
                    $this->set('error', __('The file could not be saved. Please, try again.'));
                    $this->response->header('HTTP/1.1 500', 'Internal Server Error');
                }
            }
        }

        $this->set('_serialize', ['file', 'slams', 'dates', 'error', 'suggestions']);
    }

    /**
     * @param string $fileVariable a key of $_FILES
     * @return array
     * @throws \Exception
     */
    protected function storeFile($fileVariable = 'file')
    {
        $errors = [];

        $fileobject = $this->request->getData($fileVariable);
        if ($fileobject) {
            $fileNameFull = $fileobject->getClientFilename();
            $fileName = pathinfo($fileNameFull, PATHINFO_FILENAME);
            $fileExtension = strtolower(pathinfo($fileNameFull, PATHINFO_EXTENSION));
            $destination = 'uploads' . DS . $fileName . '.' . $fileExtension;

            $counter = 0;
            while (file_exists($destination)) {
                $counter++;
                $fileNameFull = $fileName . '-' . $counter . '.' . $fileExtension;
                $destination = 'uploads' . DS . $fileNameFull;
                if ($counter > 99) {
                    $errors[] = 'Too many iterations when finding a good filename!';
                    break;
                }
            }

            $fileobject->moveTo($destination);
        } else {
            $errors[] = 'No file uploaded.';
        }

        if (count($errors)) {
            throw new \Exception(join(', ', $errors));
        } else {
            return [
                'title' => $fileName . '.' . $fileExtension,
                'file' => $fileNameFull,
            ];
        }
    }
}
