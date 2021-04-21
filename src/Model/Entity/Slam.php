<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Slam Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property string $venue
 * @property string $address
 * @property string $city
 * @property string $zip
 * @property string|null $contact
 * @property string $www
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string $state
 * @property string|null $longitude
 * @property string|null $latitude
 * @property bool|null $sleeping
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Date[] $dates
 * @property \App\Model\Entity\Tag[] $tags
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\File[] $files
 */
class Slam extends Entity
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
        'title' => true,
        'slug' => true,
        'description' => true,
        'venue' => true,
        'address' => true,
        'city' => true,
        'zip' => true,
        'contact' => true,
        'www' => true,
        'created' => true,
        'modified' => true,
        'state' => true,
        'longitude' => true,
        'latitude' => true,
        'sleeping' => true,
        'user' => true,
        'dates' => true,
        'tags' => true,
        'users' => true,
        'files' => true,
    ];

    public function ownedBy($user)
    {
        return (in_array($user->id, array_column($this->users ?? [], 'id')));
    }
}
