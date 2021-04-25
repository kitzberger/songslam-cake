<?php
declare(strict_types=1);

namespace App\Model\Table\Traits;

use Cake\Event\EventInterface;

trait GeolocationTrait
{
    public function beforeSave(EventInterface $event, $entity, $options)
    {
        if ($entity->isDirty('city') || $entity->isDirty('zip') || $entity->isDirty('address')) {
            switch (substr($entity->state, 0, 2)) {
                case 'AT': $country = 'Austria'; break;
                case 'CH': $country = 'Switzerland'; break;
                case 'DE': $country = 'Germany'; break;
            }

            if ($entity->address && $entity->city) {
                $url = "https://nominatim.openstreetmap.org/";
                $nominatim = new \maxh\Nominatim\Nominatim($url);
                $search = $nominatim
                    ->newSearch()
                    ->country($country)
                    ->city($entity->city)
                    ->postalCode($entity->zip)
                    ->street($entity->address);
                $result = $nominatim->find($search);

                if (!empty($result)) {
                    $entity->longitude = $result[0]['lon'];
                    $entity->latitude = $result[0]['lat'];
                }
                #debug($search); debug($result); die();
            }
        }
    }
}
