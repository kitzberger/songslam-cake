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
                    <th><?= __('Title') ?></th>
                    <td><?= h($file->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $file->has('user') ? $this->Html->link($file->user->email, ['controller' => 'Users', 'action' => 'view', $file->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('File') ?></th>
                    <td>
                        <?php
                            if ($file->isImage()) {
                                echo $this->Glide->image($file->file, ['w' => 320], []);
                            }
                        ?>
                    </td>
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
                            <th><?= __('Title') ?></th>
                            <th><?= __('Date') ?></th>
                        </tr>
                        <?php foreach ($file->dates as $date) : ?>
                        <tr>
                            <td><?= $this->Html->link($date->title, ['controller' => 'Dates', 'action' => 'view', $date->id]) ?></td>
                            <td><?= $date->starttime ?></td>
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
                            <th><?= __('Title') ?></th>
                            <th><?= __('City') ?></th>
                        </tr>
                        <?php foreach ($file->slams as $slam) : ?>
                        <tr>
                            <td><?= $this->Html->link($slam->title, ['controller' => 'Slams', 'action' => 'view', $slam->id]) ?></td>
                            <td><?= h($slam->city) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
