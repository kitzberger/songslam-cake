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
            <?= $this->Html->link(__('List Slams'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <script type="text/javascript">
            function setHiddenFields(saveAndAddDates = 0) {
                document.getElementById('saveAndAddDates').value = saveAndAddDates
                return true
            }
        </script>
        <div class="slams form content">
            <?= $this->Form->create($slam) ?>
            <fieldset>
                <legend><?= __('Add Slam') ?></legend>
                <?php
                    echo $this->Form->hidden('user_id', ['value' => $currentUser->getIdentifier()]);
                    echo $this->Form->hidden('users._ids[]', ['value' => $currentUser->getIdentifier()]);
                    echo $this->Form->control('title');
                ?>
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
            <?= $this->Form->hidden('saveAndAddDates', ['value' => 0, 'id' => 'saveAndAddDates']) ?>
            <?= $this->Form->button(__('Submit and back'), ['onclick' => 'return setHiddenFields(0)']) ?>
            <?= $this->Form->button(__('Submit and add dates'), ['onclick' => 'return setHiddenFields(1)']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
