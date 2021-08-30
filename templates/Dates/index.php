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
                    <th><?= $this->Paginator->sort('Dates.starttime', __('Starttime')) ?></th>
                    <th><?= __('Slam') ?></th>
                    <th><?= $this->Paginator->sort('Slams.city', __('City')) ?></th>
                    <th><?= $this->Paginator->sort('Slams.venue', __('Location')) ?></th>
                    <?php if($currentUser): ?>
                    <th class="actions"><?= __('Actions') ?></th>
                    <?php endif ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dates as $date): ?>
                <tr>
                    <td><?= $this->Html->link($date->starttime->format('d.m.Y'), ['controller' => 'Dates', 'action' => 'view', $date->slug]) ?></td>
                    <td><?= $this->Html->link($date->title ?: ($date->has('slam') ? $date->slam->title : __('???')), ['controller' => 'Dates', 'action' => 'view', $date->slug]) ?></td>
                    <td><?= $date->city ? h($date->city) : ($date->has('slam') ? h($date->slam->city) : '') ?></td>
                    <td><?= $date->venue ? h($date->venue) : ($date->has('slam') ? h($date->slam->venue) : '') ?></td>
                    <?php if($currentUser): ?>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $date->slug]) ?>
                        <?php
                            if ($currentUser->get('admin') || $date->slam->ownedBy($currentUser)) {
                                echo $this->Html->link(__('Edit'), ['action' => 'edit', $date->id]);
                                echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $date->id], ['confirm' => __('Are you sure you want to delete # {0}?', $date->id)]);
                            }
                        ?>
                    </td>
                    <?php endif ?>
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
