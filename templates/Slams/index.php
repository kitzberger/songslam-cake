<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Slam[]|\Cake\Collection\CollectionInterface $slams
 */
?>
<div class="slams index content">
    <?= $this->Html->link(__('New Slam'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3>
        <?= __('Slams') ?>
        <small>
            <?= $this->Html->link(__('List'), ['action' => 'index'], ['class' => 'active']) ?>
            /
            <?= $this->Html->link(__('Map'), ['action' => 'map']) ?>
        </small>
    </h3>
    <?= $this->element('sword', ['sword' => $sword]) ?>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('state') ?></th>
                    <th><?= $this->Paginator->sort('city') ?></th>
                    <th><?= $this->Paginator->sort('venue') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($slams as $slam): ?>
                <tr class="<?= $slam->sleeping?'inactive':'' ?>">
                    <td><?= h($slam->state) ?></td>
                    <td><?= h($slam->city) ?></td>
                    <td><?= h($slam->venue) ?></td>
                    <td><?= $this->Html->link($slam->title, ['action' => 'view', $slam->slug]) ?></td>
                    <td><?= h($slam->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $slam->slug]) ?>
                        <?php
                            if ($currentUser && $currentUser->get('admin')) {
                                echo $this->Html->link(__('Edit'), ['action' => 'edit', $slam->id]);
                                echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $slam->id], ['confirm' => __('Are you sure you want to delete # {0}?', $slam->id)]);
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
