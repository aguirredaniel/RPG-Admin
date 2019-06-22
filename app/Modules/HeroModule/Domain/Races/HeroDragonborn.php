<?php

namespace App\Modules\HeroModule\Domain\Races;

use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroLastNameException;
use App\Modules\HeroModule\Domain\HeroClass;

class HeroDragonborn implements HeroRaceStrategy
{

    /**
     * Command function to process a name to a hero.
     * @param string $name name for a hero.
     * @return string.
     * @throws InvalidHeroNameException
     */
    public function processFirstName($name)
    {
        return $name;
    }

    /**
     * Command function to process a lastName to a hero.
     * @param string $lastName lastName for a hero.
     * @return string.
     * @throws InvalidHeroLastNameException
     */
    public function processLastName($lastName)
    {
        return null;
    }

    /**
     * Query function to get available class hero.
     * @param
     * @return array of available class hero.
     * @throws
     */
    public function getAvailableClass()
    {
        return array_filter(
            HeroClass::getValues(),
            function ($heroClass) {
                return $heroClass != HeroClass::Cleric;
            }
        );
    }

    /**
     * Query function to check if hero need last name.
     * @param
     * @return boolean of hero need last name.
     * @throws
     */
    public function needLastName()
    {
        return false;
    }
}
