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
                    <th><?= __('Title') ?></th>
                    <td><?= h($slam->title) ?></td>
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
                    <th><?= __('Longitude') ?></th>
                    <td><?= $this->Number->format($slam->longitude) ?></td>
                </tr>
                <tr>
                    <th><?= __('Latitude') ?></th>
                    <td><?= $this->Number->format($slam->latitude) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($slam->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($slam->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sleeping') ?></th>
                    <td><?= $slam->sleeping ? __('Yes') : __('No'); ?></td>
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
                            <th><?= __('Title') ?></th>
                        </tr>
                        <?php foreach ($slam->tags as $tags) : ?>
                        <tr>
                            <td><?= h($tags->title) ?></td>
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
                            <th><?= __('Starttime') ?></th>
                            <th><?= __('Title') ?></th>
                        </tr>
                        <?php foreach ($slam->dates as $date) : ?>
                        <tr>
                            <td><?= $this->Html->link($date->starttime, ['controller' => 'Dates', 'action' => 'view', $date->slug]) ?></td>
                            <td><?= $this->Html->link($date->title, ['controller' => 'Dates', 'action' => 'view', $date->slug]) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
