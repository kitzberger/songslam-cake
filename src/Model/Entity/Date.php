<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Date Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $slam_id
 * @property string $title
 * @property string $slug
 * @property \Cake\I18n\FrozenTime|null $starttime
 * @property \Cake\I18n\FrozenTime|null $endtime
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Slam $slam
 */
class Date extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'slam_id' => true,
        'title' => true,
        'slug' => true,
        'starttime' => true,
        'endtime' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'slam' => true,
    ];
}
