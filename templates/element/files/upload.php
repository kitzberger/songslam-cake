<?= $this->Html->css('dropzone'); ?>
<?= $this->Html->script('dropzone'); ?>

<?php
    $id_params = null;
    if (isset($slam_id)) {
        $id_params = ['key' => 'slams[_ids][]', 'value' => $slam_id];
    }
    if (isset($date_id)) {
        $id_params = ['key' => 'dates[_ids][]', 'value' => $date_id];
    }
?>

<div class="">
    <form action="<?= $this->Url->build(['controller' => 'Files', 'action' => 'upload']) ?>" class="dropzone">
        <?php
            if ($id_params) {
                echo $this->Form->control($id_params['key'], ['type' => 'hidden', 'value' => $id_params['value']]);
            }
            echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => $currentUser['id']]);
            echo $this->Form->control('_csrfToken', ['type' => 'hidden', 'value' => $_csrfToken]);
        ?>
    </form>
</div>
