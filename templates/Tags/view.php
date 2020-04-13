<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tag $tag
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Tag'), ['action' => 'edit', $tag->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Tag'), ['action' => 'delete', $tag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tag->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Tags'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Tag'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tags view content">
            <h3><?= h($tag->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($tag->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($tag->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($tag->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($tag->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Slams') ?></h4>
                <?php if (!empty($tag->slams)) : ?>
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
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($tag->slams as $slams) : ?>
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
