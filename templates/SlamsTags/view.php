<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SlamsTag $slamsTag
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Slams Tag'), ['action' => 'edit', $slamsTag->slam_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Slams Tag'), ['action' => 'delete', $slamsTag->slam_id], ['confirm' => __('Are you sure you want to delete # {0}?', $slamsTag->slam_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Slams Tags'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Slams Tag'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="slamsTags view content">
            <h3><?= h($slamsTag->slam_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Slam') ?></th>
                    <td><?= $slamsTag->has('slam') ? $this->Html->link($slamsTag->slam->title, ['controller' => 'Slams', 'action' => 'view', $slamsTag->slam->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Tag') ?></th>
                    <td><?= $slamsTag->has('tag') ? $this->Html->link($slamsTag->tag->title, ['controller' => 'Tags', 'action' => 'view', $slamsTag->tag->id]) : '' ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
