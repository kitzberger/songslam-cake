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
                    echo $this->Form->control('venue');
                    echo $this->Ck->input('description', ['label' => __('Description')], ['removePlugins' => 'image']);
                    echo $this->Form->control('address');
                    echo $this->Form->control('zip');
                    echo $this->Form->control('city');
                    echo $this->Form->control('state', ['options' => [null => ''] + \App\Model\Table\SlamsTable::STATES]);
                    echo $this->Form->control('contact');
                    echo $this->Form->control('www');
                    echo $this->Form->control('sleeping');
                    echo $this->Form->control('tags._ids', ['options' => $tags]);
                ?>
            </fieldset>
            <?= $this->Form->hidden('saveAndAddDates', ['value' => 0, 'id' => 'saveAndAddDates']) ?>
            <?= $this->Form->button(__('Submit and back'), ['onclick' => 'return setHiddenFields(0)']) ?>
            <?= $this->Form->button(__('Submit and add dates'), ['onclick' => 'return setHiddenFields(1)']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
