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
            <?= $this->Html->link(__('List Dates'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <script type="text/javascript">
            function setHiddenFields(saveAndNew = 0) {
                document.getElementById('saveAndNew').value = saveAndNew
                let date = document.getElementById('date').value
                let time = document.getElementById('time').value
                let datetime = date + 'T' + time
                document.getElementById('starttime').value = datetime.slice(0, 16)
                return true
            }
        </script>
        <div class="dates form content">
            <?= $this->Form->create($date, ['valueSources' => ['query', 'context']]) ?>
            <fieldset>
                <legend><?= __('Add Date') ?></legend>
                <?php
                    echo $this->Form->hidden('user_id', ['value' => $currentUser->getIdentifier()]);
                    echo $this->Form->control('slam_id', ['options' => $slams, 'empty' => true]);
                    echo $this->Form->hidden('starttime', ['id' => 'starttime']);
                ?>
                <div class="row">
                    <div class="column"><?= $this->Form->control('date', ['empty' => true, 'type' => 'date', 'autofocus' => 1]); ?></div>
                    <div class="column"><?= $this->Form->control('time', ['empty' => true, 'step' => 60, 'value' => '20:00', 'type' => 'time']); ?></div>
                </div>
                <?= $this->Form->control('moderator'); ?>
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
            <?= $this->Form->hidden('saveAndNew', ['value' => 0, 'id' => 'saveAndNew']) ?>
            <?= $this->Form->button(__('Submit and another one'), ['onclick' => 'return setHiddenFields(1)']) ?>
            <?= $this->Form->button(__('Submit and back'), ['onclick' => 'return setHiddenFields(0)', 'class' => 'button-outline']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
