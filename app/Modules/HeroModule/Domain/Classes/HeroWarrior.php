<?php


namespace App\Modules\HeroModule\Domain\Classes;

use App\Modules\HeroModule\Domain\HeroWeapons;

class HeroWarrior implements HeroClassStrategy
{

    /**
     * Query function to get available weapons hero.
     * @param
     * @return array of available weapons hero.
     * @throws
     */
    public function getAvailableWeapons()
    {
        return HeroWeapons::getValues();
    }
}
