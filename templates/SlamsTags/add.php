<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SlamsTag $slamsTag
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Slams Tags'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="slamsTags form content">
            <?= $this->Form->create($slamsTag) ?>
            <fieldset>
                <legend><?= __('Add Slams Tag') ?></legend>
                <?php
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
