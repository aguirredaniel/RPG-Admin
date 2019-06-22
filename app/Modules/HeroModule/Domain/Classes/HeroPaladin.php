<?php


namespace App\Modules\HeroModule\Domain\Classes;


use App\Modules\HeroModule\Domain\HeroWeapons;

class HeroPaladin implements HeroClassStrategy
{
    const AvailableWeapons = array(HeroWeapons::Sword, HeroWeapons::Dagger );

    /**
     * Query function to get available weapons hero.
     * @param
     * @return array of available weapons hero.
     * @throws
     */
    public function getAvailableWeapons()
    {
        return self::AvailableWeapons;
    }
}
