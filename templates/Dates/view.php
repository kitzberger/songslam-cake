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
            <?= $this->Html->link(__('Edit Date'), ['action' => 'edit', $date->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Date'), ['action' => 'delete', $date->id], ['confirm' => __('Are you sure you want to delete # {0}?', $date->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Dates'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Date'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
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
                    <td><?= h($date->starttime) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($date->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($date->modified) ?></td>
                </tr>
            </table>
            <div class="files">
                <h4><?= __('Files') ?></h4>
                <?php if (!empty($date->files)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Title') ?></th>
                        </tr>
                        <?php foreach ($date->files as $file) : ?>
                        <tr>
                            <td><?= h($file->title) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
                <?= $this->element('upload', ['date_id' => $date->id]) ?>
            </div>
        </div>
    </div>
</div>
