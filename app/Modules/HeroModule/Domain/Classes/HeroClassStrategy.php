<?php

namespace App\Modules\HeroModule\Domain\Classes;


interface HeroClassStrategy
{
    /**
     * Query function to get available weapons hero.
     * @param
     * @return array of available weapons hero.
     * @throws
     */
    public function getAvailableWeapons();

}

