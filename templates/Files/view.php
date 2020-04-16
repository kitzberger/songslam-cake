<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit File'), ['action' => 'edit', $file->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete File'), ['action' => 'delete', $file->id], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Files'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New File'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="files view content">
            <h3><?= h($file->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $file->has('user') ? $this->Html->link($file->user->id, ['controller' => 'Users', 'action' => 'view', $file->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($file->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('File') ?></th>
                    <td><?= h($file->file) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($file->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($file->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($file->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Dates') ?></h4>
                <?php if (!empty($file->dates)) : ?>
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
                        <?php foreach ($file->dates as $dates) : ?>
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
            <div class="related">
                <h4><?= __('Related Slams') ?></h4>
                <?php if (!empty($file->slams)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Slug') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Venue') ?></th>
                            <th><?= __('Address') ?></th>
                            <th><?= __('City') ?></th>
                            <th><?= __('Zip') ?></th>
                            <th><?= __('Contact') ?></th>
                            <th><?= __('Www') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('State') ?></th>
                            <th><?= __('Longitude') ?></th>
                            <th><?= __('Latitude') ?></th>
                            <th><?= __('Sleeping') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($file->slams as $slams) : ?>
                        <tr>
                            <td><?= h($slams->id) ?></td>
                            <td><?= h($slams->user_id) ?></td>
                            <td><?= h($slams->title) ?></td>
                            <td><?= h($slams->slug) ?></td>
                            <td><?= h($slams->description) ?></td>
                            <td><?= h($slams->venue) ?></td>
                            <td><?= h($slams->address) ?></td>
                            <td><?= h($slams->city) ?></td>
                            <td><?= h($slams->zip) ?></td>
                            <td><?= h($slams->contact) ?></td>
                            <td><?= h($slams->www) ?></td>
                            <td><?= h($slams->created) ?></td>
                            <td><?= h($slams->modified) ?></td>
                            <td><?= h($slams->state) ?></td>
                            <td><?= h($slams->longitude) ?></td>
                            <td><?= h($slams->latitude) ?></td>
                            <td><?= h($slams->sleeping) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Slams', 'action' => 'view', $slams->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Slams', 'action' => 'edit', $slams->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Slams', 'action' => 'delete', $slams->id], ['confirm' => __('Are you sure you want to delete # {0}?', $slams->id)]) ?>
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
