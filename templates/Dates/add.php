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
                    echo $this->Form->control('date', ['empty' => true, 'type' => 'date']);
                    echo $this->Form->control('time', ['empty' => true, 'step' => 60, 'value' => '20:00', 'type' => 'time']);
                    echo $this->Form->control('title', ['label' => __('Title (optional)')]);
                ?>
            </fieldset>
            <?= $this->Form->hidden('saveAndNew', ['value' => 0, 'id' => 'saveAndNew']) ?>
            <?= $this->Form->button(__('Submit and back'), ['onclick' => 'return setHiddenFields(0)']) ?>
            <?= $this->Form->button(__('Submit and new'), ['onclick' => 'return setHiddenFields(1)']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
