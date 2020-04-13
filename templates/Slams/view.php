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
            <?= $this->Html->link(__('Edit Slam'), ['action' => 'edit', $slam->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Slam'), ['action' => 'delete', $slam->id], ['confirm' => __('Are you sure you want to delete # {0}?', $slam->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Slams'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Slam'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="slams view content">
            <h3><?= h($slam->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $slam->has('user') ? $this->Html->link($slam->user->id, ['controller' => 'Users', 'action' => 'view', $slam->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($slam->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Slug') ?></th>
                    <td><?= h($slam->slug) ?></td>
                </tr>
                <tr>
                    <th><?= __('Venue') ?></th>
                    <td><?= h($slam->venue) ?></td>
                </tr>
                <tr>
                    <th><?= __('Address') ?></th>
                    <td><?= h($slam->address) ?></td>
                </tr>
                <tr>
                    <th><?= __('City') ?></th>
                    <td><?= h($slam->city) ?></td>
                </tr>
                <tr>
                    <th><?= __('Zip') ?></th>
                    <td><?= h($slam->zip) ?></td>
                </tr>
                <tr>
                    <th><?= __('Www') ?></th>
                    <td><?= h($slam->www) ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= h($slam->state) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($slam->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($slam->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($slam->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($slam->description)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Contact') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($slam->contact)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Tags') ?></h4>
                <?php if (!empty($slam->tags)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($slam->tags as $tags) : ?>
                        <tr>
                            <td><?= h($tags->id) ?></td>
                            <td><?= h($tags->title) ?></td>
                            <td><?= h($tags->created) ?></td>
                            <td><?= h($tags->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Tags', 'action' => 'view', $tags->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Tags', 'action' => 'edit', $tags->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tags', 'action' => 'delete', $tags->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tags->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Dates') ?></h4>
                <?php if (!empty($slam->dates)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Slam Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Slug') ?></th>
                            <th><?= __('Starttime') ?></th>
                            <th><?= __('Endtime') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($slam->dates as $dates) : ?>
                        <tr>
                            <td><?= h($dates->id) ?></td>
                            <td><?= h($dates->user_id) ?></td>
                            <td><?= h($dates->slam_id) ?></td>
                            <td><?= h($dates->title) ?></td>
                            <td><?= h($dates->slug) ?></td>
                            <td><?= h($dates->starttime) ?></td>
                            <td><?= h($dates->endtime) ?></td>
                            <td><?= h($dates->created) ?></td>
                            <td><?= h($dates->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Dates', 'action' => 'view', $dates->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Dates', 'action' => 'edit', $dates->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Dates', 'action' => 'delete', $dates->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dates->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
