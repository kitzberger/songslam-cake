<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;
use Cake\Http\Exception\ForbiddenException;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    protected $allowedActionsForAnybody      = [];
    protected $allowedActionsForRegularUsers = [];

    protected $user;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication');

        $this->viewBuilder()->setHelpers(['CkEditor.Ck']);

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated($this->allowedActionsForAnybody);

        $this->user = $this->Authentication->getIdentity();
        $action = $this->getRequest()->getParam('action');

        if (in_array($action, $this->allowedActionsForAnybody)) {
            #$this->Flash->success('Allowed because this action is for anybody');
            return;
        }

        if (empty($this->user)) {
            $this->Flash->error('Please log in!');
            $this->redirect(['controller' => 'Users', 'action' => 'login']);
            return;
        }

        // you're admin? -> fine.
        if ($this->user->admin) {
            #$this->Flash->success('Allowed because you\'re an admin');
            return;
        }

        if ($this->allowedActionsForRegularUsers === ['*']) {
            #$this->Flash->success('Allowed because all actions are for logged in users');
            return;
        }

        // you wanna access an actions for regular users? -> fine.
        if (in_array($action, $this->allowedActionsForRegularUsers)) {
            #$this->Flash->success('Allowed because this action is for logged in users');
            return;
        }

        // you're not admin and wanna access other actions? -> nope.
        throw new ForbiddenException('Not authorized!');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\EventInterface $event The beforeRender event.
     * @return void
     */
    public function beforeRender(\Cake\Event\EventInterface $event)
    {
        $this->set('controller', $this->request->getParam('controller'));
        $this->set('action',     $this->request->getParam('action'));
        $this->set('_csrfToken', $this->request->getAttribute('csrfToken'));

        if (isset($this->Authentication)) {
            $currentUser = $this->Authentication->getIdentity();
            $this->set('currentUser', $currentUser);
        }
    }
}
