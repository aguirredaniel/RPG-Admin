<?php

namespace App\Modules\HeroModule\Domain\Races;

use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroFirstNameException;
use App\Modules\HeroModule\Domain\Exceptions\InvalidHeroLastNameException;
use App\Modules\HeroModule\Domain\HeroClass;

class HeroDwarf implements HeroRaceStrategy
{
    /**
     * Command function to set a name to a hero.
     * @param string $name name for a hero.
     * @return string.
     * @throws InvalidHeroFirstNameException
     */
    public function processFirstName($name)
    {
        if ($this->isValidName($name))
            return $name;
        else
            throw new InvalidHeroFirstNameException($name);
    }


    /**
     * Command function to process a lastName to a hero.
     * @param string $lastName lastName for a hero.
     * @return string.
     * @throws InvalidHeroLastNameException
     */
    public function processLastName($lastName)
    {
        if ($this->isValidName($lastName))
            return $lastName;
        else
            throw new InvalidHeroLastNameException($lastName);
    }

    /**
     * Query function to check if name is valid for Dwarf hero.
     * @param string $name name for a hero.
     * @return boolean.
     * @throws
     */
    private function isValidName($name)
    {
        $nameLowerCase = strtolower($name);
        $contains_r_h = strpos($nameLowerCase, 'r') || strpos($name, 'h');

        return ($contains_r_h !== false);
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
                return $heroClass != HeroClass::Ranger && $heroClass != HeroClass::Wizard;
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
        return true;
    }
}
