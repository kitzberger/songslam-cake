<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="column-responsive column-100">
        <div class="users form content">
            <h3 class="heading"><?= __('Login') ?></h3>
            <?= $this->Form->create() ?>
            <fieldset>
                <legend><?= __('Please enter your credentials here!') ?></legend>
                <?php
                    echo $this->Form->control('email', ['label' => __('E-Mail')]);
                    echo $this->Form->control('password');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
