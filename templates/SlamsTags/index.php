<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SlamsTag[]|\Cake\Collection\CollectionInterface $slamsTags
 */
?>
<div class="slamsTags index content">
    <?= $this->Html->link(__('New Slams Tag'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Slams Tags') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('slam_id') ?></th>
                    <th><?= $this->Paginator->sort('tag_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($slamsTags as $slamsTag): ?>
                <tr>
                    <td><?= $slamsTag->has('slam') ? $this->Html->link($slamsTag->slam->title, ['controller' => 'Slams', 'action' => 'view', $slamsTag->slam->id]) : '' ?></td>
                    <td><?= $slamsTag->has('tag') ? $this->Html->link($slamsTag->tag->title, ['controller' => 'Tags', 'action' => 'view', $slamsTag->tag->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $slamsTag->slam_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $slamsTag->slam_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $slamsTag->slam_id], ['confirm' => __('Are you sure you want to delete # {0}?', $slamsTag->slam_id)]) ?>
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
