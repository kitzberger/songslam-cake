<form class="filter-form" method="GET">
    <div class="row">
        <?php
            if (isset($sword)):
        ?>
        <div class="column column-25">
            <?= $this->Form->control(
                'sword',
                [
                    'label' => __('Search'),
                    'placeholder' => __('Search ...'),
                    'value' => $sword,
                    'autofocus',
                    'onfocus' => 'this.select()'
                ])
            ?>
        </div>
        <?php
            endif;
        ?>
        <?php
            if (isset($state)):
        ?>
        <div class="column column-25">
            <?= $this->Form->control('state', ['label' => __('State'), 'options' => [null => ''] + \App\Model\Table\SlamsTable::STATES, 'value' => $state]) ?>
        </div>
        <?php
            endif;
        ?>
        <?php
            if (isset($sleeping)):
              $this->Form->setTemplates([
                    'nestingLabel' => '<label{{attrs}}>{{text}}</label>{{hidden}}{{input}}',
                ]);
        ?>
        <div class="column column-20">
            <?= $this->Form->control('sleeping', ['label' => __('Include sleeping?'), 'value' => true, 'checked' => $sleeping]) ?>
         </div>
        <?php
            endif;
        ?>
        <div class="column column-30">
            <input type="submit" value="<?= __('Filter') ?>" class="button button-outline" />
        </div>
    </div>
</form>
