<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

?>
<!DOCTYPE html>
<html lang="<?= str_replace('_', '-', Cake\I18n\I18n::getDefaultLocale()) ?>">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= ($this->fetch('title') ? $this->fetch('title') . ' | ' : '') . 'songslams.eu' ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('milligram.min.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="/"><span>Song</span>Slams<span>.eu</span></a>
            <div>
                <?php
                    if ($currentUser) {
                        echo '<span>' . __('Logged in as: ') . $currentUser->get('email') . '</span>';
                    } else {
                        echo 'Verzeichnis europäischer SongSlam Veranstaltungen.<br>';
                        echo 'Directory of european SongSlam events.';
                    }
                ?>
            </div>
        </div>
        <div class="top-nav-links">
            <?= $this->Html->link(__('Slams'), ['controller' => 'Slams', 'action' => 'index'], ['class' => $controller=='Slams' && $action!='map'?'active':'']) ?>
            <?= $this->Html->link(__('Map'),   ['controller' => 'Slams', 'action' => 'map'],   ['class' => $controller=='Slams' && $action=='map'?'active':'']) ?>
            <?= $this->Html->link(__('Dates'), ['controller' => 'Dates', 'action' => 'index'], ['class' => $controller=='Dates'?'active':'']) ?>
            <?php
                if ($currentUser) {
                    echo $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']);
                } else {
                    echo $this->Html->link(__('Login'), ['controller' => 'Users', 'action' => 'login'], ['class' => $controller=='Users'?'active':'']);
                }
            ?>
        </div>
    </nav>
    <nav class="top-nav top-nav-2nd-row">
        <div class="top-nav-links"></div>
        <div class="top-nav-links">
            <?php
                if ($currentUser && $currentUser->admin) {
                    echo $this->Html->link(__('Users'), ['controller' => 'Users', 'action' => 'index'], ['class' => $controller==='Users'?'active':'']);
                    echo $this->Html->link(__('Tags'),  ['controller' => 'Tags',  'action' => 'index'], ['class' => $controller==='Tags'?'active':'']);
                    echo $this->Html->link(__('Files'),  ['controller' => 'Files',  'action' => 'index'], ['class' => $controller==='Files'?'active':'']);
                }
            ?>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
        <div class="container">
            <div class="row">
                <div class="column">
                    <?= $this->Html->link(__('Imprint'), ['controller' => 'Pages', 'action' => 'display', 'imprint']) ?>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
