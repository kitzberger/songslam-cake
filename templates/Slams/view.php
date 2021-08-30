<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Slam $slam
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?php
                if ($currentUser) {
                    if ($currentUser->get('admin') || $slam->ownedBy($currentUser)) {
                        echo $this->Html->link(__('Edit Slam'), ['action' => 'edit', $slam->id], ['class' => 'side-nav-item']);
                        echo $this->Form->postLink(__('Delete Slam'), ['action' => 'delete', $slam->id], ['confirm' => __('Are you sure you want to delete # {0}?', $slam->id), 'class' => 'side-nav-item']);
                    }

                    echo $this->Html->link(__('New Slam'), ['action' => 'add'], ['class' => 'side-nav-item']);
                }
                echo $this->Html->link(__('New Date'), ['controller' => 'dates', 'action' => 'add', '?' => ['slam_id' => $slam->id]], ['class' => 'side-nav-item']);
                echo $this->Html->link(__('List Slams'), ['action' => 'index'], ['class' => 'side-nav-item']);
            ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="slams view content">
            <h3><?= h($slam->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($slam->title) ?></td>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($slam->modified->format('d.m.Y')) ?></td>
                </tr>
                <tr>
                    <th><?= __('Venue') ?></th>
                    <td><?= h($slam->venue) ?></td>
                    <th><?= __('Sleeping') ?></th>
                    <td><?= $slam->sleeping ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Address') ?></th>
                    <td>
                        <?= h($slam->address) ?><br>
                        <?= h(trim($slam->zip . ' ' . $slam->city)); ?><br>
                        <?= h(__($slam->state)); ?>
                    </td>
                    <th><?= __('Contact') ?></th>
                    <td><?= $this->Text->autoParagraph($this->Text->autoLink(h($slam->contact), ['target' => '_blank'])); ?></td>
                </tr>
                <tr>
                    <th><?= __('Www') ?></th>
                    <td colspan="3"><?= $this->Text->autoLinkUrls(h($slam->www), ['target' => '_blank']) ?></td>
                </tr>
                <?php if (!empty($slam->tags)): ?>
                <tr>
                    <td colspan="4">
                        <?php foreach ($slam->tags as $tags) : ?>
                            <span class="badge"><?= h($tags->title) ?></span>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <?php endif; ?>
            </table>
            <?php if ($slam->description): ?>
                <div class="text">
                    <h4><?= __('Description') ?></h4>
                    <?= $slam->description; ?>
                </div>
            <?php endif ?>
            <div class="row">
                <div class="column related">
                    <h4><?= __('Related Dates') ?></h4>
                    <?php if (!empty($slam->dates)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Starttime') ?></th>
                                <th></th>
                            </tr>
                            <?php foreach ($slam->dates as $date) : ?>
                            <tr class="<?= $date->starttime && $date->starttime->isPast() ? 'inactive' : '' ?>">
                                <td><?= $this->Html->link(
                                    ($date->starttime ? $date->starttime->format('d.m.Y') : __('???')) . ($date->title ? ' - ' . $date->title : ''),
                                    ['controller' => 'Dates', 'action' => 'view', $date->slug]) ?>
                                </td>
                                <td>
                                    <?= $date->venue ? h($date->venue) : '' ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="column files">
                    <?php if (!empty($slam->files) || $currentUser) : ?>
                        <h4><?= __('Files') ?></h4>
                        <?php if (!empty($slam->files)) : ?>
                        <div class="table-responsive">
                            <table>
                            <?php foreach ($slam->files as $file) : ?>
                                <tr>
                                    <th><?= h($file->title) ?></th>
                                    <td><?= $this->element('files/embed', ['file' => $file]) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </table>
                        </div>
                        <?php endif; ?>
                        <?= $currentUser ? $this->element('files/upload', ['slam_id' => $slam->id]) : '' ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>
