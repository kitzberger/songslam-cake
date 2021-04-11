<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Slam $slam
 */
?>
<div class="row">
    <div class="column-responsive">
        <div class="slams form content">
            <?php
                if ($errors = $contact->getErrors()) {
                    echo '<ul class="message error">';
                    foreach ($errors as $fieldName => $fieldErrors) {
                        echo '<li>' . $fieldName . ': ' . join(', ', $fieldErrors) . '</li>';
                    }
                    echo '</ul>';
                }
            ?>
            <fieldset>
                <legend><?= __('You want to suggest a new slam?') ?></legend>
                <?php
                    echo $this->Form->create($contact);
                    echo $this->Form->control('name', ['label' => __('Your name')]);
                    echo $this->Form->control('email', ['label' => __('Your email')]);
                    echo $this->Form->control('slamname', ['label' => __('Slam name')]);
                    echo $this->Form->control('slamcity', ['label' => __('Slam city')]);
                    echo $this->Form->control('slaminfo', ['label' => __('Slam information')]);
                    echo $this->Form->button(__('Submit'));
                    echo $this->Form->end();
                ?>
            </fieldset>
        </div>
    </div>
</div>
