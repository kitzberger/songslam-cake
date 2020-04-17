<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * File Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $file
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Date[] $dates
 * @property \App\Model\Entity\Slam[] $slams
 */
class File extends Entity
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
        'file' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'dates' => true,
        'slams' => true,
    ];

    public function getExtension()
    {
        $fileFormat = strtolower(pathinfo($this->file, PATHINFO_EXTENSION));
        if ($fileFormat === 'mp3') {
            $fileFormat = 'mpeg';
        }
        return $fileFormat;
    }

    public function isAudio()
    {
        $fileFormat = $this->getExtension();
        return in_array($fileFormat, ['mp3', 'mpeg', 'ogg', 'wav', 'flac']);
    }

    public function isImage()
    {
        $fileFormat = $this->getExtension();
        return in_array($fileFormat, ['jpg', 'jpeg', 'png', 'gif']);
    }

    public function getType()
    {
        return $this->isAudio() ? 'audio' : ($this->isImage() ? 'image' : 'other');
    }

    public function getDimensions()
    {
        $size = getimagesize(WWW_ROOT . 'uploads' . DS . $this->file);
        return [
            'w' => $size[0],
            'h' => $size[1],
            'r' => $size[0] / $size[1],
        ];
    }
}
