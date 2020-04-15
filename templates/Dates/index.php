<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Date[]|\Cake\Collection\CollectionInterface $dates
 */
?>
<div class="dates index content">
    <?= $this->Html->link(__('New Date'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Dates') ?></h3>
    <?= $this->element('sword', ['sword' => $sword]) ?>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('slam_id') ?></th>
                    <th><?= $this->Paginator->sort('starttime') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dates as $date): ?>
                <tr>
                    <td><?= $date->has('slam') ? $this->Html->link($date->slam->title, ['controller' => 'Slams', 'action' => 'view', $date->slam->slug]) : '' ?></td>
                    <td><?= $this->Html->link($date->starttime, ['controller' => 'Dates', 'action' => 'view', $date->slug]) ?></td>
                    <td><?= $this->Html->link($date->title, ['controller' => 'Dates', 'action' => 'view', $date->slug]) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $date->slug]) ?>
                        <?php
                            if ($currentUser && $currentUser->get('admin')) {
                                echo $this->Html->link(__('Edit'), ['action' => 'edit', $date->id]);
                                echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $date->id], ['confirm' => __('Are you sure you want to delete # {0}?', $date->id)]);
                            }
                        ?>
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
