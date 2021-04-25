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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $date->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $date->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Dates'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="dates form content">
            <?= $this->Form->create($date) ?>
            <fieldset>
                <legend><?= __('Edit Date') ?></legend>
                <div class="row">
                    <div class="column">
                        <?= $this->Form->control('slam_id', ['options' => $slams]); ?>
                    </div>
                    <div class="column">
                        <?= $this->Form->control('starttime', ['empty' => true]); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <?= $this->Form->control('moderator'); ?>
                    </div>
                    <div class="column">
                        <?= $this->Form->control('slug'); ?>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend><?= __('Override fields') ?></legend>
                <p><?= __('These fields override the ones from the selected slam.'); ?></p>
                <div class="row">
                    <div class="column"><?= $this->Form->control('title', ['label' => __('Title (optional)')]); ?></div>
                    <div class="column"><?= $this->Form->control('contact'); ?></div>
                </div>
                <?= $this->Ck->input('description', ['label' => __('Description')], ['removePlugins' => 'image']); ?>
                <div class="row">
                    <div class="column"><?= $this->Form->control('venue'); ?></div>
                    <div class="column"><?= $this->Form->control('address'); ?></div>
                </div>
                <div class="row">
                    <div class="column"><?= $this->Form->control('zip'); ?></div>
                    <div class="column"><?= $this->Form->control('city'); ?></div>
                    <div class="column"><?= $this->Form->control('state', ['options' => [null => ''] + \App\Model\Table\Traits\StateTrait::getStates()]); ?></div>
                </div>
                <?= $this->Form->control('www'); ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
