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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $slam->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $slam->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Slams'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="slams form content">
            <?= $this->Form->create($slam) ?>
            <fieldset>
                <legend><?= __('Edit Slam') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('title');
                    echo $this->Form->control('slug');
                    echo $this->Form->control('description');
                    echo $this->Form->control('venue');
                    echo $this->Form->control('address');
                    echo $this->Form->control('city');
                    echo $this->Form->control('zip');
                    echo $this->Form->control('contact');
                    echo $this->Form->control('www');
                    echo $this->Form->control('state');
                    echo $this->Form->control('tags._ids', ['options' => $tags]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
