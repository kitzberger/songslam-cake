<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Slam[]|\Cake\Collection\CollectionInterface $slams
 */
?>
<div class="slams index content">
    <?php
        if ($currentUser) {
            echo $this->Html->link(__('New Slam'), ['action' => 'add'], ['class' => 'button float-right']);
        } else {
            echo $this->Html->link(__('New Slam'), ['action' => 'suggest'], ['class' => 'button float-right']);
        }
    ?>
    <h3>
        <?= __('Slams') ?>
    </h3>
    <?= $this->element('sword', ['sword' => $sword]) ?>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('Slams.state', __('State')) ?></th>
                    <th><?= $this->Paginator->sort('Slams.city', __('City')) ?></th>
                    <th><?= $this->Paginator->sort('Slams.venue', __('Venue')) ?></th>
                    <th><?= $this->Paginator->sort('Slams.title', __('Title')) ?></th>
                    <th><?= $this->Paginator->sort('Slams.modified', __('Modified')) ?></th>
                    <?php if($currentUser): ?>
                        <th class="actions"></th>
                    <?php endif ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($slams as $slam): ?>
                <tr class="<?= $slam->sleeping?'inactive':'' ?>">
                    <td><?= h($slam->state) ?></td>
                    <td><?= h($slam->city) ?></td>
                    <td><?= h($slam->venue) ?></td>
                    <td><?= $this->Html->link($slam->title, ['action' => 'view', $slam->slug]) ?></td>
                    <td><?= h($slam->modified->format('d.m.Y')) ?></td>
                    <?php if($currentUser): ?>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $slam->slug]) ?>
                            <?php
                                if ($currentUser->get('admin') || $slam->ownedBy($currentUser)) {
                                    echo $this->Html->link(__('Edit'), ['action' => 'edit', $slam->id]);
                                    echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $slam->id], ['confirm' => __('Are you sure you want to delete # {0}?', $slam->id)]);
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
