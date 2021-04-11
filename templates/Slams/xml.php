<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Slam[]|\Cake\Collection\CollectionInterface $slams
 */
?>
<?php foreach ($slams as $slam): ?>
    <url>
        <loc><?= $this->Url->build(['action' => 'view', $slam->slug], ['fullBase' => true]) ?></loc>
    </url>
<?php foreach ($slam->dates as $date): ?>
    <url>
        <loc><?= $this->Url->build(['controller' => 'Dates', 'action' => 'view', $date->slug], ['fullBase' => true]) ?></loc>
    </url>
<?php endforeach; ?>
<?php endforeach; ?>
