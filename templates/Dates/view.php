<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Date $date
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?php
                if ($currentUser) {
                    if ($currentUser->get('admin') || $date->slam->ownedBy($currentUser)) {
                        echo $this->Html->link(__('Edit Date'), ['action' => 'edit', $date->id], ['class' => 'side-nav-item']);
                        echo $this->Form->postLink(__('Delete Date'), ['action' => 'delete', $date->id], ['confirm' => __('Are you sure you want to delete # {0}?', $date->id), 'class' => 'side-nav-item']);
                        echo $this->Html->link(__('New Date'), ['action' => 'add', '?' => ['slam_id' => $date->slam_id]], ['class' => 'side-nav-item']);
                    }
                }
                echo $this->Html->link(__('List Dates'), ['action' => 'index'], ['class' => 'side-nav-item']);
            ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="dates view content">
            <h3><?= ($date->has('slam') ? h($date->slam->title) . ': ' : '') . h($date->starttime->format('d.m.Y')) . ($date->title ? ': ' . h($date->title) : '') ?></h3>
            <table>
                <tr>
                    <th><?= __('Slam') ?></th>
                    <td><?= $date->has('slam') ? $this->Html->link($date->slam->title, ['controller' => 'Slams', 'action' => 'view', $date->slam->slug]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Starttime') ?></th>
                    <td><?= h($date->starttime ? $date->starttime->format('d.m.Y H:i') : __('???')) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($date->modified->format('d.m.Y H:i')) ?></td>
                </tr>
            </table>
            <div class="files">
                <h4><?= __('Files') ?></h4>
                <?php if (!empty($date->files)) : ?>
                <div class="table-responsive">
                    <table>
                    <?php foreach ($date->files as $file) : ?>
                        <tr>
                            <th><?= h($file->title) ?></th>
                            <td><?= $this->element('files/embed', ['file' => $file]) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
                <?php
                    if ($currentUser) {
                        echo $this->element('files/upload', ['date_id' => $date->id]);
                    }
                ?>
            </div>
        </div>
    </div>
</div>
