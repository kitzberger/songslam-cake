<form class="filter-form" method="GET">
    <script>
        var delayTimer;
        function delayedSubmit(input) {
            clearTimeout(delayTimer);
            delayTimer = setTimeout(function() {
                input.form.submit()
            }, 500);
        }
    </script>
    <div class="row">
        <?php if (isset($sword)): ?>
        <div class="column column-20">
            <?= $this->Form->control(
                'sword',
                [
                    'label' => __('Search'),
                    'placeholder' => __('Search ...'),
                    'value' => $sword,
                    'autofocus',
                    'onfocus' => 'this.select()',
                    'onkeyup' => 'delayedSubmit(this)',
                ])
            ?>
        </div>
        <?php endif; ?>
        <?php if (isset($state)): ?>
        <div class="column column-20">
            <?= $this->Form->control(
                'state',
                [
                    'label' => __('State'),
                    'options' => [null => ''] + \App\Model\Table\SlamsTable::getStates(),
                    'value' => $state,
                    'onchange' => 'this.form.submit()'
                ]
            ) ?>
        </div>
        <?php endif; ?>
        <?php if (isset($type)): ?>
        <div class="column column-20">
            <?= $this->Form->control(
                'type',
                [
                    'label' => __('Type'),
                    'options' => [null => ''] + \App\Model\Table\SlamsTable::getTypes(),
                    'value' => $type,
                    'onchange' => 'this.form.submit()'
                ]
            ) ?>
        </div>
        <?php endif; ?>
        <?php if (isset($sleeping)):
              $this->Form->setTemplates([
                    'nestingLabel' => '<label{{attrs}}>{{text}}</label>{{hidden}}{{input}}',
                ]);
        ?>
        <div class="column column-20">
            <?= $this->Form->control(
                'sleeping',
                [
                    'label' => __('Include sleeping?'),
                    'value' => true,
                    'checked' => $sleeping,
                    'onchange' => 'this.form.submit()'
                ]
            ) ?>
         </div>
        <?php endif; ?>
        <noscript>
            <div class="column column-20">
                <input type="submit" value="<?= __('Filter') ?>" class="button button-outline" />
            </div>
        </noscript>
    </div>
</form>
