<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Date[]|\Cake\Collection\CollectionInterface $dates
 */
?>
<div class="dates index content">
    <?= $this->Html->link(__('New Date'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Dates') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('slam_id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('slug') ?></th>
                    <th><?= $this->Paginator->sort('starttime') ?></th>
                    <th><?= $this->Paginator->sort('endtime') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dates as $date): ?>
                <tr>
                    <td><?= $this->Number->format($date->id) ?></td>
                    <td><?= $date->has('user') ? $this->Html->link($date->user->id, ['controller' => 'Users', 'action' => 'view', $date->user->id]) : '' ?></td>
                    <td><?= $date->has('slam') ? $this->Html->link($date->slam->title, ['controller' => 'Slams', 'action' => 'view', $date->slam->id]) : '' ?></td>
                    <td><?= h($date->title) ?></td>
                    <td><?= h($date->slug) ?></td>
                    <td><?= h($date->starttime) ?></td>
                    <td><?= h($date->endtime) ?></td>
                    <td><?= h($date->created) ?></td>
                    <td><?= h($date->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $date->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $date->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $date->id], ['confirm' => __('Are you sure you want to delete # {0}?', $date->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
