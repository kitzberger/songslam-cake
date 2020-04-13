<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Slam[]|\Cake\Collection\CollectionInterface $slams
 */
?>
<div class="slams index content">
    <?= $this->Html->link(__('New Slam'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Slams') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('slug') ?></th>
                    <th><?= $this->Paginator->sort('venue') ?></th>
                    <th><?= $this->Paginator->sort('address') ?></th>
                    <th><?= $this->Paginator->sort('city') ?></th>
                    <th><?= $this->Paginator->sort('zip') ?></th>
                    <th><?= $this->Paginator->sort('www') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('state') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($slams as $slam): ?>
                <tr>
                    <td><?= $this->Number->format($slam->id) ?></td>
                    <td><?= $slam->has('user') ? $this->Html->link($slam->user->id, ['controller' => 'Users', 'action' => 'view', $slam->user->id]) : '' ?></td>
                    <td><?= h($slam->title) ?></td>
                    <td><?= h($slam->slug) ?></td>
                    <td><?= h($slam->venue) ?></td>
                    <td><?= h($slam->address) ?></td>
                    <td><?= h($slam->city) ?></td>
                    <td><?= h($slam->zip) ?></td>
                    <td><?= h($slam->www) ?></td>
                    <td><?= h($slam->created) ?></td>
                    <td><?= h($slam->modified) ?></td>
                    <td><?= h($slam->state) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $slam->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $slam->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $slam->id], ['confirm' => __('Are you sure you want to delete # {0}?', $slam->id)]) ?>
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
