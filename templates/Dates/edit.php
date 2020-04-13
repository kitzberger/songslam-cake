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
                <?php
                    echo $this->Form->control('slam_id', ['options' => $slams]);
                    echo $this->Form->control('title');
                    echo $this->Form->control('slug');
                    echo $this->Form->control('starttime', ['empty' => true]);
                    echo $this->Form->control('endtime', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
