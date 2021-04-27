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
                    echo $this->Form->hidden('user_id', ['value' => $currentUser->getIdentifier()]);
                ?>
                <div class="row">
                    <div class="column"><?= $this->Form->control('title'); ?></div>
                    <div class="column"><?= $this->Form->control('slug'); ?></div>
                </div>
                <div class="row">
                    <div class="column"><?= $this->Form->control('type', ['options' => \App\Model\Table\SlamsTable::getTypes()]) ?></div>
                    <div class="column"><?= $this->Form->control('sleeping'); ?></div>
                </div>
                <div class="row">
                    <div class="column"><?= $this->Form->control('contact'); ?></div>
                    <div class="column"><?= $this->Form->control('tags._ids', ['options' => $tags]); ?></div>
                </div>
                <div class="row">
                    <div class="column"><?= $this->Form->control('venue'); ?></div>
                    <div class="column"><?= $this->Form->control('address'); ?></div>
                </div>
                <div class="row">
                    <div class="column"><?= $this->Form->control('zip'); ?></div>
                    <div class="column"><?= $this->Form->control('city'); ?></div>
                    <div class="column"><?= $this->Form->control('state', ['options' => [null => ''] + \App\Model\Table\SlamsTable::getStates()]) ?></div>
                </div>
                <?php
                    echo $this->Form->control('www');
                    echo $this->Ck->input('description', ['label' => __('Description')], ['removePlugins' => 'image']);
                ?>
            </fieldset>
            <fieldset>
                <legend><?= __('Geo Infos'); ?></legend>
                <div class="row">
                    <div class="column"><?= $this->Form->control('longitude', ['readonly' => true, 'disabled' => true]); ?></div>
                    <div class="column"><?= $this->Form->control('latitude', ['readonly' => true, 'disabled' => true]); ?></div>
                </div>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
