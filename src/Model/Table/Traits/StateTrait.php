<?php
declare(strict_types=1);

namespace App\Model\Table\Traits;

trait StateTrait
{
    protected static $states = [
        'DE' => [
            'DE_BW',
            'DE_BY',
            'DE_BE',
            'DE_BB',
            'DE_HB',
            'DE_HH',
            'DE_HE',
            'DE_NI',
            'DE_MV',
            'DE_NW',
            'DE_RP',
            'DE_SL',
            'DE_SN',
            'DE_ST',
            'DE_SH',
            'DE_TH',
        ],
        'CH' => [
            'CH',
        ],
        'AT' => [
            'AT',
        ],
    ];

    public static function getStates()
    {
        $translatedStates = [];

        foreach (self::$states as $country => $countryStates) {
            $translatedStates[__($country)] = [];
            foreach ($countryStates as $countryState) {
                $translatedStates[__($country)][$countryState] = __($countryState);
            }
        }

        return $translatedStates;
    }
}
